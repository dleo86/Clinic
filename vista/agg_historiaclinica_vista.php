<?php  
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}
	//SELECT PARA PACIENTES
    $pacientes = $conexion -> prepare("SELECT * FROM pacientes, persona WHERE pacientes.idPersona = persona.idPersona ORDER BY persona.apellido");
    $pacientes ->execute();
    $pacientes = $pacientes ->fetchAll();
    if(!$pacientes)
	    $mensaje .= 'No hay pacientes, por favor registre primero! <br />';

	//SELECT PARA Obra Social
    $obrasocial = $conexion -> prepare("SELECT * FROM obra_social ORDER BY nombre");
    $obrasocial ->execute();
    $obrasocial = $obrasocial ->fetchAll();
    if(!$obrasocial)
	    $mensaje .= 'No hay obras sociales, por favor registre primero! <br />';

	//CARGAR CIUDADES EN EL SELECT
    $mednombre = $conexion->prepare("SELECT * FROM medicamento ORDER BY mednombre");
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
						<h2>Historias Clínicas</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>Agregar Historia Clínica</h2>
						<p>Se recomienda ingresar una atención médica por cada historia clínica</p>
						<label class="warning">* Campos obligatorios</label><br>
                        <label>Pacientes:</label>
                        <select name="datosPacientes" class="mayusculas" required> 
	                        <?php foreach ($pacientes as $Sql): ?>
							<?php echo "<option value='". $Sql['nombre']." " .$Sql['apellido']. "'>". $Sql['apellido']." ".$Sql['nombre']."</option>"; ?>
							<?php endforeach; ?>
                        </select><label class="warning">*</label>
                        <label>Fecha de Alta</label>
                        <input required type="date" name="fechaAlta" value="<?php echo!empty($_POST['fechaAlta']) ? $_POST['fechaAlta'] : ''; ?>"placeholder="fechaAlta"/><label class="warning">*</label>
                        <input required type="text" name="enfermedades" value="<?php echo!empty($_POST['enfermedades']) ? $_POST['enfermedades'] : ''; ?>"placeholder="enfermedades"/><label class="warning">*</label>
                        <label>Cirugías</label>
                        <select required name="cirugias">
                            <option value="No">No</option>
							<option value="Si">Si</option> 
                        </select><label class="warning">*</label>
                        <label>MEDICAMENTO</label>
						<select required name="medicamentos[]" size="5" multiple>  
                        <?php foreach ($mednombre as $Sql1): ?>
						<?php echo "<option value='". $Sql1['mednombre']. "'>". utf8_encode($Sql1['mednombre']) . "</option>"; ?>
						<?php endforeach; ?>
						</select><label class="warning">*</label>
						<a href="medicamentos.php"class="agregar">Ver Medicamentos</a><br>
                        <label>Obra Social:</label>
                        <select name="obraSocial" class="mayusculas" required> 
	                        <?php foreach ($obrasocial as $Sql2): ?>
							<?php echo "<option value='". $Sql2['nombre']. "'>". $Sql2['nombre']."</option>"; ?>
							<?php endforeach; ?>
						</select><label class="warning">*</label>	
						<label>Observaciones:</label>
                        <textarea placeholder="Observacion:" name="observaciones"></textarea>

                        <input  type="hidden" name="atencion" value="<?php echo!empty($_POST['idAtencion']) ? $_POST['idAtencion'] : ''; ?>"/>
						<input type="submit" name="enviar" value="Agregar Historia Clínica">
					</form>
						<?php  if(!empty($errores)): ?>
							<ul>
							  <?php echo $errores; ?>
							</ul>
						<?php  endif; ?>
						<a class="btn-regresar" href="historia_clinica.php">Regresar</a>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>