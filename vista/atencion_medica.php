<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

$consulta = $conexion -> prepare("
	SELECT * FROM atencion_medica ORDER BY id_atmedica limit 5");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
	$mensaje .= 'NO HAY ATENCIONES MEDICAS PARA MOSTRAR';
}
?>
<?php include 'plantillas/header.php'; ?>
	</div>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>ATENCIONES MEDICAS</h2>
					</div>
						<a class="agregar" href="agregarAtencionMedica.php">Agregar Atencion Medica</a>
						<table class="tabla">
						  <tr>
							<th>#</th>
							<th>Receta</th>
							<th>Ficha</th>
							<th>Ordenes</th>
							<th>Pedido de Medico</th>
							<th>Diagnostico</th>
							<th>Turno</th>
							<th>Opciones</th>
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
                        <?php echo "<td class='centrar'>"."<a href='actualizaratencionmedica.php?id_atmedica=".$Sql['id_atmedica']."' class='editar'>Editar</a>". "</td>"; ?>
						<?php echo "<td class='centrar'>"."<a href='eliminar_atencionmedica.php?id_atmedica=".$Sql['id_atmedica']."' class='eliminar'>Eliminar</a>". "</td>"; ?>
						</tr>
						<?php endforeach; ?>
						</table>
						<?php  if(!empty($mensaje)): ?>
							<ul>
							  <?php echo $mensaje; ?>
							</ul>
						<?php  endif; ?>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>