<?php session_start();
//$_SESSION['id'] = session_id(); 
//echo "La sesion actual es".session_id($_GET['id']);
//$_SESSION['id'] = $userData['user_id'];
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}
require 'vista/usuarios_vista.php';

?>