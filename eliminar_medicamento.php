<?php
	$mensaje='';
	extract ($_REQUEST);
	try{
		$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}
	$sql="DELETE FROM medicamento WHERE idmedicamento = '$_REQUEST[idmedicamento]'";
	$resultado = $conexion->query($sql);

	if($resultado == true){
		header('Location: medicamentos.php');
		$mensaje .='Medicamento eliminado correctamente';
	}
?>