<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	$fecha = $_POST['fecha'];
	$horai = $_POST['horai'];
	$horaf = $_POST['horaf'];
	$paciente =  $_POST['paciente'];
	$medico =  $_POST['medico'];
	$consultorio =  $_POST['consultorio'];
	$estado =  $_POST['estado'];
	$usuario = $_POST['usuario'];
	$observaciones =  $_POST['observaciones'];
	$mensaje='';
	if((strtotime($_POST['horai'])) >= (strtotime($_POST['horaf']))){
		$mensaje.= 'La hora de inicio no puede ser mayor que la hora final'."<br />";
		echo $mensaje;
		header('refresh:5; http://localhost/Clinic/citas.php');
	}
	if(empty($fecha) or empty($horai) or empty($horaf) or empty($consultorio) or empty($paciente) or empty($estado)or empty($medico)){
		$mensaje.= 'Por favor rellena todos los datos correctamente'."<br />";
	}
	else{	
		try{
			$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
		}catch(PDOException $e){
			echo "Error: ". $e->getMessage();
			die();
		}
	}
	if($mensaje==''){
		$statement = $conexion->prepare(
		'INSERT INTO citas values(default, :fecha,:horai,:horaf,:paciente,:medico,:consultorio,:estado,:usuario,:observaciones)');

		$statement ->execute(array(
		':fecha'=>$fecha,
		':horai'=>$horai,
		':horaf'=>$horaf,
		':paciente'=>$paciente,
		':medico'=>$medico,
		':consultorio'=>$consultorio,
		':estado'=>$estado,
		':usuario'=>$usuario,
		':observaciones'=>$observaciones
		));
		header('Location: citas.php');
	}
}
require 'vista/agregarcitas_vista.php';
?>