<?php 
include ("../conexion.php");
$id_cont=$_GET["id_cont"];
$id_clie=$_GET["id_clie"];

$eliminar="DELETE FROM clientexcontacto WHERE id_cliente=$id_clie and id_contacto=$id_cont";
$eliminar=mysql_query($eliminar);
echo $eliminar;
header("location: ./editar.php?id_clie=$id_clie");
?>
