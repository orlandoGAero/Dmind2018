<?php 
	include ("../../conexion.php");
	$id_estado=$_GET["id_estado"];
	$sql="DELETE FROM estados WHERE id_estado='$id_estado'";
	$sql=mysql_query($sql);
	header("location: ./");
?>
