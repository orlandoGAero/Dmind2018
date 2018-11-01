<?php
	session_start();
	//manejamos en sesion el nombre del usuario que se ha logeado
	if (!isset($_SESSION["usuario"])){
	    header("location:../../");  
	}
	$_SESSION["usuario"];
	//termina inicio de sesion

	header("Location:../");
	exit;
?>