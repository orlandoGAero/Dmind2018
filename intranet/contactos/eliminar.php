<?php 
	include ("../conexion.php");
	$id_cont=$_GET["id_cont"];
	$Eliminar="DELETE FROM contactos WHERE id_contacto='$id_cont'";
	$Eliminar=mysql_query($Eliminar);
	
	$query="DELETE FROM proveedorxcontacto WHERE id_contacto='$id_cont'";
	$query=mysql_query($query);

	$mys="DELETE FROM clientexcontacto WHERE id_contacto='$id_cont'";
	$mys=mysql_query($mys);

	$id_dir=$_GET["id_dir"];
	$sql="DELETE FROM direcciones WHERE id_direccion='$id_dir'";
	$sql=mysql_query($sql);

	header("location: ./");
?>
