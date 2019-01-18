<?php
	session_start();
	// Manejamos en sesión el nombre del usuario que se ha logeado
	if(!isset($_SESSION["usuario"])){
		header("location:../");  
	}
	$_SESSION["usuario"];
	// Termina inicio de sesión

	require('../../class/egresos.php');
	$classEgresos = new egresos();

?>

<?php
	$band = 0;
	if (isset($_REQUEST['saveProv'])) {
		$guardarComoProveedor = $_REQUEST['saveProv'];
	}else{
		$guardarComoProveedor = 'No';
	}

	if (isset($_REQUEST['dataProd'])) {
		$guardarProductos = $_REQUEST['dataProd'];
	} else {
		$guardarProductos = null;
	}

	if( $classEgresos -> registrarEgresos($_REQUEST['txtEfectCompr'],
										$_REQUEST['txtVersion'],
										$_REQUEST['txtTipoCompr'],
										$_REQUEST['txtLugarExped'],
										$_REQUEST['txtFecha'],
										$_REQUEST['txtHora'],
										$_REQUEST['txtRfcEmisor'],
										$_REQUEST['txtNombreEmisor'],
										$guardarComoProveedor,
										$_REQUEST['txtPais_dfe'],
										$_REQUEST['txtEstado_dfe'],
										$_REQUEST['txtMunicipio_dfe'],
										$_REQUEST['txtColonia_dfe'],
										$_REQUEST['txtNumExt_dfe'],
										$_REQUEST['txtNumInt_dfe'],
										$_REQUEST['txtCalle_dfe'],
										$_REQUEST['txtCodPost_dfe'],
										$_REQUEST['txtRfcReceptor'],
										$_REQUEST['txtNombreReceptor'],
										$_REQUEST['txtusoCFDI'],
										$_REQUEST['txtSerie'],
										$_REQUEST['txtFolio'],
										$_REQUEST['conceptosFactura'],
										$guardarProductos,
										$_REQUEST['txtDescuento'],
										$_REQUEST['txtSubtotal'],
										$_REQUEST['txtIva'],
										$_REQUEST['txtTotal'],
										$_REQUEST['txtMoneda'],
										$_REQUEST['txtMetodoPago'],
										$_REQUEST['txtCondicionPago'],
										$_REQUEST['txtFormaPago'],
										$_REQUEST['txtFechaHoraPago'],
										$_REQUEST['txtNombreImpuesto'],
										$_REQUEST['txtTotalImpuesto'],
										$_REQUEST['txtTipoFactorImpuesto'],
										$_REQUEST['txtTasaImpuesto'],
										$_REQUEST['txtNumCuenta'],
										$_REQUEST['sltConcepto'],
										$_REQUEST['sltClasificacion'],
										$_REQUEST['sltStatus'],
										$_REQUEST['sltOrigen'],
										$_REQUEST['sltDestino'],
										$_REQUEST['txtEstadoComprobante'],
										$_REQUEST['txtFechaHoraCancelacion'],
										$_REQUEST['txtRegiFiscal'],
										$_REQUEST['txtFolioFiscal'],
										$_REQUEST['txtFechaTimbr'],
										$_REQUEST['txtHoraTimbr'],
										$_REQUEST['txtSello'],
										$_REQUEST['txtRFCprov'])) {
	$band = 0;
	}else{
		if(isset($classEgresos -> msjErr)) echo"<div class='error'><h3>".$classEgresos -> msjErr."</h3></div>";
		if(isset($classEgresos -> msjCap)) echo"<div class='caption'><h3>".$classEgresos -> msjCap."</h3></div>";
		$band = 1;
	}

	echo "
		<script type='text/javascript'>
			let $ = jQuery.noConflict();
			$( function() {
				var flag = ".$band.";
				if (flag == 0) {
					egresos.fancybox.close();
					$('#lista_egresos').load('nuevo_egreso.php');
				}
			} );

			setTimeout(function(){
				$('.error').fadeOut(1000);
			},5000);

			setTimeout(function(){
				$('.caption').fadeOut(1000);
			},5000);

		</script>
	";
?>