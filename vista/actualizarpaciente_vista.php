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
//SELECT PARA PACIENTES
$obrasocial = $conexion -> prepare("SELECT * FROM obra_social");
$obrasocial ->execute();
$obrasocial = $obrasocial ->fetchAll();
if(!$obrasocial)
    $mensaje .= 'No hay obra social, por favor registre primero! <br />';

?>
<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>Pacientes</h2>
					</div>
                    <form action="vista/informe_un_paciente.php" target="_black" method="post">
                        <input type="hidden" name="id" value="<?php echo $pacientes['idPaciente'];?>" >
                        <input type="submit" name="btnPDF" class="agregar"  value="Mostrar PDF " />
                    </form>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <h2>EDITAR PACIENTE</h2><br/>
                        <p>El número de la obra social es el que aparece en la lista, ej: 3 equivale a "3. OSDE"</p><br/>
                        <label class="warning">* Campos obligatorios</label><br>
                        <input type="hidden" name="idPac" value="<?php echo $pacientes['idPaciente'];?>">
                        <input type="hidden" name="idP" value="<?php echo $persona['idPersona'];?>" />
                        <input type="hidden" name="idD" value="<?php echo $domicilio['idDomicilio'];?>" />
                        <input type="text" name="nombres" placeholder="Nombres:" value="<?php echo $persona['nombre'];?>"><label class="warning">*</label>
                        <input required type="text" name="apellidos" placeholder="Apellidos:" value="<?php echo $persona['apellido'];?>"><label class="warning">*</label>
                        <input required type="date" name="fechaNac" placeholder="Fecha de Nacimiento:" value="<?php echo $persona['fechaNacimiento'];?>"><label class="warning">*</label>
                        <input required type="number" name="dni" placeholder="DNI:" value="<?php echo $persona['dni'];?>"><label class="warning">*</label>
                        <input  type="email" name="correo" placeholder="Correo:" value="<?php echo $persona['email'];?>">
                        <input  type="number" name="telefono" placeholder="Teléfono:" value="<?php echo $persona['telefono'];?>"onkeyup="validar(this,'no_numeros')" onblur="validar(this,'no_numeros')"><label class="warning">*</label>
                        <label>DOMICILIO</label>
                        <input required type="text" name="calle" placeholder="Calle:" value="<?php echo $domicilio['calle'];?>"><label class="warning">*</label>
                        <input required type="number" name="numero" placeholder="Número:" value="<?php echo $domicilio['numero'];?>"><label class="warning">*</label>
                        <input required type="number" name="piso" placeholder="Piso:" value="<?php echo $domicilio['piso'];?>"><label class="warning">*</label>
                        <input type="text" name="departamento" placeholder="Departamento:" value="<?php echo $domicilio['departamento'];?>">
                        <input required type="number" name="codPostal" placeholder="Código Postal:"value="<?php echo $domicilio['codPostal'];?>"><label class="warning">*</label>
                        <label>CIUDAD</label>
                        <select required name="loc">
                            <option value="<?php $localidad['idLocalidad'];?>" ><?php echo utf8_encode($localidad['nombre']);?></option>
                            <?php foreach ($loc as $Sql1): ?>
                        <?php echo "<option value='". $Sql1['idLocalidad']. "'>". utf8_encode($Sql1['nombre']). "</option>"; ?>
                        <?php endforeach; ?>        
                        </select><label class="warning">*</label>
                        <select required name="sexo" value="<?php echo $pacientes['pacSexo'];?>">
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option> 
                        </select><label class="warning">*</label>
                        <select required name="obrasocial" class="obrasocial" required> 
                            <option value="<?php $pacientes['PacObraSocial'];?>"><?php echo $pacientes['PacObraSocial'];?></option>
                            <?php $num = 0; ?>
                            <?php foreach ($obrasocial as $Sql): ?>
                                <?php $num++; ?>
                            <?php echo "<option value='". $Sql['id_obrasocial']. "'>". $num ." ". $Sql['nombre']." </option>"; ?>
                            <?php endforeach; ?>
                        </select><label class="warning">*</label>
                        <input required type="text" name="estado" placeholder="estado:" value="<?php echo $pacientes['pacEstado'];?>" /><label class="warning">*</label>
                        <input type="submit" value="Editar Paciente" />
                        <?php  if(!empty($errores)): ?>
                          <ul>
                              <?php echo $errores; ?>
                          </ul>
                        <?php  endif; ?>
                     </form>
                    <a class="btn-regresar" href="pacientes.php">Regresar</a>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>