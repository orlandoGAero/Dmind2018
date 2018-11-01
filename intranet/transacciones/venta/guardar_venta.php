<?php
	session_start();
	// Manejamos en sesión el nombre del usuario que se ha logeado
	if(!isset($_SESSION["usuario"])){
		header("location:../");  
	}
	$_SESSION["usuario"];
	// Termina inicio de sesión

	require('../../conexion.php');
	require('funciones_ventas.php');

	$funcVentas = new funciones_ventas();

	$idVenta = $_REQUEST['txtNumVenta2'];
	$statusVenta = $_REQUEST['sltStatusV'];
	$tipoVenta = $_REQUEST['sltTipoVenta'];
	$tipoPago = $_REQUEST['sltFormaPago'];
	$idCliente = $_REQUEST['sltCliente'];
	$tipoMoneda = $_REQUEST['txtTipoMoneda'];
	$idInventario = $_REQUEST['txtIdInvTmp'];
	$cantidadProducto = $_REQUEST['txtCantidadPr'];
	$idProducto = $_REQUEST['txtIdPr'];
	$subtotal = $_REQUEST['txtSubtotalSinFormato'];
	$tipoImpuesto = $_REQUEST['sltImpuesto'];
	$porcentImpuesto = $_REQUEST['txtImpuesto'];
	$total = $_REQUEST['txtTotalSinFormato'];

	// print_r($_REQUEST);	

	if( $funcVentas -> registrarVenta($idVenta,$idCliente,$tipoMoneda,$statusVenta,$tipoVenta,$tipoPago,$idInventario,$cantidadProducto,$idProducto,$subtotal,$tipoImpuesto,$porcentImpuesto,$total) ){
		echo "<script type='text/javascript'>
				window.location.href = 'index.php';
			</script>";
	}

?>