<?php 
	include ("../../conexion.php");
	$id_direccion=$_GET["id_direccion"];
	$sql="DELETE FROM direcciones WHERE id_direccion='$id_direccion'";
	$sql=mysql_query($sql);
	header("location: ./");
?>
