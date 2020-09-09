
<?php
$fecha1 = $_POST['date1'];
$fecha2 = $_POST['date2'];
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
    $this->SetFillColor(0,128,128);//(255,0,0)
    $this->SetTextColor(255);
    $this->SetDrawColor(0,0,128);//(128,0,0)
    $this->SetLineWidth(.3);
    $this->SetFont('Arial','B',10);
    // Cabecera
    $w = array(35, 35, 45, 40);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],16,$header[$i],1,0,'C',true);
    $this->Ln();
    // Restauración de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('Arial','',8);
    // Datos
    $fill = false;
    foreach($consulta as $row)
    {
        $fecha = date("d/m/Y",strtotime($row['fechaAlta']));
        $this->Cell($w[1],12,utf8_decode($row['datosPacientes']),'LR',0,'C',$fill);
        $this->Cell($w[1],12,$fecha,'LR',0,'C',$fill);
        $this->Cell($w[2],12,utf8_decode($row['enfermedades']),'LR',0,'C',$fill);
        $this->Cell($w[3],12,utf8_decode($row['medicamentos']),'LR',0,'C',$fill);
        $this->Cell($w[4],12,utf8_decode($row['obraSocial']),'LR',0,'C',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
}
}
$mensaje='';
try{
$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
}catch(PDOException $e){
echo "Error: ". $e->getMessage();
}
if (!empty($_POST['btnPDF'])){
$consulta = $conexion -> prepare("
SELECT * FROM historia_clinica, atencion_medica WHERE idAtencion = id_atmedica AND fechaAlta BETWEEN '$fecha1' AND '$fecha2' ORDER BY fechaAlta");
$consulta ->execute();  
$consulta = $consulta ->fetchAll();
} else {
$consulta = $conexion -> prepare("
SELECT * FROM historia_clinica, atencion_medica WHERE idAtencion = id_atmedica AND fechaAlta BETWEEN '$fecha1' AND '$fecha2' ORDER BY fechaAlta");
$consulta ->execute();  
$consulta = $consulta ->fetchAll();
if (!$consulta) {
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
$pdf->Cell(0,8,utf8_decode("Historias Clínicas"),0,1,'L',true);
$pdf->PrintChapter($fecha1, $fecha2);
$header = array('Pacientes', 'Fecha de alta', 'Enfermedades', 'Medicamentos', 'Obra Social');
$pdf->FancyTable($header,$consulta);
$pdf->Output();
?>