<?php
include("../../conexion.php");

$id_cotizacion =$_GET["id_cotizacion"];
$id_cliente =$_GET["id_cliente"];

	$sql = "DELETE FROM detalle_cotizacion WHERE id_cotizacion = '$id_cotizacion' ";
	mysql_query($sql);
	echo $sql;
?>
<?php
	$sent = "UPDATE cotizacion SET subtotal='0', total='0' WHERE id_cotizacion='$id_cotizacion'";
	mysql_query($sent);
	echo $sent;
	

	header("location: ./?id_cotizacion=$id_cotizacion");
?>