<?php 
	include ("../../conexion.php");
	$id_division=$_GET["id_division"];
	$sql="DELETE FROM division WHERE id_division='$id_division'";
	$sql=mysql_query($sql);
	header("location: ./");
?>
