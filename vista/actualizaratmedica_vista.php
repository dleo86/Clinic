<?php  
$mensaje='';
try{
  $conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
  echo "Error: ". $e->getMessage();
}
  //CARGAR CIUDADES EN EL SELECT
    $mednombre = $conexion->prepare("SELECT * FROM medicamento");
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
						<h2>ATENCIÓN MÉDICA</h2>
					</div>
          <form action="vista/informe_una_atmedica.php" target="_black" method="post">
            <input type="hidden" name="id" value="<?php echo $atencion_medica['id_atmedica'];?>" >
            <input type="submit" name="btnPDF" class="agregar"  value="Mostrar PDF " />
          </form>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <h2>EDITAR ATENCIÓN MÉDICA</h2><br/>
                        <label class="warning">* Campos obligatorios</label><br>
                        <input type="hidden" name="id" value="<?php echo $atencion_medica['id_atmedica'];?>">
                        
                         <label>Recetas</label>
                        <select required name="receta[]" size="5" multiple>  
                          <?php echo "<option value='". $atencion_medica['receta']."'selected>". $atencion_medica['receta']."</option>" ?>
                            <?php foreach ($mednombre as $Sql1): ?>
                            <?php echo "<option value='". $Sql1['mednombre']. "'>". utf8_encode($Sql1['mednombre']) . "</option>"; ?>
                            <?php endforeach; ?>
                        </select><label class="warning">*</label>
                        <a href="medicamentos.php"class="agregar">Ver Medicamentos</a><br>
                        <input type="text" name="ficha" placeholder="ficha:" value="<?php echo $atencion_medica['ficha'];?>" /><label class="warning">*</label>
                        <input type="number" name="ordenes" placeholder="ordenes:" value="<?php echo $atencion_medica['ordenes'];?>" /><label class="warning">*</label>
                        <input type="text" name="pedidoMedico" placeholder="pedidoMedico:" value="<?php echo $atencion_medica['pedidoMedico'];?>" /><label class="warning">*</label>
                        <input type="text" name="diagnostico" placeholder="diagnóstico:" value="<?php echo $atencion_medica['diagnostico'];?>" /><label class="warning">*</label>
                        <input type="date" name="turno" value="<?php echo $atencion_medica['turno'];?>" /><label class="warning">*</label>
                        <input type="submit" value="Editar Atención Médica" />
                        <?php  if(!empty($errores)): ?>
                          <ul>
                              <?php echo $errores; ?>
                          </ul>
                        <?php  endif; ?>
                     </form>
                    <a class="btn-regresar" href="atencion_medica.php">Regresar</a>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>