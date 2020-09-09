<script language="javascript">
function yesnoCheck() {
    if (document.getElementById('mostrar1').checked) {
        document.getElementById('Barra').style.display = 'block';
        document.getElementById('Circular').style.display = 'none';
        document.getElementById('Anillo').style.display = 'none';
        document.getElementById('Columnas').style.display = 'none';
        document.getElementById('Lineal').style.display = 'none';
    }
    if (document.getElementById('mostrar2').checked) {
        document.getElementById('Barra').style.display = 'none';
        document.getElementById('Circular').style.display = 'block';
        document.getElementById('Anillo').style.display = 'none';
        document.getElementById('Columnas').style.display = 'none';
        document.getElementById('Lineal').style.display = 'none';
    }
    if (document.getElementById('mostrar3').checked) {
       document.getElementById('Barra').style.display = 'none';
        document.getElementById('Circular').style.display = 'none';
        document.getElementById('Anillo').style.display = 'block';
        document.getElementById('Columnas').style.display = 'none';
        document.getElementById('Lineal').style.display = 'none';
    }
    if (document.getElementById('mostrar4').checked) {
       document.getElementById('Barra').style.display = 'none';
        document.getElementById('Circular').style.display = 'none';
        document.getElementById('Anillo').style.display = 'none';
        document.getElementById('Columnas').style.display = 'block';
        document.getElementById('Lineal').style.display = 'none';
    }
    if (document.getElementById('mostrar5').checked) {
        document.getElementById('Barra').style.display = 'none';
        document.getElementById('Circular').style.display = 'none';
        document.getElementById('Anillo').style.display = 'none';
        document.getElementById('Columnas').style.display = 'none';
        document.getElementById('Lineal').style.display = 'block';
    }
   // else document.getElementById('ifYes').style.display = 'none';

}
</script>
<?php include 'plantillas/header.php'; ?>
	</div>
	<section class="main">
		Usuario Activo: <?php echo ucfirst($_SESSION['usuario']); //onClick="mostrarSeleccionado()"?>
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>INFORMES</h2>
					</div>
					<?php $tipo = "valor1";?>
					<form action = "vista/mostrar_informe1.php" name="formulario" target="_black" method="post">
					  <label>Desde: </label>
			          <input type="date"  placeholder="Start" name="date1" />
			          <label>Hasta: </label>
			          <input type="date" placeholder="End" name="date2" />
			          <fieldset>
			          <legend>Tipos de Gráficos:</legend>
			          <div class="tipo_radios"><br>
			          <input type="radio" onclick="javascript:yesnoCheck();" name="mostrar" value="mostrar1" id="mostrar1"><label for="mostrar1">Barra</label><br>
			          <input type="radio" onclick="javascript:yesnoCheck();" name="mostrar" id="mostrar2"><label for="mostrar2">Circular</label><br>
			          <input type="radio" onclick="javascript:yesnoCheck();" name="mostrar" id="mostrar3"><label for="mostrar3">Anillo</label><br>
			          <input type="radio" onclick="javascript:yesnoCheck();" name="mostrar" id="mostrar4"><label for="mostrar4">Columnas</label><br>
			          <input type="radio" onclick="javascript:yesnoCheck();" name="mostrar" id="mostrar5"><label for="mostrar5">Lineal</label>
			          </div>
			         </fieldset>
			          <?php $info = "info1";/*
			          <select id="valor"name="tipo"  onchange="submitForm();>
			          	<option id="valor1" name="valor1">Diagrama de Barras</option>
			          	<option id="valor2" name="valor2" <?php if($tipo == "valor2") echo "selected";?>>Gráfico Circular</option>
			          	<option id="valor3" name="valor3">Diagrama de Anillo</option>
			          	<option id="valor4" name="valor4">Gráfico de Columnas</option>
			          	<option id="valor5" name="valor5">Gráfico Lineal</option>
			          </select> */?>
			            <div class="tipo_informe">
						<table class="tabla">
							
						<tr>
						 <ul>	
						 	
						 <strong>Informes Estadísticos</strong><br><br>
						 <input type="radio" id="info1" name="info" value="info1" checked <?php if($info == "info1") echo "selected";?>>
                         <label>Cantidad de atenciones médicas anuales</label><br>
                         <input type="radio" id="info2" name="info" value="info2" <?php if($info == "info2") echo "selected";?>>
                         <label>Cantidad de historias clínicas de acuerdo a cada obra social</label><br>
                         <input type="radio" id="info5" name="info" value="info3"<?php if($info == "info3") echo "checked";?>>
                         <label>Cantidad de atenciones médicas mensuales</label><br>
                         <input type="radio" id="info7" name="info" value="info4"<?php if($info == "info4") echo "checked";?>>
                         <label>Cantidad de pacientes atendidos por cada médico</label><br>
                         <input type="radio" id="info8" name="info" value="info5"<?php if($info == "info5") echo "checked";?>>
                         <label>Cantidad de citas por consultorio</label><br>
                         
                         <input id="Barra" style="display:none" type="submit" value="Mostrar Diagrama de Barras"  >
                         <input id="Circular" style="display:none" type="submit" formaction="vista/mostrar_informe2.php"  value="Mostrar Gráfico Circular"> 
                         <input id="Anillo" style="display:none" type="submit" formaction="vista/mostrar_informe3.php"  value="Mostrar Diagrama de Anillo">
                         <input id="Columnas" style="display:none" type="submit" formaction="vista/mostrar_informe4.php"  value="Mostrar Gráfico de Columnas">
                         <input id="Lineal" style="display:none" type="submit" formaction="vista/mostrar_informe5.php"  value="Mostrar Lineal">

						</ul>	
						</tr>
						
						</table></div>
						
					</form>	
					
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>
