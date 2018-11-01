<?php
include ("../../conexion.php");

$id_venta=$_GET["id_venta"];
$id_producto=$_GET["id_producto"];
$nota=$_GET["nota"];

$sql="UPDATE detalle_venta SET nota='$nota' WHERE id_venta=$id_venta and id_producto=$id_producto";
$sql=mysql_query($sql)or die(mysql_error());
header("location: ./?venta=$id_venta");
?>
