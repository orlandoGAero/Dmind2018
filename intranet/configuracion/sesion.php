<?php
	$sesion = 0;
	session_start();
	//manejamos en sesion el nombre del usuario que se ha logeado
	if (!isset($_SESSION["usuario"])){
	    header("location:../");  
	    $sesion = 1; 
	}
	$_SESSION["usuario"];
	//termina inicio de sesion
?>