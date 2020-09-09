<?php session_start();
	if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
	}
	
	require 'funciones.php';
	
	try{
		$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
	}catch(PDOException $e){
		echo "ERROR: " . $e->getMessge();
		die();
	}
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$idLocalidad = limpiarDatos($_POST['idLocalidad']);
		$nombre = limpiarDatos($_POST['nombre']);
		$idprov = limpiarDatos($_POST['idProvincia']);
		
		
		$statement = $conexion->prepare(
		"UPDATE localidad SET 
		nombre =:nombre,
		idProvincia =:idProvincia
        WHERE idLocalidad = :idLocalidad");

		$statement ->execute(array(':idLocalidad'=>$idLocalidad, ':nombre'=>$nombre, ':idProvincia'=>$idprov));
		header('Location: localidades.php'); 
        //header('Location: obra_social.php');
        //header("Location: " .$_SERVER['HTTP_REFERER']);
	}else{
		$id = id_numeros($_GET['idLocalidad']);
		if(empty($id)){
			//header('Location: obra_social.php'); 
			header('Location: localidades.php'); 
			
		}
		$localidad = obtener_localidad_id3($conexion,$id);
		
		if(!$localidad){
			//header("Location: ".$_SERVER['HTTP_REFERER']);
			header('Location: localidades.php'); 
		}
		$localidad =$localidad[0];
	}
	require 'vista/actualizarlocalidad_vista.php';
?>