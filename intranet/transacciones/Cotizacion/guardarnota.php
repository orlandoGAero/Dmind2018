<?php
include ("../../conexion.php");

$id_cotizacion=$_GET["id_cotizacion"];
$id_producto=$_GET["id_producto"];
$nota=$_GET["nota"];

$sql="UPDATE detalle_cotizacion SET nota='$nota' WHERE id_cotizacion=$id_cotizacion and id_producto=$id_producto";
$sql=mysql_query($sql)or die(mysql_error());
header("location: ./?id_cotizacion=$id_cotizacion");
?>
