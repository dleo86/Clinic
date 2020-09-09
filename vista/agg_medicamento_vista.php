<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

?>

<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>MEDICAMENTO</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>Agregar Medicamento</h2>
                        <input required type="text" name="mednombre" placeholder="Medicamento:"/>
						<input type="submit" name="enviar" value="Agregar Medicamento">
					</form>
						<?php  if(!empty($errores)): ?>
							<ul>
							  <?php echo $errores; ?>
							</ul>
						<?php  endif; ?>
						<a class="btn-regresar" href="medicamentos.php">Regresar</a>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>