<?php 
	include ("../conexion.php");
	$id_cont=$_GET["id_cont"];
	$id_clie=$_GET["id_clie"];
	$Eliminar="DELETE FROM clientexcontacto WHERE id_cliente=$id_clie and id_contacto=$id_cont";
	$Eliminar=mysql_query($Eliminar);

	header("location: editar.php?id_cont=$id_cont");
?>
