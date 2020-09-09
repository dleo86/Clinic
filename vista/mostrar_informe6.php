
<?php
$fecha1 = $_POST['date1'];
$fecha2 = $_POST['date2'];

$info = $_POST['info'];
require('ReportesPDF/fpdf.php');
header('Content-Type: text/html; charset=UTF-8');
class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {
    // Logo
    $this->Image('img/logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',35);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(60,25,'Clinic',1,1,'C');
    // Salto de línea
    $this->Ln(20);
  }
  function Footer()
  {
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
  }
  function ChapterTitle($fecha1, $fecha2)
  {
    // Arial 12
    $this->SetFont('Arial','',12);
    // Color de fondo
    $this->SetFillColor(200,220,255);
    // Título
    $this->Cell(0,6,"Desde $fecha1 hasta $fecha2",0,1,'L',true);
    // Salto de línea
    $this->Ln(4);
  }
  function PrintChapter($fecha1, $fecha2)
  {
    $this->ChapterTitle($fecha1, $fecha2);
  }
   function FancyTable($header, $consulta)
{
    // Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(0,0,225);//(255,0,0)
    $this->SetTextColor(255);
    $this->SetDrawColor(0,0,0);//(128,0,0)
    $this->SetLineWidth(.4);
    $this->SetFont('Arial','B',13);
    // Cabecera
    $w = array(60, 60);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],21,$header[$i],1,0,'C',true);
    $this->Ln();
    // Restauración de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('Arial','',10);
    // Datos
    $fill = false;
    foreach ($consulta as $row){                    
     $this->Cell($w[0],17,$row['YEAR(turno)'],'LR',0,'C',$fill);
     $this->Cell($w[1],17,$row['COUNT(*)'],'LR',0,'C',$fill); 
     $this->Ln();
     $fill = !$fill;
    }
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
}
 function FancyTable2($header, $consulta)
{
    // Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(0,0,225);//(255,0,0)
    $this->SetTextColor(255);
    $this->SetDrawColor(0,0,0);//(128,0,0)
    $this->SetLineWidth(.4);
    $this->SetFont('Arial','B',13);
    // Cabecera
    $w = array(60, 60);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],21,$header[$i],1,0,'C',true);
    $this->Ln();
    // Restauración de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('Arial','',10);
    // Datos
    $fill = false;
    foreach ($consulta as $row){                    
     $this->Cell($w[0],17,$row['obraSocial'],'LR',0,'C',$fill);
     $this->Cell($w[1],17,$row['COUNT(*)'],'LR',0,'C',$fill); 
     $this->Ln();
     $fill = !$fill;
    }
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
}
function FancyTable3($header, $consulta)
{
    // Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(0,0,225);//(255,0,0)
    $this->SetTextColor(255);
    $this->SetDrawColor(0,0,0);//(128,0,0)
    $this->SetLineWidth(.4);
    $this->SetFont('Arial','B',13);
    // Cabecera
    $w = array(60, 60);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],21,$header[$i],1,0,'C',true);
    $this->Ln();
    // Restauración de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('Arial','',10);
    // Datos
    $fill = false;
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
     $this->Cell($w[0],17,$mes,'LR',0,'C',$fill);
     $this->Cell($w[1],17,$row['COUNT(*)'],'LR',0,'C',$fill); 
     $this->Ln();
     $fill = !$fill;
    }
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
}
 function FancyTable4($header, $consulta)
{
    // Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(0,0,225);//(255,0,0)
    $this->SetTextColor(255);
    $this->SetDrawColor(0,0,0);//(128,0,0)
    $this->SetLineWidth(.4);
    $this->SetFont('Arial','B',13);
    // Cabecera
    $w = array(60, 60);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],21,$header[$i],1,0,'C',true);
    $this->Ln();
    // Restauración de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('Arial','',10);
    // Datos
    $fill = false;
    foreach ($consulta as $row){                    
     $this->Cell($w[0],17,$row['Medico'],'LR',0,'C',$fill);
     $this->Cell($w[1],17,$row['COUNT(citPaciente)'],'LR',0,'C',$fill); 
     $this->Ln();
     $fill = !$fill;
    }
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
}
 function FancyTable5($header, $consulta)
{
    // Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(0,0,225);//(255,0,0)
    $this->SetTextColor(255);
    $this->SetDrawColor(0,0,0);//(128,0,0)
    $this->SetLineWidth(.4);
    $this->SetFont('Arial','B',13);
    // Cabecera
    $w = array(60, 60);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],21,$header[$i],1,0,'C',true);
    $this->Ln();
    // Restauración de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('Arial','',10);
    // Datos
    $fill = false;
    foreach ($consulta as $row){                    
     $this->Cell($w[0],17,utf8_decode($row['citConsultorio']),'LR',0,'C',$fill);
     $this->Cell($w[1],17,$row['COUNT(*)'],'LR',0,'C',$fill); 
     $this->Ln();
     $fill = !$fill;
    }
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
}
}
if($info == 'info1'){
$mensaje='';
try{
    $conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
     echo "Error: ". $e->getMessage();
}
if (isset($_POST["info"])) {
    
    $consulta = $conexion -> prepare("
           SELECT  YEAR(turno), COUNT(*) FROM atencion_medica WHERE turno BETWEEN '$fecha1' AND '$fecha2' GROUP BY YEAR(turno)");// YEAR(turno), COUNT(*)
    $consulta ->execute();  
    $consulta = $consulta ->fetchAll();
} else {
    // SELECT turno, COUNT(*) FROM atencion_medica GROUP BY turno(Y)");
      $consulta = $conexion -> prepare("
        SELECT  YEAR(turno), COUNT(*) FROM atencion_medica WHERE turno BETWEEN '$fecha1' AND '$fecha2'GROUP BY YEAR(turno)");
      $consulta ->execute();  
      $consulta = $consulta ->fetchAll();
      if(!$consulta){
         $mensaje .= 'NO HAY INFORMES PARA MOSTRAR';
      }
 }
$fecha1 = date("d/m/Y",strtotime($fecha1));
$fecha2 = date("d/m/Y",strtotime($fecha2));
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',18);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(0,8,utf8_decode("Cantidad de atenciones médicas anuales"),0,1,'L',true);
$pdf->PrintChapter($fecha1, $fecha2);
$header = array(utf8_decode('Año'), 'Atenciones Anuales');
$pdf->FancyTable($header,$consulta);
$pdf->Output();
}
else if($info == 'info2'){
  $mensaje='';
try{
  $conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
  echo "Error: ". $e->getMessage();
}
if (isset($_POST["info"])) {
    $consulta = $conexion -> prepare("
         SELECT  obraSocial, COUNT(*) FROM historia_clinica WHERE fechaAlta BETWEEN '$fecha1' AND '$fecha2' GROUP BY obraSocial"); 
    $consulta ->execute();  
    $consulta = $consulta ->fetchAll();
} else {
      $consulta = $conexion -> prepare("
    SELECT  obraSocial, COUNT(*) FROM historia_clinica WHERE fechaAlta BETWEEN '$fecha1' AND '$fecha2' GROUP BY obraSocial");
      $consulta ->execute();  
      $consulta = $consulta ->fetchAll();
      if(!$consulta){
       $mensaje .= 'NO HAY INFORMES PARA MOSTRAR';
      }
 }
$fecha1 = date("d/m/Y",strtotime($fecha1));
$fecha2 = date("d/m/Y",strtotime($fecha2));
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',18);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(0,8,utf8_decode("Cantidad de historias clínicas por cada obra social"),0,1,'L',true);
$pdf->PrintChapter($fecha1, $fecha2);
$header = array(utf8_decode('Obra Social'), 'Cantidad');
$pdf->FancyTable2($header,$consulta);
$pdf->Output();
}
else if($info == 'info3'){
$mensaje='';
try{
  $conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
  echo "Error: ". $e->getMessage();
}
if (isset($_POST["info"])) {
    $consulta = $conexion -> prepare("
         SELECT  MONTH(turno), COUNT(*) FROM atencion_medica WHERE turno BETWEEN '$fecha1' AND '$fecha2'  GROUP BY MONTH(turno)"); 
    $consulta ->execute();  
    $consulta = $consulta ->fetchAll();
} else {
      $consulta = $conexion -> prepare("
    SELECT  MONTH(turno), COUNT(*) FROM atencion_medica WHERE turno BETWEEN '$fecha1' AND '$fecha2' GROUP BY MONTH(turno)");
      $consulta ->execute();  
      $consulta = $consulta ->fetchAll();
      if(!$consulta){
       $mensaje .= 'NO HAY INFORMES PARA MOSTRAR';
      }
 }
$fecha1 = date("d/m/Y",strtotime($fecha1));
$fecha2 = date("d/m/Y",strtotime($fecha2));
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',18);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(0,8,utf8_decode("Cantidad de atenciones médicas mensuales"),0,1,'L',true);
$pdf->PrintChapter($fecha1, $fecha2);
$header = array(utf8_decode('Mes'), 'Atenciones Mensuales');
$pdf->FancyTable3($header,$consulta);
$pdf->Output();
}
else if($info == 'info4'){
$mensaje='';
try{
  $conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
  echo "Error: ". $e->getMessage();
}
if (isset($_POST["info"])) {
    $consulta = $conexion -> prepare("
         SELECT  UPPER(citMedico) AS Medico, COUNT(citPaciente) FROM citas WHERE citfecha BETWEEN '$fecha1' AND '$fecha2' GROUP BY Medico"); 
    $consulta ->execute();  
    $consulta = $consulta ->fetchAll();
} else {
      $consulta = $conexion -> prepare("
      SELECT  UPPER(citMedico) AS Medico, COUNT(citPaciente) FROM citas WHERE citfecha BETWEEN '$fecha1' AND '$fecha2' GROUP BY Medico");
      $consulta ->execute();  
      $consulta = $consulta ->fetchAll();
      if(!$consulta){
       $mensaje .= 'NO HAY INFORMES PARA MOSTRAR';
      }
 }
$fecha1 = date("d/m/Y",strtotime($fecha1));
$fecha2 = date("d/m/Y",strtotime($fecha2));
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',18);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(0,8,utf8_decode("Cantidad de pacientes atendidos por cada médico"),0,1,'L',true);
$pdf->PrintChapter($fecha1, $fecha2);
$header = array(utf8_decode('Médico'), 'Cantidad de Pacientes');
$pdf->FancyTable4($header,$consulta);
$pdf->Output();
}
else if($info == 'info5'){
  $mensaje='';
try{
  $conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
  echo "Error: ". $e->getMessage();
}
if (isset($_POST["info"])) {  
   $consulta = $conexion -> prepare("
        SELECT  citConsultorio, COUNT(*) FROM citas WHERE citfecha BETWEEN '$fecha1' AND '$fecha2' GROUP BY citConsultorio");
    $consulta ->execute();  
    $consulta = $consulta ->fetchAll();
} else {
      $$consulta = $conexion -> prepare("
        SELECT  citConsultorio, COUNT(*) FROM citas WHERE citfecha BETWEEN '$fecha1' AND '$fecha2' GROUP BY citConsultorio");
      $consulta ->execute();  
      $consulta = $consulta ->fetchAll();
      if(!$consulta){
       $mensaje .= 'NO HAY INFORMES PARA MOSTRAR';
      }
 }
$fecha1 = date("d/m/Y",strtotime($fecha1));
$fecha2 = date("d/m/Y",strtotime($fecha2));
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',18);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(0,8,"Cantidad de citas por consultorio",0,1,'L',true);
$pdf->PrintChapter($fecha1, $fecha2);
$header = array(utf8_decode('Consultorios'), 'Cantidad de Citas');
$pdf->FancyTable5($header,$consulta);
$pdf->Output();
}
