<?php
	session_start();
	// Manejamos en sesión el nombre del usuario que se ha logeado
	if(!isset($_SESSION["usuario"])){
		header("location:../");  
	}
	$_SESSION["usuario"];
	// Termina inicio de sesión

	require('../../class/ingresos.php');
	$classIngresos = new ingresos();

?>

<?php
	$band = 0;

	if( $classIngresos -> registrarIngresos($_REQUEST['txtEfectCompr'],
										$_REQUEST['txtVersion'],
										$_REQUEST['txtTipoCompr'],
										$_REQUEST['txtLugarExped'],
										$_REQUEST['txtFecha'],
										$_REQUEST['txtHora'],
										$_REQUEST['txtRfcEmisor'],
										$_REQUEST['txtNombreEmisor'],
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
		if(isset($classIngresos -> msjErr)) echo"<div class='error'><h3>".$classIngresos -> msjErr."</h3></div>";
		if(isset($classIngresos -> msjCap)) echo"<div class='caption'><h3>".$classIngresos -> msjCap."</h3></div>";
		$band = 1;
	}

	echo "
		<script type='text/javascript'>
			
			var regIgreGuardar = jQuery.noConflict();

			regIgreGuardar( function() {
				var flag = ".$band.";
				if (flag == 0) {
					ingresos.fancybox.close();
					regIgreGuardar('#lista_ingresos').load('nuevo_ingreso.php');
				}
			} );

			setTimeout(function(){
				regIgreGuardar('.error').fadeOut(1000);
			},5000);

			setTimeout(function(){
				regIgreGuardar('.caption').fadeOut(1000);
			},5000);

		</script>
	";
?>