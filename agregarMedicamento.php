<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	$mednombre = $_POST['mednombre'];
	$mensaje='';
	if(isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }
	if(empty($mednombre)){
		$mensaje.= 'Por favor rellena todos los datos correctamente'."<br />";
	}
	else{	
		try{
			$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
		}catch(PDOException $e){
			echo "Error: ". $e->getMessage();
			die();
		}
	}

	if($mensaje==''){
		$statement4 = $conexion->prepare(
		'INSERT INTO medicamento (idmedicamento, mednombre) VALUES (default, :mednombre)');

		$statement4 ->execute(array(
		':mednombre'=> $mednombre
		));
		header('Location: medicamentos.php');
		 
	}

}
require 'vista/agg_medicamento_vista.php';
?>