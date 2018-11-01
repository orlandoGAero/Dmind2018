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

<!-- DataTimePicker -->
<!-- <link rel="stylesheet" type="text/css" href="../../libs/dateTimePicker/jquery.datetimepicker.css"/>
<script src="../../libs/dateTimePicker/js/jquery.datetimepicker.full.js"></script> -->

<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* Div de Cargar Archivos XML.
* * * * * * * * *  * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * -->
<div id="loadXML">

</div>

<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* Div de Registrar Egresos.
* * * * * * * * *  * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * -->
<div id="registerEgresos">
	
</div>
 
<center>
	<section id="botonesFinanz">
		<form method="POST" id="formLoadXML" enctype="multipart/form-data">    		
			<input type="file" name="archivoEgresos" required />
			<input type="submit" class="btn primary" value="Cargar XML">
		</form>
	</section>

	<section id="contenidoFinanz" class="">
		<center>
			<form action="" method="POST" class="finanzasform" id="form_egresos" target="_self">
				
				<div class="finanzasformtitulo">
					<h2>Registrar Egreso</h2>
				</div>
				
				<div class="finanzasformcontenido">
					<span><i style="padding-left:450px;" >*&nbsp;Datos Requeridos</i></span>
					<ul>
						<li>
							<label>Efecto del Comprobante:<span>&nbsp;*</span></label>
							<input type="text" name="txtEfectCompr" id="efectCompro" value="EGRESO" readonly maxlength="6" autocomplete="off" required>
						</li>
						<li>
							<label>Versión:<span>&nbsp;*</span></label>
							<input type="text" name="txtVersion" id="Version" maxlength="5" autocomplete="off" required>
						</li>
						<li>
							<label>Tipo de Comprobante:<span>&nbsp;*</span></label>
							<input type="text" name="txtTipoCompr" id="TipoComprobante" maxlength="7" autocomplete="off" required>
						</li>
						<li>
							<label>Lugar de Expedición:<span>&nbsp;*</span></label>
							<input type="text" name="txtLugarExped" id="LugarExpedicion" maxlength="50" autocomplete="off" required>
						</li>
						<li>
							<label>Fecha:<span>&nbsp;*</span></label>
							<input type="text" name="txtFecha" id="Fecha" maxlength="10" autocomplete="off" required pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}">
						</li>
						<li>
							<label>Hora:<span>&nbsp;*</span></label>
							<input type="text" name="txtHora" id="Hora" maxlength="8" autocomplete="off" required pattern="^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$" >
						</li>
						<li>
							<label>RFC Emisor:<span>&nbsp;*</span></label>
							<input type="text" name="txtRfcEmisor" id="RfcEmisor" maxlength="13" autocomplete="off" required>
						</li>
						<li>
							<label>Razón Social Emisor:<span>&nbsp;*</span></label>
							<input type="text" name="txtNombreEmisor" id="NombreEmisor" maxlength="100" autocomplete="off" required>
						</li>
						<li>
							<label>
								<input type="checkbox" name="saveProv" value="Si" id="guardarProv" class="cbGuardarProv" disabled>
								<span class="textGuardarProv">Guardar como proveedor</span>
							</label>
						</li>
						<!-- dfe = Domicilio Fiscal Emisor -->
						<li>
							<p><center><b>Domicilio Fiscal Emisor</b></center></p>
						</li>
						<!-- País -->
						<li>
							<label>País:</label>
							<input type="text" name="txtPais_dfe" id="pais_dfe" maxlength="50">
						</li>
						<!-- Estado -->
						<li>
							<label>Estado:</label>
							<input type="text" name="txtEstado_dfe" id="estado_dfe" maxlength="50">
						<!-- Municipio -->
						<li>
							<label>Municipio:</label>
							<input type="text" name="txtMunicipio_dfe" id="municip_dfe" maxlength="50">
						<!-- Colonia -->
						<li>
							<label>Colonia:</label>
							<input type="text" name="txtColonia_dfe" id="colonia_dfe" maxlength="50">
						<!-- Número Exterior -->
						<li>
							<label>Número Exterior:</label>
							<input type="text" name="txtNumExt_dfe" id="nexterior_dfe" maxlength="25">
						<!-- Número Interior -->
						<li>
							<label>Número Interior:</label>
							<input type="text" name="txtNumInt_dfe" id="ninterior_dfe" maxlength="10">
						<!-- Calle -->
						<li>
							<label>Calle:</label>
							<input type="text" name="txtCalle_dfe" id="calle_dfe" maxlength="50">
						<!-- Código Postal -->
						<li>
							<label>Código Postal</label>
							<input type="text" name="txtCodPost_dfe" id="codigopostal_dfe" maxlength="5">
						</li>
						<p>&nbsp;</p>
						<li>
							<label>RFC Receptor:<span>&nbsp;*</span></label>
							<input type="text" name="txtRfcReceptor" id="RfcReceptor" maxlength="13" autocomplete="off" required>
						</li>
						<li>
							<label>Razón Social Receptor:<span>&nbsp;*</span></label>
							<input type="text" name="txtNombreReceptor" id="NombreReceptor" maxlength="100" autocomplete="off" required>
						</li>
						<li>
							<label>Uso CFDI:</label>
							<input type="text" name="txtusoCFDI" id="usoCFDI" maxlength="50" autocomplete="off">
						</li>
						<li>
							<label>Serie:<span>&nbsp;*</span></label>
							<input type="text" name="txtSerie" id="Serie" maxlength="50" autocomplete="off" required>
						</li>
						<li>
							<label>No. Folio:<span>&nbsp;*</span></label>
							<input type="text" name="txtFolio" id="Folio" maxlength="10" autocomplete="off" required>
						</li>
						<div id="conceptos-comprobante"></div>
						<li>
							<label>Descuento ($):</label>
							<input type="text" name="txtDescuento" id="Descuento" maxlength="15" autocomplete="off">
						</li>
						<li>
							<label>Subtotal ($):<span>&nbsp;*</span></label>
							<input type="text" name="txtSubtotal" id="Subtotal" maxlength="15" autocomplete="off" required>
						</li>
						<li>
							<label>IVA ($):<span>&nbsp;*</span></label>
							<input type="text" name="txtIva" id="Iva" maxlength="15" autocomplete="off" required>
						</li>
						<li>
							<label>Total ($):<span>&nbsp;*</span></label>
							<input type="text" name="txtTotal" id="Total" maxlength="15" autocomplete="off" required>
						</li>
						<li>
							<label>Moneda:<span>&nbsp;*</span></label>
							<input type="text" name="txtMoneda" id="Moneda" maxlength="5" autocomplete="off" required>
						</li>
						<li>
							<label>Método de Pago:<span>&nbsp;*</span></label>
							<input type="text" name="txtMetodoPago" id="MetodoPago" maxlength="50" autocomplete="off" required>
						</li>
						<li>
							<label>Condiciones de Pago:</label>
							<input type="text" name="txtCondicionPago" id="CondicionesPago" maxlength="50" autocomplete="off">
						</li>
						<li>
							<label>Forma de Pago:<span>&nbsp;*</span></label>
							<input type="text" name="txtFormaPago" id="FormaPago" maxlength="50" autocomplete="off" required>
						</li>
						<li>
							<label>Fecha de Pago:</label>
							<input type="text" name="txtFechaHoraPago" id="FechaHoraPago" maxlength="10" autocomplete="off" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}">
							<!-- Etiqueta SPAN para cargar el botón de Obtener Fecha de Pago. -->
							<span id="btnFechaPago"></span>
						</li>
						<li>
							<label>Nombre del Impuesto:<span>&nbsp;*</span></label>
							<input type="text" name="txtNombreImpuesto" id="NombreImpuesto" maxlength="50" autocomplete="off" required>
						</li>
						<li>
							<label>Total Impuesto ($):<span>&nbsp;*</span></label>
							<input type="text" name="txtTotalImpuesto" id="TotalImpuesto" maxlength="15" autocomplete="off" required>
						</li>
						<li>
							<label>Tipo de Factor Impuesto:</label>
							<input type="text" name="txtTipoFactorImpuesto" id="TipoFactorImpuesto" maxlength="35" autocomplete="off">
						</li>
						<li>
							<label>Tasa Impuesto:<span>&nbsp;*</span></label>
							<input type="text" name="txtTasaImpuesto" id="tasaOCuotaImpuesto" maxlength="15" autocomplete="off" required>
						</li>
						<li>
							<label>No. de Cuenta:</label>
							<input type="text" name="txtNumCuenta" id="numCuenta" maxlength="18" autocomplete="off" >
						</li>
						<li>
							<label>Concepto:</label>
							<?php $datosConceptos = $classEgresos -> listaConceptos() ?>
							<select name="sltConcepto">
								<option value="" selected>Elige</option>
								<?php foreach($datosConceptos as $concepto) :?>
									<option value="<?=$concepto['nom_concepto']?>"><?=$concepto['nom_concepto']?></option>
								<?php endforeach ?>
							</select>
						</li>
						<li>
							<label>Clasificación:</label>
							<?php $datosClasif = $classEgresos -> listaClasificaciones() ?>
							<select name="sltClasificacion">
								<option value="" selected>Elige</option>
								<?php foreach($datosClasif as $clasif) :?>
									<option value="<?=$clasif['nom_clasifi']?>"><?=$clasif['nom_clasifi']?></option>
								<?php endforeach; ?>
							</select>
						</li>
						<li>
							<label>Status:</label>
							<?php $datosStatus = $classEgresos -> listaStatus() ?>
							<select name="sltStatus" id="statusEgreso">
								<option value="" selected>Elige</option>
								<?php foreach($datosStatus as $status) :?>
									<option value="<?=$status['nom_status']?>"><?=$status['nom_status']?></option>
								<?php endforeach; ?>
							</select>
						</li>
						<li>
							<label>Origen:</label>
							<?php $datosOrigen = $classEgresos -> listaOrigenes() ?>
							<select name="sltOrigen" id="">
								<option value="" selected>Elige</option>
								<?php foreach($datosOrigen as $origen) :?>
									<option value="<?=$origen['nom_origen']?>"><?=$origen['nom_origen']?></option>
								<?php endforeach; ?>
							</select>
						</li>
						<li>
							<label>Destino:</label>
							<?php $datosDestino = $classEgresos -> listaDestinos() ?>
							<select name="sltDestino" id="">
								<option value="" selected>Elige</option>
								<?php foreach($datosDestino as $destino) :?>
									<option value="<?=$destino['nom_destino']?>"><?=$destino['nom_destino']?></option>
								<?php endforeach; ?>
							</select>
						</li>
						<li>
							<label>Estado del Comprobante:</label>
							<input type="text" name="txtEstadoComprobante" maxlength="20" autocomplete="off" >
						</li>
						<li>
							<label>Fecha y Hora de Cancelación:</label>
							<input type="text" name="txtFechaHoraCancelacion" id="FechaHoraCancelacion" minlength="10" maxlength="19" autocomplete="off" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}">
						</li>
						<li>
							<label>Régimen Fiscal:</label>
							<input type="text" name="txtRegiFiscal" id="RegimenFiscal" maxlength="50" autocomplete="off">
						</li>
						<li>
							<label>Folio Fiscal:<span>&nbsp;*</span></label>
							<input type="text" name="txtFolioFiscal" id="FolioFiscal" maxlength="50" autocomplete="off" required>
						</li>
						<li>
							<label>Fecha Timbrado:<span>&nbsp;*</span></label>
							<input type="text" name="txtFechaTimbr" id="FechaTimbrado" maxlength="10" autocomplete="off" required pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}" placeholder="dd-mm-yyyy">
						</li>
						<li>
							<label>Hora Timbrado:<span>&nbsp;*</span></label>
							<input type="text" name="txtHoraTimbr" id="HoraTimbrado" maxlength="8" autocomplete="off" required pattern="^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$" placeholder="hh:mm:ss">
						</li>
						<li>
							<label class="label-textarea">Sello:<span>&nbsp;*</span></label>
							<textarea name="txtSello" class="sello" id="Sello" cols="50" rows="8" autocomplete="off" required></textarea>
						</li>
						<li>
							<label>RFC Proveedor:</label>
							<input type="text" name="txtRFCprov" id="RFCproveedor" maxlength="13" autocomplete="off">
						</li>
					</ul>
					<br>
					<div id="opcionesFechaPag" title="Agregar Fecha de Pago"></div>
				</div>
				
				<div class="finanzasformpie">
					<input type="submit" name="btnRegistrarEgreso" value="Registrar" class="btn primary" />
					<input type="button" value="Limpiar" id="btn_limpiar" class="btn" />
					<input type="button" name="btnCancelarEgreso" id="btnCancelarE" value="Cancelar" class="btneliminar" />
				</div>

			</form>
		</center>
	</section>
</center>

<script type="text/javascript">
var $ = jQuery.noConflict();
$(document).ready(function(){
	$('#guardarProv').click(function() {
		if ( $('#guardarProv').attr('checked') ) {
			var rfcEmi = $('#RfcEmisor');
			if (rfcEmi.val() != "") {
				var url = "obtener_rfc_proveedores.php";
		    	$.ajax({
		    		url: url,
		    		type: 'POST',
		    		data: rfcEmi,
		    		success: function(result) {
		    			$("#registerEgresos").html(result);
		    		}
		    	});
		    }
		}
	});
	$('#btn_limpiar').click(function(){
		$(':input','#form_egresos')
		.not(':button, :submit, :reset, #efectCompro')
		.val('')
		.removeAttr('checked');
		$('#guardarProv').attr('disabled', 'disabled');
		$('#conceptos-comprobante').html('');
		$('#obtenerFechaP').remove();
		// 	.removeAttr('selected');
	});

	$('#btnCancelarE').click(function(){
		var msjConfirm = confirm('¿Esta seguro de cancelar el registro?');
		if (msjConfirm == true) {
			egresos.fancybox.close();
		}
	});

	$("#formLoadXML").submit(function(xml) {
		xml.preventDefault();
		$('#conceptos-comprobante').html('');
		var formData = new FormData(document.getElementById("formLoadXML"));
		$.ajax({
			url: "registrar_egresos_cargar_xml.php",
			type: "POST",
			dataType: "html",
			data: formData,
			cache: false,
			contentType: false,
			processData: false
		})
			.done(function(result){
				$("#loadXML").html(result);
			});
	});

	$("#form_egresos").submit(function(guardar) {
		guardar.preventDefault();
		$.post('registrar_egresos_guardar.php', $("#form_egresos").serialize())
		.done(function(data){
			$("#registerEgresos").html(data);
		});
	});

	$( "#Fecha" ).datepicker({
      changeMonth: true,
      changeYear: true,
      showButtonPanel: true,
      showWeek: true,
      firstDay: 1,
      showOtherMonths: true,
      dateFormat: "dd-mm-yy"
    });
    
    $( "#FechaHoraPago" ).datepicker({
      changeMonth: true,
      changeYear: true,
      showButtonPanel: true,
      showWeek: true,
      firstDay: 1,
      showOtherMonths: true,
      dateFormat: "dd-mm-yy"
    });

    $( "#FechaHoraCancelacion" ).datepicker({
      changeMonth: true,
      changeYear: true,
      showButtonPanel: true,
      showWeek: true,
      firstDay: 1,
      showOtherMonths: true,
      dateFormat: "dd-mm-yy"
    });
	
	// DataTimePicker
	// $.datetimepicker.setLocale('es');
	
	// $('#FechaHoraPago').datetimepicker({
	// 	dayOfWeekStart : 0
	// });
	
	// $('#FechaHoraPago').datetimepicker();

});
</script>