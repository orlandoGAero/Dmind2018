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
		foreach ($datosEgresos as $datoEg) {
			
			if( $classEgresos -> registrarEgresos($datoEg['txtEfectCompr'],
													$datoEg['txtVersion'],
													$datoEg['txtTipoCompr'],
													$datoEg['txtLugarExped'],
													$datoEg['txtFecha'],
													$datoEg['txtHora'],
													$datoEg['txtRfcEmisor'],
													$datoEg['txtNombreEmisor'],
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
													$datoEg['txtSerie'],
													$datoEg['txtFolio'],
													$datoEg['conceptosFactura'],
													null,
													$datoEg['txtDescuento'],
													$datoEg['txtSubtotal'],
													$datoEg['txtIva'],
													$datoEg['txtTotal'],
													$datoEg['txtMoneda'],
													$datoEg['txtMetodoPago'],
													$datoEg['txtCondicionPago'],
													$datoEg['txtFormaPago'],
													$datoEg['txtFechaHoraPago'],
													$datoEg['txtNombreImpuesto'],
													$datoEg['txtTotalImpuesto'],
													$datoEg['txtTipoFactorImpuesto'],
													$datoEg['txtTasaImpuesto'],
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

			// print "----bandera-------".$band;

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