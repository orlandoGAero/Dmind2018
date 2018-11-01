<?php 
	include ("../../conexion.php");
	$id_subcategoria=$_GET["id_subcategoria"];
	$sql="DELETE FROM subcategorias WHERE id_subcategoria='$id_subcategoria'";
	$sql=mysql_query($sql);
	header("location: ./");
?>
