<?php
	require('../../conexion.php');
	require('funciones_ventas.php');

	$funcVentas = new funciones_ventas();
	$idp = $_REQUEST['txt_idV'];
	$funcVentas -> borrar_producto($idp);
	$idVenta = $funcVentas -> numeroVenta();
?>
	<?php include 'tabla_venta_detalle.php' ?>
