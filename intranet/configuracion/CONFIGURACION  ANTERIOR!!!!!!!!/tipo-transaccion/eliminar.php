<?php 
	include ("../../conexion.php");
	$id_tipo=$_GET["id_tipo"];
	$sql="DELETE FROM tipo_transaccion WHERE id_tipo_transaccion='$id_tipo'";
	$sql=mysql_query($sql);
	header("location: ./");
?>
