<?php
	require('../../class/egresos.php');
	$classEgresos = new egresos();
	$idE = $_REQUEST['egreso'];
	$detalleDatosEgresos = $classEgresos->detalleEgresos($idE);
	$conceptosEgr = $classEgresos -> conceptosDetalleEgresos($idE);
?>
<article id="comprobanteFiscal">
	<img class="icono" src="../../images/banner.png" >
	<div id="datosCot">
		Comprobante Fiscal Digital <br/>
		<?=$detalleDatosEgresos['serie']?>&nbsp;<?=$detalleDatosEgresos['no_folio']?><br />
		<?php $FechaEgreso = $detalleDatosEgresos['fecha'] ?>
		<?php $FechaEgreso = date_format(date_create($FechaEgreso),'d-m-Y H:i:s')?>
		Fecha:&nbsp;<?=$FechaEgreso?>
	</div>
	<div class="datos-comprobante">
		<p><span>Versi&oacute;n:</span>&nbsp;<?=$detalleDatosEgresos['version_comprobante']?></p>
		<p><span>Folio Fiscal:</span>&nbsp;<?=$detalleDatosEgresos['folio_fiscal']?></p>
		<p>
			<span>Fecha de Certificaci&oacute;n:</span>&nbsp;
			<?php $FechaTimbrado = $detalleDatosEgresos['fecha_timbrado'] ?>
			<?php $FechaTimbrado = date_format(date_create($FechaTimbrado),'d-m-Y H:i:s')?>
			<?=$FechaTimbrado?>
		<p><span>Lugar Expedici&oacute;n:</span>&nbsp;<?=$detalleDatosEgresos['lugar_expedicion']?></p>
		<p><?=$detalleDatosEgresos['regimen_fiscal']?></p>
	</div>
	
	<table>
		<tr>
			<td>
	    		<div class="datosReceptor">
	    			<h3>RECEPTOR</h3>
		    		<ul>
		    			<li class="razonSocial"><b><?=$detalleDatosEgresos['razon_social_receptor']?></b></li>
		    			<li>RFC: <b><?=$detalleDatosEgresos['rfc_receptor']?></b></li>
		    			<li>Direcci&oacute;n: <b></b> </li>
		    			<li>Colonia: <b></b></li>
		    			<li>Localidad: <b></b></li>
		    			<li>Municipio: <b></b></li>
		    			<li>Estado: <b></b></li>
		    			<li>C.P./Pa&iacute;s: <b></b></li>
		    			<li>Uso de CFDI: <b><?=$detalleDatosEgresos['uso_cfdi']?></b></li>
		    		</ul>
	    		</div>
			</td>

			<td>
				<div class="datosEmisor">
				    <h3>EMISOR</h3>
				    <ul>
					    <li class="razonSocial"><b><?=$detalleDatosEgresos['razon_social_emisor']?></b></li>
					    <li>RFC: <b><?=$detalleDatosEgresos['rfc_emisor']?></b></li>
					    <li>
					    	Direcci&oacute;n:
					    	<b>
					    		<?=$detalleDatosEgresos['ed_calle'];?> 
			    				<?=$detalleDatosEgresos['ed_no_ext'];?>
			    				<?=$detalleDatosEgresos['ed_no_int'];?>
			    			</b>
			    		</li>
					    <li>Colonia: <b><?=$detalleDatosEgresos['ed_colonia']?></b></li>
					    <li>Localidad: <b></b></li>
					    <li>Municipio: <b><?=$detalleDatosEgresos['ed_municipio']?></b></li>
					    <li>Estado: <b><?=$detalleDatosEgresos['ed_estado']?></b></li>
					    <li>C.P./Pa&iacute;s: <b><?=$detalleDatosEgresos['ed_cod_post']?>/<?=$detalleDatosEgresos['ed_pais']?></b></li>
					</ul>
				</div>
			</td>
		</tr>
	</table>
	<section id="comprobanteF">
		<table cellpadding="0" cellspacing="0" id="conceptosComprobante">
		  <tr>
		    <th>Clave</th>
		    <th>Descripci&oacute;n<br><span>Impuestos</span></th>
		    <th>Cantidad</th>
		    <th>U.M. SAT</th>
		    <th>Precio Unitario</th>
		    <th>Importe</th>
		  </tr>
		  <?php foreach($conceptosEgr as $conceptoComp) : ?>
				<?php if ($conceptoComp['valor_unitario_concepto_e'] != "" || $conceptoComp['importe_concepto_e'] != "" || $conceptoComp['base_impuesto_concepto_e'] != "" || $conceptoComp['importe_impuesto_concepto_e'] != "") : ?>
					<?php $signoMoneda = "<b>$</b>"; ?>
				<?php else : ?>
					<?php $signoMoneda = ""; ?>
				<?php endif; ?>
				<tr>
					<td><?=$conceptoComp['clave_concepto_e']?></td>
					<td class="descripcion">
						<?=$conceptoComp['descripcion_concepto_e']?>
						<p>
							Traslado:&nbsp;Base=<?=$signoMoneda?><?=number_format($conceptoComp['base_impuesto_concepto_e'], 2, '.', ',')?>&nbsp;<?=$conceptoComp['impuesto_concepto_e']?>&nbsp;Tasa=<?=$conceptoComp['tasacuota_impuesto_concepto_e']?>
						</p>
						<p>
							Tipo Factor=<?=$conceptoComp['tipofactor_impuesto_concepto_e']?>&nbsp;Importe=<?=$signoMoneda?><?=number_format($conceptoComp['importe_impuesto_concepto_e'], 2, '.', ',')?>
						</p>
					</td>
					<td><?=$conceptoComp['cantidad_concepto_e']?></td>
					<td><?=$conceptoComp['unidad_concepto_e']?>&nbsp;<?=$conceptoComp['clave_unidad_concepto_e']?></td>
					<td><?=$signoMoneda?><?=number_format($conceptoComp['valor_unitario_concepto_e'], 2, '.', ',')?></td>
					<td><?=$signoMoneda?><?=number_format($conceptoComp['importe_concepto_e'], 2, '.', ',')?></td>
				</tr>
		   <?php endforeach; ?>
		</table>
		<table cellspacing="-1" id="operaciones">
	        <tr>
	            <td class="izqOperac">
	                Moneda: <?=$detalleDatosEgresos['moneda_comprobante']?>&nbsp;
	                Forma de Pago: <b><?=$detalleDatosEgresos['forma_pago']?></b>
	            </td>
	            <td class="azulOperac">SubTotal:</td>
	            <td class="costos">
	                <!-- Subtotal -->
	                <b>$</b><?=number_format($detalleDatosEgresos['subtotal'], 2, '.', ',')?>
	            </td>
	        </tr>
	        <tr>
	            <td class="izqOperac">
	            	Traslado: <?=$detalleDatosEgresos['nombre_impuesto']?>&nbsp;
	                Tasa: <b><?=$detalleDatosEgresos['tasa_cuota_impuesto']?></b>&nbsp;
	                Tipo Factor: <?=$detalleDatosEgresos['tipo_factor_impuesto']?>
	            </td>
	            <td class="azulOperac">Descuento:</td>
	            <td class="costos ">
	            	<!-- Descuento -->
	                <b>$</b><?=number_format($detalleDatosEgresos['descuento'], 2, '.', ',')?>
	            </td>
	        </tr>
	        <tr>
	            <td class="izqOperac"></td>
	            <td class="azulOperac">Traslados:</td>
	            <td class="costos ">
	            	<!-- Traslados -->
	                <b>$</b><?=number_format($detalleDatosEgresos['total_impuesto'], 2, '.', ',')?>
	            </td>
	        </tr>
	        <tr>
	            <td class="izqOperac"></td>
	            <td class="azulOperac radiusBottomIzq">Total:</td>
	            <td class="costos radiusBottomDer">
	            	<!-- Total -->
	                <b>$</b><?=number_format($detalleDatosEgresos['total'], 2, '.', ',')?>
	            </td>
	        </tr>
	    </table>
		<div id="masDatosComprobante">
			<p><span>Tipo de Comprobante:</span> <?=$detalleDatosEgresos['tipo_comprobante']?>&nbsp;<?=$detalleDatosEgresos['efecto_comprobante']?></p>
			<p><span>Sello:</span></p>
			<p><?=$detalleDatosEgresos['sello_comprobante']?></p>
			<p><span>M&eacute;todo de Pago:</span> <?=$detalleDatosEgresos['metodo_pago']?></p>
			<p><span>Condiciones de Pago:</span> <?=$detalleDatosEgresos['condiciones_pago']?></p>
			<p><span>N&uacute;mero de Cuenta:</span> <?=$detalleDatosEgresos['no_cuenta']?></p>
			<p><span>Estado del Comprobante:</span> <?=$detalleDatosEgresos['estado_comprobante']?></p>
			<p>
				<span>Concepto:</span> <?=$detalleDatosEgresos['concepto']?>
				<span>Clasificaci&oacute;n:</span> <?=$detalleDatosEgresos['clasificacion']?>
				<span>Status:</span> <?=$detalleDatosEgresos['estado']?>
			</p>
			<p>
				<span>Origen:</span> <?=$detalleDatosEgresos['origen']?>
				<span>Destino:</span> <?=$detalleDatosEgresos['destino']?>
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
			<p><span>RFC Proveedor:</span> <?=$detalleDatosEgresos['rfc_proveedor']?></p>
			<p class="btnSalirDet"><a class="btn primary" href="listar_egresos.php">Salir</a></p>
		</div>
	</section>
</article>