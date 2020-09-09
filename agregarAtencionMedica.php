<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	
	$receta = implode(', ', $_POST['receta']);
	$ficha = filter_var(strtolower($_POST['ficha']),FILTER_SANITIZE_STRING);
	$ordenes = filter_var(strtolower($_POST['ordenes']),FILTER_SANITIZE_STRING);
	$pedidoMedico = filter_var(strtolower($_POST['pedidoMedico']),FILTER_SANITIZE_STRING);
	$diagnostico = filter_var(strtolower($_POST['diagnostico']),FILTER_SANITIZE_STRING);
	$turno = filter_var(strtolower($_POST['turno']),FILTER_SANITIZE_STRING);
	//$atencion = filter_var(strtolower($_POST['atencion']),FILTER_SANITIZE_STRING);
	$mensaje='';
		try{
			$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
		}catch(PDOException $e){
			echo "Error: ". $e->getMessage();
			die();
		}

	if($mensaje==''){

		$statement = $conexion->prepare("INSERT INTO atencion_medica VALUES(default, :receta, :ficha, :ordenes, :pedidoMedico, :diagnostico, :turno)");

		$statement ->execute(array( 
		':receta'=> $receta,
		':ficha'=> $ficha,
		':ordenes'=> $ordenes,
		':pedidoMedico'=> $pedidoMedico,
		':diagnostico'=> $diagnostico,
		':turno'=> $turno,
		));
		header('Location: atencion_medica.php');
	}
}
require 'vista/agg_atencionmedica_vista.php';
?>