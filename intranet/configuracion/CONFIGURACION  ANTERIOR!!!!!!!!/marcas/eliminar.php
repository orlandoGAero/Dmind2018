<?php 
	include ("../../conexion.php");
	$id_marca=$_GET["id_marca"];
	$sql="DELETE FROM marcas WHERE id_marca='$id_marca'";
	$sql=mysql_query($sql);
	header("location: ./");
?>
