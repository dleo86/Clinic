<?php session_start();
if(isset($_SESSION['usuario'])){
	require 'vista/localidades_vista.php';
}else{
	header('Location: login.php');
}
?>