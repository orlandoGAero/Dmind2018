<?php
	require('../../conexion.php');
	require('funciones_ventas.php');

	$funcVentas = new funciones_ventas();
	$idVenta = $funcVentas -> numeroVenta();
?>
<?php include 'tabla_venta_detalle.php' ?>