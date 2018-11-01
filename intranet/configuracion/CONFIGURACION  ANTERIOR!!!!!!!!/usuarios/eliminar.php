<?php 
	include ("../../conexion.php");
	$id_usuario=$_GET["id_usuario"];
	$Eliminar="DELETE FROM usuarios WHERE id_usuario='$id_usuario'";
	$Eliminar=mysql_query($Eliminar);
	header("location: ./");
?>
