<?php 

$fecha1 = $_POST['date1'];
$fecha2 = $_POST['date2'];
$info = $_POST['info'];
if ($fecha2 < $fecha1) {
  $info = 6;
}
if (($fecha2 == null) || ($fecha1 == null)) {
  $info = 7;
}
try{
    $conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
     echo "Error: ". $e->getMessage();
}
$fechaInicial = date("d/m/Y",strtotime($fecha1));
$fechaFinal = date("d/m/Y",strtotime($fecha2));

if($info == 'info1'){
$mensaje='';
 $consulta = $conexion -> prepare("
         SELECT  YEAR(turno), COUNT(*) FROM atencion_medica WHERE turno BETWEEN '$fecha1' AND '$fecha2' GROUP BY YEAR(turno)"); 
    $consulta ->execute();  
    $consulta = $consulta ->fetchAll();
    foreach ($consulta as $row){
        $height = $row['YEAR(turno)'];
        $height  = preg_replace('/\D/', '', $height);
        $weight = $row['COUNT(*)'];
        $weight  = preg_replace('/\D/', '', $weight);
        $myurl[] = "[' ".$height."',".$weight."]";
    }

?>
<!Doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Antic" rel="stylesheet">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>Diagrama de Barras</title>
    <link rel="stylesheet" href="../css/estilo_informes.css">
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            /* Define the chart to be drawn.*/
            var data = google.visualization.arrayToDataTable([
             ['Año', 'Cantidad de atenciones. <?php echo "Desde $fechaInicial hasta $fechaFinal"; ?>' ], 
                <?php echo implode(",", $myurl); ?>
            ]);
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" }
                       ]);
          
           var options = {
                title: 'Cantidad de atenciones médicas por año',
                colors: ['#47a2c8'],
                titleTextStyle: {
                   color: 'black',    // any HTML string color ('red', '#cc00cc')
                   fontName: 'Times New Roman', // i.e. 'Times New Roman'
                   fontSize: 22, // 12, 18 whatever you want (don't specify px)
                   bold: true,    // true or false
                   italic: false   // true of false
                }, 
                hAxis : {  
                  textStyle : {
                    fontSize: 14, 
                  }
                },
                chartArea: {
                bottom: 24,
                left: 236,
                right: 325,
                top: 48,
                width: '100%',
                height: '100%'
                },
                legend: {position: 'top'},
                height: 600,
                width: 1400,
                bar: {groupWidth: "65%"}       
            };/*
            /* Instantiate and draw the chart.*/
            var my_div = document.getElementById('my_div');
            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            chart.draw(view, options);
            var btnSave = document.getElementById('save-pdf');

  google.visualization.events.addListener(chart, 'ready', function () {
    document.getElementById('my_div').innerHTML = '<img src="' + chart.getImageURI() + '">';
    document.getElementById('my_div').outerHTML = '<a href="' + chart.getImageURI() + '" target="_blank"><input id= "save-pdf" type="button" value="Mostrar en PNG" /></a>';
    btnSave.disabled = false;
  });

  btnSave.addEventListener('click', function () {
    var doc = new jsPDF(); 
    doc.addImage(chart.getImageURI(), 0, 0, 225, 150);
    doc.save('DiagramaBarras.pdf');
  }, false);
  chart.draw(view, options);
  
}
<?php }//Fin info1 ?>

<?php
if($info == 'info2'){
$mensaje='';
 $consulta = $conexion -> prepare("
         SELECT  obraSocial, COUNT(*) FROM historia_clinica WHERE fechaAlta BETWEEN '$fecha1' AND '$fecha2' GROUP BY obraSocial"); 
    $consulta ->execute();  
    $consulta = $consulta ->fetchAll();
    foreach ($consulta as $row){
        $height = $row['obraSocial'];
        $height =  trim(addslashes($row['obraSocial']));
        $weight = $row['COUNT(*)'];
        $weight  = preg_replace('/\D/', '', $weight);
        $myurl[] = "[' ".$height."',".$weight."]";
    }
?>
<!Doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Antic" rel="stylesheet">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>Diagrama de Barras</title>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
         google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            /* Define the chart to be drawn.*/
            var data = google.visualization.arrayToDataTable([
             ['Obra social', 'Cantidad de historias clínicas.<?php echo "Desde $fechaInicial hasta $fechaFinal"; ?>' ], 
                <?php echo implode(",", $myurl); ?>
            ]);
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" }
                       ]);
          
           var options = {
                title: 'Cantidad de historias clínicas de acuerdo a cada obra social',
                colors: ['#47a2c8'],
                titleTextStyle: {
                   color: 'black',    // any HTML string color ('red', '#cc00cc')
                   fontName: 'Times New Roman', // i.e. 'Times New Roman'
                   fontSize: 22, // 12, 18 whatever you want (don't specify px)
                   bold: true,    // true or false
                   italic: false   // true of false
                }, 
                hAxis : { 
                   //title: 'Cantidad', 
                  textStyle : {
                    fontSize: 14, 
                  }
                },
                chartArea: {
                bottom: 24,
                left: 236,
                right: 325,
                top: 48,
                width: '100%',
                height: '100%'
                },
                legend: {position: 'top'},
                height: 600,
                width: 1400,
                bar: {groupWidth: "65%"}     
            };/*
            /* Instantiate and draw the chart.*/
            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            chart.draw(view, options);
            var btnSave = document.getElementById('save-pdf');

  google.visualization.events.addListener(chart, 'ready', function () {
     document.getElementById('my_div').innerHTML = '<img src="' + chart.getImageURI() + '">';
    document.getElementById('my_div').outerHTML = '<a href="' + chart.getImageURI() + '" target="_blank"><input id= "save-pdf" type="button" value="Mostrar en PNG" /></a>';
    btnSave.disabled = false;
  });

  btnSave.addEventListener('click', function () {
    var doc = new jsPDF(); 
    doc.addImage(chart.getImageURI(), 0, 0, 225, 150);
    doc.save('DiagramaBarras.pdf');
  }, false);
  chart.draw(view, options);
  
}
<?php }//Fin info2 ?>

<?php
if($info == 'info3'){
$mensaje='';
 $consulta = $conexion -> prepare("
         SELECT  MONTH(turno), COUNT(*) FROM atencion_medica WHERE turno BETWEEN '$fecha1' AND '$fecha2'  GROUP BY MONTH(turno)"); 
    $consulta ->execute();  
    $consulta = $consulta ->fetchAll();
    foreach ($consulta as $row){
       switch ($row['MONTH(turno)']) {
             case 1:
               $mes = 'Enero';
               break;
             case 2:
               $mes = 'Febrero';
               break;
             case 3:
               $mes = 'Marzo';
               break;
             case 4:
               $mes = 'Abril';
               break;
             case 5:
               $mes = 'Mayo';
               break;
             case 6:
               $mes = 'Junio';
               break;
             case 7:
               $mes = 'Julio';
               break;
             case 8:
               $mes = 'Agosto';
               break;
             case 9:
               $mes = 'Septiembre';
               break;
             case 10:
               $mes = 'Octubre';
               break;
             case 11:
               $mes = 'Noviembre';
               break;
             case 12:
               $mes = 'Diciembre';
               break;
             default:
               $mes = 'Sin mes';
               break;
           }                   
        $height = $mes;
        $height =  trim(addslashes($mes));
        $weight = $row['COUNT(*)'];
        $weight  = preg_replace('/\D/', '', $weight);
        $myurl[] = "[' ".$height."',".$weight."]";
    }
?>
<!Doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Antic" rel="stylesheet">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>Diagrama de Barras</title>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            /* Define the chart to be drawn.*/
            var data = google.visualization.arrayToDataTable([
             ['Mes', 'Atenciones médicas.<?php echo "Desde $fechaInicial hasta $fechaFinal"; ?>' ], 
                <?php echo implode(",", $myurl); ?>
            ]);
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" }
                       ]);
          
           var options = {
                title: 'Cantidad de atenciones médicas mensuales',
                colors: ['#47a2c8'],
                titleTextStyle: {
                   color: 'black',    // any HTML string color ('red', '#cc00cc')
                   fontName: 'Times New Roman', // i.e. 'Times New Roman'
                   fontSize: 22, // 12, 18 whatever you want (don't specify px)
                   bold: true,    // true or false
                   italic: false   // true of false
                }, 
                hAxis : { 
                   //title: 'Cantidad', 
                  textStyle : {
                    fontSize: 14, 
                  }
                },
                chartArea: {
                bottom: 24,
                left: 236,
                right: 325,
                top: 48,
                width: '100%',
                height: '100%'
                },
                legend: {position: 'top'},
                height: 600,
                width: 1400,
                bar: {groupWidth: "65%"}        
            };/*
            /* Instantiate and draw the chart.*/
            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            chart.draw(view, options);
            var btnSave = document.getElementById('save-pdf');

  google.visualization.events.addListener(chart, 'ready', function () {
     document.getElementById('my_div').innerHTML = '<img src="' + chart.getImageURI() + '">';
    document.getElementById('my_div').outerHTML = '<a href="' + chart.getImageURI() + '" target="_blank"><input id= "save-pdf" type="button" value="Mostrar en PNG" /></a>';
    btnSave.disabled = false;
  });

  btnSave.addEventListener('click', function () {
    var doc = new jsPDF(); 
    doc.addImage(chart.getImageURI(), 0, 0, 225, 150);
    doc.save('DiagramaBarras.pdf');
  }, false);
  chart.draw(view, options);
  
}
<?php }//Fin info3 ?>

<?php
if($info == 'info4'){
$mensaje='';
 $consulta = $conexion -> prepare("
         SELECT  UPPER(citMedico) AS Medico, COUNT(citPaciente) FROM citas WHERE citfecha BETWEEN '$fecha1' AND '$fecha2'GROUP BY Medico"); 
    $consulta ->execute();  
    $consulta = $consulta ->fetchAll();
    foreach ($consulta as $row){
        $height =  trim(addslashes($row['Medico']));
        $weight = $row['COUNT(citPaciente)'];
        $weight  = preg_replace('/\D/', '', $weight);
        $myurl[] = "[' ".$height."',".$weight."]";
    }
//print_r($myurl);
//echo implode(",", $myurl);
?>
<!Doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Antic" rel="stylesheet">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>Diagrama de Barras</title>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            /* Define the chart to be drawn.*/
            var data = google.visualization.arrayToDataTable([
             ['Médico', 'Cantidad de pacientes. <?php echo "Desde $fechaInicial hasta $fechaFinal"; ?>' ], 
                <?php echo implode(",", $myurl); ?>
            ]);
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" }
                       ]);
          
           var options = {
                title: 'Cantidad de pacientes atendidos por cada medico',
                colors: ['#47a2c8'],
               titleTextStyle: {
                   color: 'black',    // any HTML string color ('red', '#cc00cc')
                   fontName: 'Times New Roman', // i.e. 'Times New Roman'
                   fontSize: 22, // 12, 18 whatever you want (don't specify px)
                   bold: true,    // true or false
                   italic: false   // true of false
                }, 
                hAxis : { 
                   //title: 'Cantidad', 
                  textStyle : {
                    fontSize: 14, 
                  }
                },
                vAxis : { 
                   //title: 'Cantidad', 
                  textStyle : {
                    fontSize: 12, 
                  }
                },
                chartArea: {
                bottom: 24,
                left: 236,
                right: 325,
                top: 48,
                width: '100%',
                height: '100%'
                },
                legend: {position: 'top'},
                height: 600,
                width: 1400,
                bar: {groupWidth: "65%"}      
            };/*
            /* Instantiate and draw the chart.*/
            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            chart.draw(view, options);
            var btnSave = document.getElementById('save-pdf');

  google.visualization.events.addListener(chart, 'ready', function () {
     document.getElementById('my_div').innerHTML = '<img src="' + chart.getImageURI() + '">';
    document.getElementById('my_div').outerHTML = '<a href="' + chart.getImageURI() + '" target="_blank"><input id= "save-pdf" type="button" value="Mostrar en PNG" /></a>';
    btnSave.disabled = false;
  });

  btnSave.addEventListener('click', function () {
    var doc = new jsPDF(); 
    doc.addImage(chart.getImageURI(), 0, 0, 225, 150);
    doc.save('DiagramaBarras.pdf');
  }, false);
  chart.draw(view, options);
  
}
<?php }//Fin info4 ?>

<?php
if($info == 'info5'){
$mensaje='';
 $consulta = $conexion -> prepare("
         SELECT  citConsultorio, COUNT(*) FROM citas WHERE citfecha BETWEEN '$fecha1' AND '$fecha2' GROUP BY citConsultorio"); 
    $consulta ->execute();  
    $consulta = $consulta ->fetchAll();
    foreach ($consulta as $row){
        $height = $row['citConsultorio'];
        trim(addslashes($row['citConsultorio']));
        $weight = $row['COUNT(*)'];
        $weight  = preg_replace('/\D/', '', $weight);
        $myurl[] = "[' ".$height."',".$weight."]";
    }
//print_r($myurl);
//echo implode(",", $myurl);
?>
<!Doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Antic" rel="stylesheet">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>Diagrama de Barras</title>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            /* Define the chart to be drawn.*/
            var data = google.visualization.arrayToDataTable([
             ['Consultorio', 'Cantidad de citas. <?php echo "Desde $fechaInicial hasta $fechaFinal"; ?>' ], 
                <?php echo implode(",", $myurl); ?>
            ]);
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" }
                       ]);
          
           var options = {
                title: 'Cantidad de citas por consultorio',
                colors: ['#47a2c8'],
                titleTextStyle: {
                   color: 'black',    // any HTML string color ('red', '#cc00cc')
                   fontName: 'Times New Roman', // i.e. 'Times New Roman'
                   fontSize: 22, // 12, 18 whatever you want (don't specify px)
                   bold: true,    // true or false
                   italic: false   // true of false
                }, 
                hAxis : { 
                  textStyle : {
                    fontSize: 14, 
                  }
                },
                vAxis : { 
                  textStyle : {
                    fontSize: 12, 
                  }
                },
                chartArea: {
                bottom: 24,
                left: 236,
                right: 325,
                top: 48,
                width: '100%',
                height: '100%'
                },
                legend: {position: 'top'},
                height: 600,
                width: 1400,
                bar: {groupWidth: "65%"}          
            };/*
            /* Instantiate and draw the chart.*/
            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            chart.draw(view, options);
            var btnSave = document.getElementById('save-pdf');

  google.visualization.events.addListener(chart, 'ready', function () {
     document.getElementById('my_div').innerHTML = '<img src="' + chart.getImageURI() + '">';
    document.getElementById('my_div').outerHTML = '<a href="' + chart.getImageURI() + '" target="_blank"><input id= "save-pdf" type="button" value="Mostrar en PNG" /></a>';
    btnSave.disabled = false;
  });

  btnSave.addEventListener('click', function () {
    var doc = new jsPDF(); 
    doc.addImage(chart.getImageURI(), 0, 0, 225, 150);
    doc.save('DiagramaBarras.pdf');
  }, false);
  chart.draw(view, options);
  
}
<?php }//Fin info5 ?>
<?php if ($info == 6) {
  echo "El valor de 'Hasta' no puede ser menor que el valor de 'Desde'.Por favor ingrese los valores correctamente";
} 
if ($info == 7) {
  echo "Los valores de las fechas no pueden ser nulos";
}?>
    </script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <link rel="stylesheet" href="../css/estilo_informes.css">
    </head>
<body>
    
    <div id="chart_div" style="width: 1300px; height: 650px; font-size: 3px; height: 200em;">
    </div>
    <input id="save-pdf" type="button" value="Guardar PDF" disabled />
    
     <div id="my_div" >
    </div>
</body>
</html>