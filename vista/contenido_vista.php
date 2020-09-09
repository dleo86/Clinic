<?php include 'plantillas/header.php'; ?>
	<section class="main">
		Usuario Activo: <?php echo ucfirst($_SESSION['usuario']); ?>
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
			
				<article>
					<div class="mensaje">
						<h2>Sistema de Gestión de Consultorio Médico</h2>
					</div>
						<p><img src="img/logo3.png">
						</p><br/><br/>
						<p>Bienvenido a <b>CLINIC</b>! un Sistema de Citas Médicas útil para consultorios médicos y/o médicos independientes.</p>
						<br/><br/>
						<h3>FUNCIONES</h3><br/>
						<p>	- Gestión de Citas <br/>
							- Gestión de Médicos <br/>
							- Gestión de Pacientes <br/>
							- Gestión de Informes <br/>
							- Gestión de Historias Clínicas <br/>
							- Gestión de Usuarios con Acceso al Sistema <br/>
						</p>
				</article>
	</section>
	<?php include 'plantillas/footer.php'; ?>
</body>
</html>