<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	
	$nombre = filter_var(strtolower($_POST['nombre']),FILTER_SANITIZE_STRING);
	$mensaje='';
		try{
			$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
		}catch(PDOException $e){
			echo "Error: ". $e->getMessage();
			die();
		}

	if($mensaje==''){
		$statement = $conexion->prepare("INSERT INTO obra_social VALUES(default, :nombre)");

		$statement ->execute(array( 
		':nombre'=> $nombre
		));
		header('Location: obra_social.php');
	}
}
require 'vista/agg_obrasocial_vista.php';
?>