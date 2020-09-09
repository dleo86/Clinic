<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>Obras Sociales</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>Agregar Obra Social</h2>
                        <input required type="text" name="nombre" value="<?php echo!empty($_POST['nombre']) ? $_POST['nombre'] : ''; ?>"placeholder="Obra Social:"/>
						<input type="submit" name="enviar" value="Agregar Obra Social">
					</form>
						<?php  if(!empty($errores)): ?>
							<ul>
							  <?php echo $errores; ?>
							</ul>
						<?php  endif; ?>
						<a class="btn-regresar" href="obra_social.php">Regresar</a>
				</article>

	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>