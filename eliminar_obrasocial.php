<?php
	$mensaje='';
	extract ($_REQUEST);
	try{
		$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}
	$sql="DELETE FROM obra_social WHERE id_obrasocial = '$_REQUEST[id_obrasocial]'";
	$resultado = $conexion->query($sql);

	if($resultado == true){
		header('Location: obra_social.php');
		$mensaje .='Obra social eliminada correctamente';
	}
?>