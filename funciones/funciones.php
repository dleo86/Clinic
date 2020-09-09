<?php
function ControlLocalidad($nombre){
	 $mensaje='';
    try{
     	$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
    }catch(PDOException $e){
	    echo "Error: ". $e->getMessage();
    }
    
    $consulta = $conexion -> prepare("
    	SELECT * FROM localidad WHERE lower(nombre) = lower('{$nombre}')");
    $consulta ->execute();
    $consulta = $consulta ->fetchAll();
    if($consulta != false){
	  $mensaje .= 'La localidad ya existe';
	  echo $mensaje;
    }
    return $mensaje;
}

function ControlUsuario($usuario){
	 $mensaje='';
    try{
     	$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
    }catch(PDOException $e){
	    echo "Error: ". $e->getMessage();
    }
    
    $consulta = $conexion -> prepare("
    	SELECT * FROM usuarios WHERE lower(usuario) = lower('{$usuario}')");
    $consulta ->execute();
    $consulta = $consulta ->fetchAll();
    if($consulta != false){
	  $mensaje .= 'El usuario ya existe';
	  //echo $mensaje;
    }
    return $mensaje;
}

function ListarPacientes() {
    $Listado = array();
    $mensaje='';
    try{
     	$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
    }catch(PDOException $e){
	    echo "Error: ". $e->getMessage();
    }

    $consulta = $conexion -> prepare("
	SELECT * FROM pacientes, obra_social where PacObraSocial = id_obrasocial"); 
    $consulta ->execute();
    $consulta = $consulta ->fetchAll();
    if(!$consulta){
	   $mensaje .= 'NO HAY PACIENTES PARA MOSTRAR';
    }

    return $Listado;
}

function BuscarPaciente($Patron_Nombre_Ingresado) {
    $mensaje='';
    try{
     	$conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
    }catch(PDOException $e){
	    echo "Error: ". $e->getMessage();
    }
    
    $consulta = $conexion -> prepare("
    	SELECT * FROM citas WHERE citPaciente LIKE '%$Patron_Nombre_Ingresado%' ORDER BY idcita LIMIT 5");
    $consulta ->execute();
    $consulta = $consulta ->fetchAll();
    if(!$consulta){
	  $mensaje .= 'NO HAY CITAS PARA MOSTRAR';
    }
    return $consulta;
}

function BuscarMedicamento($Patron_Nombre_Ingresado){
      $mensaje='';
    try{
        $conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
    }catch(PDOException $e){
        echo "Error: ". $e->getMessage();
    }
    $consulta = $conexion -> prepare("
        SELECT * FROM medicamento WHERE mednombre LIKE '%$Patron_Nombre_Ingresado%' ORDER BY idmedicamento LIMIT 5");
    $consulta ->execute();
    $consulta = $consulta ->fetchAll();
    if(!$consulta){
      $mensaje .= 'NO HAY MEDICAMENTOS PARA MOSTRAR';
    }
    return $consulta;
}

function BuscarLocalidad($Patron_Nombre_Ingresado){
      $mensaje='';
    try{
        $conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
    }catch(PDOException $e){
        echo "Error: ". $e->getMessage();
    }
    $consulta = $conexion -> prepare("
        SELECT * FROM localidad WHERE nombre LIKE '%$Patron_Nombre_Ingresado%' ORDER BY idLocalidad LIMIT 5");
    $consulta ->execute();
    $consulta = $consulta ->fetchAll();
    if(!$consulta){
      $mensaje .= 'NO HAY LOCALIDAD PARA MOSTRAR';
    }
    return $consulta;
}

function BuscarMedico($Patron_Apellido_Ingresado) {
    $mensaje='';
    try{
        $conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
    }catch(PDOException $e){
        echo "Error: ". $e->getMessage();
    }
    
    $consulta = $conexion -> prepare("
        SELECT * FROM medicos, persona WHERE medicos.idPersona = persona.idPersona AND persona.apellido LIKE '%$Patron_Apellido_Ingresado%' ORDER BY idMedico LIMIT 5");
    $consulta ->execute();
    $consulta = $consulta ->fetchAll();
    if(!$consulta){
      $mensaje .= 'NO HAY MEDICOS PARA MOSTRAR';
    }
    return $consulta;
}

function BuscarApPaciente($Patron_Nombre_Ingresado, $Patron_Apellido_Ingresado) {
    $mensaje='';
    try{
        $conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
    }catch(PDOException $e){
        echo "Error: ". $e->getMessage();
    }
    
    $consulta = $conexion -> prepare("
        SELECT * FROM pacientes, persona WHERE pacientes.idPersona = persona.idPersona AND persona.nombre LIKE '%$Patron_Nombre_Ingresado%' AND persona.apellido LIKE '%$Patron_Apellido_Ingresado%'  ORDER BY idPaciente LIMIT 5");
    $consulta ->execute();
    $consulta = $consulta ->fetchAll();
    if(!$consulta){
      $mensaje .= 'NO HAY PACIENTES PARA MOSTRAR';
    }
    return $consulta;
}

function BuscarConsultorio($Patron_Nombre_Ingresado) {
    $mensaje='';
    try{
        $conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
    }catch(PDOException $e){
        echo "Error: ". $e->getMessage();
    }
    
    $consulta = $conexion -> prepare("
        SELECT * FROM consultorios WHERE conNombre LIKE '%$Patron_Nombre_Ingresado%' ORDER BY idConsultorio LIMIT 5");
    $consulta ->execute();
    $consulta = $consulta ->fetchAll();
    if(!$consulta){
      $mensaje .= 'NO HAY CONSULTORIOS PARA MOSTRAR';
    }
    return $consulta;
}

function BuscarEspecialidad($Patron_Nombre_Ingresado) {
    $mensaje='';
    try{
        $conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
    }catch(PDOException $e){
        echo "Error: ". $e->getMessage();
    }
    
    $consulta = $conexion -> prepare("
        SELECT * FROM especialidades WHERE espNombre LIKE '%$Patron_Nombre_Ingresado%' ORDER BY idespecialidad LIMIT 5");
    $consulta ->execute();
    $consulta = $consulta ->fetchAll();
    if(!$consulta){
      $mensaje .= 'NO HAY ESPECIALIDAD PARA MOSTRAR';
    }
    return $consulta;
}

function BuscarObraSocial($Patron_Nombre_Ingresado) {
    $mensaje='';
    try{
        $conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
    }catch(PDOException $e){
        echo "Error: ". $e->getMessage();
    }
    
    $consulta = $conexion -> prepare("
        SELECT * FROM obra_social WHERE nombre LIKE '%$Patron_Nombre_Ingresado%' ORDER BY id_obrasocial LIMIT 5");
    $consulta ->execute();
    $consulta = $consulta ->fetchAll();
    if(!$consulta){
      $mensaje .= 'NO HAY OBRA SOCIAL PARA MOSTRAR';
    }
    return $consulta;
}

function BuscarUsuario($Patron_Nombre_Ingresado) {
    $mensaje='';
    try{
        $conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
    }catch(PDOException $e){
        echo "Error: ". $e->getMessage();
    }
    
    $consulta = $conexion -> prepare("
        SELECT * FROM usuarios, persona WHERE usuarios.idPersona = persona.idPersona AND usuarios.usuario LIKE '%$Patron_Nombre_Ingresado%' ORDER BY id LIMIT 5");
    $consulta ->execute();
    $consulta = $consulta ->fetchAll();
    if(!$consulta){
      $mensaje .= 'NO HAY OBRA SOCIAL PARA MOSTRAR';
    }
    return $consulta;
}

function ObtenerId($usuario){
    //$mensaje='';
    try{
        $conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
    }catch(PDOException $e){
        echo "Error: ". $e->getMessage();
    }
    
    $id = $conexion -> prepare("
       SELECT id FROM usuarios WHERE usuario = '".$usuario."'");
    $id ->execute();
    //$id = mysql_query("SELECT id FROM usuarios WHERE usuario = '".$usuario."'");
    //$valor = mysql_fetch_assoc($id);
    $valor = $id ->fetchAll();
   /* if(!$id){
      $mensaje .= 'NO HAY OBRA SOCIAL PARA MOSTRAR';
    }*/
    return $valor;
}
?>