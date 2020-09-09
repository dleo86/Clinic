<?php
	$mensaje='';
	extract ($_REQUEST);
	try{
		$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}
	$sql="DELETE FROM usuarios WHERE id = '$_REQUEST[id]'";
	//$sql="DELETE FROM usuarios WHERE id = '$_REQUEST[id]' AND idPersona IN (SELECT persona.idPersona FROM persona)";
	$resultado = $conexion->query($sql);

	if($resultado == true){
		header('Location: usuarios.php');
		$mensaje .='Usuario eliminado correctamente';
	}
?>