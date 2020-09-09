<?php
require_once 'funciones/funciones.php';
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

$consulta = $conexion -> prepare("
	SELECT * FROM consultorios order by idconsultorio");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
	$mensaje .= 'NO HAY CONSULTORIOS PARA MOSTRAR';
}
$select = 5;
if (!empty($_POST['btnMostrar'])) {

   (isset($_POST["select"])) ? $select = $_POST["select"] : $select=5;
}

if (isset($_GET['order'])){
  $order = $_GET['order'];
} else {
  $order = 'idConsultorio';
}

if (isset($_GET['sort'])){
  $sort = $_GET['sort'];
} else{
  $sort = 'DESC';
}

$array = [5,10,15];
$CantidadRegistrosPorPagina = $select;
$total = COUNT($consulta);

$PaginasAMostrar = round($total / $CantidadRegistrosPorPagina);

//si me viene valor por GET de la variable de paginacion, lo uso. 
//Sino por defecto sera 0, es decir q muestre a partir del registro 0
$RegistroInicial = !empty($_GET['page']) && $_GET['page'] > 1 ? ($_GET['page'] - 1) * $CantidadRegistrosPorPagina : 0;

$consulta = $conexion -> prepare("
	SELECT * FROM consultorios order by $order $sort limit $RegistroInicial, $CantidadRegistrosPorPagina");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
	$mensaje .= 'NO HAY CONSULTORIOS PARA MOSTRAR';
}

$sort == 'ASC' ? $sort = 'DESC' : $sort = 'ASC'; 
$sort == 'ASC' ? $arrow = '<img src="img/sort-desc.png" width="10px" height="10px"/>' : $arrow =  '<img src="img/sort-asc.png" width="10px" height="10px"/>';

if (!empty($_POST['btnBuscar1'])) {
    //limpio de espacios el filtro ingresado
    $_POST['PatronNombre']=trim($_POST['PatronNombre']);
    
    //valido q el filtro al menos tenga valor
    if (!empty($_POST['PatronNombre'])) {
        $consulta=BuscarConsultorio($_POST['PatronNombre']);
        if (!empty($consulta)) {
            $mensaje='Se encontraron '.count($consulta).' registros con ese filtro de b&uacute;squeda.';
        }else {
            $mensaje='Esta b&uacute;squeda no arroja resultados.';
        }
           
    }else {
        $mensaje='El filtro debe llevar algun valor para poder buscar.';
    }
}
?>
<?php include 'plantillas/header.php'; ?>
	</div>
	<section class="main">
        Usuario Activo: <?php echo ucfirst($_SESSION['usuario']); ?>
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>CONSULTORIOS</h2>
					</div>
					<table>
					  <form method="post">
                            <select name="select" id= "select">
                        <?php foreach ($array as $arreglo) {
                             $select = !empty($_POST['select']) && $_POST['select'] == $arreglo ? 'selected' : '';
                         ?>
                         <option value="<?php print($arreglo); ?>"  <?php echo $select; ?>><?php print($arreglo); ?></option>   
                         <?php }  ?>
                        </select>
                        <input type="submit" name="btnMostrar" value="Mostrar" />
			          	<label> Nombre: </label>
			            <input type="text" placeholder="" name="PatronNombre" value="<?php echo !empty($_POST['PatronNombre'])? $_POST['PatronNombre']: ''; ?>" />
			            <input type="submit" name="btnBuscar1" value="Buscar " />
			          </form>
						<a class="agregar" href="agregarconsultorios.php">Agregar Consultorio</a>
					</table>	
						<table class="tabla">
						  <tr>
                            <?php echo "<th><a href='consultorios.php?order=idConsultorio&sort=".$sort."'>Nº".$arrow."</a></th>";?>
                            <?php echo "<th><a href='consultorios.php?order=conNombre&sort=".$sort."'>Nombre".$arrow."</a></th>";?>
							<th colspan="2">Opciones</th>
						  </tr>
						<?php foreach ($consulta as $Sql): ?>
						<tr>
						<?php echo "<td>". $Sql['idConsultorio']. "</td>"; ?>
						<?php echo "<td>". $Sql['conNombre']. "</td>"; ?>
                        <?php echo "<td class='centrar'>"."<a href='actualizarconsultorio.php?idConsultorio=".$Sql['idConsultorio']."' class='editar'>Editar</a>". "</td>"; ?>
						<?php echo "<td class='centrar'>"."<a href='eliminar_consultorio.php?idConsultorio=".$Sql['idConsultorio']."' class='eliminar'>Eliminar</a>". "</td>"; ?>
						</tr>
						<?php endforeach; ?>
						</table>
						<?php  if(!empty($mensaje)): ?>
							<ul>
							  <?php echo $mensaje; ?>
							</ul>
						<?php  endif; ?>
				<?php
			//PAGINACIÓN
            //agrego el link a la pagina anterior 
            //si no tengo la variable q viaja por GET, debo mostrar el listado de la pagina 1, y el Anterior no debe ser link
            if (empty($_GET['page'])) {
                $PaginaAnterior = '';
                
            } else if ($_GET['page'] == 1) {
                //si tengo la variable q viaja por GET, y es la primer pagina, debo mostrar el listado de la pagina 1, y el Anterior tampoco debe ser link
                $PaginaAnterior = '';
                
            } else if ($_GET['page'] < $PaginasAMostrar) {
                //si tengo la variable GET y es alguna pagina intermedia, agrego 1 para la proxima page
                $PaginaAnterior = '?page=' . ($_GET['page'] + 1);
            }

            //se mostrara si estoy en la pagina 2 o superior.
            //No deberia ver una pagina anterior si estoy en la pagina 1 con los primeros registros
            if (!empty($PaginaAnterior)) {
                ?> 
                <a href="consultorios.php<?php echo $PaginaAnterior; ?>" >Anterior </a>
            <?php } else { ?>
                Anterior
            <?php } ?>


            <?php for ($j = 1; $j <= $PaginasAMostrar; $j++) { ?>
                * <a href="consultorios.php?page=<?php echo $j; ?>"> <?php echo $j; ?> </a>
            <?php } ?>


            <?php
            //agrego el link a la pagina siguiente 
            //si no tengo la variable q viaja por GET, debo mostrar el listado de la pagina 1, y el Siguiente apunta a la page 2
            if (empty($_GET['page'])) {
                $PaginaSiguiente = '?page=2';
            } else if ($_GET['page'] < $PaginasAMostrar) {
                //si tengo la variable GET y es alguna pagina intermedia, agrego 1 para la proxima page
                $PaginaSiguiente = '?page=' . ($_GET['page'] + 1);
            } else if ($_GET['page'] == $PaginasAMostrar) {
                //si la variable GET tiene el valor de la ultima pagina, no le doy valor al Siguiente
                $PaginaSiguiente = '';
            }

            if (!empty($PaginaSiguiente)) {
                ?> 
                * <a href="consultorios.php<?php echo $PaginaSiguiente; ?>" >Siguiente </a>
            <?php } else { ?>
                Siguiente
            <?php } ?>		
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>