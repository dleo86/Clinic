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
		$id = $_POST['id'];
		$receta = implode(', ', $_POST['receta']);
		$ficha = $_POST['ficha'];
		$ordenes = $_POST['ordenes'];
		$pedidoMedico = $_POST['pedidoMedico'];
		$diagnostico = $_POST['diagnostico'];
		$turno = $_POST['turno'];
		
		$statement = $conexion->prepare(
		"UPDATE atencion_medica SET 
		receta =:receta, 
        ficha =:ficha,
        ordenes =:ordenes,
        pedidoMedico =:pedidoMedico,
        diagnostico =:diagnostico,
        turno =:turno
        WHERE id_atmedica = :id");

		$statement ->execute(array(':id'=>$id, ':receta'=>$receta, ':ficha'=>$ficha, ':ordenes'=>$ordenes,':pedidoMedico'=>$pedidoMedico, ':diagnostico'=>$diagnostico,':turno'=>$turno)); //':id_atmedica'=>$id_atmedica,
        header('Location: atencion_medica.php');
	}else{
		$id_atmedica = id_numeros($_GET['id_atmedica']);
		if(empty($id_atmedica)){
			header('Location: atencion_medica.php'); 
		}
		$atencion_medica = obtener_atencion_medica_id($conexion,$id_atmedica);
		
		if(!$atencion_medica){
			header('Location: atencion_medica.php');
		}
		$atencion_medica =$atencion_medica[0];
	}
	require 'vista/actualizaratmedica_vista.php';
?>