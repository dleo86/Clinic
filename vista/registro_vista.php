<?php
$mensaje='';
try{
  $conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
  echo "Error: ". $e->getMessage();
}

$consulta = $conexion -> prepare("
    SELECT  * FROM usuarios, persona WHERE usuarios.idPersona = persona.idPersona order by id limit 5");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
  $mensaje .= 'NO HAY USUARIOS PARA MOSTRAR'; 
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
					<form class="login" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" name="login">
                            <h2>REGISTRAR USUARIOS</h2><br/>
                            <label class="warning">* Campos obligatorios</label>
                            <input required type="text" name="usuario"placeholder="Usuario" autofocus/><label class="warning">*</label>
                            <input required type="password" name="password" placeholder="Contraseña" /><label class="warning">*</label>
                            <input required type="password" name="password2" placeholder="Repita su contraseña" /><label class="warning">*</label>
                            <input required type="text" name="nombres" placeholder="Nombres:"><label class="warning">*</label>
                            <input required type="text" name="apellidos" placeholder="Apellidos:"><label class="warning">*</label>
                            <label>Fecha de Nacimiento</label>
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
                            <select required name="roll">
                                <option value="admin">Admin</option>
                                <option value="Limitado">Limitado</option>
                            </select><label class="warning">*</label>
                            <label>CIUDAD</label>
                            <select required name="loc">  
                            <?php foreach ($loc as $Sql1): ?>
                            <?php echo "<option value='". $Sql1['idLocalidad']. "'>". utf8_encode($Sql1['nombre']). "</option>"; ?>
                            <?php endforeach; ?>
                            </select><label class="warning">*</label>
                            <a href="localidades.php"class="agregar">Ver Localidades</a>
                            <br><label>FECHA DE INGRESO</label>
                            <input required type="date" name="ingreso" placeholder="Fecha de ingreso:" /><label class="warning">*</label>
                            <input type="submit" value="Registrar" />
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