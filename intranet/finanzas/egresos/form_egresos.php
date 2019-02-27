<?php 
	$folioFis = $egreso['folioFiscalE'];
	
	$folio8dig = substr($folioFis, 0, 8);
	
	$fila = $classEgresos->encontrarEgxFolio($folioFis);
	
 ?>

<div class="nomFact <?php if($fila == 1){ echo "siExiste"; } else { echo "noExiste"; } ?>" <?php if($fila == 1){ echo "style='display:flex; flex-direction:row; '"; } ?> >
	<div>
		<p>Factura No. <?=$i+1?> - <?=$folio8dig?></p>
	</div>
	<?php if ($fila == 1) : ?>
		<div class="guardada-ant">Ya Existe</div>
	<?php endif ?>
</div>

<div style="display: none;">
	<ul>
		<li>
			<label>Efecto del Comprobante:<span>&nbsp;*</span></label>
			<input type="text" name="txtEfectCompr[<?=$i?>]" id="efectCompro" value="EGRESO" readonly maxlength="6" autocomplete="off" >
		</li>
		<li>
			<label>Versión:<span>&nbsp;*</span></label>
			<input type="text" name="txtVersion[<?=$i?>]" id="Version<?=$i?>" maxlength="5" autocomplete="off" >
		</li>
		<li>
			<label>Tipo de Comprobante:<span>&nbsp;*</span></label>
			<input type="text" name="txtTipoCompr[<?=$i?>]" id="TipoComprobante<?=$i?>" maxlength="7" autocomplete="off" >
		</li>
		<li>
			<label>Lugar de Expedición:<span>&nbsp;*</span></label>
			<input type="text" name="txtLugarExped[<?=$i?>]" id="LugarExpedicion<?=$i?>" maxlength="50" autocomplete="off" >
		</li>
		<li>
			<label>Fecha:<span>&nbsp;*</span></label>
			<input type="text" name="txtFecha[<?=$i?>]" id="Fecha<?=$i?>" maxlength="10" autocomplete="off"  pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}">
		</li>
		<li>
			<label>Hora:<span>&nbsp;*</span></label>
			<input type="text" name="txtHora[<?=$i?>]" id="Hora<?=$i?>" maxlength="8" autocomplete="off"  pattern="^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$" >
		</li>
		<li>
			<label>RFC Emisor:<span>&nbsp;*</span></label>
			<input type="text" name="txtRfcEmisor[<?=$i?>]" id="RfcEmisor<?=$i?>" maxlength="13" autocomplete="off" >
		</li>
		<li>
			<label>Razón Social Emisor:<span>&nbsp;*</span></label>
			<input type="text" name="txtNombreEmisor[<?=$i?>]" id="NombreEmisor<?=$i?>" maxlength="100" autocomplete="off" >
		</li>
		<li>
			<label>
				<input type="checkbox" name="saveProv[<?=$i?>]" value="Si" id="guardarProv" class="cbGuardarProv" disabled>
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
			<input type="text" name="txtPais_dfe[<?=$i?>]" id="pais_dfe<?=$i?>" maxlength="50">
		</li>
		<!-- Estado -->
		<li>
			<label>Estado:</label>
			<input type="text" name="txtEstado_dfe[<?=$i?>]" id="estado_dfe<?=$i?>" maxlength="50">
		<!-- Municipio -->
		<li>
			<label>Municipio:</label>
			<input type="text" name="txtMunicipio_dfe[<?=$i?>]" id="municip_dfe<?=$i?>" maxlength="50">
		<!-- Colonia -->
		<li>
			<label>Colonia:</label>
			<input type="text" name="txtColonia_dfe[<?=$i?>]" id="colonia_dfe<?=$i?>" maxlength="50">
		<!-- Número Exterior -->
		<li>
			<label>Número Exterior:</label>
			<input type="text" name="txtNumExt_dfe[<?=$i?>]" id="nexterior_dfe<?=$i?>" maxlength="25">
		<!-- Número Interior -->
		<li>
			<label>Número Interior:</label>
			<input type="text" name="txtNumInt_dfe[<?=$i?>]" id="ninterior_dfe<?=$i?>" maxlength="10">
		<!-- Calle -->
		<li>
			<label>Calle:</label>
			<input type="text" name="txtCalle_dfe[<?=$i?>]" id="calle_dfe<?=$i?>" maxlength="50">
		<!-- Código Postal -->
		<li>
			<label>Código Postal</label>
			<input type="text" name="txtCodPost_dfe[<?=$i?>]" id="codigopostal_dfe<?=$i?>" maxlength="5">
		</li>
		<p>&nbsp;</p>
		<li>
			<label>RFC Receptor:<span>&nbsp;*</span></label>
			<input type="text" name="txtRfcReceptor[<?=$i?>]" id="RfcReceptor<?=$i?>" maxlength="13" autocomplete="off" >
		</li>
		<li>
			<label>Razón Social Receptor:<span>&nbsp;*</span></label>
			<input type="text" name="txtNombreReceptor[<?=$i?>]" id="NombreReceptor<?=$i?>" maxlength="100" autocomplete="off" >
		</li>
		<li>
			<label>Uso CFDI:</label>
			<input type="text" name="txtusoCFDI[<?=$i?>]" id="usoCFDI<?=$i?>" maxlength="50" autocomplete="off">
		</li>
		<li>
			<label>Serie:<span>&nbsp;*</span></label>
			<input type="text" name="txtSerie[<?=$i?>]" id="Serie<?=$i?>" maxlength="50" autocomplete="off" >
		</li>
		<li>
			<label>No. Folio:<span>&nbsp;*</span></label>
			<input type="text" name="txtFolio[<?=$i?>]" id="Folio<?=$i?>" maxlength="10" autocomplete="off" >
		</li>
		<!-- Div para agregar conceptos -->
		<hr>
		<div id="conceptos-comprobante<?=$i?>">
			<p>Conceptos</p>
			<?php
				$numC = 1;  
		 		// foreach pora cada conceptos
				foreach ($conceptosXmlEgresos[$i] as $concepto) :
			?>
	
			<li>
				<div>
					<span class='azul'><b> - Concepto <?=$numC?> -</b></span>
				</div>
			</li>
			<input type='hidden' name='conceptosFactura[<?=$i?>][<?=$numC?>][agregarInve]' value='Si' />
			<li>
				<label>Clave Concepto <?=$numC?>:</label>
				<input type='text' name='conceptosFactura[<?=$i?>][<?=$numC?>][claveC]' maxlength='20' value="<?=$concepto['claveConceptoE']?>" autocomplete='off'>
			</li>
			 <li>
				<label>Cantidad Concepto <?=$numC?></label>
				<input type='text' name='conceptosFactura[<?=$i?>][<?=$numC?>][cantidadC]' maxlength='7' value="<?=$concepto['cantidadConceptoE']?>" autocomplete='off'>
			</li>
			<li>
				<label>Clave Unidad <?=$numC?>:</label>
				<input type='text' name='conceptosFactura[<?=$i?>][<?=$numC?>][claveUnidadC]' maxlength='10' value="<?=$concepto['claveUnidadConceptoE']?>" autocomplete='off'>
			</li>
			<li>
				<label>Unidad Concepto <?=$numC?>:</label>
				<input type='text' name='conceptosFactura[<?=$i?>][<?=$numC?>][unidadC]' maxlength='5' value="<?=$concepto['unidadConceptoE']?>" autocomplete='off'>
			</li>
			<li>
				<label>Descripción <?=$numC?>:</label>
				<input type='text' id='desc{$i}' name='conceptosFactura[<?=$i?>][<?=$numC?>][descripcionC]' maxlength='255' value="<?=$concepto['descripcionConceptoE']?>" autocomplete='off'>
			</li>
			<li>
				<label>Modelo <?=$numC?>:</label>
				<input type='text' id='model{$i}' name='conceptosFactura[<?=$i?>][<?=$numC?>][modeloC]' maxlength='20' value="<?=$concepto['modeloConceptoE']?>" autocomplete='off'>
			</li>
			<li>
				<label>Valor Unitario <?=$numC?>:</label>
				<input type='text' id='price{$i}' name='conceptosFactura[<?=$i?>][<?=$numC?>][valorUnitarioC]' maxlength='10' value="<?=$concepto['valorUnitarioConceptoE']?>" autocomplete='off'>
			</li>
			<li>
				<label>Importe Concepto <?=$numC?>:</label>
				<input type='text' name='conceptosFactura[<?=$i?>][<?=$numC?>][importeC]' maxlength='10' value="<?=$concepto['importeConceptoE']?>" autocomplete='off'>
			</li>
			<li>
				<label>Base Impuesto Concepto <?=$numC?>:</label>
				<input type='text' name='conceptosFactura[<?=$i?>][<?=$numC?>][baseImpuestoC]' maxlength='10' value="<?php if(isset($concepto['baseConceptoE'])) echo $concepto['baseConceptoE'] ?>" autocomplete='off'>
			</li>
			<li>
				<label>Impuesto del Concepto <?=$numC?>:</label>
				<input type='text' name='conceptosFactura[<?=$i?>][<?=$numC?>][impuestoC]' maxlength='20' value="<?php if(isset($concepto['impuestoConceptoE'])) echo $concepto['impuestoConceptoE'] ?>" autocomplete='off'>
			</li>
			<li>
				<label>Tipo Factor del Impuesto Concepto <?=$numC?>:</label>
				<input type='text' name='conceptosFactura[<?=$i?>][<?=$numC?>][tipoFactorImpuestoC]' maxlength='20' value="<?php if(isset($concepto['tipoFactorConceptoE'])) echo $concepto['tipoFactorConceptoE']?>" autocomplete='off'>
			</li>
			<li>
				<label>Tasa/Cuota del Impuesto Concepto <?=$numC?>:</label>
				<input type='text' name='conceptosFactura[<?=$i?>][<?=$numC?>][tasaCuotaImpuestoC]' maxlength='10' value="<?php if(isset($concepto['tasaCuotaConceptoE'])) echo $concepto['tasaCuotaConceptoE']?>" autocomplete='off'>
			</li>
			<li>
				<label>Importe del Impuesto Concepto <?=$numC?>:</label>
				<input type='text' name='conceptosFactura[<?=$i?>][<?=$numC?>][importeImpuestoC]' maxlength='10' value="<?php if(isset($concepto['importeImpuestoConceptoE'])) echo $concepto['importeImpuestoConceptoE']?>" autocomplete='off'>
			</li>
	
			<?php 
				$numC++;
				endforeach; 
			?>
		</div>
	
		<hr>
		<li>
			<label>Descuento ($):</label>
			<input type="text" name="txtDescuento[<?=$i?>]" id="Descuento<?=$i?>" maxlength="15" autocomplete="off">
		</li>
		<li>
			<label>Subtotal ($):<span>&nbsp;*</span></label>
			<input type="text" name="txtSubtotal[<?=$i?>]" id="Subtotal<?=$i?>" maxlength="15" autocomplete="off" >
		</li>
		<li>
			<label>IVA ($):<span>&nbsp;*</span></label>
			<input type="text" name="txtIva[<?=$i?>]" id="Iva<?=$i?>" maxlength="15" autocomplete="off" >
		</li>
		<li>
			<label>Total ($):<span>&nbsp;*</span></label>
			<input type="text" name="txtTotal[<?=$i?>]" id="Total<?=$i?>" maxlength="15" autocomplete="off" >
		</li>
		<li>
			<label>Moneda:<span>&nbsp;*</span></label>
			<input type="text" name="txtMoneda[<?=$i?>]" id="Moneda<?=$i?>" maxlength="5" autocomplete="off" >
		</li>
		<li>
			<label>Método de Pago:<span>&nbsp;*</span></label>
			<input type="text" name="txtMetodoPago[<?=$i?>]" id="MetodoPago<?=$i?>" maxlength="50" autocomplete="off" >
		</li>
		<li>
			<label>Condiciones de Pago:</label>
			<input type="text" name="txtCondicionPago[<?=$i?>]" id="CondicionesPago<?=$i?>" maxlength="50" autocomplete="off">
		</li>
		<li>
			<label>Forma de Pago:<span>&nbsp;*</span></label>
			<input type="text" name="txtFormaPago[<?=$i?>]" id="FormaPago<?=$i?>" maxlength="50" autocomplete="off" >
		</li>
		<li>
			<label>Fecha de Pago:</label>
			<input type="text" name="txtFechaHoraPago[<?=$i?>]" id="FechaHoraPago<?=$i?>" maxlength="10" autocomplete="off" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}">
			<!-- Etiqueta SPAN para cargar el botón de Obtener Fecha de Pago. -->
			<span id="btnFechaPago"></span>
		</li>
		<li>
			<label>Nombre del Impuesto:<span>&nbsp;*</span></label>
			<input type="text" name="txtNombreImpuesto[<?=$i?>]" id="NombreImpuesto<?=$i?>" maxlength="50" autocomplete="off" >
		</li>
		<li>
			<label>Total Impuesto ($):<span>&nbsp;*</span></label>
			<input type="text" name="txtTotalImpuesto[<?=$i?>]" id="TotalImpuesto<?=$i?>" maxlength="15" autocomplete="off" >
		</li>
		<li>
			<label>Tipo de Factor Impuesto:</label>
			<input type="text" name="txtTipoFactorImpuesto[<?=$i?>]" id="TipoFactorImpuesto<?=$i?>" maxlength="35" autocomplete="off">
		</li>
		<li>
			<label>Tasa Impuesto:<span>&nbsp;*</span></label>
			<input type="text" name="txtTasaImpuesto[<?=$i?>]" id="tasaOCuotaImpuesto<?=$i?>" maxlength="15" autocomplete="off" >
		</li>
		<li>
			<label>No. de Cuenta:</label>
			<input type="text" name="txtNumCuenta[<?=$i?>]" id="numCuenta" maxlength="18" autocomplete="off" >
		</li>
		<li>
			<label>Concepto:</label>
			<?php $datosConceptos = $classEgresos -> listaConceptos() ?>
			<select name="sltConcepto[<?=$i?>]">
				<option value="" selected>Elige</option>
				<?php foreach($datosConceptos as $concepto) :?>
					<option value="<?=$concepto['nom_concepto']?>"><?=$concepto['nom_concepto']?></option>
				<?php endforeach ?>
			</select>
		</li>
		<li>
			<label>Clasificación:</label>
			<?php $datosClasif = $classEgresos -> listaClasificaciones() ?>
			<select name="sltClasificacion[<?=$i?>]">
				<option value="" selected>Elige</option>
				<?php foreach($datosClasif as $clasif) :?>
					<option value="<?=$clasif['nom_clasifi']?>"><?=$clasif['nom_clasifi']?></option>
				<?php endforeach; ?>
			</select>
		</li>
		<li>
			<label>Status:</label>
			<?php $datosStatus = $classEgresos -> listaStatus() ?>
			<select name="sltStatus[<?=$i?>]" id="statusEgreso">
				<option value="" selected>Elige</option>
				<?php foreach($datosStatus as $status) :?>
					<option value="<?=$status['nom_status']?>"><?=$status['nom_status']?></option>
				<?php endforeach; ?>
			</select>
		</li>
		<li>
			<label>Origen:</label>
			<?php $datosOrigen = $classEgresos -> listaOrigenes() ?>
			<select name="sltOrigen[<?=$i?>]" id="">
				<option value="" selected>Elige</option>
				<?php foreach($datosOrigen as $origen) :?>
					<option value="<?=$origen['nom_origen']?>"><?=$origen['nom_origen']?></option>
				<?php endforeach; ?>
			</select>
		</li>
		<li>
			<label>Destino:</label>
			<?php $datosDestino = $classEgresos -> listaDestinos() ?>
			<select name="sltDestino[<?=$i?>]" id="">
				<option value="" selected>Elige</option>
				<?php foreach($datosDestino as $destino) :?>
					<option value="<?=$destino['nom_destino']?>"><?=$destino['nom_destino']?></option>
				<?php endforeach; ?>
			</select>
		</li>
		<li>
			<label>Estado del Comprobante:</label>
			<input type="text" name="txtEstadoComprobante[<?=$i?>]" maxlength="20" autocomplete="off" >
		</li>
		<li>
			<label>Fecha y Hora de Cancelación:</label>
			<input type="text" name="txtFechaHoraCancelacion[<?=$i?>]" id="FechaHoraCancelacion<?=$i?>" minlength="10" maxlength="19" autocomplete="off" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}">
		</li>
		<li>
			<label>Régimen Fiscal:</label>
			<input type="text" name="txtRegiFiscal[<?=$i?>]" id="RegimenFiscal<?=$i?>" maxlength="50" autocomplete="off">
		</li>
		<li>
			<label>Folio Fiscal:<span>&nbsp;*</span></label>
			<input type="text" name="txtFolioFiscal[<?=$i?>]" id="FolioFiscal<?=$i?>" maxlength="50" autocomplete="off" >
		</li>
		<li>
			<label>Fecha Timbrado:<span>&nbsp;*</span></label>
			<input type="text" name="txtFechaTimbr[<?=$i?>]" id="FechaTimbrado<?=$i?>" maxlength="10" autocomplete="off"  pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}" placeholder="dd-mm-yyyy">
		</li>
		<li>
			<label>Hora Timbrado:<span>&nbsp;*</span></label>
			<input type="text" name="txtHoraTimbr[<?=$i?>]" id="HoraTimbrado<?=$i?>" maxlength="8" autocomplete="off"  pattern="^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$" placeholder="hh:mm:ss">
		</li>
		<li>
			<label class="label-textarea">Sello:<span>&nbsp;*</span></label>
			<textarea name="txtSello[<?=$i?>]" class="sello" id="Sello<?=$i?>" cols="50" rows="8" autocomplete="off" ></textarea>
		</li>
		<li>
			<label>RFC Proveedor:</label>
			<input type="text" name="txtRFCprov[<?=$i?>]" id="RFCproveedor<?=$i?>" maxlength="13" autocomplete="off">
		</li>
	</ul>
		
	<hr>
</div>
