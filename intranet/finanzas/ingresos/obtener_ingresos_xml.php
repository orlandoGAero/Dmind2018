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

	$nombreArchivo = $_FILES['archivoIngresos']['name'];
	$nombreArchTmp = $_FILES['archivoIngresos']['tmp_name'];
	$tipoArch = $_FILES['archivoIngresos']['type'];
	$tamArch = $_FILES['archivoIngresos']['size'];

?>

<?php $classIngresos -> obtenerDatosXML($nombreArchivo,$nombreArchTmp,$tipoArch) ?>
<!-- Array para cargar los datos del Ingreso en el formulario de registro -->
<?php if(isset($classIngresos -> datosIngresosXML)) $xmlIngresos = $classIngresos -> datosIngresosXML ?>
<!-- Mensajes -->
<?php if(isset($classIngresos -> msjErr)) :?><div class="error"><h3><?=$classIngresos -> msjErr?></h3></div><?php endif; ?>
<?php if(isset($classIngresos -> msjCap)) :?><div class="caption"><h3><?=$classIngresos -> msjCap?></h3></div><?php endif; ?>
<?php if(isset($classIngresos -> msjOk)) :?><div class="success"><h3><?=$classIngresos -> msjOk?></h3></div><?php endif; ?>

<?php
	if(isset($classIngresos -> datosIngresosXML)){
		$xmlIngresos = $classIngresos -> datosIngresosXML;
		foreach ($xmlIngresos['conceptosComprobanteI'] as $key => $value) {
			$conceptosXmlIngresos[] = array_merge($xmlIngresos['conceptosComprobanteI'][$key], $xmlIngresos['impuestosConceptosComprobanteI'][$key]);
		}
		$i = 0;
		foreach ($conceptosXmlIngresos as $conceptosComprobante) {
			$i = $i + 1;
			$arrayConceptosComprobante[] = "
				<li style='margin: 20px 0;'>
					<span class='azul'><b> - Concepto ".$i." -</b></span>
				</li>
				<li>
					<label>Clave Concepto ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][claveC]' maxlength='20' value='".$conceptosComprobante['claveConceptoI']."' autocomplete='off'>
				</li>
				<li>
					<label>Cantidad Concepto ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][cantidadC]' maxlength='7' value='".$conceptosComprobante['cantidadConceptoI']."' autocomplete='off'>
				</li>
				<li>
					<label>Clave Unidad ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][claveUnidadC]' maxlength='10' value='".$conceptosComprobante['claveUnidadConceptoI']."' autocomplete='off'>
				</li>
				<li>
					<label>Unidad Concepto ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][unidadC]' maxlength='5' value='".$conceptosComprobante['unidadConceptoI']."' autocomplete='off'>
				</li>
				<li>
					<label>Descripción ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][descripcionC]' maxlength='255' value='".$conceptosComprobante['descripcionConceptoI']."' autocomplete='off'>
				</li>
				<li>
					<label>Valor Unitario ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][valorUnitarioC]' maxlength='10' value='".$conceptosComprobante['valorUnitarioConceptoI']."' autocomplete='off'>
				</li>
				<li>
					<label>Importe Concepto ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][importeC]' maxlength='10' value='".$conceptosComprobante['importeConceptoI']."' autocomplete='off'>
				</li>
				<li>
					<label>Base Impuesto Concepto ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][baseImpuestoC]' maxlength='10' value='".$conceptosComprobante['baseConceptoI']."' autocomplete='off'>
				</li>
				<li>
					<label>Impuesto del Concepto ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][impuestoC]' maxlength='20' value='".$conceptosComprobante['impuestoConceptoI']."' autocomplete='off'>
				</li>
				<li>
					<label>Tipo Factor del Impuesto Concepto ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][tipoFactorImpuestoC]' maxlength='20' value='".$conceptosComprobante['tipoFactorConceptoI']."' autocomplete='off'>
				</li>
				<li>
					<label>Tasa/Cuota del Impuesto Concepto ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][tasaCuotaImpuestoC]' maxlength='10' value='".$conceptosComprobante['tasaCuotaConceptoI']."' autocomplete='off'>
				</li>
				<li>
					<label>Importe del Impuesto Concepto ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][importeImpuestoC]' maxlength='10' value='".$conceptosComprobante['importeImpuestoConceptoI']."' autocomplete='off'>
				</li>
			";
		}
	}
?>

<script type="text/javascript">
	regIngr(document).ready(function() {
		// Convierte un array PHP a un array JS.
		var conceptosComprobanteJS = <?=json_encode($arrayConceptosComprobante)?>;
		// Lee los datos del array JS.
		regIngr('#conceptos-comprobante').append("<hr class='linea-azul'>");
		for (var i = 0; i < conceptosComprobanteJS.length; i++) {
			// Agregar los input text en el div con id conceptos-comprobante.
			regIngr('#conceptos-comprobante').append(conceptosComprobanteJS[i]);
		}
		// regIngr('#conceptos-comprobante').append('<center>-----------------------------------------------------------------------------------------------------------</center>');
		// La información extraida del XML se agrega en los input text correspondientes.
		regIngr('#Version').val('<?=$xmlIngresos['versionI']?>');
		regIngr('#TipoComprobante').val('<?=$xmlIngresos['tipoComprobanteI']?>');
		regIngr('#LugarExpedicion').val('<?=$xmlIngresos['lugarExpI']?>');
		regIngr('#Fecha').val('<?=$xmlIngresos['fechaI']?>');
		regIngr('#Hora').val('<?=$xmlIngresos['horaI']?>');
		regIngr('#RfcEmisor').val('<?=$xmlIngresos['rfcEmisorI']?>');
		regIngr('#NombreEmisor').val('<?=$xmlIngresos['nombreEmisorI']?>');
		regIngr('#pais_dfe').val('<?=$xmlIngresos['dirPaisI']?>');
		regIngr('#estado_dfe').val('<?=$xmlIngresos['dirEstadoI']?>');
		regIngr('#municip_dfe').val('<?=$xmlIngresos['dirMunicipioI']?>');
		regIngr('#colonia_dfe').val('<?=$xmlIngresos['dirColoniaI']?>');
		regIngr('#nexterior_dfe').val('<?=$xmlIngresos['dirNExtI']?>');
		regIngr('#ninterior_dfe').val('<?=$xmlIngresos['dirNIntI']?>');
		regIngr('#calle_dfe').val('<?=$xmlIngresos['dirCalleI']?>');
		regIngr('#codigopostal_dfe').val('<?=$xmlIngresos['dirCodPostI']?>');
		regIngr('#RfcReceptor').val('<?=$xmlIngresos['rfcReceptorI']?>');
		regIngr('#NombreReceptor').val('<?=$xmlIngresos['nombreReceptorI']?>');
		regIngr('#usoCFDI').val('<?=$xmlIngresos['usoCfdiReceptorI']?>');
		regIngr('#Serie').val('<?=$xmlIngresos['serieI']?>');
		regIngr('#Folio').val('<?=$xmlIngresos['folioI']?>');
		regIngr('#Descuento').val('<?=$xmlIngresos['descuentoI']?>');
		regIngr('#Subtotal').val('<?=$xmlIngresos['subtotalI']?>');
		regIngr('#Iva').val('<?=$xmlIngresos['importeImpuestoI']?>');
		regIngr('#Total').val('<?=$xmlIngresos['totalI']?>');
		regIngr('#Moneda').val('<?=$xmlIngresos['monedaI']?>');
		regIngr('#MetodoPago').val('<?=$xmlIngresos['metodoPagoI']?>');
		regIngr('#CondicionesPago').val('<?=$xmlIngresos['condicionPagoI']?>');
		regIngr('#FormaPago').val('<?=$xmlIngresos['formaPagoI']?>');
		regIngr('#NombreImpuesto').val('<?=$xmlIngresos['tipoImpuestoI']?>');
		regIngr('#TotalImpuesto').val('<?=$xmlIngresos['totalImpuestosI']?>');
		regIngr('#TipoFactorImpuesto').val('<?=$xmlIngresos['tipoFactorImpuestoI']?>');
		regIngr('#tasaOCuotaImpuesto').val('<?=$xmlIngresos['tasaCuotaImpuestoI']?>');
		regIngr('#RegimenFiscal').val('<?=$xmlIngresos['regimenFiscalI']?>');
		regIngr('#FolioFiscal').val('<?=$xmlIngresos['folioFiscalI']?>');
		regIngr('#FechaTimbrado').val('<?=$xmlIngresos['fechaTimbradoI']?>');
		regIngr('#HoraTimbrado').val('<?=$xmlIngresos['horaTimbradoI']?>');
		regIngr('#Sello').val('<?=$xmlIngresos['selloI']?>');
		regIngr('#RFCproveedor').val('<?=$xmlIngresos['rfcProvI']?>');
		// Remueve los mensajes en pantalla.
		setTimeout(function(){
			regIngr('.error').fadeOut(1000);
		},5000);

		setTimeout(function(){
			regIngr('.caption').fadeOut(1000);
		},5000);

		setTimeout(function(){
			regIngr('.success').fadeOut(1000);
		},5000);
	});
</script>