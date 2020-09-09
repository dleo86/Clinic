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
?>
<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>USUARIOS</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <h2>EDITAR USUARIO</h2><br/>
                        <label class="warning">* Campos obligatorios</label>
                        <input type="hidden" name="id" value="<?php echo $user['id'];?>">
                        <input type="hidden" name="idP" value="<?php echo $persona['idPersona'];?>" />
                        <input type="hidden" name="idD" value="<?php echo $domicilio['idDomicilio'];?>" />
                        <input required type="text" name="usuario" placeholder="Usuario" value="<?php echo $user['usuario'];?>" autofocus/><label class="warning">*</label>
                        <input required type="password" name="pass" placeholder="Contraseña" value="<?php echo $user['pass'];?>"/><label class="warning">*</label>
                        <input required type="password" name="pass2" placeholder="Repita la contraseña" value="<?php echo $user['pass'];?>"/><label class="warning">*</label>
                        <input required type="text" name="nombres" placeholder="Nombres:" value="<?php echo $persona['nombre'];?>"><label class="warning">*</label>
                        <input required type="text" name="apellidos" placeholder="Apellidos:" value="<?php echo $persona['apellido'];?>"><label class="warning">*</label>
                        <input required type="date" name="fechaNac" placeholder="Fecha de Nacimiento:" value="<?php echo $persona['fechaNacimiento'];?>"><label class="warning">*</label>
                        <input type="number" name="dni" placeholder="DNI:" value="<?php echo $persona['dni'];?>"><label class="warning">*</label>
                        <input type="email" name="correo" placeholder="Correo:" value="<?php echo $persona['email'];?>"><label class="warning">*</label>
                        <input type="tel" name="telefono" placeholder="Teléfono:" value="<?php echo $persona['telefono'];?>"onkeyup="validar(this,'no_numeros')" onblur="validar(this,'no_numeros')"><label class="warning">*</label>
                        <label>DOMICILIO</label>
                        <input required type="text" name="calle" placeholder="Calle:" value="<?php echo $domicilio['calle'];?>"><label class="warning">*</label>
                        <input required type="number" name="numero" placeholder="Número:" value="<?php echo $domicilio['numero'];?>"><label class="warning">*</label>
                        <input type="number" name="piso" placeholder="Piso:" value="<?php echo $domicilio['piso'];?>"><label class="warning">*</label>
                        <input type="text" name="departamento" placeholder="Departamento:" value="<?php echo $domicilio['departamento'];?>">
                        <input required type="number" name="codPostal" placeholder="Código Postal:"value="<?php echo $domicilio['codPostal'];?>"><label class="warning">*</label>
                        <label>CIUDAD</label>
                        <select name="loc">
                        <option value="<?php $localidad['idLocalidad'];?>" ><?php echo utf8_encode($localidad['nombre']);?></option>
                        <?php foreach ($loc as $Sql1): ?>
                        <?php echo "<option value='". $Sql1['idLocalidad']. "'>". utf8_encode($Sql1['nombre']). "</option>"; ?>
                        <?php endforeach; ?>    
                        </select><label class="warning">*</label>
                         <?php 
                            $var = 'admin';
                            if(strcmp($_SESSION['usuario'], $var) === 0){ ?>
                        <select name="roll">
                            <option value="admin">Admin</option>
                            <option value="Limitado">Limitado</option>
                        </select><label class="warning">*</label>
                         <?php } ?>
                        <input type="date" name="ingreso" placeholder="Fecha de ingreso:" value="<?php echo $user['fechaIngreso'];?>" required/>
                        <input type="submit" value="Editar Usuario" />
                        <?php  if(!empty($errores)): ?>
                          <ul>
                              <?php echo $errores; ?>
                          </ul>
                        <?php  endif; ?>
                     </form>
                    <a class="btn-regresar" href="usuarios.php">Regresar</a>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>
</html>