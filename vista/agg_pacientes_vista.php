<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}
//SELECT PARA PACIENTES
$obrasocial = $conexion -> prepare("SELECT * FROM obra_social");
$obrasocial ->execute();
$obrasocial = $obrasocial ->fetchAll();
if(!$obrasocial)
	$mensaje .= 'No hay obra social, por favor registre primero! <br />';

//CARGAR CIUDADES EN EL SELECT
$loc = $conexion->prepare("SELECT * FROM localidad");
$loc ->execute();
$loc = $loc ->fetchAll();
if(!$loc)
	$mensaje .= 'No hay ciudades, por favor cargue una!';
?>
<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>PACIENTES</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>Agregar Pacientes</h2>
						<label class="warning">* Campos obligatorios</label>
						<input required type="text" name="nombres" placeholder="Nombres:"><label class="warning">*</label>
						<input required type="text" name="apellidos" placeholder="Apellidos:"><label class="warning">*</label>
						<label>Fecha de nacimiento</label>
						<input required type="date" name="fechaNac" placeholder="Fecha de Nacimiento:"><label class="warning">*</label>
						<input required type="number" name="dni" placeholder="DNI:"><label class="warning">*</label>
						<input type="email" name="correo" placeholder="Correo:">
						<input type="tel" name="telefono" placeholder="Teléfono:" onkeyup="validar(this,'no_numeros')" onblur="validar(this,'no_numeros')">
						<label>DOMICILIO</label>
						<input required type="text" name="calle" placeholder="Calle:"><label class="warning">*</label>
						<input required type="number" name="numero" placeholder="Número:"><label class="warning">*</label>
						<label>PISO (El valor 0 equivale a planta baja)</label><br>
						<select name="piso">  
                        <?php for($piso = 0; $piso < 55; $piso++){ ?>
						<?php echo "<option value='". $piso. "'>". $piso . "</option>"; ?>
						<?php } ?>
						</select><label class="warning">*</label>
						<input type="text" name="departamento" placeholder="Departamento:">
						<input required type="number" name="codPostal" placeholder="Código Postal:"><label class="warning">*</label>
						<select name="sexo" required>
                            <option value="Masculino">Masculino</option>
							<option value="Femenino">Femenino</option> 
                        </select><label class="warning">*</label>
                        <label>Obra Social:</label>
                        <select name="obrasocial" class="obrasocial" required> 
	                        <?php foreach ($obrasocial as $Sql): ?>
							<?php echo "<option value='". $Sql['id_obrasocial']. "'>". $Sql['nombre']." </option>"; ?>
							<?php endforeach; ?>
                        </select><label class="warning">*</label>
                        <label>Estado</label><br>
                        <select required name="estado">
                            <option value="Dado de alta">Dado de alta</option>
							<option value="Asignado">Asignado</option> 
                        </select><label class="warning">*</label>
                        <label>CIUDAD</label>
						<select name="loc">  
                        <?php foreach ($loc as $Sql1): ?>
						<?php echo "<option value='". $Sql1['idLocalidad']. "'>". utf8_encode($Sql1['nombre']). "</option>"; ?>
						<?php endforeach; ?>
						</select><label class="warning">*</label>
						<a href="localidades.php"class="agregar">Ver Localidades</a>
						
						<input type="submit" name="enviar" value="Agregar Paciente">
						
					</form>
						<?php  if(!empty($errores)): ?>
							<ul>
							  <?php echo $errores; ?>
							</ul>
						<?php  endif; ?>
						<a class="btn-regresar" href="pacientes.php">Regresar</a>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>