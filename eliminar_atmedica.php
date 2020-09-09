<?php
	$mensaje='';
	extract ($_REQUEST);
	try{
		$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}
	$sql="DELETE FROM atencion_medica WHERE id_atmedica = '$_REQUEST[id_atmedica]'";
	$resultado = $conexion->query($sql);

	if($resultado == true){
		header('Location: atencion_medica.php');
		$mensaje .='Atencion medica eliminada correctamente';
	}
?>