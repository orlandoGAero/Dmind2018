<?php 
	include ("../../conexion.php");
	$id_areacontacto=$_GET["id_areacontacto"];
	$sql="DELETE FROM areacontacto WHERE id_areacontacto='$id_areacontacto'";
	$sql=mysql_query($sql);
	header("location: ./");
?>
