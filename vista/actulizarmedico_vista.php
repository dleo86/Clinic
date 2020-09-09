<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

//CARGAR CIUDADES EN EL SELECT
$loc = $conexion->prepare("SELECT * FROM localidad");
$loc ->execute();
$loc = $loc ->fetchAll();
if(!$loc)
	$mensaje .= 'No hay ciudades, por favor cargue una!';

//CARGAR ESPECIALIDADES EN EL SELECT
$especialidad = $conexion -> prepare("SELECT * FROM especialidades");
$especialidad ->execute();
$especialidad = $especialidad ->fetchAll();
if(!$especialidad)
	$mensaje .= 'No hay especialidades, por favor registre!';
?>
<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>MÉDICOS</h2>
					</div>
					<form action="vista/informe_un_medico.php" target="_black" method="post">
						<input type="hidden" name="id" value="<?php echo $medico['idMedico'];?>" >
						<input type="hidden" name="nombre" placeholder="Nombres:" value="<?php echo $persona['nombre'];?>">
			          	<input type="submit" name="btnPDF" class="agregar"  value="Mostrar PDF " />
			        </form>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>EDITAR MÉDICO</h2>
						<label class="warning">* Campos obligatorios</label>
						<input type="hidden" name="idM" value="<?php echo $medico['idMedico'];?>" />
						<input type="hidden" name="idP" value="<?php echo $persona['idPersona'];?>" />
						<input type="hidden" name="idD" value="<?php echo $domicilio['idDomicilio'];?>" />
						
						<input type="numeric" name="identificacion" placeholder="Matrícula" value="<?php echo $medico['medidentificacion'];?>" ><label class="warning">*</label>
						<input type="text" name="nombres" placeholder="Nombres:" value="<?php echo $persona['nombre'];?>"><label class="warning">*</label>
						<input type="text" name="apellidos" placeholder="Apellidos:" value="<?php echo $persona['apellido'];?>"><label class="warning">*</label>
						<input type="date" name="fechaNac" placeholder="Fecha de Nacimiento:" value="<?php echo $persona['fechaNacimiento'];?>"><label class="warning">*</label>
						<input type="number" name="dni" placeholder="DNI:" value="<?php echo $persona['dni'];?>">
						<input type="email" name="correo" placeholder="Correo:" value="<?php echo $persona['email'];?>">
						<input type="tel" name="telefono" placeholder="Teléfono:" value="<?php echo $persona['telefono'];?>" onkeyup="validar(this,'no_numeros')" onblur="validar(this,'no_numeros')">
						<label>DOMICILIO</label>
						<input type="text" name="calle" placeholder="Calle:" value="<?php echo $domicilio['calle'];?>"><label class="warning">*</label>
						<input type="number" name="numero" placeholder="Número:" value="<?php echo $domicilio['numero'];?>"><label class="warning">*</label>
						<input type="numeric" name="piso" placeholder="Piso:" value="<?php echo $domicilio['piso'];?>"><label class="warning">*</label>
						<input type="text" name="departamento" placeholder="Departamento:" value="<?php echo $domicilio['departamento'];?>">
						<input type="number" name="codPostal" placeholder="Código Postal:"value="<?php echo $domicilio['codPostal'];?>"><label class="warning">*</label>
		                <label>CIUDAD</label>
		                <select name="loc">
							<option value="<?php $localidad['idLocalidad'];?>" ><?php echo utf8_encode($localidad['nombre']);?></option>
							<?php foreach ($loc as $Sql1): ?>
						<?php echo "<option value='". $Sql1['idLocalidad']. "'>". utf8_encode($Sql1['nombre']). "</option>"; ?>
						<?php endforeach; ?>		
						</select><label class="warning">*</label>
						<select name="especialidad">
							<option value="<?php echo $medico['medEspecialidad'];?>"><?php echo $medico['medEspecialidad'];?></option>
							<?php foreach ($especialidad as $Sql): ?>
						<?php echo "<option value='". $Sql['espNombre']. "'>". $Sql['espNombre']. "</option>"; ?>
						<?php endforeach; ?>
						</select><label class="warning">*</label>
						<input type="date" name="ingreso" placeholder="Fecha de ingreso:" value="<?php echo $medico['medingreso'];?>" required/>
						<input type="submit" name="enviar" value="Editar Médico">
						
					</form>
						<?php  if(!empty($errores)): ?>
							<ul>
							  <?php echo $errores; ?>
							</ul>
						<?php  endif; ?>
                    <a class="btn-regresar" href="medicos.php">Regresar</a>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>