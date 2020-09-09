<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>Obras Sociales</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <h2>EDITAR OBRA SOCIAL</h2><br/>
                        <input type="hidden" name="id" value="<?php echo $obra_social['id_obrasocial'];?>">
                        <input type="text" name="nombre" placeholder="Nombre:" value="<?php echo $obra_social['nombre'];?>" autofocus/>
                        <input type="submit" value="Editar Obra Social" />
                        <?php  if(!empty($errores)): ?>
                          <ul>
                              <?php echo $errores; ?>
                          </ul>
                        <?php  endif; ?>
                     </form>
                    <a class="btn-regresar" href="obra_social.php">Regresar</a>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>