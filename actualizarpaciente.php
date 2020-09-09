<?php session_start();
	if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
	}
	
	require 'funciones.php';
	
	try{
		$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
	}catch(PDOException $e){
		echo "ERROR: " . $e->getMessge();
		die();
	}
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		//PACIENTE
		$idPac = limpiarDatos($_POST['idPac']);
	    $sexo =  limpiarDatos($_POST['sexo']);
	    $obrasocial = limpiarDatos($_POST['obrasocial']);
	    $estado =  limpiarDatos($_POST['estado']);
	    //PERSONA
		$idP = limpiarDatos($_POST['idP']);
		$nombres = limpiarDatos($_POST['nombres']);
		$apellidos = limpiarDatos($_POST['apellidos']);
		$correo = limpiarDatos($_POST['correo']);
		$telefono = limpiarDatos($_POST['telefono']);
		$dni = limpiarDatos($_POST['dni']);
		$fechaNac = limpiarDatos($_POST['fechaNac']);
		//DOMICILIO
		$idD = limpiarDatos($_POST['idD']);
	    $calle = limpiarDatos($_POST['calle']);
	    $numero = limpiarDatos($_POST['numero']);
	    $piso = limpiarDatos($_POST['piso']);
	    $departamento = limpiarDatos($_POST['departamento']);
	    $codPostal = limpiarDatos($_POST['codPostal']);
	    //LOCALIDAD
	    $idL = limpiarDatos($_POST['idL']);
	    $loc = limpiarDatos($_POST['loc']);

		
		$statement1 = $conexion->prepare(
		"UPDATE domicilio
        SET calle = :calle,  
		numero =:numero, 
		piso = :piso,
		departamento = :departamento,
		codPostal = :codPostal,
		idLocalidad = :loc
		WHERE idDomicilio = :idD");

		$statement1 ->execute(array(
        ':calle'=>$calle, 
		':numero'=>$numero, 
		':piso'=>$piso,
		':departamento'=>$departamento,
        ':codPostal'=> $codPostal,
        ':loc'=>$loc,
        ':idD'=>$idD
        ));

		$statement2 = $conexion->prepare(
		"UPDATE persona
        SET nombre = :nombres,  
		apellido =:apellidos, 
		fechaNacimiento = :fechaNac,
		telefono = :telefono,
		dni = :dni,
		email = :correo,
		idDomicilio = :idD
		WHERE idPersona = :idP");

		$statement2 ->execute(array(
        ':nombres'=>$nombres, 
		':apellidos'=>$apellidos, 
		':fechaNac'=>$fechaNac,
		':telefono'=>$telefono,
        ':dni'=> $dni,
        ':correo'=>$correo,
        ':idD'=>$idD,
        ':idP'=>$idP
        ));
        $statement = $conexion->prepare(
		"UPDATE pacientes SET 
		idPersona = :idD,
        pacSexo = :sexo,
        PacObraSocial = :obrasocial,
        pacEstado =:estado
        WHERE idPaciente = :idPac");
		$statement ->execute(array(
			':idD'=>$idPersona,
			':sexo'=>$sexo, 
			':obrasocial'=>$obrasocial, 
			':estado'=>$estado ));
        header('Location: pacientes.php');
	}else{
		$idPaciente = id_numeros($_GET['idPaciente']);
		if(empty($idPaciente)){
			header('Location: pacientes.php'); 
		}
		$pacientes = obtener_pacientes_id($conexion,$idPaciente);
		$persona = obtener_persona_id1($conexion,$idPaciente);
		$domicilio = obtener_domicilio_id1($conexion,$idPaciente);
		$localidad = obtener_localidad_id1($conexion,$idPaciente);
		
		if(!$pacientes){
			header('Location: pacientes.php');
		}
		if(!$persona){
			header('Location: pacientes.php');
		}
		if(!$domicilio){
			header('Location: pacientes.php');
		}
		if(!$localidad){
			header('Location: pacientes.php');
		}
		$pacientes =$pacientes[0];
		$persona =$persona[0];
		$domicilio =$domicilio[0];
		$localidad = $localidad[0];
	}
	require 'vista/actualizarpaciente_vista.php';
?>