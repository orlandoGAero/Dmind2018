<?php
include("../conexion.php");
$id_prov=$_GET["id_prov"];
$id_cont=$_GET["id_cont"];

$query="UPDATE proveedorxcontacto SET id_contacto='$id_cont' WHERE id_proveedor='$id_prov'";
mysql_query($query) or die(mysql_error());
header("location: ./editar.php?id_prov=$id_prov");
?>