<?php session_start();
require_once 'funciones/funciones.php';
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	$nombre = $_POST['nombre'];
	$prov = $_POST['prov'];
	$mensaje='';
	$mensaje .= ControlLocalidad($nombre);
	if(isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }
	if(empty($nombre) or empty($prov)){
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
		'INSERT INTO localidad (idLocalidad, nombre, idProvincia) VALUES (null, :nombre, :prov)');

		$statement4 ->execute(array(
		':nombre'=> $nombre,
		':prov'=> $prov
		));
		header('Location: localidades.php');
		 
	}

}
require 'vista/agg_localidad_vista.php';
?>