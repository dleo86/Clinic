<?php
	$errores='';
	extract ($_REQUEST);
	try{
		$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}
	$sql="DELETE FROM pacientes WHERE idPaciente = '$_REQUEST[idPaciente]' AND idPersona IN (SELECT idPersona FROM persona)";
	//$sql="DELETE FROM pacientes WHERE idPaciente = '$_REQUEST[idPaciente]'";
	//$sql="DELETE FROM pacientes INNER JOIN persona ON pacientes.idPersona = persona.idPersona WHERE pacientes.idPaciente = '$_REQUEST[idPaciente]'";

	$resultado = $conexion->query($sql);

	if($resultado == true){
		header('Location: Pacientes.php');
		$errores .='Paciente eliminado correctamente';
	}
?>