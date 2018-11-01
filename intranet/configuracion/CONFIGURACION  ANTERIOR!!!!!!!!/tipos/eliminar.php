<?php 
	include ("../../conexion.php");
	$id_tipo=$_GET["id_tipo"];
	$sql="DELETE FROM tipos WHERE id_tipo='$id_tipo'";
	$sql=mysql_query($sql);
	header("location: ./");
?>
