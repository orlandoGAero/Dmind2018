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

	$nombreArchivo = $_FILES['archivoEgresos']['name'];
	$nombreArchTmp = $_FILES['archivoEgresos']['tmp_name'];
	$tipoArch = $_FILES['archivoEgresos']['type'];
	$tamArch = $_FILES['archivoEgresos']['size'];

?>

<?php $classEgresos -> obtenerDatosXML($nombreArchivo, $nombreArchTmp, $tipoArch) ?>
<!-- Array para cargar los datos del Egreso en el formulario de registro -->
<?php if(isset($classEgresos -> datosEgresosXML)) $xmlEgresos = $classEgresos -> datosEgresosXML ?>
<!-- Mensajes -->
<?php if(isset($classEgresos -> msjErr)) :?><div class="error"><h3><?=$classEgresos -> msjErr?></h3></div><?php endif; ?>
<?php if(isset($classEgresos -> msjCap)) :?><div class="caption"><h3><?=$classEgresos -> msjCap?></h3></div><?php endif; ?>
<?php if(isset($classEgresos -> msjOk)) :?><div class="success"><h3><?=$classEgresos -> msjOk?></h3></div><?php endif; ?>

<?php if(isset($classEgresos -> datosEgresosXML)) : ?>
	<?php
		$xmlEgresos = $classEgresos -> datosEgresosXML;
		foreach ($xmlEgresos['conceptosComprobanteE'] as $key => $value) {
			$conceptosXmlEgresos[] = array_merge($xmlEgresos['conceptosComprobanteE'][$key], $xmlEgresos['impuestosConceptosComprobanteE'][$key]);
		}
		$i = 0;
		foreach ($conceptosXmlEgresos as $conceptosComprobante) {
			// echo"<pre>";print_r($conceptosComprobante)."</pre>"."\n";
			$i = $i + 1;
			$arrayConceptosComprobante[] = "
				<li>
					<div class='div-save'>
						<div>
							<span class='azul'><b> - Concepto ".$i." -</b></span>
						</div>
						<div class='div-btn'>
							<form method='post' class='agregar-datos'>
								<input type='hidden' name='conceptoid' value='{$i}'>
								<button style='display:none;' type='submit' id='boton-ag{$i}' name='boton-a'>
									<img src='../../images/if_save.png' alt='Cargar Datos'/>
								</button>
							</form>
						</div>
						<div>
							<span style='color: #030;'>Guardar en productos<span> <input type='checkbox' id='check{$i}' onclick='validar(this,{$i})' style='vertical-align: middle;'/>
						</div>
						<div class='msj-egresos' id='mensaje{$i}'></div>
					</div>
				</li>
					<div id='fade' class='overlay-egresos cerrarDatos'></div>
					
					<div id='datos{$i}'>
						
					</div>
				
				<li>
					<label>Clave Concepto ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][claveC]' maxlength='20' value='".$conceptosComprobante['claveConceptoE']."' autocomplete='off'>
				</li>
				<li>
					<label>Cantidad Concepto ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][cantidadC]' maxlength='7' value='".$conceptosComprobante['cantidadConceptoE']."' autocomplete='off'>
				</li>
				<li>
					<label>Clave Unidad ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][claveUnidadC]' maxlength='10' value='".$conceptosComprobante['claveUnidadConceptoE']."' autocomplete='off'>
				</li>
				<li>
					<label>Unidad Concepto ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][unidadC]' maxlength='5' value='".$conceptosComprobante['unidadConceptoE']."' autocomplete='off'>
				</li>
				<li>
					<label>Descripción ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][descripcionC]' maxlength='255' value='".$conceptosComprobante['descripcionConceptoE']."' autocomplete='off'>
				</li>
				<li>
					<label>Modelo ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][modeloC]' maxlength='20' value='".$conceptosComprobante['modeloConceptoE']."' autocomplete='off'>
				</li>
				<li>
					<label>Valor Unitario ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][valorUnitarioC]' maxlength='10' value='".$conceptosComprobante['valorUnitarioConceptoE']."' autocomplete='off'>
				</li>
				<li>
					<label>Importe Concepto ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][importeC]' maxlength='10' value='".$conceptosComprobante['importeConceptoE']."' autocomplete='off'>
				</li>
				<li>
					<label>Base Impuesto Concepto ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][baseImpuestoC]' maxlength='10' value='".$conceptosComprobante['baseConceptoE']."' autocomplete='off'>
				</li>
				<li>
					<label>Impuesto del Concepto ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][impuestoC]' maxlength='20' value='".$conceptosComprobante['impuestoConceptoE']."' autocomplete='off'>
				</li>
				<li>
					<label>Tipo Factor del Impuesto Concepto ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][tipoFactorImpuestoC]' maxlength='20' value='".$conceptosComprobante['tipoFactorConceptoE']."' autocomplete='off'>
				</li>
				<li>
					<label>Tasa/Cuota del Impuesto Concepto ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][tasaCuotaImpuestoC]' maxlength='10' value='".$conceptosComprobante['tasaCuotaConceptoE']."' autocomplete='off'>
				</li>
				<li>
					<label>Importe del Impuesto Concepto ".$i.":</label>
					<input type='text' name='conceptosFactura[".$i."][importeImpuestoC]' maxlength='10' value='".$conceptosComprobante['importeImpuestoConceptoE']."' autocomplete='off'>
				</li>
			";
		}
	?>
	<script type="text/javascript">
		$(document).ready(function() {
			// Convierte un array PHP a un array JS.
			var conceptosComprobanteJS = <?=json_encode($arrayConceptosComprobante)?>;
			// Lee los datos del array JS.
			for (var i = 0; i < conceptosComprobanteJS.length; i++) {
				// Agregar los input text en el div con id conceptos-comprobante.
				$('#conceptos-comprobante').append(conceptosComprobanteJS[i]);
			}
			$('#conceptos-comprobante').append("<hr class='linea-azul'>");
			// La información extraida del XML se agrega en los input text correspondientes.
			$('#Version').val('<?=$xmlEgresos['versionE']?>');
			$('#TipoComprobante').val('<?=$xmlEgresos['tipoComprobanteE']?>');
			$('#LugarExpedicion').val('<?=$xmlEgresos['lugarExpE']?>');
			$('#Fecha').val('<?=$xmlEgresos['fechaE']?>');
			$('#Hora').val('<?=$xmlEgresos['horaE']?>');
			$('#RfcEmisor').val('<?=$xmlEgresos['rfcEmisorE']?>');
			$('#NombreEmisor').val('<?=$xmlEgresos['nombreEmisorE']?>');
			$('#pais_dfe').val('<?=$xmlEgresos['dirPaisE']?>');
			$('#estado_dfe').val('<?=$xmlEgresos['dirEstadoE']?>');
			$('#municip_dfe').val('<?=$xmlEgresos['dirMunicipioE']?>');
			$('#colonia_dfe').val('<?=$xmlEgresos['dirColoniaE']?>');
			$('#nexterior_dfe').val('<?=$xmlEgresos['dirNExtE']?>');
			$('#ninterior_dfe').val('<?=$xmlEgresos['dirNIntE']?>');
			$('#calle_dfe').val('<?=$xmlEgresos['dirCalleE']?>');
			$('#codigopostal_dfe').val('<?=$xmlEgresos['dirCodPostE']?>');
			$('#RfcReceptor').val('<?=$xmlEgresos['rfcReceptorE']?>');
			$('#NombreReceptor').val('<?=$xmlEgresos['nombreReceptorE']?>');
			$('#usoCFDI').val('<?=$xmlEgresos['usoCfdiReceptorE']?>');
			$('#Serie').val('<?=$xmlEgresos['serieE']?>');
			$('#Folio').val('<?=$xmlEgresos['folioE']?>');
			$('#Descuento').val('<?=$xmlEgresos['descuentoE']?>');
			$('#Subtotal').val('<?=number_format($xmlEgresos['subtotalE'], 2)?>');
			$('#Iva').val('<?=number_format($xmlEgresos['importeImpuestoE'], 2)?>');
			$('#Total').val('<?=number_format($xmlEgresos['totalE'], 2)?>');
			$('#Moneda').val('<?=$xmlEgresos['monedaE']?>');
			$('#MetodoPago').val('<?=$xmlEgresos['metodoPagoE']?>');
			$('#CondicionesPago').val('<?=$xmlEgresos['condicionPagoE']?>');
			$('#FormaPago').val('<?=$xmlEgresos['formaPagoE']?>');
			$('#NombreImpuesto').val('<?=$xmlEgresos['tipoImpuestoE']?>');
			$('#TotalImpuesto').val('<?=number_format($xmlEgresos['totalImpuestosE'], 2)?>');
			$('#TipoFactorImpuesto').val('<?=$xmlEgresos['tipoFactorImpuestoE']?>');
			$('#tasaOCuotaImpuesto').val('<?=$xmlEgresos['tasaCuotaImpuestoE']?>');
			$('#RegimenFiscal').val('<?=$xmlEgresos['regimenFiscalE']?>');
			$('#FolioFiscal').val('<?=$xmlEgresos['folioFiscalE']?>');
			$('#FechaTimbrado').val('<?=$xmlEgresos['fechaTimbradoE']?>');
			$('#HoraTimbrado').val('<?=$xmlEgresos['horaTimbradoE']?>');
			$('#Sello').val('<?=$xmlEgresos['selloE']?>');
			$('#RFCproveedor').val('<?=$xmlEgresos['rfcProvE']?>');
			// Remueve el atributo disabled del checkbox con el id guardarProv.
			$('#guardarProv').removeAttr('disabled');
		});
	</script>
<?php endif; ?>
<div id='contenido' class='modal-egresos'></div>

<script type="text/javascript">
	$(".agregar-datos").click(function(e){
		e.preventDefault();
		$.ajax("cargar_datos.php", {
			type: 'POST',
			data: {conceptoid: e.currentTarget[0].value},
			success: function(res) {
				document.getElementById('contenido').innerHTML = res;
			}
		});
		document.getElementById('contenido').style.display='block';
		document.getElementById('fade').style.display='block';
	});
	
	$(".cerrarDatos").click(function(){
		document.getElementById('contenido').style.display='none';
		document.getElementById('fade').style.display='none';
	});

	// Remueve los mensajes en pantalla.
	setTimeout(function(){
		$('.error').fadeOut(1000);
	},5000);

	setTimeout(function(){
		$('.caption').fadeOut(1000);
	},5000);

	setTimeout(function(){
		$('.success').fadeOut(1000);
	},5000);

	// Botón obtener Fecha de Pago.
	$('#obtenerFechaP').click(function() {
		var tot = $('#Total').val();
		$('#opcionesFechaPag').dialog({
			resizable: false,
			autoOpen: true,
			modal: true,
			width: 642,
			height: 372,
			show: "fold",
			hide: "fade"
		});
		$.post('opciones_fecha_pago.php', {totalEgreso: tot})
		.done(function(data) {
			$('#opcionesFechaPag').html(data);
		});
	});

	function validar(obj,index) {
		if(obj.checked == true) {
			// let mostrar = `check${index}`;
			// console.log(mostrar);
			document.getElementById(`boton-ag${index}`).style.display='block';
			console.log('si');
		} else {
			document.getElementById(`boton-ag${index}`).style.display='none';
			console.log('no');
		}
	}

	function agregarDatos() {
		var categoria = $("#selcategoria").val();
		var subcategoria = $("#selsubcategoria").val();
		var division = $("#seldivision").val();
		var nombre = $("#selnombre").val();
		var tipo = $("#seltipo").val();
		var marca = $("#selmarca").val();
		var moneda = $("#selmoneda").val();
		var datos = {
			cat: categoria,
			sub: subcategoria,
			div: division,
			nom: nombre,
			tip: tipo,
			mar: marca,
			mon: moneda
		}
		let idco = `datos${$('#idconcepto').val()}`;
		let num = $('#idconcepto').val();
		let mesj = `mensaje${num}`;
		let cambiar = `#check${num}`;

		let {cat, sub, div, nom, tip, mar, mon} = datos;
		
		let entradas = `
		<input type='hidden' name='${idco}c[cat]' id='${idco}-cat' value='${cat}' disabled/>
		<input type='hidden' name='${idco}c[sub]' id='${idco}-sub' value='${sub}' disabled/>
		<input type='hidden' name='${idco}c[div]' id='${idco}-div' value='${div}' disabled/>
		<input type='hidden' name='${idco}c[nom]' id='${idco}-nom' value='${nom}' disabled/>
		<input type='hidden' name='${idco}c[tip]' id='${idco}-tip' value='${tip}' disabled/>
		<input type='hidden' name='${idco}c[mar]' id='${idco}-mar' value='${mar}' disabled/>
		<input type='hidden' name='${idco}c[mon]' id='${idco}-mon' value='${mon}' disabled/>`;

		document.getElementById(idco).innerHTML = entradas;
		document.getElementById(mesj).innerHTML = `<p>Datos Agregados</p>`;
		console.log(idco);
		console.log(mesj);
		console.log("array: ", datos);
		$(cambiar).prop('checked', true);
		$('#contenido').hide();
		$('#fade').hide();
		return false;
	}
</script>