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

	$IDingreso = $_GET['ingreso'];
	$datosIngresos = $classIngresos -> detalleIngresos($IDingreso);
	$conceptosIngr = $classIngresos -> conceptosDetalleIngresos($IDingreso);
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Digital Mind</title>
		<link rel="shortcut icon" type="image/x-icon" href="../../images/favicon.ico" />
		<link rel="stylesheet" href="../../css/menu.css" media="screen" />
		<link rel="stylesheet" href="../../css/tabla.css" media="screen" />
		<link rel="stylesheet" href="../../css/formularios.css" media="screen" />
		<link rel=stylesheet href="../../css/formatocotizacion.css" type="text/css">
		<link rel=stylesheet href="../../css/detallecomprobantef.css" type="text/css">
	</head>
	<body>

		<header>
			<img src="../../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
		</header>

		<nav>
			<ul>
				<li><a href="../../Home" alt="Inicio" title="Inicio"><img src="../../images/home.png"/></a></li>
				<li></li>
	            <li></li>
	            <li></li>
	            <li><spam style="color:#fff;"><?php echo $_SESSION["usuario"]; ?></spam></li>
				<li><a href="../../salir.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../../images/lock.png"/></a></li>
			</ul>
		</nav>

		 <h1 style="text-align:center; color:rgba(0,191,255,.9);">
	    	<a href="index.php">
				<img class="atras" src="../../images/atras.png" title="Regresar">
			</a>Detalle Ingresos
	    </h1>
		<center>
	    	<article id="comprobanteFiscal">
	    		<img class="icono" src="../../images/banner.png" >
	    		<div id="datosCot">
					Comprobante Fiscal Digital <br/>
					<?=$datosIngresos['serie']?>&nbsp;<?=$datosIngresos['no_folio']?><br />
					<?php $FechaEgreso = $datosIngresos['fecha'] ?>
					<?php $FechaEgreso = date_format(date_create($FechaEgreso),'d-m-Y H:i:s')?>
					Fecha:&nbsp;<?=$FechaEgreso?>
	    		</div>
	    		<div class="datos-comprobante">
	    			<p><span>Versi&oacute;n:</span>&nbsp;<?=$datosIngresos['version_comprobante']?></p>
	    			<p><span>Folio Fiscal:</span>&nbsp;<?=$datosIngresos['folio_fiscal']?></p>
	    			<p>
	    				<span>Fecha de Certificaci&oacute;n:</span>&nbsp;
						<?php $FechaTimbrado = $datosIngresos['fecha_timbrado'] ?>
						<?php $FechaTimbrado = date_format(date_create($FechaTimbrado),'d-m-Y H:i:s')?>
						<?=$FechaTimbrado?>
	    			<p><span>Lugar Expedici&oacute;n:</span>&nbsp;<?=$datosIngresos['lugar_expedicion']?></p>
	    			<p><?=$datosIngresos['regimen_fiscal']?></p>
	    		</div>
				
				<table>
					<tr>
						<td>
				    		<div class="datosReceptor">
				    			<h3>RECEPTOR</h3>
					    		<ul>
					    			<li class="razonSocial"><b><?=$datosIngresos['razon_social_receptor']?></b></li>
					    			<li>RFC: <b><?=$datosIngresos['rfc_receptor']?></b></li>
					    			<li>Direcci&oacute;n: <b></b> </li>
					    			<li>Colonia: <b></b></li>
					    			<li>Localidad: <b></b></li>
					    			<li>Municipio: <b></b></li>
					    			<li>Estado: <b></b></li>
					    			<li>C.P./Pa&iacute;s: <b></b></li>
					    			<li>Uso de CFDI: <b><?=$datosIngresos['uso_cfdi']?></b></li>
					    		</ul>
				    		</div>
		    			</td>

		    			<td>
							<div class="datosEmisor">
							    <h3>EMISOR</h3>
							    <ul>
								    <li class="razonSocial"><b><?=$datosIngresos['razon_social_emisor']?></b></li>
								    <li>RFC: <b><?=$datosIngresos['rfc_emisor']?></b></li>
								    <li>
								    	Direcci&oacute;n:
								    	<b>
								    		<?=$datosIngresos['ingr_calle'];?> 
						    				<?=$datosIngresos['ingr_no_ext'];?>
						    				<?=$datosIngresos['ingr_no_int'];?>
						    			</b>
						    		</li>
								    <li>Colonia: <b><?=$datosIngresos['ingr_colonia']?></b></li>
								    <li>Localidad: <b></b></li>
								    <li>Municipio: <b><?=$datosIngresos['ingr_municipio']?></b></li>
								    <li>Estado: <b><?=$datosIngresos['ingr_estado']?></b></li>
								    <li>C.P./Pa&iacute;s: <b><?=$datosIngresos['ingr_cod_post']?>/<?=$datosIngresos['ingr_pais']?></b></li>
								</ul>
							</div>
						</td>
		    		</tr>
				</table>
				<section id="comprobanteF">
					<table cellpadding="0" cellspacing="0" id="conceptosComprobante">
					  <tr>
					    <th>Clave</th>
					    <th>Descripci&oacute;n<br><span>Impuestos<span></th>
					    <th>Cantidad</th>
					    <th>U.M. SAT</th>
					    <th>Precio Unitario</th>
					    <th>Importe</th>
					  </tr>
					  <?php foreach($conceptosIngr as $conceptoComp) : ?>
							<?php if ($conceptoComp['valor_unitario_concepto_i'] != "" || $conceptoComp['importe_concepto_i'] != "" || $conceptoComp['base_impuesto_concepto_i'] != "" || $conceptoComp['importe_impuesto_concepto_i'] != "") : ?>
								<?php $signoMoneda = "<b>$</b>"; ?>
							<?php else : ?>
								<?php $signoMoneda = ""; ?>
							<?php endif; ?>
							<tr>
								<td><?=$conceptoComp['clave_concepto_i']?></td>
								<td class="descripcion">
									<?=$conceptoComp['descripcion_concepto_i']?>
									<p>
										Traslado:&nbsp;Base=<?=$signoMoneda?><?=number_format($conceptoComp['base_impuesto_concepto_i'], 2, '.', ',')?>&nbsp;<?=$conceptoComp['impuesto_concepto_i']?>&nbsp;Tasa=<?=$conceptoComp['tasacuota_impuesto_concepto_i']?>
									</p>
									<p>
										Tipo Factor=<?=$conceptoComp['tipofactor_impuesto_concepto_i']?>&nbsp;Importe=<?=$signoMoneda?><?=number_format($conceptoComp['importe_impuesto_concepto_i'], 2, '.', ',')?>
									</p>
								</td>
								<td><?=$conceptoComp['cantidad_concepto_i']?></td>
								<td><?=$conceptoComp['unidad_concepto_i']?>&nbsp;<?=$conceptoComp['clave_unidad_concepto_i']?></td>
								<td><?=$signoMoneda?><?=number_format($conceptoComp['valor_unitario_concepto_i'], 2, '.', ',')?></td>
								<td><?=$signoMoneda?><?=number_format($conceptoComp['importe_concepto_i'], 2, '.', ',')?></td>
							<tr>
					   <?php endforeach; ?>
					</table>
					<table cellspacing="-1" id="operaciones">
				        <tr>
				            <td class="izqOperac">
				                Moneda: <?=$datosIngresos['moneda_comprobante']?>&nbsp;
				                Forma de Pago: <b><?=$datosIngresos['forma_pago']?></b>
				            </td>
				            <td class="azulOperac">SubTotal:</td>
				            <td class="costos">
				                <!-- Subtotal -->
				                <b>$</b><?=number_format($datosIngresos['subtotal'], 2, '.', ',')?>
				            </td>
				        </tr>
				        <tr>
				            <td class="izqOperac">
				            	Traslado: <?=$datosIngresos['nombre_impuesto']?>&nbsp;
				                Tasa: <b><?=$datosIngresos['tasa_cuota_impuesto']?></b>&nbsp;
				                Tipo Factor: <?=$datosIngresos['tipo_factor_impuesto']?>
				            </td>
				            <td class="azulOperac">Descuento:</td>
				            <td class="costos ">
				            	<!-- Descuento -->
				                <b>$</b><?=number_format($datosIngresos['descuento'], 2, '.', ',')?>
				            </td>
				        </tr>
				        <tr>
				            <td class="izqOperac"></td>
				            <td class="azulOperac">Traslados:</td>
				            <td class="costos ">
				            	<!-- Traslados -->
				                <b>$</b><?=number_format($datosIngresos['total_impuesto'], 2, '.', ',')?>
				            </td>
				        </tr>
				        <tr>
				            <td class="izqOperac"></td>
				            <td class="azulOperac radiusBottomIzq">Total:</td>
				            <td class="costos radiusBottomDer">
				            	<!-- Total -->
				                <b>$</b><?=number_format($datosIngresos['total'], 2, '.', ',')?>
				            </td>
				        </tr>
				    </table>
					<div id="masDatosComprobante">
						<p><span>Tipo de Comprobante:</span> <?=$datosIngresos['tipo_comprobante']?>&nbsp;<?=$datosIngresos['efecto_comprobante']?></p>
						<p><span>Sello:</span></p>
						<p><?=$datosIngresos['sello_comprobante']?></p>
						<p><span>M&eacute;todo de Pago:</span> <?=$datosIngresos['metodo_pago']?></p>
						<p><span>Condiciones de Pago:</span> <?=$datosIngresos['condiciones_pago']?></p>
						<p><span>N&uacute;mero de Cuenta:</span> <?=$datosIngresos['no_cuenta']?></p>
						<p><span>Estado del Comprobante:</span> <?=$datosIngresos['estado_comprobante']?></p>
						<p>
							<span>Concepto:</span> <?=$datosIngresos['concepto']?>
							<span>Clasificaci&oacute;n:</span> <?=$datosIngresos['clasificacion']?>
							<span>Status:</span> <?=$datosIngresos['estado']?>
						</p>
						<p>
							<span>Origen:</span> <?=$datosIngresos['origen']?>
							<span>Destino:</span> <?=$datosIngresos['destino']?>
						</p>
						<p>
							<span>Fecha y Hora de Pago:</span>
							<?php $FechaHoraPago = $datosIngresos['fecha_hora_pago'] ?>
							<?php if($FechaHoraPago != NULL) :?>
								<?php $FechaHoraPago = date_format(date_create($FechaHoraPago),'d-m-Y H:i:s') ?>
								<?=$FechaHoraPago?>
							<?php endif; ?>
						</p>
						<p>
							<span>Fecha de Cancelaci&oacute;n:</span>
							<?php $FechaCancelacion = $datosIngresos['fecha_cancelacion'] ?>
							<?php if($FechaCancelacion != NULL) :?>
								<?php $FechaCancelacion = date_format(date_create($FechaCancelacion),'d-m-Y H:i:s') ?>
								<?=$FechaCancelacion?>
							<?php endif; ?>
						</p>
						<p><span>RFC Proveedor:</span> <?=$datosIngresos['rfc_proveedor']?></p>
						<p class="btnSalirDet"><a class="btn primary" href="index.php">Salir</a></p>
					</div>
				</section>
			</article>
		</center>
	</body>
</html>