
<?php
$id = $_POST['id'];
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
  function FancyTable($header, $consulta)
{
    // Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(50,0,0);//(255,0,0)
    $this->SetTextColor(255);
    $this->SetDrawColor(0,0,0);//(128,0,0)
    $this->SetLineWidth(.3);
    $this->SetFont('Arial','B',10);
    // Cabecera
    $w = array(20, 20, 20, 45, 45, 45);
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
        $fecha = date("d/m/Y",strtotime($row['citfecha']));
        $this->Cell($w[0],12,$fecha,'LR',0,'C',$fill);
        $this->Cell($w[1],12,$row['cithorai'],'LR',0,'C',$fill);
        $this->Cell($w[2],12,$row['cithoraf'],'LR',0,'C',$fill);
        $this->Cell($w[3],12,utf8_decode($row['citPaciente']),'LR',0,'C',$fill);
        $this->Cell($w[4],12,utf8_decode($row['citMedico']),'LR',0,'C',$fill);
        $this->Cell($w[4],12,utf8_decode($row['citConsultorio']),'LR',0,'C',$fill);
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
SELECT * FROM citas WHERE idcita = '$id'");
$consulta ->execute();  
$consulta = $consulta ->fetchAll();
} else {
$consulta = $conexion -> prepare("
SELECT * FROM citas WHERE idcita = '$id'");
$consulta ->execute();  
$consulta = $consulta ->fetchAll();
if (!$consulta) {
$mensaje .= 'NO HAY INFORMES PARA MOSTRAR';
}  
}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',16);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(0,8,"Ficha de la cita del paciente",0,1,'L',true);
$header = array('Fecha', 'Hora Inicio', 'Hora Final', 'Paciente', utf8_decode('Médico'), 'Consultorio');
$pdf->FancyTable($header,$consulta);
$pdf->Output();
?>