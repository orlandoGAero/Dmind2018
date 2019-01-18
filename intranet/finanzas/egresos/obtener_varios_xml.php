<?php 
	require('../../class/egresos.php');
	$classEgresos = new egresos();

	if (isset($_FILES['facturas'])) {
			
		$nombreArchivo = $_FILES['facturas']['name'];
		$nombreArchTmp = $_FILES['facturas']['tmp_name'];
		$erroArch = $_FILES['facturas']['error'];
		$tipoArch = $_FILES['facturas']['type'];
		$tamArch = $_FILES['facturas']['size'];
		
		function array_map_llave($name, $type, $tmp_name, $error, $size) {
			$tmp_array['name'] = $name;
			$tmp_array['type'] = $type;
			$tmp_array['tmp_name'] = $tmp_name;
			$tmp_array['error'] = $error;
			$tmp_array['size'] = $size;

			return $tmp_array;
		}

		$archivos = array_map('array_map_llave',$nombreArchivo,$tipoArch,$nombreArchTmp,$erroArch,$tamArch);
		}

		$indice = 0;
		$xmlEgresos = array();

		foreach ($archivos as $archivo) :

		 	$classEgresos -> obtenerDatosXML($archivo['name'],$archivo['tmp_name'],$archivo['type']);

			// Array para cargar los datos del Egreso en el formulario de registro
			if ($archivo['type'] == 'text/xml') {
				
				if(isset($classEgresos -> datosEgresosXML)) {

					$xmlEgresos[$indice] = $classEgresos -> datosEgresosXML; 
					$indice += 1;
				}
			}
			
	 	endforeach;

	 	// $cantEg = 0;
 ?>
			<!-- Mensajes -->
			<?php if(isset($classEgresos -> msjErr)) :?><div class="error"><h3><?=$classEgresos -> msjErr?></h3></div>
			<?php endif; ?>

			<?php if(isset($classEgresos -> msjCap)) :?>
				<div class="caption"><h3><?=$classEgresos -> msjCap?></h3></div>
			<?php endif; ?>

			<?php if(isset($classEgresos -> msjOk)) :?>
				<div class="success"><h3><?=$classEgresos -> msjOk?></h3></div>

				<div class=''>
					<h2 style='color:#0c0;'>Registrar Egresos</h2>
				</div>
				<form action="" method="post" name="form" id="formEg" target="_self">
			<?php
					// array para unir conceptos e impuestos de la factura
				$conceptosXmlEgresos = array();

				$i = 0;
				// foreach por cada archivo
				foreach ($xmlEgresos as $egreso) { 
					// ciclo por cada concepto 
					for ($idx=0; $idx < count($xmlEgresos[$i]['conceptosComprobanteE']) ; $idx++) { 
					
						$conceptosXmlEgresos[$i][] = array_merge($xmlEgresos[$i]['conceptosComprobanteE'][$idx], 
																 $xmlEgresos[$i]['impuestosConceptosComprobanteE'][$idx]);


					} // fin for

					include 'form_egresos.php';

					$i++;
				
				}

			?>
				 <div class="">
					<input type="submit" name="btnRegistrarEgreso" id="btnRegistrar" value="Registrar" class="btn primary" />
					<!-- <input type="button" value="Limpiar" id="btn_limpiar" class="btn" /> -->
					<input type="button" name="btnCancelarEgreso" id="btnCancelarE" value="Cancelar" class="btneliminar" />
				</div>
			</form>

			<div id="registrarEg"></div>
		<?php endif; ?>

	<script>

		let $ = jQuery.noConflict();
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

		// La información extraida del XML se agrega en los input text correspondientes.
		let egresos = <?=json_encode($xmlEgresos)?>;
		// console.log(egresos);
		for(let i in egresos) {

			let {
				versionE,
				tipoComprobanteE,
				lugarExpE,
				fechaE,
				horaE,
				rfcEmisorE,
				nombreEmisorE,
				dirPaisE,
				dirEstadoE,
				dirMunicipioE,
				dirColoniaE,
				dirNExtE,
				dirNIntE,
				dirCalleE,
				dirCodPostE,
				rfcReceptorE,
				nombreReceptorE,
				usoCfdiReceptorE,
				serieE,
				folioE,
				descuentoE,
				subtotalE,
				importeImpuestoE,
				totalE,
				monedaE,
				metodoPagoE,
				condicionPagoE,
				formaPagoE,
				tipoImpuestoE,
				totalImpuestosE,
				tipoFactorImpuestoE,
				tasaCuotaImpuestoE,
				regimenFiscalE,
				folioFiscalE,
				fechaTimbradoE,
				horaTimbradoE,
				selloE,
				rfcProvE
			} = egresos[i];

			$(`#Version${i}`).val(versionE);
			$(`#TipoComprobante${i}`).val(tipoComprobanteE);
			$(`#LugarExpedicion${i}`).val(lugarExpE);
			$(`#Fecha${i}`).val(fechaE);
			$(`#Hora${i}`).val(horaE);
			$(`#RfcEmisor${i}`).val(rfcEmisorE);
			$(`#NombreEmisor${i}`).val(nombreEmisorE);
			$(`#pais_dfe${i}`).val(dirPaisE);
			$(`#estado_dfe${i}`).val(dirEstadoE);
			$(`#municip_dfe${i}`).val(dirMunicipioE);
			$(`#colonia_dfe${i}`).val(dirColoniaE);
			$(`#nexterior_dfe${i}`).val(dirNExtE);
			$(`#ninterior_dfe${i}`).val(dirNIntE);
			$(`#calle_dfe${i}`).val(dirCalleE);
			$(`#codigopostal_dfe${i}`).val(dirCodPostE);
			$(`#RfcReceptor${i}`).val(rfcReceptorE);
			$(`#NombreReceptor${i}`).val(nombreReceptorE);
			$(`#usoCFDI${i}`).val(usoCfdiReceptorE);
			$(`#Serie${i}`).val(serieE);
			$(`#Folio${i}`).val(folioE);
			$(`#Descuento${i}`).val(descuentoE);
			$(`#Subtotal${i}`).val(subtotalE);
			$(`#Iva${i}`).val(importeImpuestoE);
			$(`#Total${i}`).val(totalE);
			$(`#Moneda${i}`).val(monedaE);
			$(`#MetodoPago${i}`).val(metodoPagoE);
			$(`#CondicionesPago${i}`).val(condicionPagoE);
			$(`#FormaPago${i}`).val(formaPagoE);
			$(`#NombreImpuesto${i}`).val(tipoImpuestoE);
			$(`#TotalImpuesto${i}`).val(totalImpuestosE);
			$(`#TipoFactorImpuesto${i}`).val(tipoFactorImpuestoE);
			$(`#tasaOCuotaImpuesto${i}`).val(tasaCuotaImpuestoE);
			$(`#RegimenFiscal${i}`).val(regimenFiscalE);
			$(`#FolioFiscal${i}`).val(folioFiscalE);
			$(`#FechaTimbrado${i}`).val(fechaTimbradoE);
			$(`#HoraTimbrado${i}`).val(horaTimbradoE);
			$(`#Sello${i}`).val(selloE);
			$(`#RFCproveedor${i}`).val(rfcProvE);

			$(`#Fecha${i}`).datepicker({
		      changeMonth: true,
		      changeYear: true,
		      showButtonPanel: true,
		      showWeek: true,
		      firstDay: 1,
		      showOtherMonths: true,
		      dateFormat: "dd-mm-yy"
		    });

		    $(`#FechaHoraPago${i}`).datepicker({
		      changeMonth: true,
		      changeYear: true,
		      showButtonPanel: true,
		      showWeek: true,
		      firstDay: 1,
		      showOtherMonths: true,
		      dateFormat: "dd-mm-yy"
		    });

		    $(`#FechaHoraCancelacion${i}`).datepicker({
		      changeMonth: true,
		      changeYear: true,
		      showButtonPanel: true,
		      showWeek: true,
		      firstDay: 1,
		      showOtherMonths: true,
		      dateFormat: "dd-mm-yy"
		    });

		} //fin for in

		$("#formEg").submit(function(e) {
			e.preventDefault();

			let datosForm = $("#formEg").serialize();

			$.ajax({
				url: "guardar_varios_egresos.php",
				type: "post",
				data: datosForm,
				
			})
			.done(function(result){
				$("#registrarEg").html(result);
				console.log(result);
			});
		});

		$('#btnCancelarE').click(function(){
			var msjConfirm = confirm('¿Esta seguro de cancelar el registro?');
			if (msjConfirm == true) {
				$.fancybox.close();
			}
		});

	</script>