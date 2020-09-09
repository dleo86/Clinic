<?php
	$errores='';
	extract ($_REQUEST);
	try{
		$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}
	$sql="DELETE FROM medicos WHERE idMedico = '$_REQUEST[idMedico]' ";
	//$sql="DELETE FROM medicos WHERE idMedico = '$_REQUEST[idMedico]' AND idPersona IN (SELECT idPersona FROM persona)";
	$resultado = $conexion->query($sql);

	if($resultado == true){
		header('Location: medicos.php');
		$errores .='Medico eliminado correctamente';
	}
?>