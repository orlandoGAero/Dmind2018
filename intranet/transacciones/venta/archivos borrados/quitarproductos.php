<?php
include("../../conexion.php");

$id_venta=$_GET["id_venta"];

	$sql = "DELETE FROM detalle_venta WHERE id_venta='$id_venta'";
	mysql_query($sql);
	echo $sql;
?>
<?php
	$sent = "UPDATE venta SET subtotal='0', total='0' WHERE id_venta='$id_venta'";
	mysql_query($sent);
	echo $sent;
	

	header("location: ./?venta=$id_venta");
?>