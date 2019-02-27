<?php 

	require('../../class/egresos.php');
	$classEgresos = new egresos();

	function diverse_array($vector) { 
	    $result = array(); 
	    foreach($vector as $key1 => $value1) 
	        foreach($value1 as $key2 => $value2) 
	            $result[$key2][$key1] = $value2; 
	    return $result; 
	} 

	if (isset($_REQUEST)) {
		
		$datosEgresos = diverse_array($_REQUEST);

		$band = 0;
		// echo "<pre>";print_r($datosEgresos);echo "</pre>";
		foreach ($datosEgresos as $datoEg) {

			if ($datoEg['txtSerie'] != "")
				$numeroSerie = $datoEg['txtSerie'];
			else
				$numeroSerie = 'Sin Serie';

			if ($datoEg['txtFolio'] != "")
				$noFolio = $datoEg['txtFolio'];
			else
				$noFolio = 0;

			if ($datoEg['txtIva'] != "")
				$iva = $datoEg['txtIva'];
			else
				$iva = 0;

			if ($datoEg['txtNombreImpuesto'] != "")
				$nomImp = $datoEg['txtNombreImpuesto'];
			else
				$nomImp = 'N/A';

			if ($datoEg['txtTotalImpuesto'] != "")
				$totalImp = $datoEg['txtTotalImpuesto'];
			else
				$totalImp = 0;

			if ($datoEg['txtTasaImpuesto'] != "")
				$tasaImp = $datoEg['txtTasaImpuesto'];
			else
				$tasaImp = 0;

			if ($datoEg['txtMetodoPago'] != "")
				$metodoPago = $datoEg['txtMetodoPago'];
			else
				$metodoPago = 'N/A';

			if ($datoEg['txtFormaPago'] != "")
				$formaPago = $datoEg['txtFormaPago'];
			else
				$formaPago = 'N/A';

			if( $classEgresos -> registrarEgresos($datoEg['txtEfectCompr'],
													$datoEg['txtVersion'],
													$datoEg['txtTipoCompr'],
													$datoEg['txtLugarExped'],
													$datoEg['txtFecha'],
													$datoEg['txtHora'],
													$datoEg['txtRfcEmisor'],
													$datoEg['txtNombreEmisor'],
													null,
													'No',
													$datoEg['txtPais_dfe'],
													$datoEg['txtEstado_dfe'],
													$datoEg['txtMunicipio_dfe'],
													$datoEg['txtColonia_dfe'],
													$datoEg['txtNumExt_dfe'],
													$datoEg['txtNumInt_dfe'],
													$datoEg['txtCalle_dfe'],
													$datoEg['txtCodPost_dfe'],
													$datoEg['txtRfcReceptor'],
													$datoEg['txtNombreReceptor'],
													$datoEg['txtusoCFDI'],
													$numeroSerie,
													$noFolio,
													$datoEg['conceptosFactura'],
													null,
													$datoEg['txtDescuento'],
													$datoEg['txtSubtotal'],
													$iva,
													$datoEg['txtTotal'],
													$datoEg['txtMoneda'],
													$metodoPago,
													$datoEg['txtCondicionPago'],
													$formaPago,
													$datoEg['txtFechaHoraPago'],
													$nomImp,
													$totalImp,
													$datoEg['txtTipoFactorImpuesto'],
													$tasaImp,
													$datoEg['txtNumCuenta'],
													$datoEg['sltConcepto'],
													$datoEg['sltClasificacion'],
													$datoEg['sltStatus'],
													$datoEg['sltOrigen'],
													$datoEg['sltDestino'],
													$datoEg['txtEstadoComprobante'],
													$datoEg['txtFechaHoraCancelacion'],
													$datoEg['txtRegiFiscal'],
													$datoEg['txtFolioFiscal'],
													$datoEg['txtFechaTimbr'],
													$datoEg['txtHoraTimbr'],
													$datoEg['txtSello'],
													$datoEg['txtRFCprov'])) {
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
		}
	}
 ?>