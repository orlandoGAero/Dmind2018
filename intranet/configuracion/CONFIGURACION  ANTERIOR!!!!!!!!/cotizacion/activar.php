<?php
include ("../../conexion.php");
$id_cot=$_GET["id_cot"];

$sql="UPDATE cotizacion SET estado='1' WHERE id_cotizacion=$id_cot";
$sql=mysql_query($sql)or die(mysql_error());
header("location: ./");
?>
