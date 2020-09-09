<?php session_start();
if(isset($_SESSION['usuario'])){
	require 'vista/medicamentos_vista.php';
}else{
	header('Location: login.php');
}
?>