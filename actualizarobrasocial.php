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
		$id = limpiarDatos($_POST['id']);
		$nombres = limpiarDatos($_POST['nombre']);
		
		
		$statement = $conexion->prepare(
		"UPDATE obra_social SET 
		nombre =:nombres
        WHERE id_obrasocial = :id");

		$statement ->execute(array(':id'=>$id, ':nombres'=>$nombres));
        header('Location: obra_social.php');
	}else{
		$id_obrasocial = id_numeros($_GET['id_obrasocial']);
		if(empty($id_obrasocial)){
			header('Location: obra_social.php'); 
		}
		$obra_social = obtener_obra_social_id($conexion,$id_obrasocial);
		
		if(!$obra_social){
			header('Location: obra_social.php');
		}
		$obra_social =$obra_social[0];
	}
	require 'vista/actualizarobrasocial_vista.php';
?>