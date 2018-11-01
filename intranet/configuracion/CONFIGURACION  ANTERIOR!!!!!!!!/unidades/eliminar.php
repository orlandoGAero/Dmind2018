<?php 
	include ("../../conexion.php");
	$id_unidad=$_GET["id_unidad"];
	$sql="DELETE FROM unidades WHERE id_unidad='$id_unidad'";
	$sql=mysql_query($sql);
	header("location: ./");
?>
