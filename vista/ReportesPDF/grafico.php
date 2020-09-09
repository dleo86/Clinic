<?php 
try{
    $conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
     echo "Error: ". $e->getMessage();
}
 $consulta = $conexion -> prepare("
         SELECT  UPPER(citMedico) AS Medico, COUNT(citPaciente) FROM citas GROUP BY Medico"); 
    $consulta ->execute();  
    $consulta = $consulta ->fetchAll();
    foreach ($consulta as $row){
        $height = $row['Medico'];
        $height = preg_replace('/\D/', '', $height);
        $weight = $row['COUNT(citPaciente)'];
        $weight  = preg_replace('/\D/', '', $weight);
        $myurl[] = "[' ".$height."',".$weight."]";
        //$myurl[] = “[‘”.$firstname.” “.$lastname.”’, “.$height.”,”.$weight.”]”;
    }
print_r($myurl);
echo implode(",", $myurl);
?>
<!Doctype html>
<html>
<head>
    <title>Google Charts Tutorial</title>
    
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            /* Define the chart to be drawn.*/
            var data = google.visualization.arrayToDataTable([
               ['Page Vist', 'Students Tutorial'],/* 
                ['2012', 10000],
                ['2013', 23000],
                ['2014', 46000],
                ['2015', 49000],
                ['2016', 55000],
                ['2017', 100000]*/
                <?php echo implode(",", $myurl); ?>
            ]);
            var options = {
                title: 'Page visit per year',
                vAxis: {title: 'Members',  titleTextStyle: {color: 'red'}}
                //isStacked: true
            };
            /* Instantiate and draw the chart.*/
            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
        //google.charts.setOnLoadCallback(drawChart);
    </script>
    </head>
<body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
</body>
</html>