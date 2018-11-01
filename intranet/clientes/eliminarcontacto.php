<?php 
	include ("../conexion.php");
	$id=$_GET["id"];
	$Eliminar="DELETE FROM clientesxcontactos WHERE id_contacto='$id'";
	$Eliminar=mysql_query($Eliminar);
	header("location: editar.php?id=$id");
?>
