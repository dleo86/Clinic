<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}
//SELECT PARA MEDICOS
$medicos = $conexion -> prepare("SELECT * FROM medicos, persona WHERE medicos.idPersona = persona.idPersona");
$medicos ->execute();
$medicos = $medicos ->fetchAll();
if(!$medicos)
	$mensaje .= 'No hay medicos, por favor registre primero! <br />';
//SELECT PARA CONSULTORIOS
$consultorios = $conexion -> prepare("SELECT * FROM consultorios");
$consultorios ->execute();
$consultorios = $consultorios ->fetchAll();
if(!$consultorios)
	$mensaje .= 'No hay consultorios, por favor registre primero! <br />';
//SELECT PARA PACIENTES
$pacientes = $conexion -> prepare("SELECT * FROM pacientes, persona WHERE pacientes.idPersona = persona.idPersona");
$pacientes ->execute();
$pacientes = $pacientes ->fetchAll();
if(!$pacientes)
	$mensaje .= 'No hay pacientes, por favor registre primero! <br />';
//SELECT PARA MEDICOS
$usuarios = $conexion -> prepare("SELECT * FROM usuarios");
$usuarios ->execute();
$usuarios = $usuarios ->fetchAll();
if(!$usuarios)
	$mensaje .= 'No hay medicos, por favor registre primero! <br />';
?>
<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>CITAS</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>Agregar Citas</h2>
						<label class="warning">* Campos obligatorios</label><br>
						<label>Fecha:</label><br>
                        <input required type="date" name="fecha" placeholder="Fecha:"><label class="warning">*</label>
                        <label>Hora Inicial:</label>
                        <input required type="time" name="horai" value="11:45" max="23:55" min="05:00" step="60"><label class="warning">*</label>
                         <label>Hora Final:</label>
                        <input required type="time" name="horaf" value="12:45" max="23:55" min="05:00" step="60"><label class="warning">*</label>
                        <label>Paciente:</label>
                        <input required type="text" name="paciente" placeholder="Paciente:"><label class="warning">*</label>
                        <label>Médicos:</label>
                        <select required name="medico" class="mayusculas"> 
	                        <?php foreach ($medicos as $Sql): ?>
							<?php echo "<option value='". $Sql['nombre']. " ". $Sql['apellido']. "'>". $Sql['nombre']." ". $Sql['apellido']. "</option>"; ?>
							<?php endforeach; ?>
                        </select><label class="warning">*</label>
                        <label>Consultorios:</label>
                        <select required name="consultorio" class="mayusculas"> 
	                        <?php foreach ($consultorios as $Sql2): ?>
							<?php echo "<option value='". $Sql2['conNombre']. "'>". $Sql2['conNombre']."</option>"; ?>
							<?php endforeach; ?>
                        </select><label class="warning">*</label><br>
                        <label>Estado:</label><br>
                        <select required name="estado">
                        	<option value="asignado">Asignado</option>
                        	<option value="atendido">Atendido</option>                    	
                        </select><label class="warning">*</label>
                        <label>Usuario que asigna la cita:</label><br>
                        <select required name="usuario" class="mayusculas"> 
	                        <?php foreach ($usuarios as $Sql3): ?>
							<?php echo "<option value='". $Sql3['id']. "'>". $Sql3['usuario']."</option>"; ?>
							<?php endforeach; ?>
                        </select><label class="warning">*</label>                        
                        <label>Observaciones:</label>
                        <textarea placeholder="Observacion:" name="observaciones"></textarea>
						<input type="submit" name="enviar" value="Agregar Cita">
					</form>
						<?php  if(!empty($mensaje)): ?>
							<ul>
							  <?php echo $mensaje; ?>
							</ul>
						<?php  endif; ?>
						<a class="btn-regresar" href="citas.php">Regresar</a>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>