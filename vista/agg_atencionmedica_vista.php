<?php  
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}
	//CARGAR CIUDADES EN EL SELECT
    $mednombre = $conexion->prepare("SELECT * FROM medicamento");
	$mednombre ->execute();
	$mednombre = $mednombre ->fetchAll();
	if(!$mednombre)
		$mensaje .= 'No hay medicamentos, por favor cargue una!';
 ?>
<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>ATENCIÓN MÉDICA</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>Agregar Atención Médica</h2>
						<p>*Se recomienda no ingresar más de una atención médica sin haber ingresado antes una historia clínica</p>
						<label class="warning">* Campos obligatorios</label><br>
						 <label>Receta</label><br>
						<select required name="receta[]" size="5" multiple>  
                        <?php foreach ($mednombre as $Sql1): ?>
						<?php echo "<option value='". $Sql1['mednombre']. "'>". utf8_encode($Sql1['mednombre']). "</option>"; ?>
						<?php endforeach; ?>
						</select><label class="warning">*</label>
						<a href="medicamentos.php"class="agregar">Ver Medicamentos</a><br>
                  
                        <input required type="text" name="ficha" placeholder="Ficha:"/><label class="warning">*</label>
                        <input required type="number" name="ordenes" placeholder="Ordenes:"/><label class="warning">*</label>
                        <input required type="text" name="pedidoMedico" placeholder="PedidoMedico:"/><label class="warning">*</label>
                        <label>Diagnostico</label>
                        <select required name="diagnostico">
                            <option value="No es urgente">No es urgente</option>
                            <option value="Poco urgente">Poco urgente</option>
                            <option value="Urgente">Urgente</option>
                            <option value="Muy urgente">Muy urgente</option>
							<option value="Emergencia">Emergencia</option> 
                        </select><label class="warning">*</label>
                        <label>Turno</label><br>
                        <input required type="date" name="turno" placeholder="Turno:"/><label class="warning">*</label>
						<input type="submit" name="enviar" value="Agregar Atención Médica">
					</form>
						<?php  if(!empty($errores)): ?>
							<ul>
							  <?php echo $errores; ?>
							</ul>
						<?php  endif; ?>
						<a class="btn-regresar" href="atencion_medica.php">Regresar</a>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>