<?php 
	include ("../../conexion.php");
	$id_status=$_GET["id_status"];
	$sql="DELETE FROM status_inventario WHERE id_status='$id_status'";
	$sql=mysql_query($sql);
	header("location: ./");
?>
