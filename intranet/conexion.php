<?php
	$server="localhost";
	$user="desarrollo";
	$pass="entraradmin";
	$dataBase = "digitalm";
	$enlace=mysql_connect($server,$user,$pass) or die ("Error en la conexion");
	mysql_select_db($dataBase,$enlace) or die ("La Base de Datos no existe");
	mysql_set_charset('utf8');
?>
