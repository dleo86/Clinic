<?php
	function conexion(){
		try{
			$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
			return $conexion;
		}catch(PDOException $e){
			return false;
		}
	}
	function limpiarDatos($datos){
		$datos = trim($datos);//Elimina espacio en blanco
		$datos = stripslashes($datos);//quita las barras del string
		$datos = htmlspecialchars($datos);//Convierte caracteres especiales en entidades HTML
		return $datos;
	}
	function id_numeros($id){
		return (int)limpiarDatos($id);
	}

	function obtener_medicamento_id($conexion,$id){
		$resultado = $conexion->query("SELECT * FROM medicamento WHERE idmedicamento = $id LIMIT 1");
		$resultado = $resultado->fetchAll();
		return ($resultado) ? $resultado : false;
	}
	function obtener_localidad_id($conexion,$id){
		$resultado = $conexion->query("SELECT * FROM domicilio, persona, medicos, localidad WHERE idMedico = $id AND medicos.idPersona = persona.idPersona AND domicilio.idDomicilio = persona.idDomicilio AND localidad.idLocalidad = domicilio.idLocalidad  LIMIT 1");
		$resultado = $resultado->fetchAll();
		return ($resultado) ? $resultado : false;
	}
	function obtener_localidad_id1($conexion,$id){
		$resultado = $conexion->query("SELECT * FROM domicilio, persona, pacientes, localidad WHERE idPaciente = $id AND pacientes.idPersona = persona.idPersona AND domicilio.idDomicilio = persona.idDomicilio AND localidad.idLocalidad = domicilio.idLocalidad  LIMIT 1");
		$resultado = $resultado->fetchAll();
		return ($resultado) ? $resultado : false;
	}
	function obtener_localidad_id2($conexion,$id){
		$resultado = $conexion->query("SELECT * FROM domicilio, persona, usuarios, localidad WHERE id = $id AND usuarios.idPersona = persona.idPersona AND domicilio.idDomicilio = persona.idDomicilio AND localidad.idLocalidad = domicilio.idLocalidad  LIMIT 1");
		$resultado = $resultado->fetchAll();
		return ($resultado) ? $resultado : false;
	}
	function obtener_localidad_id3($conexion,$id){
		$resultado = $conexion->query("SELECT * FROM localidad WHERE idLocalidad = $id LIMIT 1");
		$resultado = $resultado->fetchAll();
		return ($resultado) ? $resultado : false;
	}

	function obtener_domicilio_id($conexion,$id){
		$resultado = $conexion->query("SELECT * FROM domicilio, persona, medicos WHERE idMedico = $id AND medicos.idPersona = persona.idPersona AND domicilio.idDomicilio = persona.idDomicilio LIMIT 1");
		$resultado = $resultado->fetchAll();
		return ($resultado) ? $resultado : false;
	}
	function obtener_domicilio_id1($conexion,$id){
		$resultado = $conexion->query("SELECT * FROM domicilio, persona, pacientes WHERE idPaciente = $id AND pacientes.idPersona = persona.idPersona AND domicilio.idDomicilio = persona.idDomicilio LIMIT 1");
		$resultado = $resultado->fetchAll();
		return ($resultado) ? $resultado : false;
	}
	function obtener_domicilio_id2($conexion,$id){
		$resultado = $conexion->query("SELECT * FROM domicilio, persona, usuarios WHERE id = $id AND usuarios.idPersona = persona.idPersona AND domicilio.idDomicilio = persona.idDomicilio LIMIT 1");
		$resultado = $resultado->fetchAll();
		return ($resultado) ? $resultado : false;
	}

	function obtener_persona_id($conexion,$id){
		$resultado = $conexion->query("SELECT * FROM medicos, persona WHERE idMedico = $id AND medicos.idPersona = persona.idPersona LIMIT 1");
		$resultado = $resultado->fetchAll();
		return ($resultado) ? $resultado : false;
	}
	function obtener_persona_id1($conexion,$id){
		$resultado = $conexion->query("SELECT * FROM pacientes, persona WHERE idPaciente = $id AND pacientes.idPersona = persona.idPersona LIMIT 1");
		$resultado = $resultado->fetchAll();
		return ($resultado) ? $resultado : false;
	}
	function obtener_persona_id2($conexion,$id){
		$resultado = $conexion->query("SELECT * FROM usuarios, persona WHERE id = $id AND usuarios.idPersona = persona.idPersona LIMIT 1");
		$resultado = $resultado->fetchAll();
		return ($resultado) ? $resultado : false;
	}

	function obtener_medico_id($conexion,$id){
		$resultado = $conexion->query("SELECT * FROM medicos WHERE idMedico = $id LIMIT 1");
		$resultado = $resultado->fetchAll();
		return ($resultado) ? $resultado : false;
	}
    function obtenerUser_id($conexion,$id){
        $resultado = $conexion->query("SELECT * FROM usuarios WHERE id = $id LIMIT 1");
		$resultado = $resultado->fetchall();
		return ($resultado) ? $resultado : false;
        
    }
    function obtener_consultorio_id($conexion,$id_consultorio){
        $resultado = $conexion->query("SELECT * FROM consultorios WHERE idConsultorio = $id_consultorio LIMIT 1");
		$resultado = $resultado->fetchall();
		return ($resultado) ? $resultado : false;
    }
    function obtener_especialidad_id($conexion,$id_especialidad){
        $resultado = $conexion->query("SELECT * FROM especialidades WHERE idespecialidad = $id_especialidad LIMIT 1");
		$resultado = $resultado->fetchall();
		return ($resultado) ? $resultado : false;
    }
    function obtener_obra_social_id($conexion,$id_obrasocial){
        $resultado = $conexion->query("SELECT * FROM obra_social WHERE id_obrasocial = $id_obrasocial LIMIT 1");
		$resultado = $resultado->fetchall();
		return ($resultado) ? $resultado : false;
    }
    function obtener_cita_id($conexion,$id_cita){
        $resultado = $conexion->query("SELECT * FROM citas WHERE idcita = $id_cita LIMIT 1");
		$resultado = $resultado->fetchall();
		return ($resultado) ? $resultado : false;
    }
    function obtener_atencion_medica_id($conexion,$id_atmedica){
        $resultado = $conexion->query("SELECT * FROM atencion_medica WHERE id_atmedica = $id_atmedica LIMIT 1");
		$resultado = $resultado->fetchall();
		return ($resultado) ? $resultado : false;
    }
    function obtener_historia_clinica_id($conexion,$id_hclinica){
        $resultado = $conexion->query("SELECT * FROM historia_clinica WHERE id_hclinica = $id_hclinica LIMIT 1");
		$resultado = $resultado->fetchall();
		return ($resultado) ? $resultado : false;
    }
    function obtener_pacientes_id($conexion,$idPaciente){
        $resultado = $conexion->query("SELECT * FROM pacientes WHERE idPaciente = $idPaciente LIMIT 1");
		$resultado = $resultado->fetchall();
		return ($resultado) ? $resultado : false;
    }

?>