<?php
$mensaje='';
try{
  $conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
  echo "Error: ". $e->getMessage();
}

$consulta = $conexion -> prepare("
  SELECT * FROM atencion_medica ORDER BY id_atmedica DESC");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
  $mensaje .= 'NO HAY ATENCIONES MEDICAS PARA MOSTRAR';
}
$select = 5;
if (!empty($_POST['btnMostrar'])) {

   (isset($_POST["select"])) ? $select = $_POST["select"] : $select=5;
}

if (isset($_GET['order'])){
  $order = $_GET['order'];
} else {
  $order = 'id_atmedica';
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
  SELECT * FROM atencion_medica ORDER BY $order $sort limit $RegistroInicial, $CantidadRegistrosPorPagina");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
  $mensaje .= 'NO HAY ATENCIONES MEDICAS PARA MOSTRAR';
}

$sort == 'ASC' ? $sort = 'DESC' : $sort = 'ASC'; 
$sort == 'ASC' ? $arrow = '<img src="img/sort-desc.png" width="10px" height="10px"/>' : $arrow =  '<img src="img/sort-asc.png" width="10px" height="10px"/>';

if(!empty($_POST['btnBuscar'])){
  $date1 = $_POST['date1'];
  $date2 = $_POST['date2'];
  $consulta = $conexion -> prepare("
    SELECT * FROM atencion_medica WHERE turno BETWEEN '$date1' AND '$date2' order by $order $sort limit 5");

  $consulta ->execute();
  $consulta = $consulta ->fetchAll();
  if(!$consulta){
     $mensaje .= 'NO HAY ATENCIONES MEDICAS PARA MOSTRAR';
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
            <h2>ATENCIONES MÉDICAS</h2>
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
                  <input type="submit" name="btnBuscar" value="Buscar " />
                  
              </form>    
            <a class="agregar" href="agregarAtencionMedica.php">Agregar Atención Médica</a>
          </table>  
            <table class="tabla">
              <tr>
                <?php echo "<th><a href='atencion_medica.php?order=id_atmedica&sort=".$sort."'>Nº".$arrow."</a></th>";?>
              <th>Receta</th>
              <th>Ficha</th>
              <th>Ordenes</th>
              <th>Pedidos Medicos</th>
              <th>Diagnóstico</th>
              <?php echo "<th><a href='atencion_medica.php?order=turno&sort=".$sort."'>Turno".$arrow."</a></th>";?>
              <th colspan="2">Opciones</th>
              </tr>
            <?php foreach ($consulta as $Sql): ?>
            <tr>
            <?php $fecha = date("d/m/Y",strtotime($Sql['turno'])); ?>
            <?php echo "<td>". $Sql['id_atmedica']. "</td>"; ?>
            <?php echo "<td>". $Sql['receta']. "</td>"; ?>
            <?php echo "<td>". $Sql['ficha']. "</td>"; ?>
            <?php echo "<td>". $Sql['ordenes']. "</td>"; ?>
            <?php echo "<td>". $Sql['pedidoMedico']. "</td>"; ?>
            <?php echo "<td>". $Sql['diagnostico']. "</td>"; ?>
            <?php echo "<td>". $fecha. "</td>"; ?>
                        <?php echo "<td class='centrar'>"."<a href='actualizaratmedica.php?id_atmedica=".$Sql['id_atmedica']."' class='editar'>Editar</a>". "</td>"; ?>
            <?php echo "<td class='centrar'>"."<a href='eliminar_atmedica.php?id_atmedica=".$Sql['id_atmedica']."' class='eliminar'>Eliminar</a>". "</td>"; ?>
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
                <a href="atencion_medica.php<?php echo $PaginaAnterior; ?>" >Anterior </a>
            <?php } else { ?>
                Anterior
            <?php } ?>


            <?php for ($j = 1; $j <= $PaginasAMostrar; $j++) { ?>
                * <a href="atencion_medica.php?page=<?php echo $j; ?>"> <?php echo $j; ?> </a>
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
                * <a href="atencion_medica.php<?php echo $PaginaSiguiente; ?>" >Siguiente </a>
            <?php } else { ?>
                Siguiente
            <?php } ?>
        </article>
  </section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>