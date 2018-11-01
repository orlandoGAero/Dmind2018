<?php
session_start();
//manejamos en sesion el nombre del usuario que se ha logeado
if (!isset($_SESSION["usuario"])){
    header("location:../");  
}
$_SESSION["usuario"];
//termina inicio de sesion
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Digital Mind</title>
  <link rel="shortcut icon" type="image/x-icon" href="../../images/favicon.ico" />
	<link rel="stylesheet" href="../../css/estilos.css" />
	<link rel="stylesheet" href="../../css/menu.css" />
	<link rel="stylesheet" href="../../css/tabla.css" />
	<link rel="stylesheet" href="../../css/formularios.css" />
	<script type="text/javascript" src="../../js/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="../../js/configuracion.js"></script>
</head>