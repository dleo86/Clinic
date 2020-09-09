<?php
	$errores='';
	extract ($_REQUEST);
	try{
		$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}
	$sql="DELETE FROM historia_clinica WHERE id_hclinica = '$_REQUEST[id_hclinica]'";
	$resultado = $conexion->query($sql);

	if($resultado == true){
		header('Location: historia_clinica.php');
		$errores .='Historia clinica eliminada correctamente';
	}
?>