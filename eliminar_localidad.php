<?php
	$mensaje='';
	extract ($_REQUEST);
	try{
		$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}
	$sql="DELETE FROM localidad WHERE idLocalidad = '$_REQUEST[idLocalidad]'";
	$resultado = $conexion->query($sql);

	if($resultado == true){
		header('Location: localidades.php');
		$mensaje .='Localidad eliminada correctamente';
	}
?>