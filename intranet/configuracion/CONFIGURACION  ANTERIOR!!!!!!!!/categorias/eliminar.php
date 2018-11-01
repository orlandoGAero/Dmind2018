<?php 
	include ("../../conexion.php");
	$id_categoria=$_GET["id_categoria"];
	$sql="DELETE FROM categorias WHERE id_categoria='$id_categoria'";
	$sql=mysql_query($sql);
	header("location: ./");
?>
