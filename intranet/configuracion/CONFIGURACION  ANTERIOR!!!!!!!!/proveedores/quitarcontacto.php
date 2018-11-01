<?php 
include ("../../conexion.php");
$id_cont=$_GET["id_cont"];
$id_prov=$_GET["id_prov"];

$eliminar="DELETE FROM proveedorxcontacto WHERE id_proveedor=$id_prov and id_contacto=$id_cont";
$eliminar=mysql_query($eliminar);
echo $eliminar;
header("location: ./editar.php?id_prov=$id_prov");
?>
