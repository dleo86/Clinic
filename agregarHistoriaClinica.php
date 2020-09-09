<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	
	$datosPacientes = $_POST['datosPacientes'];
	$fechaAlta = $_POST['fechaAlta'];
	$enfermedades = filter_var(strtolower($_POST['enfermedades']),FILTER_SANITIZE_STRING);
	$cirugias = filter_var(strtolower($_POST['cirugias']),FILTER_SANITIZE_STRING);
	$medicamentos = implode(', ', $_POST['medicamentos']);
	$obraSocial = filter_var(strtolower($_POST['obraSocial']),FILTER_SANITIZE_STRING);
	$atencion = filter_var(strtolower($_POST['atencion']),FILTER_SANITIZE_STRING);
	$observaciones =  $_POST['observaciones'];
	$mensaje='';
		try{
			$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
		}catch(PDOException $e){
			echo "Error: ". $e->getMessage();
			die();
		}

	if($mensaje==''){

		$statement = $conexion->prepare("INSERT INTO historia_clinica VALUES(default, :datosPacientes, :fechaAlta, :enfermedades, :cirugias, :medicamentos, :obraSocial, (SELECT MAX(id_atmedica) FROM atencion_medica),:observaciones)");

		$statement ->execute(array( 
		':datosPacientes'=> $datosPacientes,
		':fechaAlta'=> $fechaAlta,
		':enfermedades'=> $enfermedades,
		':cirugias'=> $cirugias,
		':medicamentos'=> $medicamentos,
		':obraSocial'=> $obraSocial,
		':observaciones'=>$observaciones
		));
		header('Location: historia_clinica.php');
	}
}
require 'vista/agg_historiaclinica_vista.php';
?>