<?php 
include("../conexion.php");
$id_prov=$_GET["id_prov"];
$id_cont=$_GET["id_cont"];

	$GuardarC="INSERT INTO proveedorxcontacto VALUES (null,'$id_prov','$id_cont')";
	$GuardarC=mysql_query($GuardarC)or die(mysql_error());
header("location: ./editar.php?id_prov=$id_prov");
 ?>