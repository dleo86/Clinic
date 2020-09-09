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
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Medicos - CenterMedicine</title>
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="icon" type="image/x-icon" href="img/favicon.png">
</head>
<body>
<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>MÉDICOS</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>Agregar Médico</h2>
						<label class="warning">* Campos obligatorios</label>
						<input required type="number" name="identificacion" placeholder="Matrícula:"><label class="warning">*</label>
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
		                <label>CIUDAD</label>
						<select name="loc">  
                        <?php foreach ($loc as $Sql1): ?>
						<?php echo "<option value='". $Sql1['idLocalidad']. "'>". utf8_encode($Sql1['nombre']). "</option>"; ?>
						<?php endforeach; ?>
						</select><label class="warning">*</label>
						<a href="localidades.php"class="agregar">Ver Localidades</a>
						<select name="especialidad">  
                        <?php foreach ($especialidad as $Sql): ?>
						<?php echo "<option value='". $Sql['espNombre']. "'>". $Sql['espNombre']. "</option>"; ?>
						<?php endforeach; ?>
						</select><label class="warning">*</label>
						<label>FECHA DE INGRESO</label>
						<input required type="date" name="ingreso" placeholder="Fecha de ingreso:" /><label class="warning">*</label>
						<input type="submit" name="enviar" value="Agregar Médico">
						
					</form>
						<?php  if(!empty($mensaje)): ?>
							<ul>
							  <?php echo $mensaje; ?>
							</ul>
						<?php  endif; ?>
						<a class="btn-regresar" href="medicos.php">Regresar</a>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>