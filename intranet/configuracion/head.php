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
  <link rel="shortcut icon" type="image/x-icon" href="../../../images/favicon.ico" />
	<link rel="stylesheet" href="../../../css/estilos.css" />
	<link rel="stylesheet" href="../../../css/menu.css" />
	<link rel="stylesheet" href="../../../css/tabla.css" />
	<link rel="stylesheet" href="../../../css/formularios.css" />
	<link rel="stylesheet" href="../../../css/busqueda.css" />
	<link rel="stylesheet" type="text/css" href="../../../css/mensajes.css" />
	<link rel="stylesheet" type="text/css" href="../../../css/menu_individual_config.css" />
	 <!-- jQuery -->
    <script type="text/javascript" src="../../../js/jquery-1.7.1.min.js" ></script>
    <script type="text/javascript" src="../../../js/configuracion.js"></script>
    <!-- FancyBox-->
	<!-- CSS --><link rel="stylesheet" type="text/css" href="../../../libs/fancyBox/source/jquery.fancybox.css">	
	<!-- JS --><script type="text/javascript" src="../../../libs/fancyBox/source/jquery.fancybox.js" ></script>
	<!-- DataTables -->
    <!-- CSS --><link rel="stylesheet" type="text/css" href="../../../libs/dataTables/css/datatables.css">
    <!-- JS --><script type="text/javascript" src="../../../libs/dataTables/js/jquery.dataTables.js" ></script>
    <!-- JS Filtrar Columnas --><script type="text/javascript" src="../../../libs/dataTables/js/dataTables.columnFilter.js" ></script>	
</head>