<?php 
	include ("../../conexion.php");
	$id_nombre=$_GET["id_nombre"];
	$sql="DELETE FROM nombres WHERE id_nombre='$id_nombre'";
	$sql=mysql_query($sql);
	header("location: ./");
?>
