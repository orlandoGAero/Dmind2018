﻿<?php
	session_start();
	// Manejamos en sesión el nombre del usuario que se ha logeado
	if(!isset($_SESSION["usuario"])){
		header("location:../");  
	}
	$_SESSION["usuario"];
	// Termina inicio de sesión
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title>Modificar Egresos</title>
	<link rel="shortcut icon" type="image/x-icon" href="../../images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="../../css/menu.css">
	<link rel="stylesheet" type="text/css" href="../../css/busqueda.css">
	<link rel="stylesheet" type="text/css" href="../../css/formularios.css">
    <link rel="stylesheet" type="text/css" href="../../css/mensajes.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilos.css">
    <script type="text/javascript" src="../../js/jquery-2.1.4.js" ></script><!-- jQuery -->
    <!-- Jquery UI -->
	<link rel="stylesheet" type="text/css" href="../../libs/jQueryUI/css/jquery-ui.css"><!-- CSS -->
	<!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="../../libs/dataTables/css/datatables.css"><!-- CSS -->
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

     <?php 
     	// Clase de Egresos.
     	require('../../class/egresos.php');
		$classEgresos = new egresos();
		// Clase de Saldos.
		require '../../class/saldos.php';
		$fnSaldos = new saldos();
		// Verifica si el Botón de Modificar esta definido.
	    if(isset($_POST['btnModificarEgreso'])) {
	    	// Verificar si opción de guardar como proveedor este seleccionada.
	    	if (isset($_POST['saveProv'])) {
				$guardarComoProveedor = $_POST['saveProv'];
			}else{
				$guardarComoProveedor = NULL;
			} // Fin de verificación guardar como proveedor.
			// Verificar si esta definido el campo que indica que el proveedor ya fue guardado.
	    	if (isset($_POST['provGuardado'])) {
				$proveedorYaGuardado = $_POST['provGuardado'];
			}else{
				$proveedorYaGuardado = NULL;
			} // Fin de verificación del campo que indica que el proveedor ya fue guardado.
			# Verificar la existencia de la dirección de Emisor.
				if (isset($_REQUEST['txtIdEgrDir'])) { // Id egreso dirección
					$idEgresoDir = $_REQUEST['txtIdEgrDir'];
				} else {
					$idEgresoDir = NULL;
				} // Fin Id egreso dirección.
				if (isset($_REQUEST['txtPais_dfe'])) { // País Emisor
					$paisEgresoDir = $_REQUEST['txtPais_dfe'];
				} else {
					$paisEgresoDir = NULL;
				} // Fin País Emisor.
				if (isset($_REQUEST['txtEstado_dfe'])) { // Estado Emisor
					$estadoEgresoDir = $_REQUEST['txtEstado_dfe'];
				} else {
					$estadoEgresoDir = NULL;
				} // Fin Estado Emisor.
				if (isset($_REQUEST['txtMunicipio_dfe'])) { // Municipio Emisor
					$municipioEgresoDir = $_REQUEST['txtMunicipio_dfe'];
				} else {
					$municipioEgresoDir = NULL;
				} // Fin Municipio Emisor.
				if (isset($_REQUEST['txtColonia_dfe'])) { // Colonia Emisor
					$coloniaEgresoDir = $_REQUEST['txtColonia_dfe'];
				} else {
					$coloniaEgresoDir = NULL;
				} // Fin Colonia Emisor.
				if (isset($_REQUEST['txtNumExt_dfe'])) { // Num Exterior Emisor
					$nExtEgresoDir = $_REQUEST['txtNumExt_dfe'];
				} else {
					$nExtEgresoDir = NULL;
				} // Fin Num Exterior Emisor.
				if (isset($_REQUEST['txtNumInt_dfe'])) { // Num Interior Emisor
					$nIntEgresoDir = $_REQUEST['txtNumInt_dfe'];
				} else {
					$nIntEgresoDir = NULL;
				} // Fin Num Interior Emisor.
				if (isset($_REQUEST['txtCalle_dfe'])) { // Calle Emisor
					$calleEgresoDir = $_REQUEST['txtCalle_dfe'];
				} else {
					$calleEgresoDir = NULL;
				} // Fin Calle Emisor.
				if (isset($_REQUEST['txtCodPost_dfe'])) { // Código Postal Emisor
					$codPosEgresoDir = $_REQUEST['txtCodPost_dfe'];
				} else {
					$codPosEgresoDir = NULL;
				} // Fin Código Postal Emisor.
			# Fin verificación de existencia de la dirección de Emisor.
	    	$classEgresos -> modificarEgresos($_REQUEST['txt_ide'],
	    									  $_REQUEST['txtEfectCompr'],
											  $_REQUEST['txtVersion'],
											  $_REQUEST['txtTipoCompr'],
											  $_REQUEST['txtLugarExped'],
											  $_REQUEST['txtFecha'],
											  $_REQUEST['txtHora'],
											  $_REQUEST['txtRfcEmisor'],
											  $_REQUEST['txtNombreEmisor'],
											  $guardarComoProveedor,
											  $proveedorYaGuardado,
											  $idEgresoDir,
											  $paisEgresoDir,
											  $estadoEgresoDir,
											  $municipioEgresoDir,
											  $coloniaEgresoDir,
											  $nExtEgresoDir,
											  $nIntEgresoDir,
											  $calleEgresoDir,
											  $codPosEgresoDir,
											  $_REQUEST['txtRfcReceptor'],
											  $_REQUEST['txtNombreReceptor'],
											  $_REQUEST['txtusoCFDI'],
											  $_REQUEST['txtSerie'],
											  $_REQUEST['txtFolio'],
											  $_REQUEST['conceptosFactura'],
											  $_REQUEST['txtDescuento'],
											  $_REQUEST['txtSubtotal'],
											  $_REQUEST['txtIva'],
											  $_REQUEST['txtTotal'],
											  $_REQUEST['txtMoneda'],
											  $_REQUEST['txtMetodoPago'],
											  $_REQUEST['txtCondicionPago'],
											  $_REQUEST['txtFormaPago'],
											  $_REQUEST['txtFechaHoraPago'],
											  $_REQUEST['txtNombreImpuesto'],
											  $_REQUEST['txtTotalImpuesto'],
											  $_REQUEST['txtTipoFactorImpuesto'],
											  $_REQUEST['txtTasaImpuesto'],
											  $_REQUEST['txtNumCuenta'],
											  $_REQUEST['sltConcepto'],
											  $_REQUEST['sltClasificacion'],
											  $_REQUEST['sltStatus'],
											  $_REQUEST['sltOrigen'],
											  $_REQUEST['sltDestino'],
											  $_REQUEST['txtEstadoComprobante'],
											  $_REQUEST['txtFechaHoraCancelacion'],
											  $_REQUEST['txtRegiFiscal'],
											  $_REQUEST['txtFolioFiscal'],
											  $_REQUEST['txtFechaTimbr'],
											  $_REQUEST['txtHoraTimbr'],
											  $_REQUEST['txtSello'],
											  $_REQUEST['txtRFCprov']
	    									);
	    } // Fin de verificación si el Botón de Modificar esta definido.
	?>

	<?php if(isset($classEgresos -> msjErr)) :?>
		<div class="error position-error"><h3><?=$classEgresos -> msjErr?></h3></div>
	<?php endif; ?>
	<?php if(isset($classEgresos -> msjCap)) :?>
		<div class="caption"><h3><?=$classEgresos -> msjCap?></h3></div>
	<?php endif; ?>
	
	<?php
	    if(isset($_GET['idEg'])){
			$idEgre = $_GET['idEg'];
		}
		 
		$ModE = $classEgresos -> datosEditarEgreso($idEgre);
	?>

    <h1 style="text-align:center; color:rgba(0,191,255,.9);">
    	<a href="listar_egresos.php">
			<img class="atras" src="../../images/atras.png" title="Regresar">
		</a>Modificar Egresos
	</h1>

	<center>
		<section id="contenido">
    		<center>
				<form action="" method="POST" class="finanzasform" id="form_egresos">
					<div class="finanzasformtitulo">
						<h2>Editar Egreso</h2>
					</div>
					<div class="finanzasformcontenido">
						<span><i style="padding-left:450px;" >*&nbsp;Datos Requeridos</i></span>
						<ul>
							<!-- ID Egresos -->
							<li>
								<input type="hidden" name="txt_ide" value="<?=$ModE['idegresos']?>" readonly>
							</li>
							<li>
								<label>Efecto del Comprobante:<span>&nbsp;*</span></label>
								<input type="text" name="txtEfectCompr" value="<?=$ModE['efecto_comprobante']?>" readonly maxlength="6" autocomplete="off" required>
							</li>
							<li>
								<label>Versión:<span>&nbsp;*</span></label>
								<input type="text" name="txtVersion" value="<?=$ModE['version_comprobante']?>" maxlength="5" autocomplete="off" required>
							</li>
							<li>
								<label>Tipo de Comprobante:<span>&nbsp;*</span></label>
								<input type="text" name="txtTipoCompr" value="<?=$ModE['tipo_comprobante']?>" maxlength="7" autocomplete="off" required>
							</li>
							<li>
								<label>Lugar de Expedición:<span>&nbsp;*</span></label>
								<input type="text" name="txtLugarExped" value="<?=$ModE['lugar_expedicion']?>" maxlength="50" autocomplete="off" required>
							</li>
							<!-- INICIO de Fecha y Hora de Egreso -->
								<?php 
									$FechaComprobante = trim($ModE['fecha']);
									$Fecha = date_format(date_create($FechaComprobante),'d-m-Y');
									$Hora = date_format(date_create($FechaComprobante),'H:i:s');
								?>
								<li>
									<label>Fecha:<span>&nbsp;*</span></label>
									<input type="text" name="txtFecha" id="Fecha" value="<?=$Fecha?>" maxlength="10" autocomplete="off" required pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}">
								</li>
								<li>
									<label>Hora:<span>&nbsp;*</span></label>
									<input type="text" name="txtHora" value="<?=$Hora?>" maxlength="5" autocomplete="off" required pattern="^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$" >
								</li>
							<!-- FIN de Fecha y Hora de Egreso -->
							<li>
								<label>RFC Emisor:<span>&nbsp;*</span></label>
								<input type="text" name="txtRfcEmisor" id="RfcEmisor" value="<?=$ModE['rfc_emisor']?>" maxlength="13" autocomplete="off" required>
							</li>
							<li>
								<label>Razón Social Emisor:<span>&nbsp;*</span></label>
								<input type="text" name="txtNombreEmisor" value="<?=$ModE['razon_social_emisor']?>" maxlength="100" autocomplete="off" required>
							</li>
							<li>
								<label>
									<?php if($classEgresos -> buscarRfcProveedor($ModE['rfc_emisor']) == "no existe") : ?>
										<input type="checkbox" name="saveProv" value="Si" id="guardarProv" class="cbGuardarProv">
										<span class="textGuardarProv">Guardar como proveedor</span>
									<?php elseif ($classEgresos -> buscarRfcProveedor($ModE['rfc_emisor']) == "existe") : ?>
										<input type="checkbox" class="cbGuardarProv" checked disabled>
										<input type="hidden" name="saveProv" value="Si" readonly>
										<input type="hidden" name="provGuardado" value="guardado" readonly>
										<span class="textGuardarProv">Guardar como proveedor</span>
									<?php endif; ?>
								</label>
							</li>
							<?php if ($ModE['ed_pais'] || $ModE['ed_estado'] || $ModE['ed_municipio'] || $ModE['ed_colonia'] || $ModE['ed_no_ext'] || $ModE['ed_no_int'] || $ModE['ed_calle'] || $ModE['ed_cod_post']) : ?>
								<!-- dfe = Domicilio Fiscal Emisor -->
								<li>
									<p><center><b>Domicilio Fiscal Emisor</b></center></p>
								</li>
								<!-- ID dirección egresos -->
								<li>
									<input type="hidden" name="txtIdEgrDir" value="<?=$ModE['id_e_direccion']?>" readonly>
								</li>
								<!-- País -->
								<li>
									<label>País:</label>
									<input type="text" name="txtPais_dfe" value="<?=$ModE['ed_pais']?>" maxlength="50">
								</li>
								<!-- Estado -->
								<li>
									<label>Estado:</label>
									<input type="text" name="txtEstado_dfe" value="<?=$ModE['ed_estado']?>" maxlength="50">
								<!-- Municipio -->
								<li>
									<label>Municipio:</label>
									<input type="text" name="txtMunicipio_dfe" value="<?=$ModE['ed_municipio']?>" maxlength="50">
								<!-- Colonia -->
								<li>
									<label>Colonia:</label>
									<input type="text" name="txtColonia_dfe" value="<?=$ModE['ed_colonia']?>" maxlength="50">
								<!-- Número Exterior -->
								<li>
									<label>Número Exterior:</label>
									<input type="text" name="txtNumExt_dfe" value="<?=$ModE['ed_no_ext']?>" maxlength="25">
								<!-- Número Interior -->
								<li>
									<label>Número Interior:</label>
									<input type="text" name="txtNumInt_dfe" value="<?=$ModE['ed_no_int']?>" maxlength="10">
								<!-- Calle -->
								<li>
									<label>Calle:</label>
									<input type="text" name="txtCalle_dfe" value="<?=$ModE['ed_calle']?>" maxlength="50">
								<!-- Código Postal -->
								<li>
									<label>Código Postal</label>
									<input type="text" name="txtCodPost_dfe" value="<?=$ModE['ed_cod_post']?>" maxlength="5">
								</li>
								<p>&nbsp;</p>
							<?php endif; ?>
							<li>
								<label>RFC Receptor:<span>&nbsp;*</span></label>
								<input type="text" name="txtRfcReceptor" value="<?=$ModE['rfc_receptor']?>" maxlength="13" autocomplete="off" required>
							</li>
							<li>
								<label>Razón Social Receptor:<span>&nbsp;*</span></label>
								<input type="text" name="txtNombreReceptor" value="<?=$ModE['razon_social_receptor']?>" maxlength="100" autocomplete="off" required>
							</li>
							<li>
								<label>Uso CFDI:</label>
								<input type="text" name="txtusoCFDI" value="<?=$ModE['uso_cfdi']?>" maxlength="50" autocomplete="off">
							</li>
							<li>
								<label>Serie:<span>&nbsp;*</span></label>
								<input type="text" name="txtSerie" value="<?=$ModE['serie']?>" maxlength="50" autocomplete="off" required>
							</li>
							<!-- Conceptos de Egresos -->
							<?php if ($conceptosEgresos = $classEgresos -> conceptosDetalleEgresos($idEgre)) : ?>
								<?php $i = 0; ?>
								<?php foreach ($conceptosEgresos as $conceptoE) : ?>
									<?php $i += 1; ?>
									<li>
										<span class='azul'><b> - Concepto <?=$i?> -</b></span>
									</li>
									<!-- Id concepto egreso -->
									<li>
										<input type='hidden' name='conceptosFactura[<?=$i?>][idCoEg]' maxlength='6' value="<?=$conceptoE['id_egresos_conceptos']?>" autocomplete='off' readonly>
									</li>
									<li>
										<label>Clave Concepto <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][claveC]' maxlength='20' value="<?=$conceptoE['clave_concepto_e']?>" autocomplete='off'>
									</li>
									<li>
										<label>Cantidad Concepto <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][cantidadC]' maxlength='7' value="<?=$conceptoE['cantidad_concepto_e']?>" autocomplete='off'>
									</li>
									<li>
										<label>Clave Unidad <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][claveUnidadC]' maxlength='10' value="<?=$conceptoE['clave_unidad_concepto_e']?>" autocomplete='off'>
									</li>
									<li>
										<label>Unidad Concepto <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][unidadC]' maxlength='5' value="<?=$conceptoE['unidad_concepto_e']?>" autocomplete='off'>
									</li>
									<li>
										<label>Descripción <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][descripcionC]' maxlength='255' value="<?=$conceptoE['descripcion_concepto_e']?>" autocomplete='off'>
									</li>
									<li>
										<label>Valor Unitario <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][valorUnitarioC]' maxlength='10' value="<?=$conceptoE['valor_unitario_concepto_e']?>" autocomplete='off'>
									</li>
									<li>
										<label>Importe Concepto <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][importeC]' maxlength='10' value="<?=$conceptoE['importe_concepto_e']?>" autocomplete='off'>
									</li>
									<li>
										<label>Base Impuesto Concepto <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][baseImpuestoC]' maxlength='10' value="<?=$conceptoE['base_impuesto_concepto_e']?>" autocomplete='off'>
									</li>
									<li>
										<label>Impuesto del Concepto <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][impuestoC]' maxlength='20' value="<?=$conceptoE['impuesto_concepto_e']?>" autocomplete='off'>
									</li>
									<li>
										<label>Tipo Factor del Impuesto Concepto <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][tipoFactorImpuestoC]' maxlength='20' value="<?=$conceptoE['tipofactor_impuesto_concepto_e']?>" autocomplete='off'>
									</li>
									<li>
										<label>Tasa/Cuota del Impuesto Concepto <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][tasaCuotaImpuestoC]' maxlength='10' value="<?=$conceptoE['tasacuota_impuesto_concepto_e']?>" autocomplete='off'>
									</li>
									<li>
										<label>Importe del Impuesto Concepto <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][importeImpuestoC]' maxlength='10' value="<?=$conceptoE['importe_impuesto_concepto_e']?>" autocomplete='off'>
									</li>
								<?php endforeach; ?>
								<hr class='linea-azul'>
							<?php endif; ?>
							<li>
								<label>No. Folio:<span>&nbsp;*</span></label>
								<input type="text" name="txtFolio" value="<?=$ModE['no_folio']?>" maxlength="10" autocomplete="off" required>
							</li>
							<li>
								<label>Descuento ($):</label>
								<input type="text" name="txtDescuento" value="<?=$ModE['descuento']?>" maxlength="15" autocomplete="off">
							</li>
							<li>
								<label>Subtotal ($):<span>&nbsp;*</span></label>
								<input type="text" name="txtSubtotal" value="<?=number_format($ModE['subtotal'], 2)?>" maxlength="15" autocomplete="off" required>
							</li>
							<li>
								<label>IVA ($):<span>&nbsp;*</span></label>
								<input type="text" name="txtIva" value="<?=number_format($ModE['iva'], 2)?>" maxlength="15" autocomplete="off" required>
							</li>
							<li>
								<label>Total ($):<span>&nbsp;*</span></label>
								<input type="text" name="txtTotal" id="Total" value="<?=number_format($ModE['total'], 2)?>" maxlength="15" autocomplete="off" required>
							</li>
							<li>
								<label>Moneda:<span>&nbsp;*</span></label>
								<input type="text" name="txtMoneda" value="<?=$ModE['moneda_comprobante']?>" maxlength="5" autocomplete="off" required>
							</li>
							<li>
								<label>Método de Pago:<span>&nbsp;*</span></label>
								<input type="text" name="txtMetodoPago" value="<?=$ModE['metodo_pago']?>" maxlength="50" autocomplete="off" required>
							</li>
							<li>
								<label>Condiciones de Pago:</label>
								<input type="text" name="txtCondicionPago" value="<?=$ModE['condiciones_pago']?>" maxlength="50" autocomplete="off">
							</li>
							<li>
								<label>Forma de Pago:<span>&nbsp;*</span></label>
								<input type="text" name="txtFormaPago" value="<?=$ModE['forma_pago']?>" maxlength="50" autocomplete="off" required>
							</li>
							<!-- INICIO de Fecha y Hora de Pago -->
								<?php
									$fechPagoE = trim($ModE['fecha_pago']);
									if($fechPagoE != NULL){
										$fechPagoE = date_format(date_create($fechPagoE),'d-m-Y');
									}else{
										$fechPagoE = "";
									}
								?>
								<li>
									<label>Fecha de Pago:</label>
									<input type="text" name="txtFechaHoraPago" id="FechaHoraPago" value="<?=$fechPagoE?>" maxlength="10" autocomplete="off" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}">
									<?php if(($fechPagoE != "" || $fechPagoE == "") && $ModE['estado'] != "PAGADO") : ?>
										<button type="button" class="btn primary" id="obtenerCargoS">Obtener Cargo</button>
									<?php endif; ?>
								</li>
								<!-- Tabla de Pagos Parciales Agregados desde Saldos. -->
								<li id="pagosParcialesAgregados">
									<?php if($infoPagosP = $fnSaldos -> pagosParciales($ModE['idegresos'])) : ?>
										<span class="azul">Pagos Agregados</span>
										<br><br>
										<table cellspacing="0" cellpadding="2" class="display" width="auto">
											<thead>
												<tr>
													<th>Fecha de Pago</th>
													<th>Cargo</th>
												</tr>
											</thead>
											<tbody>
												<?php $totalAbonado = 0; ?>
												<?php foreach($infoPagosP as $pagosP) : ?>
													<tr>
														<td>
															<?php $fPagoEgreso= $pagosP['fecha_pago'] ?>
															<?php $fPagoEgreso = date_format(date_create($fPagoEgreso),'d-m-Y') ?>
															<?=$fPagoEgreso?>
														</td>
														<td><b>$</b><?=number_format($pagosP['cargos_s'], 2)?></td>
														<?php $totalAbonado += $pagosP['cargos_s']; ?>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
										<p>
											<i>Total Abonado:</i> <b>$</b><?=number_format($totalAbonado, 2)?>
											&nbsp;
											<?php $totalXpagar = number_format(($ModE['total'] - $totalAbonado), 2); ?>
											<i>Por Pagar:</i> <b>$</b><?=$totalXpagar?>
											<input type="hidden" id="porPagar" value="<?=str_replace(',', '', $totalXpagar)?>" readonly>
										</p>
									<?php endif; ?>
								</li>
							<!-- FIN de Fecha y Hora de Pago -->
							<li>
								<label>Nombre del Impuesto:<span>&nbsp;*</span></label>
								<input type="text" name="txtNombreImpuesto" value="<?=$ModE['nombre_impuesto']?>" maxlength="50" autocomplete="off" required>
							</li>
							<li>
								<label>Total Impuesto ($):<span>&nbsp;*</span></label>
								<input type="text" name="txtTotalImpuesto" value="<?=number_format($ModE['total_impuesto'], 2)?>" maxlength="15" autocomplete="off" required>
							</li>
							<li>
								<label>Tipo de Factor Impuesto:</label>
								<input type="text" name="txtTipoFactorImpuesto" value="<?=$ModE['tipo_factor_impuesto']?>" maxlength="35" autocomplete="off">
							</li>
							<li>
								<label>Tasa Impuesto:<span>&nbsp;*</span></label>
								<input type="text" name="txtTasaImpuesto" value="<?=$ModE['tasa_cuota_impuesto']?>" maxlength="15" autocomplete="off" required>
							</li>
							<li>
								<label>No. de Cuenta:</label>
								<input type="text" name="txtNumCuenta" id="numCuenta" value="<?=$ModE['no_cuenta']?>" maxlength="18" autocomplete="off" >
							</li>
							<li>
								<label>Concepto:</label>
								<select name="sltConcepto">
									<?php if($ModE['concepto'] == "") :?>
										<option value="" selected="">Elige</option>
										<!-- Todos los conceptos registrados -->
										<?php $datosConceptos = $classEgresos -> listaConceptos() ?>
										<?php foreach($datosConceptos as $concepto) :?>
											<option value="<?=$concepto['nom_concepto']?>"><?=$concepto['nom_concepto']?></option>
										<?php endforeach ?>
									<?php else :?>
										<option value="<?=$ModE['concepto']?>"><?=$ModE['concepto']?></option>
										<!-- Conceptos Diferentes al Seleccionado -->
										<?php $DiffDatosConceptos = $classEgresos -> listaConceptosDiff($ModE['concepto']) ?>
										<?php foreach($DiffDatosConceptos as $Diffconcepto) :?>
											<option value="<?=$Diffconcepto['nom_concepto']?>"><?=$Diffconcepto['nom_concepto']?></option>
										<?php endforeach ?>
									<?php endif; ?>
								</select>
							</li>
							<li>
							<label>Clasificación:</label>
								<select name="sltClasificacion">
									<?php if($ModE['clasificacion'] == "") :?>
										<option value="" selected="">Elige</option>
										<!-- Todas las clasificaciones registradas -->
										<?php $datosClasif = $classEgresos -> listaClasificaciones() ?>
										<?php foreach($datosClasif as $clasif) :?>
											<option value="<?=$clasif['nom_clasifi']?>"><?=$clasif['nom_clasifi']?></option>
										<?php endforeach ?>
									<?php else :?>
										<option value="<?=$ModE['clasificacion']?>"><?=$ModE['clasificacion']?></option>
										<!-- Clasificaciones Diferentes a la Seleccionada -->
										<?php $DiffDatosClasif = $classEgresos -> listaClasificacionesDiff($ModE['clasificacion']) ?>
										<?php foreach($DiffDatosClasif as $DiffClasif) :?>
											<option value="<?=$DiffClasif['nom_clasifi']?>"><?=$DiffClasif['nom_clasifi']?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
							</li>
							<li>
								<label>Status:</label>
								<select name="sltStatus" id="statusEgreso">
									<?php if($ModE['estado'] == "") :?>
										<option value="" selected="">Elige</option>
										<!-- Todos los status registrados -->
										<?php $datosStatus = $classEgresos -> listaStatus() ?>
										<?php foreach($datosStatus as $status) :?>
											<option value="<?=$status['nom_status']?>"><?=$status['nom_status']?></option>
										<?php endforeach; ?>
									<?php else :?>
										<option value="<?=$ModE['estado']?>"><?=$ModE['estado']?></option>
										<!-- Status Diferentes al Seleccionado -->
										<?php $DiffDatosStatus = $classEgresos -> listaStatusDiff($ModE['estado']) ?>
										<?php foreach($DiffDatosStatus as $DiffStatus) :?>
											<option value="<?=$DiffStatus['nom_status']?>"><?=$DiffStatus['nom_status']?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
							</li>
							<li>
								<label>Origen: </label>
								<select name="sltOrigen">
									<?php if($ModE['origen'] == "") :?>
										<option value="" selected="">Elige</option>
										<!-- Todos los origenes registrados -->
										<?php $datosOrigen = $classEgresos -> listaOrigenes() ?>
										<?php foreach($datosOrigen as $origen) :?>
											<option value="<?=$origen['nom_origen']?>"><?=$origen['nom_origen']?></option>
										<?php endforeach; ?>
									<?php else :?>
										<option value="<?=$ModE['origen']?>"><?=$ModE['origen']?></option>
										<!-- Origenes Diferentes al Seleccionado -->
										<?php $DiffDatosOrigen = $classEgresos -> listaOrigenesDiff($ModE['origen']) ?>
										<?php foreach($DiffDatosOrigen as $DiffOrigen) :?>
											<option value="<?=$DiffOrigen['nom_origen']?>"><?=$DiffOrigen['nom_origen']?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
							</li>
							<li>
								<label>Destino:</label>
								<select name="sltDestino">
									<?php if($ModE['destino'] == "") :?>
										<option value="" selected="">Elige</option>
										<!-- Todos los destinos registrados -->
										<?php $datosDestino = $classEgresos -> listaDestinos() ?>
										<?php foreach($datosDestino as $destino) :?>
											<option value="<?=$destino['nom_destino']?>"><?=$destino['nom_destino']?></option>
										<?php endforeach; ?>
									<?php else :?>
										<option value="<?=$ModE['destino']?>"><?=$ModE['destino']?></option>
										<!-- Destinos Diferentes al Seleccionado -->
										<?php $DiffDatosDestino = $classEgresos -> listaDestinosDiff($ModE['destino']) ?>
										<?php foreach($DiffDatosDestino as $DiffDestino) :?>
											<option value="<?=$DiffDestino['nom_destino']?>"><?=$DiffDestino['nom_destino']?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
							</li>
							<li>
								<label>Estado del Comprobante:</label>
								<input type="text" name="txtEstadoComprobante" value="<?=$ModE['estado_comprobante']?>" maxlength="20" autocomplete="off" >
							</li>
							<!-- INICIO de Fecha y Hora de Cancelación -->
								<?php
									$FechaHoraCancelacion = trim($ModE['fecha_cancelacion']);
									if($FechaHoraCancelacion != NULL){
										$FechaHoraCancelacion = date_format(date_create($FechaHoraCancelacion),'d-m-Y H:i:s');
									}else{
										$FechaHoraCancelacion = "";
									}
								?>
								<li>
									<label>Fecha de Cancelación:</label>
									<input type="text" name="txtFechaHoraCancelacion" id="FechaHoraCancelacion" value="<?=$FechaHoraCancelacion?>" minlength="10" maxlength="19" autocomplete="off" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).([0-9]{4}).(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)">
								</li>
							<!-- FIN de Fecha y Hora de Cancelación -->
							<li>
								<label>Régimen Fiscal:</label>
								<input type="text" name="txtRegiFiscal" value="<?=$ModE['regimen_fiscal']?>" maxlength="50" autocomplete="off">
							</li>
							<li>
								<label>Folio Fiscal:<span>&nbsp;*</span></label>
								<input type="text" name="txtFolioFiscal" value="<?=$ModE['folio_fiscal']?>" maxlength="50" autocomplete="off" required>
							</li>
							<!-- INICIO de Fecha y Hora de Timbrado -->
								<?php 
									$FechaTimbrado = trim($ModE['fecha_timbrado']);
									$fTimbrado = date_format(date_create($FechaTimbrado),'d-m-Y');
									$hTimbrado = date_format(date_create($FechaTimbrado),'H:i:s');
								?>
								<li>
									<label>Fecha Timbrado:<span>&nbsp;*</span></label>
									<input type="text" name="txtFechaTimbr" value="<?=$fTimbrado?>" maxlength="10" autocomplete="off" required pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}" placeholder="dd-mm-yyyy">
								</li>
								<li>
									<label>Hora Timbrado:<span>&nbsp;*</span></label>
									<input type="text" name="txtHoraTimbr" value="<?=$hTimbrado?>" maxlength="8" autocomplete="off" required pattern="^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$" placeholder="hh:mm:ss">
								</li>
							<!-- FIN de Fecha y Hora de Timbrado -->
							<li>
								<label class="label-textarea">Sello:<span>&nbsp;*</span></label>
								<textarea name="txtSello" class="sello" cols="50" rows="8" autocomplete="off" required><?=$ModE['sello_comprobante']?></textarea>
							</li>
							<li>
								<label>RFC Proveedor:</label>
								<input type="text" name="txtRFCprov" value="<?=$ModE['rfc_proveedor']?>" maxlength="13" autocomplete="off">
							</li>
							<p>&nbsp;</p>
							<div id="opcionesCargoSaldo" title="Agregar Cargo de Saldo"></div>
						</ul>
					</div>
					<div class="finanzasformpie">
						<input type="submit" name="btnModificarEgreso" value="Modificar" class="btn primary" />
						<!-- <input type="button" value="Limpiar" id="btn_limpiar" class="btn" /> -->
						<input type="button" name="btnCancelarEgreso" id="btnCancelarE" value="Cancelar" class="btneliminar" />
					</div>
				</form>
			</center>
    	</section>
    </center>
    <div id="rfcProv">&nbsp;</div>
    <!-- Jquery UI -->
	<script type="text/javascript" src="../../libs/jQueryUI/js/jquery-ui.js"></script><!-- JS -->
	<!-- DataTables -->
    <script type="text/javascript" src="../../libs/dataTables/js/jquery.dataTables.js" ></script><!-- JS -->
    <script type="text/javascript" src="../../libs/dataTables/js/dataTables.columnFilter.js" ></script><!-- JS Filtrar Columnas -->
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#guardarProv').click(function() {
			if ( $('#guardarProv').is(':checked') ) {
				var rfcEmi = $('#RfcEmisor');
				if (rfcEmi.val() != "") {
					var url = "obtener_rfc_proveedores.php";
			    	$.ajax({
			    		url: url,
			    		type: 'POST',
			    		data: rfcEmi,
			    		success: function(result) {
			    			$("#rfcProv").html(result);
			    		}
			    	});
			    }
			}
		});
		$('#btnCancelarE').click(function(){
			var msjConfirm = confirm('¿Esta seguro de cancelar el registro?');
			if (msjConfirm == true) {
				window.location.href = "listar_egresos.php";
			}
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
		
		setTimeout(function(){
			$('.error').fadeOut(1500);
		},5000);

		setTimeout(function(){
			$('.caption').fadeOut(1500);
		},5000);

		setTimeout(function(){
			$('.success').fadeOut(1500);
		},5000);
		// Botón obtener Fecha de Pago.
		$('#obtenerCargoS').click(function() {
			var tot = $('#Total').val(),
				nuevoTotal = tot.replace(',', '');
			$('#opcionesCargoSaldo').html("<div align='center'><img src='../../images/loader_blue.gif'></div>");
			$('#opcionesCargoSaldo').dialog({
				resizable: false,
				autoOpen: true,
				modal: true,
				width: 642,
				height: 372,
				show: "fold",
				hide: "fade"
			});
			$.post('opciones_cargos_saldos.php', {totalEgreso: nuevoTotal, egreso: <?=$ModE['idegresos']?>, pagoRestante: $('#porPagar').val()})
			.done(function(data) {
				$('#opcionesCargoSaldo').html(data);
			});
		});
	});
</script>