<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

//CARGAR CIUDADES EN EL SELECT
$prov = $conexion->prepare("SELECT * FROM provincia");
$prov ->execute();
$prov = $prov ->fetchAll();
if(!$prov)
	$mensaje .= 'No hay provincias, por favor cargue una!';?>

<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>LOCALIDAD</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>Agregar Localidad</h2>
                        <input required type="text" name="nombre" placeholder="Localidad:"/>
                        <label>PROVINCIA</label>
						<select name="prov">  
                        <?php foreach ($prov as $Sql): ?>
						<?php echo "<option value='". $Sql['idProvincia']. "'>". utf8_encode($Sql['nombre']). "</option>"; ?>
						<?php endforeach; ?>
						</select>
						<input type="submit" name="enviar" value="Agregar Localidad">
					</form>
						<?php  if(!empty($errores)): ?>
							<ul>
							  <?php echo $errores; ?>
							</ul>
						<?php  endif; ?>
						<a class="btn-regresar" href="localidades.php">Regresar</a>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>