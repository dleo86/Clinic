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
		//MEDICO
		$idM = limpiarDatos($_POST['idM']);
		$identificacion = limpiarDatos($_POST['identificacion']);
		$ingreso = limpiarDatos($_POST['ingreso']);
		$especialidad = limpiarDatos($_POST['especialidad']);
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
		//$nomloc = limpiarDatos($_POST['nombre']);

		/*$statement4 = $conexion->prepare(
		"UPDATE localidad
        SET nombre = :loc  
		
		WHERE idLocalidad = :idL");

		$statement4 ->execute(array(
        ':loc'=>$loc, 
		':idL'=>$idL
        ));*/

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

		$statement3 = $conexion->prepare(
		"UPDATE medicos
        SET medidentificacion = :identificacion,  
		medEspecialidad =:especialidad, 
		medingreso = :ingreso,
		idPersona = :idD
		WHERE idMedico = :idM");

		$statement3 ->execute(array(
        ':identificacion'=>$identificacion, 
		':especialidad'=>$especialidad, 
		':ingreso'=>$ingreso,
		':idD'=>$idP,
        ':idM'=> $idM
        ));
        header('Location: medicos.php');
	}else{
		$id_medico = id_numeros($_GET['idMedico']);
		if(empty($id_medico)){
			header('Location: medicos.php');
		}

/*		$id_persona = id_numeros($_GET['idPersona']);
		if(empty($id_persona)){
			header('Location: medicos.php');
		} 

		$id_domicilio = id_numeros($_GET['idDomicilio']);
		if(empty($id_domicilio)){
			header('Location: medicos.php');
		}

	/*	$id_localidad = id_numeros($_GET['idLocalidad']);
		if(empty($id_localidad)){
			header('Location: medicos.php');
		}*/
		$medico = obtener_medico_id($conexion,$id_medico);
		$persona = obtener_persona_id($conexion,$id_medico);
		$domicilio = obtener_domicilio_id($conexion,$id_medico);
		$localidad = obtener_localidad_id($conexion,$id_medico);
		if(!$medico){
			header('Location: medicos.php');
		}
		if(!$persona){
			header('Location: medicos.php');
		}
		if(!$domicilio){
			header('Location: medicos.php');
		}
		if(!$localidad){
			header('Location: medicos.php');
		}
		$medico =$medico[0];
	    $persona =$persona[0];
		$domicilio =$domicilio[0];
		$localidad = $localidad[0];
	}
	require 'vista/actulizarmedico_vista.php';
?>