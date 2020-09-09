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
//SELECT PARA USUARIOS
$usuarios = $conexion -> prepare("SELECT * FROM usuarios");

$usuarios ->execute();
$usuarios = $usuarios ->fetchAll();
if(!$usuarios)
	$mensaje .= 'No hay usuarios, por favor registre primero! <br />';

?>
<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>CITAS</h2>
					</div>
					<form action="vista/informe_una_cita.php" target="_black" method="post">
						<input type="hidden" name="id" value="<?php echo $cita['idcita'];?>" >
			          	<input type="submit" name="btnPDF" class="agregar"  value="Mostrar PDF " />
			        </form>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>Editar Cita</h2>
						<label class="warning">* Campos obligatorios</label><br>
						<label>Fecha:</label><br>
						<input type="hidden" name="id" value="<?php echo $cita['idcita'];?>" >
                        <input type="date" name="fecha" placeholder="Fecha:" value="<?php echo $cita['citfecha'];?>" required/><label class="warning">*</label><br>
                        <label>Hora Inicial:</label><br>
                        <input type="time" name="horai" max="23:55" min="05:00" step="60" value="<?php echo $cita['cithorai'];?>" required><label class="warning">*</label> <br>
                        <label>Hora Final:</label>
                        <input type="time" name="horaf" max="23:55" min="05:00" step="60" value="<?php echo $cita['cithoraf'];?>" required><label class="warning">*</label>
                        <label>Paciente:</label>
                        <input type="text" name="paciente" class="mayusculas" value="<?php echo $cita['citPaciente'];?>" required><label class="warning">*</label>
                        <label>Médicos:</label>
                        <select name="medico" class="mayusculas" required>
                        	<option value="<?php echo $cita['citMedico'];?>"><?php echo $cita['citMedico'];?></option>  
	                        <?php foreach ($medicos as $Sql): ?>
							<?php echo "<option value='". $Sql['nombre']. " ". $Sql['apellido']."'>". $Sql['nombre']." ". $Sql['apellido']. "</option>"; ?>
							<?php endforeach; ?>
                        </select><label class="warning">*</label>
                        <label>Consultorios:</label>
                        <select name="consultorio" class="mayusculas" required>
                        	<option value="<?php echo $cita['citConsultorio'];?>"><?php echo $cita['citConsultorio'];?></option> 
	                        <?php foreach ($consultorios as $Sql2): ?>
							<?php echo "<option value='". $Sql2['conNombre']. "'>". $Sql2['conNombre']."</option>"; ?>
							<?php endforeach; ?>
                        </select><label class="warning">*</label><br>
                        <label>Estado:</label required><br>
                        <select name="estado">
                        if (<?php echo $cita['citMedico'];?>=asignado){
                        	<option value="asignado">Asignado</option>
                        	<option value="atendido">Atendido</option> 
                        }
                        if (<?php echo $cita['citMedico'];?>=atendido){
                        	<option value="atendido">Atendido</option> 
                        	<option value="asignado">Asignado</option>
                        }
                                   	
                        </select><label class="warning">*</label>
                        <label>Usuario que asigna la cita:</label>
                        <select name="usuario" class="mayusculas" required> 
	                        <?php foreach ($usuarios as $Sql3): ?>
							<?php echo "<option value='". $Sql3['id']. "'>". $Sql3['usuario']."</option>"; ?>
							<?php endforeach; ?>
                        </select>   <label class="warning">*</label>
                        <label>Observaciones:</label>
                        <textarea placeholder="Observacion:" name="observaciones" ><?php echo $cita['citobservaciones'];?></textarea>
						<input type="submit" name="enviar" value="Editar Cita">
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