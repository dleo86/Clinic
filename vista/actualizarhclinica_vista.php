<?php  
$mensaje='';
try{
  $conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
  echo "Error: ". $e->getMessage();
}
  //SELECT PARA PACIENTES
    $pacientes = $conexion -> prepare("SELECT * FROM pacientes, persona WHERE pacientes.idPersona = persona.idPersona ORDER BY persona.apellido");
    $pacientes ->execute();
    $pacientes = $pacientes ->fetchAll();
    if(!$pacientes)
      $mensaje .= 'No hay pacientes, por favor registre primero! <br />';

  //SELECT PARA Obra Social
    $obrasocial = $conexion -> prepare("SELECT * FROM obra_social ORDER BY nombre");
    $obrasocial ->execute();
    $obrasocial = $obrasocial ->fetchAll();
    if(!$obrasocial)
      $mensaje .= 'No hay obras sociales, por favor registre primero! <br />';
    //CARGAR CIUDADES EN EL SELECT
    $mednombre = $conexion->prepare("SELECT * FROM medicamento ORDER BY mednombre");
    $mednombre ->execute();
    $mednombre = $mednombre ->fetchAll();
    if(!$mednombre)
      $mensaje .= 'No hay medicamentos, por favor cargue una!';

 ?>
<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>Historias Clínicas</h2>
					</div>
          <form action="vista/informe_una_hclinica.php" target="_black" method="post">
            <input type="hidden" name="id" value="<?php echo $historia_clinica['id_hclinica'];?>" >
            <input type="submit" name="btnPDF" class="agregar"  value="Mostrar PDF " />
          </form>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <h2>EDITAR HISTORIA CLÍNICA</h2><br/>
                        <label class="warning">* Campos obligatorios</label><br>
                        <input type="hidden" name="id" value="<?php echo $historia_clinica['id_hclinica'];?>">
                        <label>Pacientes:</label>
                        <select name="datosPacientes" class="mayusculas" required> 
                          <?php echo "<option value='". $historia_clinica['datosPacientes']."'selected>". $historia_clinica['datosPacientes']."</option>" ?>
                          <?php foreach ($pacientes as $Sql): ?>
                          <?php echo "<option value='". $Sql['nombre']." " .$Sql['apellido']. "'>". $Sql['apellido']." ".$Sql['nombre']."</option>"; ?>
                          <?php endforeach; ?>
                        </select><label class="warning">*</label>
                        <input type="date" name="fechaAlta" placeholder="fechaAlta:" value="<?php echo $historia_clinica['fechaAlta'];?>" /><label class="warning">*</label>
                        <input type="text" name="enfermedades" placeholder="enfermedades:" value="<?php echo $historia_clinica['enfermedades'];?>" /><label class="warning">*</label>
                        <input type="text" name="cirugias" placeholder="cirugías:" value="<?php echo $historia_clinica['cirugias'];?>" /><label class="warning">*</label>
                        <label>MEDICAMENTO</label>
                        <select required name="medicamentos[]" size="5" multiple>  
                          <?php echo "<option value='". $historia_clinica['medicamentos']."'selected>". $historia_clinica['medicamentos']."</option>" ?>
                            <?php foreach ($mednombre as $Sql1): ?>
                            <?php echo "<option value='". $Sql1['mednombre']. "'>". utf8_encode($Sql1['mednombre']) . "</option>"; ?>
                            <?php endforeach; ?>
                        </select><label class="warning">*</label>
                        <a href="medicamentos.php"class="agregar">Ver Medicamentos</a><br>
                        <label>Obra Social:</label>
                        <select name="obraSocial" class="mayusculas" required> 
                          <?php echo "<option value='". $historia_clinica['obraSocial']."'selected>". $historia_clinica['obraSocial']."</option>" ?>
                          <?php foreach ($obrasocial as $Sql2): ?>
                          <?php echo "<option value='". $Sql2['nombre']. "'>". $Sql2['nombre']."</option>"; ?>
                          <?php endforeach; ?></select><label class="warning">*</label>
                           <label>Observaciones:</label>
                        <textarea placeholder="Observacion:" name="observaciones" ><?php echo $historia_clinica['observaciones'];?></textarea>
                        <input type="hidden" name="atencion" value="<?php echo $historia_clinica['idAtencion'];?>" />
                        <input type="submit" value="Editar Historia Clínica" />
                        <?php  if(!empty($errores)): ?>
                          <ul>
                              <?php echo $errores; ?>
                          </ul>
                        <?php  endif; ?>
                     </form>
                    <a class="btn-regresar" href="historia_clinica.php">Regresar</a>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>