<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>Localidad</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <h2>EDITAR LOCALIDAD</h2><br/>
                        <input type="hidden" name="idLocalidad" value="<?php echo $localidad['idLocalidad'];?>">
                        <input type="hidden" name="idProvincia" value="<?php echo $localidad['idProvincia'];?>">
                        <input type="text" name="nombre" placeholder="Nombre:" value="<?php echo $localidad['nombre'];?>" autofocus/>
                        <input type="submit" value="Editar Localidad" />
                        <?php  if(!empty($errores)): ?>
                          <ul>
                              <?php echo $errores; ?>
                          </ul>
                        <?php  endif; ?>
         </form>
                    <a class="btn-regresar" href="javascript:history.back()">Regresar</a>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>