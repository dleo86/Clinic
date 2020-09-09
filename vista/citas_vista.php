<?php
require_once 'funciones/funciones.php';
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

$consulta = $conexion -> prepare("
		SELECT 	* FROM citas order by idcita DESC");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
	$mensaje .= 'NO HAY CITAS PARA MOSTRAR';
}
$select = 5;

if (isset($_GET['order'])){
	$order = $_GET['order'];
} else {
	$order = 'idcita';
}

if (isset($_GET['sort'])){
	$sort = $_GET['sort'];
} else{
	$sort = 'DESC';
}
/*
$consulta = $conexion -> prepare("
		SELECT 	* FROM citas order by $order $sort limit 5");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
	$mensaje .= 'NO HAY CITAS PARA MOSTRAR';
}
$select = 5;*/
if (!empty($_POST['btnMostrar'])) {

   (isset($_POST["select"])) ? $select = $_POST["select"] : $select=5;
}


$array = [5,10,15];
$CantidadRegistrosPorPagina = $select;
$total = COUNT($consulta);

$PaginasAMostrar = round($total / $CantidadRegistrosPorPagina);

//si me viene valor por GET de la variable de paginacion, lo uso. 
//Sino por defecto sera 0, es decir q muestre a partir del registro 0
$RegistroInicial = !empty($_GET['page']) && $_GET['page'] > 1 ? ($_GET['page'] - 1) * $CantidadRegistrosPorPagina : 0;

$consulta = $conexion -> prepare("
		SELECT 	* FROM citas order by $order $sort limit $RegistroInicial,$CantidadRegistrosPorPagina");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
	$mensaje .= 'NO HAY CITAS PARA MOSTRAR';
}

if(!empty($_POST['btnBuscar'])){
 $date1 = $_POST['date1'];
 $date2 = $_POST['date2'];
 $consulta = $conexion -> prepare("
		SELECT * FROM citas WHERE citfecha BETWEEN '$date1' AND '$date2' order by $order $sort limit 5");

 $consulta ->execute();
 $consulta = $consulta ->fetchAll();
 if(!$consulta){
	$mensaje .= 'NO HAY CITAS PARA MOSTRAR';
 }
}

$sort == 'ASC' ? $sort = 'DESC' : $sort = 'ASC'; 
$sort == 'ASC' ? $arrow = '<img src="img/sort-desc.png" width="10px" height="10px"/>' : $arrow =  '<img src="img/sort-asc.png" width="10px" height="10px"/>';

if (!empty($_POST['btnBuscar1'])) {
    //limpio de espacios el filtro ingresado
    $_POST['PatronNombre']=trim($_POST['PatronNombre']);
    
    //valido q el filtro al menos tenga valor
    if (!empty($_POST['PatronNombre'])) {
        $consulta=BuscarPaciente($_POST['PatronNombre']);
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
	
	<section class="main">
		Usuario Activo: <?php echo ucfirst($_SESSION['usuario']); ?>
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>CITAS</h2>
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
			          <label>Desde: </label>
			          <input type="date"  placeholder="Start" name="date1" />
			          <label> Hasta: </label>
			          <input type="date" placeholder="End" name="date2" />
			          
			          <input type="submit" name="btnBuscar" value="Buscar" />
			          </form>
			          <form method="post">
			          	<label> Paciente: </label>
			            <input type="text" placeholder="" name="PatronNombre" value="<?php echo !empty($_POST['PatronNombre'])? $_POST['PatronNombre']: ''; ?>" />
			            <input type="submit" name="btnBuscar1"  value="Buscar " />
			          </form>
			          <form action="vista/informe_citas.php" target="_black" method="post">
			          	<br>
			          	<label>Desde: </label>
			            <input type="date"  placeholder="Start" name="date1" />
			            <label> Hasta: </label>
			            <input type="date" placeholder="End" name="date2" />
			          	<input type="submit" name="btnPDF" class="agregar"  value="Mostrar PDF " />
			          </form>
			          
		            
					<a class="agregar" href="agregarcitas.php">Agregar Cita</a></table>
					<table class="tabla">
						  
						  <tr>
							<?php echo "<th><a href='citas.php?order=idcita&sort=".$sort."'>Nº".$arrow."</a></th>";?>
							<?php echo "<th><a href='citas.php?order=citfecha&sort=".$sort."'>Fecha".$arrow."</a></th>";?>
							<th>Hora Inicio </th>
							<th>Hora Fin</th>
							<th>Paciente</th>
							<th>Médico</th>
							<th>Consultorio</th>
							<th>Estado</th>
							<th colspan="2">Opciones</th>
						  </tr>
						<?php foreach ($consulta as $Sql): ?>
						<tr>
						<?php $fecha = date("d/m/Y",strtotime($Sql['citfecha'])); ?>
						<?php echo "<td class='mayusculas'>". $Sql['idcita']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $fecha. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['cithorai']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['cithoraf']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['citPaciente']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['citMedico']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['citConsultorio']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['citestado']. "</td>"; ?>
                        <?php echo "<td class='centrar'>"."<a href='actualizarcitas.php?idcita=".$Sql['idcita']."' class='editar'>Editar</a>". "</td>"; ?>
						<?php echo "<td class='centrar'>"."<a href='eliminar_citas.php?idcita=".$Sql['idcita']."' class='eliminar'>Eliminar</a>". "</td>"; ?>
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
                <a href="citas.php<?php echo $PaginaAnterior; ?>" >Anterior </a>
            <?php } else { ?>
                Anterior
            <?php } ?>


            <?php for ($j = 1; $j <= $PaginasAMostrar; $j++) { ?>
                * <a href="citas.php?page=<?php echo $j; ?>"> <?php echo $j; ?> </a>
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
                * <a href="citas.php<?php echo $PaginaSiguiente; ?>" >Siguiente </a>
            <?php } else { ?>
                Siguiente
            <?php } ?>
				</article>
	</section>

<?php include 'plantillas/footer.php'; ?>

</body>
</html>