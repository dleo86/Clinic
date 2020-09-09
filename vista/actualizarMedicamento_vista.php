<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>Medicamento</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <h2>EDITAR MEDICAMENTO</h2><br/>
                        <input type="hidden" name="idmedicamento" value="<?php echo $medicamento['idmedicamento'];?>">
                        <input type="text" name="mednombre" placeholder="Nombre:" value="<?php echo $medicamento['mednombre'];?>" autofocus/>
                        <input type="submit" value="Editar Medicamento" />
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