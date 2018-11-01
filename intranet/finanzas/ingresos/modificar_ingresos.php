<?php
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
	<title>Modificar Ingresos</title>
	<link rel="shortcut icon" type="image/x-icon" href="../../images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="../../css/menu.css">
	<link rel="stylesheet" type="text/css" href="../../css/formularios.css">
    <link rel="stylesheet" type="text/css" href="../../css/mensajes.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilos.css">
    <!-- jQuery --><script type="text/javascript" src="../../js/jquery-2.1.4.js" ></script>

    <!-- Jquery UI Calendario -->
	<!-- CSS --><link rel="stylesheet" type="text/css" href="../../libs/jQueryUI/css/jquery-ui.css">
	<!-- JS --><script type="text/javascript" src="../../libs/jQueryUI/js/jquery-ui.js"></script>
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
     	require('../../class/ingresos.php');
		$classIngresos = new ingresos();
		// Verifica si el Botón de Modificar esta definido.
	    if(isset($_POST['btnModificarIngreso'])) {
	    	# Verificar la existencia de la dirección de Emisor.
				if (isset($_REQUEST['txtIdIngrDir'])) { // Id ingreso dirección
					$idIngresoDir = $_REQUEST['txtIdIngrDir'];
				} else {
					$idIngresoDir = NULL;
				} // Fin Id egreso dirección.
				if (isset($_REQUEST['txtPais_dfe'])) { // País Emisor
					$paisIngresoDir = $_REQUEST['txtPais_dfe'];
				} else {
					$paisIngresoDir = NULL;
				} // Fin País Emisor.
				if (isset($_REQUEST['txtEstado_dfe'])) { // Estado Emisor
					$estadoIngresoDir = $_REQUEST['txtEstado_dfe'];
				} else {
					$estadoIngresoDir = NULL;
				} // Fin Estado Emisor.
				if (isset($_REQUEST['txtMunicipio_dfe'])) { // Municipio Emisor
					$municipioIngresoDir = $_REQUEST['txtMunicipio_dfe'];
				} else {
					$municipioIngresoDir = NULL;
				} // Fin Municipio Emisor.
				if (isset($_REQUEST['txtColonia_dfe'])) { // Colonia Emisor
					$coloniaIngresoDir = $_REQUEST['txtColonia_dfe'];
				} else {
					$coloniaIngresoDir = NULL;
				} // Fin Colonia Emisor.
				if (isset($_REQUEST['txtNumExt_dfe'])) { // Num Exterior Emisor
					$nExtIngresoDir = $_REQUEST['txtNumExt_dfe'];
				} else {
					$nExtIngresoDir = NULL;
				} // Fin Num Exterior Emisor.
				if (isset($_REQUEST['txtNumInt_dfe'])) { // Num Interior Emisor
					$nIntIngresoDir = $_REQUEST['txtNumInt_dfe'];
				} else {
					$nIntIngresoDir = NULL;
				} // Fin Num Interior Emisor.
				if (isset($_REQUEST['txtCalle_dfe'])) { // Calle Emisor
					$calleIngresoDir = $_REQUEST['txtCalle_dfe'];
				} else {
					$calleIngresoDir = NULL;
				} // Fin Calle Emisor.
				if (isset($_REQUEST['txtCodPost_dfe'])) { // Código Postal Emisor
					$codPosIngresoDir = $_REQUEST['txtCodPost_dfe'];
				} else {
					$codPosIngresoDir = NULL;
				} // Fin Código Postal Emisor.
			# Fin verificación de existencia de la dirección de Emisor.
	    	$classIngresos -> modificarIngresos($_REQUEST['txt_idi'],
	    										$_REQUEST['txtEfectCompr'],
												$_REQUEST['txtVersion'],
												$_REQUEST['txtTipoCompr'],
												$_REQUEST['txtLugarExped'],
												$_REQUEST['txtFecha'],
												$_REQUEST['txtHora'],
												$_REQUEST['txtRfcEmisor'],
												$_REQUEST['txtNombreEmisor'],
												$idIngresoDir,
												$paisIngresoDir,
												$estadoIngresoDir,
												$municipioIngresoDir,
												$coloniaIngresoDir,
												$nExtIngresoDir,
												$nIntIngresoDir,
												$calleIngresoDir,
												$codPosIngresoDir,
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

	<?php if(isset($classIngresos -> msjErr)) :?>
		<div class="error"><h3><?=$classIngresos -> msjErr?></h3></div>
	<?php endif; ?>
	<?php if(isset($classIngresos -> msjCap)) :?>
		<div class="caption"><h3><?=$classIngresos -> msjCap?></h3></div>
	<?php endif; ?>
	
	<?php
	    if(isset($_GET['ingreso'])){
			$idIngreso = $_GET['ingreso'];
		}
		 
		$datosModI = $classIngresos -> datosEditarIngreso($idIngreso);
	?>

    <h1 style="text-align:center; color:rgba(0,191,255,.9);">
    	<a href="listar_ingresos.php">
			<img class="atras" src="../../images/atras.png" title="Regresar">
		</a>Modificar Ingresos
	</h1>

	<center>
		<section id="contenido">
    		<center>
				<form action="" method="POST" class="finanzasform">
					<div class="finanzasformtitulo">
						<h2>Editar Ingreso</h2>
					</div>
					<div class="finanzasformcontenido">
						<span><i style="padding-left:450px;" >*&nbsp;Datos Requeridos</i></span>
						<ul>
							<!-- ID Ingresos -->
							<input type="hidden" name="txt_idi" readonly value="<?=$datosModI['id_ingresos']?>" />
							<li>
								<label>Efecto del Comprobante:<span>&nbsp;*</span></label>
								<input type="text" name="txtEfectCompr" value="<?=$datosModI['efecto_comprobante']?>" readonly maxlength="7" autocomplete="off" required>
							</li>
							<li>
								<label>Versión:<span>&nbsp;*</span></label>
								<input type="text" name="txtVersion" value="<?=$datosModI['version_comprobante']?>" maxlength="5" autocomplete="off" required>
							</li>
							<li>
								<label>Tipo de Comprobante:<span>&nbsp;*</span></label>
								<input type="text" name="txtTipoCompr" value="<?=$datosModI['tipo_comprobante']?>" maxlength="7" autocomplete="off" required>
							</li>
							<li>
								<label>Lugar de Expedición:<span>&nbsp;*</span></label>
								<input type="text" name="txtLugarExped" value="<?=$datosModI['lugar_expedicion']?>" maxlength="50" autocomplete="off" required>
							</li>
							<!-- INICIO de Fecha y Hora de Egreso -->
								<?php 
									$FechaComprobante = trim($datosModI['fecha']);
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
								<input type="text" name="txtRfcEmisor" value="<?=$datosModI['rfc_emisor']?>" maxlength="13" autocomplete="off" required>
							</li>
							<li>
								<label>Razón Social Emisor:<span>&nbsp;*</span></label>
								<input type="text" name="txtNombreEmisor" value="<?=$datosModI['razon_social_emisor']?>" maxlength="100" autocomplete="off" required>
							</li>
							<?php if ($datosModI['ingr_pais'] || $datosModI['ingr_estado'] || $datosModI['ingr_municipio'] || $datosModI['ingr_colonia'] || $datosModI['ingr_no_ext'] || $datosModI['ingr_no_int'] || $datosModI['ingr_calle'] || $datosModI['ingr_cod_post']) : ?>
								<!-- dfe = Domicilio Fiscal Emisor -->
								<li>
									<p><center><b>Domicilio Fiscal Emisor</b></center></p>
								</li>
								<!-- ID dirección ingresos -->
								<li>
									<input type="hidden" name="txtIdIngrDir" value="<?=$datosModI['id_ingr_direccion']?>" readonly>
								</li>
								<!-- País -->
								<li>
									<label>País:</label>
									<input type="text" name="txtPais_dfe" value="<?=$datosModI['ingr_pais']?>" maxlength="50">
								</li>
								<!-- Estado -->
								<li>
									<label>Estado:</label>
									<input type="text" name="txtEstado_dfe" value="<?=$datosModI['ingr_estado']?>" maxlength="50">
								<!-- Municipio -->
								<li>
									<label>Municipio:</label>
									<input type="text" name="txtMunicipio_dfe" value="<?=$datosModI['ingr_municipio']?>" maxlength="50">
								<!-- Colonia -->
								<li>
									<label>Colonia:</label>
									<input type="text" name="txtColonia_dfe" value="<?=$datosModI['ingr_colonia']?>" maxlength="50">
								<!-- Número Exterior -->
								<li>
									<label>Número Exterior:</label>
									<input type="text" name="txtNumExt_dfe" value="<?=$datosModI['ingr_no_ext']?>" maxlength="25">
								<!-- Número Interior -->
								<li>
									<label>Número Interior:</label>
									<input type="text" name="txtNumInt_dfe" value="<?=$datosModI['ingr_no_int']?>" maxlength="10">
								<!-- Calle -->
								<li>
									<label>Calle:</label>
									<input type="text" name="txtCalle_dfe" value="<?=$datosModI['ingr_calle']?>" maxlength="50">
								<!-- Código Postal -->
								<li>
									<label>Código Postal</label>
									<input type="text" name="txtCodPost_dfe" value="<?=$datosModI['ingr_cod_post']?>" maxlength="5">
								</li>
								<p>&nbsp;</p>
							<?php endif; ?>
							<li>
								<label>RFC Receptor:<span>&nbsp;*</span></label>
								<input type="text" name="txtRfcReceptor" value="<?=$datosModI['rfc_receptor']?>" maxlength="13" autocomplete="off" required>
							</li>
							<li>
								<label>Razón Social Receptor:<span>&nbsp;*</span></label>
								<input type="text" name="txtNombreReceptor" value="<?=$datosModI['razon_social_receptor']?>" maxlength="100" autocomplete="off" required>
							</li>
							<li>
								<label>Uso CFDI:</label>
								<input type="text" name="txtusoCFDI" value="<?=$datosModI['uso_cfdi']?>" maxlength="50" autocomplete="off">
							</li>
							<li>
								<label>Serie:<span>&nbsp;*</span></label>
								<input type="text" name="txtSerie" value="<?=$datosModI['serie']?>" maxlength="50" autocomplete="off" required>
							</li>
							<!-- Conceptos de Ingresos -->
							<?php if ($conceptosIgresos = $classIngresos -> conceptosDetalleIngresos($idIngreso)) : ?>
								<?php $i = 0; ?>
								<?php foreach ($conceptosIgresos as $conceptoI) : ?>
									<?php $i += 1; ?>
									<li>
										<span class='azul'><b> - Concepto <?=$i?> -</b></span>
									</li>
									<!-- Id concepto ingreso -->
									<li>
										<input type='hidden' name='conceptosFactura[<?=$i?>][idCoIng]' maxlength='6' value="<?=$conceptoI['id_ingresos_conceptos']?>" autocomplete='off' readonly>
									</li>
									<li>
										<label>Clave Concepto <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][claveC]' maxlength='20' value="<?=$conceptoI['clave_concepto_i']?>" autocomplete='off'>
									</li>
									<li>
										<label>Cantidad Concepto <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][cantidadC]' maxlength='7' value="<?=$conceptoI['cantidad_concepto_i']?>" autocomplete='off'>
									</li>
									<li>
										<label>Clave Unidad <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][claveUnidadC]' maxlength='10' value="<?=$conceptoI['clave_unidad_concepto_i']?>" autocomplete='off'>
									</li>
									<li>
										<label>Unidad Concepto <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][unidadC]' maxlength='5' value="<?=$conceptoI['unidad_concepto_i']?>" autocomplete='off'>
									</li>
									<li>
										<label>Descripción <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][descripcionC]' maxlength='255' value="<?=$conceptoI['descripcion_concepto_i']?>" autocomplete='off'>
									</li>
									<li>
										<label>Valor Unitario <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][valorUnitarioC]' maxlength='10' value="<?=$conceptoI['valor_unitario_concepto_i']?>" autocomplete='off'>
									</li>
									<li>
										<label>Importe Concepto <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][importeC]' maxlength='10' value="<?=$conceptoI['importe_concepto_i']?>" autocomplete='off'>
									</li>
									<li>
										<label>Base Impuesto Concepto <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][baseImpuestoC]' maxlength='10' value="<?=$conceptoI['base_impuesto_concepto_i']?>" autocomplete='off'>
									</li>
									<li>
										<label>Impuesto del Concepto <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][impuestoC]' maxlength='20' value="<?=$conceptoI['impuesto_concepto_i']?>" autocomplete='off'>
									</li>
									<li>
										<label>Tipo Factor del Impuesto Concepto <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][tipoFactorImpuestoC]' maxlength='20' value="<?=$conceptoI['tipofactor_impuesto_concepto_i']?>" autocomplete='off'>
									</li>
									<li>
										<label>Tasa/Cuota del Impuesto Concepto <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][tasaCuotaImpuestoC]' maxlength='10' value="<?=$conceptoI['tasacuota_impuesto_concepto_i']?>" autocomplete='off'>
									</li>
									<li>
										<label>Importe del Impuesto Concepto <?=$i?>:</label>
										<input type='text' name='conceptosFactura[<?=$i?>][importeImpuestoC]' maxlength='10' value="<?=$conceptoI['importe_impuesto_concepto_i']?>" autocomplete='off'>
									</li>
								<?php endforeach; ?>
								<hr class='linea-azul'>
							<?php endif; ?>
							<li>
								<label>No. Folio:<span>&nbsp;*</span></label>
								<input type="text" name="txtFolio" value="<?=$datosModI['no_folio']?>" maxlength="10" autocomplete="off" required>
							</li>
							<li>
								<label>Descuento ($):</label>
								<input type="text" name="txtDescuento" value="<?=$datosModI['descuento']?>" maxlength="15" autocomplete="off">
							</li>
							<li>
								<label>Subtotal ($):<span>&nbsp;*</span></label>
								<input type="text" name="txtSubtotal" value="<?=$datosModI['subtotal']?>" maxlength="15" autocomplete="off" required>
							</li>
							<li>
								<label>IVA ($):<span>&nbsp;*</span></label>
								<input type="text" name="txtIva" value="<?=$datosModI['iva']?>" maxlength="15" autocomplete="off" required>
							</li>
							<li>
								<label>Total ($):<span>&nbsp;*</span></label>
								<input type="text" name="txtTotal" value="<?=$datosModI['total']?>" maxlength="15" autocomplete="off" required>
							</li>
							<li>
								<label>Moneda:<span>&nbsp;*</span></label>
								<input type="text" name="txtMoneda" value="<?=$datosModI['moneda_comprobante']?>" maxlength="5" autocomplete="off" required>
							</li>
							<li>
								<label>Método de Pago:<span>&nbsp;*</span></label>
								<input type="text" name="txtMetodoPago" value="<?=$datosModI['metodo_pago']?>" maxlength="50" autocomplete="off" required>
							</li>
							<li>
								<label>Condiciones de Pago:</label>
								<input type="text" name="txtCondicionPago" value="<?=$datosModI['condiciones_pago']?>" maxlength="50" autocomplete="off">
							</li>
							<li>
								<label>Forma de Pago:<span>&nbsp;*</span></label>
								<input type="text" name="txtFormaPago" value="<?=$datosModI['forma_pago']?>" maxlength="50" autocomplete="off" required>
							</li>
							<!-- INICIO de Fecha y Hora de Pago -->
								<?php
									$FechaHoraPago = trim($datosModI['fecha_hora_pago']);
									if($FechaHoraPago != NULL){
										$FechaHoraPago = date_format(date_create($FechaHoraPago),'d-m-Y H:i:s');
									}else{
										$FechaHoraPago = "";
									}
								?>
								<li>
									<label>Fecha y Hora de Pago:</label>
									<input type="text" name="txtFechaHoraPago" id="FechaHoraPago" value="<?=$FechaHoraPago?>" minlength="10" maxlength="19" autocomplete="off" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).([0-9]{4}).(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)">
								</li>
							<!-- FIN de Fecha y Hora de Pago -->
							<li>
								<label>Nombre del Impuesto:<span>&nbsp;*</span></label>
								<input type="text" name="txtNombreImpuesto" value="<?=$datosModI['nombre_impuesto']?>" maxlength="50" autocomplete="off" required>
							</li>
							<li>
								<label>Total Impuesto ($):<span>&nbsp;*</span></label>
								<input type="text" name="txtTotalImpuesto" value="<?=$datosModI['total_impuesto']?>" maxlength="15" autocomplete="off" required>
							</li>
							<li>
								<label>Tipo de Factor Impuesto:</label>
								<input type="text" name="txtTipoFactorImpuesto" value="<?=$datosModI['tipo_factor_impuesto']?>" maxlength="35" autocomplete="off">
							</li>
							<li>
								<label>Tasa Impuesto:<span>&nbsp;*</span></label>
								<input type="text" name="txtTasaImpuesto" value="<?=$datosModI['tasa_cuota_impuesto']?>" maxlength="15" autocomplete="off" required>
							</li>
							<li>
								<label>No. de Cuenta:</label>
								<input type="text" name="txtNumCuenta" value="<?=$datosModI['no_cuenta']?>" maxlength="18" autocomplete="off" >
							</li>
							<li>
								<label>Concepto:</label>
								<select name="sltConcepto">
									<?php if($datosModI['concepto'] == "") :?>
										<option value="" selected="">Elige</option>
										<!-- Todos los conceptos registrados -->
										<?php $datosConceptos = $classIngresos -> listaConceptos() ?>
										<?php foreach($datosConceptos as $concepto) :?>
											<option value="<?=$concepto['nom_concepto']?>"><?=$concepto['nom_concepto']?></option>
										<?php endforeach ?>
									<?php else :?>
										<option value="<?=$datosModI['concepto']?>"><?=$datosModI['concepto']?></option>
										<!-- Conceptos Diferentes al Seleccionado -->
										<?php $DiffDatosConceptos = $classIngresos -> listaConceptosDiff($datosModI['concepto']) ?>
										<?php foreach($DiffDatosConceptos as $Diffconcepto) :?>
											<option value="<?=$Diffconcepto['nom_concepto']?>"><?=$Diffconcepto['nom_concepto']?></option>
										<?php endforeach ?>
									<?php endif; ?>
								</select>
							</li>
							<li>
							<label>Clasificación:</label>
								<select name="sltClasificacion">
									<?php if($datosModI['clasificacion'] == "") :?>
										<option value="" selected="">Elige</option>
										<!-- Todas las clasificaciones registradas -->
										<?php $datosClasif = $classIngresos -> listaClasificaciones() ?>
										<?php foreach($datosClasif as $clasif) :?>
											<option value="<?=$clasif['nom_clasifi']?>"><?=$clasif['nom_clasifi']?></option>
										<?php endforeach ?>
									<?php else :?>
										<option value="<?=$datosModI['clasificacion']?>"><?=$datosModI['clasificacion']?></option>
										<!-- Clasificaciones Diferentes a la Seleccionada -->
										<?php $DiffDatosClasif = $classIngresos -> listaClasificacionesDiff($datosModI['clasificacion']) ?>
										<?php foreach($DiffDatosClasif as $DiffClasif) :?>
											<option value="<?=$DiffClasif['nom_clasifi']?>"><?=$DiffClasif['nom_clasifi']?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
							</li>
							<li>
								<label>Status:</label>
								<select name="sltStatus">
									<?php if($datosModI['estado'] == "") :?>
										<option value="" selected="">Elige</option>
										<!-- Todos los status registrados -->
										<?php $datosStatus = $classIngresos -> listaStatus() ?>
										<?php foreach($datosStatus as $status) :?>
											<option value="<?=$status['nom_status']?>"><?=$status['nom_status']?></option>
										<?php endforeach; ?>
									<?php else :?>
										<option value="<?=$datosModI['estado']?>"><?=$datosModI['estado']?></option>
										<!-- Status Diferentes al Seleccionado -->
										<?php $DiffDatosStatus = $classIngresos -> listaStatusDiff($datosModI['estado']) ?>
										<?php foreach($DiffDatosStatus as $DiffStatus) :?>
											<option value="<?=$DiffStatus['nom_status']?>"><?=$DiffStatus['nom_status']?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
							</li>
							<li>
								<label>Origen: </label>
								<select name="sltOrigen">
									<?php if($datosModI['origen'] == "") :?>
										<option value="" selected="">Elige</option>
										<!-- Todos los origenes registrados -->
										<?php $datosOrigen = $classIngresos -> listaOrigenes() ?>
										<?php foreach($datosOrigen as $origen) :?>
											<option value="<?=$origen['nom_origen']?>"><?=$origen['nom_origen']?></option>
										<?php endforeach; ?>
									<?php else :?>
										<option value="<?=$datosModI['origen']?>"><?=$datosModI['origen']?></option>
										<!-- Origenes Diferentes al Seleccionado -->
										<?php $DiffDatosOrigen = $classIngresos -> listaOrigenesDiff($datosModI['origen']) ?>
										<?php foreach($DiffDatosOrigen as $DiffOrigen) :?>
											<option value="<?=$DiffOrigen['nom_origen']?>"><?=$DiffOrigen['nom_origen']?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
							</li>
							<li>
								<label>Destino:</label>
								<select name="sltDestino">
									<?php if($datosModI['destino'] == "") :?>
										<option value="" selected="">Elige</option>
										<!-- Todos los destinos registrados -->
										<?php $datosDestino = $classIngresos -> listaDestinos() ?>
										<?php foreach($datosDestino as $destino) :?>
											<option value="<?=$destino['nom_destino']?>"><?=$destino['nom_destino']?></option>
										<?php endforeach; ?>
									<?php else :?>
										<option value="<?=$datosModI['destino']?>"><?=$datosModI['destino']?></option>
										<!-- Destinos Diferentes al Seleccionado -->
										<?php $DiffDatosDestino = $classIngresos -> listaDestinosDiff($datosModI['destino']) ?>
										<?php foreach($DiffDatosDestino as $DiffDestino) :?>
											<option value="<?=$DiffDestino['nom_destino']?>"><?=$DiffDestino['nom_destino']?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
							</li>
							<li>
								<label>Estado del Comprobante:</label>
								<input type="text" name="txtEstadoComprobante" value="<?=$datosModI['estado_comprobante']?>" maxlength="20" autocomplete="off" >
							</li>
							<!-- INICIO de Fecha y Hora de Cancelación -->
								<?php
									$FechaHoraCancelacion = trim($datosModI['fecha_cancelacion']);
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
								<input type="text" name="txtRegiFiscal" value="<?=$datosModI['regimen_fiscal']?>" maxlength="50" autocomplete="off">
							</li>
							<li>
								<label>Folio Fiscal:<span>&nbsp;*</span></label>
								<input type="text" name="txtFolioFiscal" value="<?=$datosModI['folio_fiscal']?>" maxlength="50" autocomplete="off" required>
							</li>
							<!-- INICIO de Fecha y Hora de Timbrado -->
								<?php 
									$FechaTimbrado = trim($datosModI['fecha_timbrado']);
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
								<textarea name="txtSello" class="sello" cols="50" rows="8" autocomplete="off" required><?=$datosModI['sello_comprobante']?></textarea>
							</li>
							<li>
								<label>RFC Proveedor:</label>
								<input type="text" name="txtRFCprov" value="<?=$datosModI['rfc_proveedor']?>" maxlength="13" autocomplete="off">
							</li>
							<p>&nbsp;</p>
						</ul>
					</div>
					<div class="finanzasformpie">
						<input type="submit" name="btnModificarIngreso" value="Modificar" class="btn primary" />
						<input type="button" id="btnCancelarModI" value="Cancelar" class="btneliminar" />
					</div>
				</form>
			</center>
    	</section>
    </center>
    </body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#btnCancelarModI').click(function(){
			var msjConfirm = confirm('¿Esta seguro de cancelar el registro?');
			if (msjConfirm == true) {
				window.location.href = "listar_ingresos.php";
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
		},3000);

		setTimeout(function(){
			$('.caption').fadeOut(1500);
		},3000);

		setTimeout(function(){
			$('.success').fadeOut(1500);
		},3000);
	});
</script>