<link rel="stylesheet" type="text/css" href="../../libs/dataTables/css/datatables.css"/>
<?php
	// Clase Egresos.
	require('../../class/egresos.php');
	$classEgresos = new egresos();
	// Clase Saldos.
	require('../../class/saldos.php');
	$fnSaldos = new saldos();
	$idE = $_REQUEST['egreso'];
	$detalleDatosEgresos = $classEgresos->detalleEgresos($idE);
	$conceptosEgr = $classEgresos -> conceptosDetalleEgresos($idE);
?>
<article id="detalleLista">
	<h3>Comprobante Fiscal Digital</h3>
	<h4>Datos Generales</h4>
	<p>
		<span>Serie/No. Folio:</span>
		<?=$detalleDatosEgresos['serie']?>&nbsp;<?=$detalleDatosEgresos['no_folio']?>
	</p>
	<p>
		<span>Fecha:</span>
		<?php $FechaEgreso = $detalleDatosEgresos['fecha'] ?>
		<?php $FechaEgreso = date_format(date_create($FechaEgreso),'d-m-Y H:i:s')?>
		<?=$FechaEgreso?>	
	</p>
	<p>
		<span>Versi&oacute;n:</span>
		<?=$detalleDatosEgresos['version_comprobante']?>
	</p>
	<p>
		<span>Folio Fiscal:</span>
		<?=$detalleDatosEgresos['folio_fiscal']?>
	</p>
	<p>
		<span>Fecha de Certificaci&oacute;n:</span>
		<?php $FechaTimbrado = $detalleDatosEgresos['fecha_timbrado'] ?>
		<?php $FechaTimbrado = date_format(date_create($FechaTimbrado),'d-m-Y H:i:s')?>
		<?=$FechaTimbrado?>
	</p>
	<p>
		<span>Lugar Expedici&oacute;n:</span>
		<?=$detalleDatosEgresos['lugar_expedicion']?>
	</p>
	<p>
		<span>R&eacute;gimen Fiscal:</span>
		<?=$detalleDatosEgresos['regimen_fiscal']?>
	</p>
	<h4>Datos Receptor</h4>
	<p>
		<span>Raz&oacute;n Social:</span>
		<?=$detalleDatosEgresos['razon_social_receptor']?>
	</p>
	<p>
		<span>RFC:</span>
		<?=$detalleDatosEgresos['rfc_receptor']?>
	</p>
	<p>
		<span>Uso de CFDI:</span>
		<?=$detalleDatosEgresos['uso_cfdi']?>
	</p>
	<h4>Datos Emisor</h4>
	<p>
		<span>Raz&oacute;n Social:</span>
		<?=$detalleDatosEgresos['razon_social_emisor']?>
	</p>
	<p>
		<span>RFC:</span>
		<?=$detalleDatosEgresos['rfc_emisor']?>
	</p>
	<p>
		<span>Direcci&oacute;n:</span>
		<?=$detalleDatosEgresos['ed_calle']?>&nbsp;<?=$detalleDatosEgresos['ed_no_ext']?>&nbsp;<?=$detalleDatosEgresos['ed_no_int']?>
	</p>
	<p>
		<span>Colonia:</span>
		<?=$detalleDatosEgresos['ed_colonia']?>
	</p>
	<p>
		<span>Municipio:</span>
		<?=$detalleDatosEgresos['ed_municipio']?>
	</p>
	<p>
		<span>Estado:</span>
		<?=$detalleDatosEgresos['ed_estado']?>
	</p>
	<p>
		<span>C.P./Pa&iacute;s:</span>
		<?php if ($detalleDatosEgresos['ed_cod_post'] != "" && $detalleDatosEgresos['ed_pais'] != ""): ?>
			<?=$detalleDatosEgresos['ed_cod_post']?>/<?=$detalleDatosEgresos['ed_pais']?>
		<?php endif ?>
	</p>
	<h4>Conceptos</h4>
	<div>
		<table cellpadding="0" cellspacing="0" class="display">
			<thead>
				<tr>
				    <th>Clave</th>
				    <th>Descripci&oacute;n<br><span class="text-small">Impuestos</span></th>
				    <th>Cantidad</th>
				    <th>U.M. SAT</th>
				    <th>Precio Unitario</th>
				    <th>Importe</th>
			  	</tr>
			</thead>
			<tbody>
			  	<?php foreach($conceptosEgr as $conceptoComp) : ?>
					<?php if ($conceptoComp['valor_unitario_concepto_e'] != "" || $conceptoComp['importe_concepto_e'] != "" || $conceptoComp['base_impuesto_concepto_e'] != "" || $conceptoComp['importe_impuesto_concepto_e'] != "") : ?>
						<?php $signoMoneda = "<b>$</b>"; ?>
					<?php else : ?>
						<?php $signoMoneda = ""; ?>
					<?php endif; ?>
					<tr>
						<td class="center"><?=$conceptoComp['clave_concepto_e']?></td>
						<td class="descripcion">
							<?=$conceptoComp['descripcion_concepto_e']?>
							<p>
								Traslado:&nbsp;Base=<?=$signoMoneda?><?=number_format($conceptoComp['base_impuesto_concepto_e'], 2, '.', ',')?>&nbsp;<?=$conceptoComp['impuesto_concepto_e']?>&nbsp;Tasa=<?=$conceptoComp['tasacuota_impuesto_concepto_e']?>
							</p>
							<p>
								Tipo Factor=<?=$conceptoComp['tipofactor_impuesto_concepto_e']?>&nbsp;Importe=<?=$signoMoneda?><?=number_format($conceptoComp['importe_impuesto_concepto_e'], 2, '.', ',')?>
							</p>
						</td>
						<td class="center"><?=$conceptoComp['cantidad_concepto_e']?></td>
						<td class="center"><?=$conceptoComp['unidad_concepto_e']?>&nbsp;<?=$conceptoComp['clave_unidad_concepto_e']?></td>
						<td class="center"><?=$signoMoneda?><?=number_format($conceptoComp['valor_unitario_concepto_e'], 2, '.', ',')?></td>
						<td class="center"><?=$signoMoneda?><?=number_format($conceptoComp['importe_concepto_e'], 2, '.', ',')?></td>
					</tr>
			   	<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<p class="precios">
		<span>SubTotal:</span>
		<b>$</b><?=number_format($detalleDatosEgresos['subtotal'], 2, '.', ',')?>
		<span>Descuento:</span>
		<b>$</b><?=number_format($detalleDatosEgresos['descuento'], 2, '.', ',')?>
		<span>Traslados:</span>
		<b>$</b><?=number_format($detalleDatosEgresos['total_impuesto'], 2, '.', ',')?>
		<span>Total:</span>
		<b>$</b><?=number_format($detalleDatosEgresos['total'], 2, '.', ',')?>
	</p>
	<p>
		<span>Moneda:</span>
		<?=$detalleDatosEgresos['moneda_comprobante']?>
		<span>Forma de Pago:</span>
		<?=$detalleDatosEgresos['forma_pago']?>
	</p>
	<p>
		<span>Traslado:</span>
		<?=$detalleDatosEgresos['nombre_impuesto']?>
	</p>
	<p>
		<span>Tasa:</span>
		<?=$detalleDatosEgresos['tasa_cuota_impuesto']?>
	</p>
	<p>
		<span>Tipo Factor:</span>
		<?=$detalleDatosEgresos['tipo_factor_impuesto']?>
	</p>
	<h4>Datos Adicionales</h4>
	<p>
		<span>Tipo de Comprobante:</span>
		<?=$detalleDatosEgresos['tipo_comprobante']?>&nbsp;<?=$detalleDatosEgresos['efecto_comprobante']?>
	</p>
	<p>
		<span>Sello:</span>&nbsp;<?=$detalleDatosEgresos['sello_comprobante']?>
	</p>
	<p>
		<span>M&eacute;todo de Pago:</span>
		<?=$detalleDatosEgresos['metodo_pago']?>
	</p>
	<p>
		<span>Condiciones de Pago:</span>
		<?=$detalleDatosEgresos['condiciones_pago']?>
	</p>
	<p>
		<span>N&uacute;mero de Cuenta:</span>
		<?=$detalleDatosEgresos['no_cuenta']?>
	</p>
	<p>
		<span>Estado del Comprobante:</span>
		<?=$detalleDatosEgresos['estado_comprobante']?>
	</p>
	<p>
		<span>Concepto:</span>
		<?=$detalleDatosEgresos['concepto']?>
	</p>
	<p>
		<span>Clasificaci&oacute;n:</span>
		<?=$detalleDatosEgresos['clasificacion']?>
	</p>
	<p>
		<span>Status:</span>
		<?=$detalleDatosEgresos['estado']?>
	</p>
	<p>
		<span>Origen:</span>
		<?=$detalleDatosEgresos['origen']?>
	</p>
	<p>
		<span>Destino:</span>
		<?=$detalleDatosEgresos['destino']?>
	</p>
	<p>
		<span>Fecha de Pago:</span>
		<?php $fechaPagoE = $detalleDatosEgresos['fecha_pago'] ?>
		<?php if($fechaPagoE != NULL) :?>
			<?php $fechaPagoE = date_format(date_create($fechaPagoE),'d-m-Y') ?>
			<?=$fechaPagoE?>
		<?php endif; ?>
	</p>
	<p>
		<span>Fecha de Cancelaci&oacute;n:</span>
		<?php $FechaCancelacion = $detalleDatosEgresos['fecha_cancelacion'] ?>
		<?php if($FechaCancelacion != NULL) :?>
			<?php $FechaCancelacion = date_format(date_create($FechaCancelacion),'d-m-Y H:i:s') ?>
			<?=$FechaCancelacion?>
		<?php endif; ?>
	</p>
	<p>
		<span>RFC Proveedor:</span>
		<?=$detalleDatosEgresos['rfc_proveedor']?>
	</p>
	<h4>Pagos</h4>
	<div>
		<?php $formaPagoEgreso = $classEgresos -> statusPagoEgreso($idE); ?>
		<?php if ($formaPagoEgreso == 'parcial'): ?>
			<p class="titulo">Pago Parcial de Egreso</p>
			<?php $pagoParcialEgrSal = $classEgresos -> pagosParciales($idE); ?>
			<table cellspacing="0" cellpadding="2" class="display">
				<thead>
					<tr>
						<th>Fecha Pago</th>
						<th>Descripci&oacute;n</th>
						<th>Monto</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($pagoParcialEgrSal as $pagoParcialE) :?>
						<tr>
							<td>
								<?php $fechaPagoS= $pagoParcialE['fecha_pago'] ?>
								<span style="display: none;"><?=$fechaPagoS?></span>
								<?php $fechaPagoS = date_format(date_create($fechaPagoS),'d-m-Y') ?>
								<?=$fechaPagoS?>
							</td>
							<td><?=$pagoParcialE['descripcion_s']?></td>
							<td class="right"><b>$</b><?=number_format($pagoParcialE['cargos_s'], 2)?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<p class="pTotal">
				<span>Restante:&nbsp;$</span><?=number_format(($detalleDatosEgresos['total'] - $fnSaldos -> totalPagosParciales($idE)), 2)?>
				<span>Total:&nbsp;$</span><?=$precioTotal = number_format($fnSaldos -> totalPagosParciales($idE), 2)?>
			</p>
		<?php elseif ($formaPagoEgreso == 'completo'): ?>
			<p class="titulo">Pago Completo de Egreso</p>
			<?php $pagoCompletoEgrSal = $classEgresos -> pagosCompletos($idE); ?>
			<table cellspacing="0" cellpadding="2" class="display">
				<thead>
					<tr>
						<th>Fecha Pago</th>
						<th>Descripci&oacute;n</th>
						<th>Monto</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($pagoCompletoEgrSal as $pagoCompletoE) :?>
						<tr>
							<td>
								<?php $fechaPagoS= $pagoCompletoE['fecha_s'] ?>
								<span style="display: none;"><?=$fechaPagoS?></span>
								<?php $fechaPagoS = date_format(date_create($fechaPagoS),'d-m-Y') ?>
								<?=$fechaPagoS?>
							</td>
							<td><?=$pagoCompletoE['descripcion_s']?></td>
							<td class="right"><b>$</b><?=number_format($pagoCompletoE['precio_acumulado'], 2)?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<p class="pTotal">
				<?php $idSaldo = $classEgresos -> obtenerIdSaldo($idE); ?>
				<span>Total Saldo:&nbsp;$</span><?=number_format($classEgresos -> precioCargoSaldo($idSaldo), 2)?>
				<span>Restante:&nbsp;$</span><?=number_format(($classEgresos -> precioCargoSaldo($idSaldo) - $fnSaldos -> totalPagosCompletos($idSaldo)), 2)?>
			</p>
		<?php else: ?>
			<span class="sin-datos">(Sin pagos)</span>
		<?php endif ?>
	</div>
	<p class="btnSalirDet"><a class="btn primary" href="index.php">Salir</a></p>
</article>