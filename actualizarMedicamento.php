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
		$idmed = limpiarDatos($_POST['idmedicamento']);
		$nombre = limpiarDatos($_POST['mednombre']);
		
		
		$statement = $conexion->prepare(
		"UPDATE medicamento SET 
		mednombre =:nombre
        WHERE idmedicamento = :idmed");

		$statement ->execute(array(':idmed'=>$idmed, ':nombre'=>$nombre));
		header('Location: medicamentos.php'); 
        //header('Location: obra_social.php');
        //header("Location: " .$_SERVER['HTTP_REFERER']);
	}else{
		$id = id_numeros($_GET['idmedicamento']);
		if(empty($id)){
			//header('Location: obra_social.php'); 
			header('Location: medicamentos.php'); 
			
		}
		$medicamento = obtener_medicamento_id($conexion,$id);
		
		if(!$medicamento){
			//header("Location: ".$_SERVER['HTTP_REFERER']);
			header('Location: medicamentos.php'); 
		}
		$medicamento =$medicamento[0];
	}
	require 'vista/actualizarMedicamento_vista.php';
?>