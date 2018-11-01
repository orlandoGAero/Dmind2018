<?php 
	include ("../../conexion.php");
	$id_ubicacion=$_GET["id_ubicacion"];
	$sql="DELETE FROM ubicaciones WHERE id_ubicacion='$id_ubicacion'";
	$sql=mysql_query($sql);
	header("location: ./");
?>
