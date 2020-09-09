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
		//USUARIO
		$id = limpiarDatos($_POST['id']);
		$usuario = limpiarDatos($_POST['usuario']);
		$pass = limpiarDatos($_POST['pass']);
		$ingreso = limpiarDatos($_POST['ingreso']);
		$Roll = limpiarDatos($_POST['roll']);
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
		
		$statement3 = $conexion->prepare(
		"UPDATE usuarios
        SET 
		usuario =:usuario, 
		pass =:pass, 
		fechaIngreso =:ingreso,
		idPersona = :idD,
		Roll = :roll
		WHERE id = :id");

		$statement3 ->execute(array(
		':usuario'=>$usuario, 
		':pass'=>$pass,	
		':ingreso'=>$ingreso,  
		':roll'=>$Roll,
        ':id'=> $id
        ));
        header('Location: usuarios.php');
	}else{
		$id_usuario = id_numeros($_GET['id']);
		if(empty($id_usuario)){
			header('Location: usuarios.php');
		}
		$user = obtenerUser_id($conexion,$id_usuario);
		$persona = obtener_persona_id2($conexion,$id_usuario);
		$domicilio = obtener_domicilio_id2($conexion,$id_usuario);
		$localidad = obtener_localidad_id2($conexion,$id_usuario);
		if(!$user){
			header('Location: usuarios.php');
		}
    	if(!$persona){
			header('Location: usuarios.php');
		}
		if(!$domicilio){
			header('Location: usuarios.php');
		}
		if(!$localidad){
			header('Location: usuarios.php');
		}
		$user =$user[0];
	    $persona =$persona[0];
	    $domicilio =$domicilio[0];
	    $localidad = $localidad[0];
	
	}
	require 'vista/actualizarusuario.php';
?>