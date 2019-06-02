<?php 
	require('../../class/ingresos.php');
	$classIngresos = new ingresos();

	// function diverse_array($vector) { 
	//     $result = array(); 
	//     foreach($vector as $key1 => $value1) 
	//         foreach($value1 as $key2 => $value2) 
	//             $result[$key2][$key1] = $value2; 
	//     return $result; 
	// }

	if (isset($_REQUEST['btnNameGuardarV'])) {
		$nomBtn = $_REQUEST['btnNameGuardarV'];
	}

	if (isset($_REQUEST['ingresos'])) {
		$ingresos = $_REQUEST['ingresos'];
		
		// $datosIngresos = diverse_array($ingresos);
		// print_r($datosIngresos);
		$fechaHrPago = '';
		$cuenta = '';
		$concepto = '';
		$clasificacion = '';
		$status = '';
		$origen = '';
		$destino = '';
		$estadoCompr = '';
		$fechaHrCancel = '';
		
		// if (isset($datoEg['ivaI']) != "")
		// 		$iva = $datoEg['txtIva'];
		// else
		// 	$iva = 0;

		$band = 0;

		foreach ($ingresos as $datoIng) :

			if( $classIngresos -> registrarIngresos('INGRESO',
											$datoIng['versionI'],
											$datoIng['tipoComprobanteI'],
											$datoIng['lugarExpI'],
											$datoIng['fechaI'],
											$datoIng['horaI'],
											$datoIng['rfcEmisorI'],
											$datoIng['nombreEmisorI'],
											$datoIng['dirPaisI'],
											$datoIng['dirEstadoI'],
											$datoIng['dirMunicipioI'],
											$datoIng['dirColoniaI'],
											$datoIng['dirNExtI'],
											$datoIng['dirNIntI'],
											$datoIng['dirCalleI'],
											$datoIng['dirCodPostI'],
											$datoIng['rfcReceptorI'],
											$datoIng['nombreReceptorI'],
											$datoIng['usoCfdiReceptorI'],
											$datoIng['serieI'],
											$datoIng['folioI'],

											$datoIng['conceptosFacturas'],

											$datoIng['descuentoI'],
											$datoIng['subtotalI'],
											$datoIng['importeImpuestoI'],
											$datoIng['totalI'],
											$datoIng['monedaI'],
											$datoIng['metodoPagoI'],
											$datoIng['condicionPagoI'],
											$datoIng['formaPagoI'],

											$fechaHrPago,

											$datoIng['tipoImpuestoI'],
											$datoIng['totalImpuestosI'],
											$datoIng['tipoFactorImpuestoI'],
											$datoIng['tasaCuotaImpuestoI'],

											$cuenta,
											$concepto,
											$clasificacion,
											$status,
											$origen,
											$destino,
											$estadoCompr,
											$fechaHrCancel,

											$datoIng['regimenFiscalI'],
											$datoIng['folioFiscalI'],
											$datoIng['fechaTimbradoI'],
											$datoIng['horaTimbradoI'],
											$datoIng['selloI'],
											$datoIng['rfcProvI'],
											$nomBtn) ) {

				if (isset($classIngresos -> msjSuccess)) echo "<div class='success' id='ok'><h3>".$classIngresos -> msjSuccess."</h3></div>";
				$band = 0;
			} else{
				if(isset($classIngresos -> msjErr)) echo "<div class='error'><h3>".$classIngresos -> msjErr."</h3></div>";
				if(isset($classIngresos -> msjCap)) echo "<div class='caption'><h3>".$classIngresos -> msjCap."</h3></div>";
				$band = 1;
			}
		endforeach;
		$bandera = json_encode($band);
		echo "<div id='banderaReg' data-bandera='{$bandera}'></div>";
	}

?>