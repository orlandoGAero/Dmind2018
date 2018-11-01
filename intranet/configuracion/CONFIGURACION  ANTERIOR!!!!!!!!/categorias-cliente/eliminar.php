<?php 
	include ("../../conexion.php");
	$id_categoria_cliente=$_GET["id_categoria"];
	$sql="DELETE FROM categoria_cliente WHERE id_categoria_cliente='$id_categoria_cliente'";
	$sql=mysql_query($sql);
	header("location: ./");
?>
