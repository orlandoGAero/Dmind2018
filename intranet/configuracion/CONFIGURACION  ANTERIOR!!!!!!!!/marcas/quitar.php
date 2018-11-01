<?php 
	include ("../../conexion.php");
	$id_marca=$_GET["id_marca"];
	$nombre_marca=$_GET["nombre_marca"];
	$id_categoria=$_GET["id_categoria"];
	$sql="DELETE FROM marcas WHERE nombre_marca='$nombre_marca' and id_categoria='$id_categoria'";
	$sql=mysql_query($sql);
	header("location: ./editar.php?id_marca=$id_marca");
?>
