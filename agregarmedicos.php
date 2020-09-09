<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	$nombre = filter_var(strtolower($_POST['nombres']),FILTER_SANITIZE_STRING);
	$apellidos = $_POST['apellidos'];
	$fechaNac = $_POST['fechaNac'];
	$correo =  $_POST['correo'];
	$identificacion =  $_POST['identificacion'];
	$dni = $_POST['dni'];
	$especialidad =  $_POST['especialidad'];
	$telefono =  $_POST['telefono'];
	$ingreso = $_POST['ingreso'];
	//DOMICILIO
	$calle = $_POST['calle'];
	$numero = $_POST['numero'];
	$piso = $_POST['piso'];
	$departamento = $_POST['departamento'];
	$codPostal = $_POST['codPostal'];
	//LOCALIDAD
	$loc = $_POST['loc'];
	$mensaje='';
	if(empty($nombre) or empty($apellidos)  or empty($identificacion)  or empty($fechaNac)){
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
		$statement3 = $conexion->prepare(
		'INSERT INTO domicilio (idDomicilio, calle, numero, piso, departamento, codPostal,idLocalidad)
		values(null,:calle,:numero,:piso,:departamento,:codPostal, :loc)');

		$statement3 ->execute(array(
		':calle'=> $calle,
		':numero'=>$numero,
		':piso'=>$piso,
		':departamento'=>$departamento,
		':codPostal'=>$codPostal,
		':loc'=>$loc
		));

	}

	if($mensaje==''){
		$statement = $conexion->prepare(
		'INSERT INTO persona (idPersona,nombre,apellido,fechaNacimiento,telefono,email,dni,idDomicilio)
		values(null, :nombre,:apellidos,:fechaNac,:telefono,:correo,:dni, (SELECT MAX(idDomicilio) FROM domicilio))');

		$statement ->execute(array(
		':nombre'=> $nombre,
		':apellidos'=>$apellidos,
		':fechaNac'=>$fechaNac,
		':telefono'=>$telefono,
		':correo'=>$correo,
		':dni'=>$dni
		));

	}
	
	if($mensaje==''){
		$statement1 = $conexion->prepare(
		'INSERT INTO medicos (idMedico,medidentificacion, medEspecialidad, medingreso, idPersona)
		values(default, :id,:especialidad,:ingreso, (SELECT MAX(idPersona) FROM persona))');

		$statement1 ->execute(array(
		':id'=>$identificacion,
		':especialidad'=>$especialidad,
		':ingreso'=>$ingreso
		));
		header('Location: medicos.php');
	}	 
}
require 'vista/agg_medicos_vista.php';
?>