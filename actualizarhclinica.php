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
		$datosPacientes = limpiarDatos($_POST['datosPacientes']);
		$fechaAlta = $_POST['fechaAlta'];
		$enfermedades = limpiarDatos($_POST['enfermedades']);
		$cirugias = limpiarDatos($_POST['cirugias']);
		$medicamentos = implode(', ', $_POST['medicamentos']);
		$obraSocial = limpiarDatos($_POST['obraSocial']);
		$atencion = limpiarDatos($_POST['atencion']);
		$observaciones = limpiarDatos($_POST['observaciones']);
		$statement = $conexion->prepare(
		"UPDATE historia_clinica SET 
		datosPacientes =:datosPacientes, 
        fechaAlta =:fechaAlta,
        enfermedades =:enfermedades,
        cirugias =:cirugias,
        medicamentos =:medicamentos,
        obraSocial =:obraSocial,
        observaciones = :observaciones
        WHERE id_hclinica = :id");

		$statement ->execute(array(':id'=>$id, ':datosPacientes'=>$datosPacientes, ':fechaAlta'=>$fechaAlta, ':enfermedades'=>$enfermedades,':cirugias'=>$cirugias, ':medicamentos'=>$medicamentos, ':obraSocial'=>$obraSocial, ':observaciones'=> $observaciones));
        header('Location: historia_clinica.php');
	}else{
		$id_hclinica = id_numeros($_GET['id_hclinica']);
		if(empty($id_hclinica)){
			header('Location: historia_clinica.php'); 
		}
		$historia_clinica = obtener_historia_clinica_id($conexion,$id_hclinica);
		
		if(!$historia_clinica){
			header('Location: historia_clinica.php');
		}
		$historia_clinica =$historia_clinica[0];
	}
	require 'vista/actualizarhclinica_vista.php';
?>