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
		$id = limpiarDatos($_POST['id']);
		$fecha = limpiarDatos($_POST['fecha']);
        $horai = limpiarDatos($_POST['horai']);
        $horaf = limpiarDatos($_POST['horaf']);
        $paciente = limpiarDatos($_POST['paciente']);
        $medico = limpiarDatos($_POST['medico']);
        $consultorio = limpiarDatos($_POST['consultorio']);
        $estado = limpiarDatos($_POST['estado']);
        $usuario = limpiarDatos($_POST['usuario']);
        $observaciones = limpiarDatos($_POST['observaciones']);
        $mensaje='';
         if((strtotime($_POST['horai'])) >= (strtotime($_POST['horaf']))){
		   $mensaje.= 'La hora de inicio no puede ser mayor que la hora final'."<br />";
		   echo $mensaje;
		   header('refresh:5; http://localhost/Clinic/citas.php');
	    }
	if($mensaje==''){
		$statement = $conexion->prepare(
		"UPDATE citas SET
        citfecha = :fecha,
        cithorai = :horai,
        cithoraf = :horaf,
        citPaciente = :paciente,
        citMedico = :medico,
        citConsultorio = :consultorio,
        citestado = :estado,
        idUsuario = :usuario,
        citobservaciones = :observaciones
		WHERE idcita =:id");

       
		$statement ->execute(array(
			':id'=>$id,
			':fecha'=> $fecha,
            ':horai'=> $horai,
            ':horaf'=> $horaf,
            ':paciente'=> $paciente,
            ':medico'=> $medico,
            ':consultorio'=> $consultorio,
            ':estado'=> $estado,
            ':usuario'=>$usuario,
            ':observaciones'=> $observaciones
			));
        header('Location: citas.php');
    }
	}else{
		$id_cita = id_numeros($_GET['idcita']);
		if(empty($id_cita)){
			header('Location: citas.php');
		}
		$cita = obtener_cita_id($conexion,$id_cita);
		
		if(!$cita){
			header('Location: citas.php');
		}
		$cita =$cita[0];
	}

	require 'vista/actualizarcitas_vista.php';
?>