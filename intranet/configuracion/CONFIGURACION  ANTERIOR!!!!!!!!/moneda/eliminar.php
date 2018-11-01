<?php 
	include ("../../conexion.php");
	$id_moneda=$_GET["id_moneda"];
	$sql="DELETE FROM moneda WHERE id_moneda='$id_moneda'";
	$sql=mysql_query($sql);
	header("location: ./");
?>
