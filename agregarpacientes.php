<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	$nombre = $_POST['nombres'];
	$apellidos = $_POST['apellidos'];
	$fechaNac = $_POST['fechaNac'];
	$correo =  $_POST['correo'];
	$dni = $_POST['dni'];
	$telefono =  $_POST['telefono'];
	//DOMICILIO
	$calle = $_POST['calle'];
	$numero = $_POST['numero'];
	$piso = $_POST['piso'];
	$departamento = $_POST['departamento'];
	$codPostal = $_POST['codPostal'];
	//LOCALIDAD
	$loc = $_POST['loc'];
	//PACIENTE
	$sexo =  $_POST['sexo'];
	$obrasocial =  $_POST['obrasocial'];
	$estado =  $_POST['estado'];
	$mensaje='';
	if(empty($nombre) or empty($apellidos)){
		$mensaje.= 'Por favor rellena todos los datos correctamente'."<br />";
	}
	else{	
		try{
			$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
		}catch(PDOException $e){
			echo "Error: ". $e->getMessage();
			die();
		}
		/*
		$statement = $conexion -> prepare(
			'SELECT * FROM pacientes WHERE idPaciente = :id LIMIT 1');
		$statement ->execute(array(':id'=>$identificacion));
		$resultado= $statement->fetch();

		if($resultado != false){
			$mensaje .='Ya existe un paciente con esa identificación </br>';
		}*/
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
		'INSERT INTO pacientes (idPaciente, idPersona, pacSexo, PacObraSocial, pacEstado)
		values(default, (SELECT MAX(idPersona) FROM persona),:sexo,:obrasocial,:pacEstado)');

		$statement1 ->execute(array(
		':sexo'=> $sexo,
		':obrasocial'=>$obrasocial,
		':pacEstado'=>$estado
		));
		header('Location: pacientes.php');
	}
}
require 'vista/agg_pacientes_vista.php';
?>