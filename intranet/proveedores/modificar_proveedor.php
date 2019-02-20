<?php
	session_start();
	// Manejamos en sesión el nombre del usuario que se ha logeado
	if(!isset($_SESSION["usuario"])){
		header("location:../");  
	}
	$_SESSION["usuario"];
	// Termina inicio de sesión
	// Clase Proveedores.
	include 'classProveedores.php';
	$fnProv = new Proveedores();
?>
<div id="modificarProveedor"></div>
<center>
	<section id="contenidoFinanz">
		<center>
			<form method="POST" class="finanzasform" id="formProvee" target="_self">
				<div class="finanzasformtitulo">
					<h2>Modificar Proveedor</h2>
				</div>
				<div class="finanzasformcontenido">
					<?php if (isset($_REQUEST['proveedor'])) : ?>
						<?php
							$idProve = $_REQUEST['proveedor'];
							$datosProv = $fnProv -> datosProveedorEditar($idProve);
						?>
						<span><i style="padding-left:450px;" >*&nbsp;Datos Requeridos</i></span>
						<ul>
							<li><span class="azul">Datos Generales</span></li>
							<li>
								<!-- Id proveedor -->
								<input type="hidden" name="txtIdProveedor" readonly value="<?=$datosProv['id_proveedor']?>">
							</li>
							<li>
								<label>Nombre:<span>&nbsp;*</span></label>
								<input type="text" name="txtNomP" id="nomProveedor" maxlength="75" autocomplete="off" required value="<?=$datosProv['nom_proveedor']?>">
								<input type="button" value="Mismo RS" id="btnCopiarRS" class="btn" title="Razón Social igual a Nombre" />
							</li>
							<li>
								<label>Teléfono:</label>
								<input type="text" name="txtTelP" maxlength="10" autocomplete="off" pattern="^[0-9]{10}$" title="10 digitos" value="<?=$datosProv['tel_proveedor']?>">
							</li>
							<li>
								<label>Correo Electrónico:</label>
								<input type="text" name="txtEmailP" maxlength="75" autocomplete="off" pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,5})+$" title="usuario@empresa.com" value="<?=$datosProv['email_proveedor']?>">
							</li>
							<li>
								<?php if ($datosProv['url_proveedor'] != "") : ?>
									<?php $urlProveedor = $datosProv['url_proveedor']; ?>
								<?php else : ?>
									<?php $urlProveedor = "http://"; ?>
								<?php endif; ?>
								<label>Dirección Web:</label>
								<input type="text" name="txtUrlP" maxlength="75" autocomplete="off" value="<?=$urlProveedor?>">
							</li>
							<li>
								<!-- Id detalle categorias proveedor -->
								<input type="hidden" name="txtIdCatPro" readonly value="<?=$datosProv['id_detalle_prov']?>">
							</li>
							<li>
								<label>Categoría:</label>
								<div id="selectCatPv" style="display: inline-block;">
									<?php include_once 'datosSelCatPvMod.php'; ?>
								</div>
								<button type="button" id="btnCatProv" value="<?=$idProve?>" name="btnCatProvMod" class="botonesDatos" onclick="nuevaCatProv()">
                                	Nueva Categoría
                            	</button>
							</li>
							<li>&nbsp;</li>
							<li><span class="azul">Datos Fiscales</span></li>
							<li>
								<!-- Id proveedor datos fiscales -->
								<input type="hidden" name="txtIdProDatFis" readonly value="<?=$datosProv['idprov_datos_fiscales']?>">
							</li>
							<li>
								<label>Razón Social:<span>&nbsp;*</span></label>
								<input type="text" name="txtRazSocP" maxlength="75" id="razonSocial" autocomplete="off" required value="<?=$datosProv['razon_social_prov']?>">
							</li>
							<li>
								<label>RFC:<span>&nbsp;*</span></label>
								<input type="text" name="txtrRfcP" maxlength="13" autocomplete="off" required value="<?=$datosProv['rfc_prov']?>">
							</li>
							<li>
								<label>Tipo Razón Social:</label>
								<select name="sltTipRazSocP" >
									<?php if ($datosProv['tipo_razon_social_prov'] != "") : ?>
										<option value="<?=$datosProv['tipo_razon_social_prov']?>"><?=$datosProv['tipo_razon_social_prov']?></option>
										<?php if ($datosProv['tipo_razon_social_prov'] == "FÍSICA") : ?>
											<option value="MORAL">MORAL</option>
										<?php elseif ($datosProv['tipo_razon_social_prov'] == "MORAL") : ?>
											<option value="FÍSICA">FÍSICA</option>
										<?php endif; ?>
									<?php else : ?>
										<option value="">Elige</option>
										<option value="MORAL">MORAL</option>
										<option value="FÍSICA">FÍSICA</option>
									<?php endif; ?>
								</select>
							</li>
							<li>&nbsp;</li>
							<?php if ($datosProv['idprov_datos_bancarios'] != NULL) : ?>
								<li><span class="azul">Datos Bancarios</span></li>
								<li>
									<!-- Id proveedor datos bancarios -->
									<input type="hidden" name="txtIdProDatBan" readonly value="<?=$datosProv['idprov_datos_bancarios']?>">
								</li>
								<li>
									<label>Banco:</label>
									<input type="text" name="txtBancoP" maxlength="50" autocomplete="off" value="<?=$datosProv['nombre_banco_p']?>">
								</li>
								<li>
									<label>Sucursal:</label>
									<input type="text" name="txtSucursalP" maxlength="50" autocomplete="off" value="<?=$datosProv['sucursal_banco_p']?>">
								</li>
								<li>
									<label>Titular:</label>
									<input type="text" name="txtTitularP" maxlength="50" autocomplete="off" value="<?=$datosProv['titular_cuenta_p']?>">
								</li>
								<li>
									<label>No. Cuenta:</label>
									<select name="sltNumCuentaP">
										<?php if ($datosProv['id_cbancarias_p'] != "") : ?>
											<option value="<?=$datosProv['id_cbancarias_p']?>"><?=$datosProv['num_cbancaria_p']?></option>
											<?php foreach ($fnProv -> cuentasBancariasProvDiff($datosProv['id_cbancarias_p']) as $numCuentaP) : ?>
												<option value="<?=$numCuentaP['id_cbancarias_p']?>"><?=$numCuentaP['num_cbancaria_p']?></option>
											<?php endforeach; ?>
										<?php else : ?>
											<?php foreach ($fnProv -> cuentasBancariasProv() as $numCuentaP) : ?>
												<option value="<?=$numCuentaP['id_cbancarias_p']?>"><?=$numCuentaP['num_cbancaria_p']?></option>
											<?php endforeach; ?>
										<?php endif; ?>
									</select>
								</li>
								<li>
									<label>No. Clabe Interbancaria:</label>
									<input type="text" name="txtNumClaInterP" maxlength="18" autocomplete="off" value="<?=$datosProv['clabe_interbancaria_p']?>">
								</li>
								<li>
									<label>Tipo Cuenta:</label>
									<input type="text" name="txtTipCuentaP" maxlength="25" autocomplete="off" value="<?=$datosProv['tipo_cuenta_p']?>">
								</li>
							<?php else : ?>
								<li><span class="azul">Datos Bancarios</span></li>
								<li>
									<label>Banco:</label>
									<input type="text" name="txtBancoP" maxlength="50" autocomplete="off" value="<?=$datosProv['nombre_banco_p']?>">
								</li>
								<li>
									<label>Sucursal:</label>
									<input type="text" name="txtSucursalP" maxlength="50" autocomplete="off" value="<?=$datosProv['sucursal_banco_p']?>">
								</li>
								<li>
									<label>Titular:</label>
									<input type="text" name="txtTitularP" maxlength="50" autocomplete="off" value="<?=$datosProv['titular_cuenta_p']?>">
								</li>
								<li>
									<label>No. Cuenta:</label>
									<select name="sltNumCuentaP" >
										<option value="">Elige</option>
										<?php foreach ($fnProv -> cuentasBancariasProv() as $numCuentaP) : ?>
											<option value="<?=$numCuentaP['id_cbancarias_p']?>"><?=$numCuentaP['num_cbancaria_p']?></option>
										<?php endforeach; ?>
									</select>
								</li>
								<li>
									<label>No. Clabe Interbancaria:</label>
									<input type="text" name="txtNumClaInterP" maxlength="18" autocomplete="off" value="<?=$datosProv['clabe_interbancaria_p']?>">
								</li>
								<li>
									<label>Tipo Cuenta:</label>
									<input type="text" name="txtTipCuentaP" maxlength="25" autocomplete="off" value="<?=$datosProv['tipo_cuenta_p']?>">
								</li>
							<?php endif; ?>
							<li>&nbsp;</li>
							<?php $i = 0; ?>
							<?php foreach ($direccionesP = $fnProv -> direccionesProveedor($datosProv['id_proveedor']) as $direccionProv) : ?>
								<?php if ($direccionProv != NULL) : ?>
									<?php $i = $i + 1; ?>
									<li><span class="azul">Dirección <?=$direccionProv['tipo_direccion']?></span></li>
									<li>
										<!-- Id proveedor direccion -->
										<input type="hidden" name="direccionP[<?=$i?>][txtIdProvDir]" readonly value="<?=$direccionProv['idprov_direccion']?>">
									</li>
									<?php if ($direccionProv['tipo_direccion'] == "FISCAL") : ?>
										<li>
											<div id="opcDireccion" title="Agregar Datos de Dirección"></div>
											<button type="button" class="btn primary" id="obtenerDireccion">Obtener Dirección</button>
										</li>
									<?php endif; ?>
									<li>
										<label>Calle:</label>
										<input type="text" name="direccionP[<?=$i?>][txtCalle]" maxlength="70" autocomplete="off" value="<?=$direccionProv['calle_p']?>">
									</li>
									<li>
										<label>No. Exterior:</label>
										<input type="text" name="direccionP[<?=$i?>][txtNexterior]" maxlength="10" autocomplete="off" value="<?=$direccionProv['num_ext_p']?>">
									</li>
									<li>
										<label>No. Interior:</label>
										<input type="text" name="direccionP[<?=$i?>][txtNinterior]" maxlength="10" autocomplete="off" value="<?=$direccionProv['num_int_p']?>">
									</li>
									<li>
										<label>Colonia:</label>
										<input type="text" name="direccionP[<?=$i?>][txtColonia]" maxlength="70" autocomplete="off" value="<?=$direccionProv['colonia_p']?>">
									</li>
									<li>
										<label>Localidad:</label>
										<input type="text" name="direccionP[<?=$i?>][txtLocalidad]" id="loc" maxlength="70" autocomplete="off" value="<?=$direccionProv['localidad_p']?>">
									</li>
									<li>
										<label>Municipio:</label>
										<input type="text" name="direccionP[<?=$i?>][txtMunicipio]" id="mun" maxlength="70" autocomplete="off" value="<?=$direccionProv['municipio_p']?>">
									</li>
									<li>
										<label>Estado:</label>
										<input type="text" name="direccionP[<?=$i?>][txtEstado]" id="est" maxlength="70" autocomplete="off" value="<?=$direccionProv['estado_p']?>">
									</li>
									<li>
										<label>País:</label>
										<input type="text" name="direccionP[<?=$i?>][txtPais]" id="pais" maxlength="70" autocomplete="off" value="<?=$direccionProv['pais_p']?>">
									</li>
									<li>
										<label>Código Postal:</label>
										<input type="text" name="direccionP[<?=$i?>][txtCp]" id="cp" maxlength="5" autocomplete="off" pattern="^[0-9]{4,5}$" title="4 ó 5 digitos" value="<?=$direccionProv['cod_postal_p']?>">
									</li>
									<li>
										<label>Referencia:</label>
										<input type="text" name="direccionP[<?=$i?>][txtRef]" maxlength="70" autocomplete="off" value="<?=$direccionProv['referencia_direccion']?>">
									</li>
									<li>
										<label>Ubicación GPS:</label>
										<input type="text" name="direccionP[<?=$i?>][txtUbGps]" maxlength="70" autocomplete="off" value="<?=$direccionProv['gps_ubicacion']?>">
									</li>
									<li>
										<!-- Id detalle proveedor direccion -->
										<input type="hidden" name="direccionP[<?=$i?>][txtIdDetProDir]" readonly value="<?=$direccionProv['iddetalle_prov_dir']?>">
									</li>
									<li>
										<label>Tipo Dirección:</label>
										<input type="text" name="direccionP[<?=$i?>][txtTipDir]" id="tipoDireccion" maxlength="45" autocomplete="off" readonly value="<?=$direccionProv['tipo_direccion']?>">
									</li>
									<li>&nbsp;</li>
									<?php if ($direccionProv['tipo_direccion'] == "FISCAL Y FISICA") : ?>
										<li>
											<label>
												<span class="textGuardarProv">¿Agregar dirección fisica?</span>
												<input type="checkbox" name="dirFisica" id="dirFisProv" class="cbGuardarProv">
											</label>
										</li>
										<div id="tipoDir">&nbsp;</div>
									<?php endif; ?>
								<?php else : ?>
									<li><span class="azul">Dirección Fiscal</span></li>
									<li>
										<div id="opcDireccion" title="Agregar Datos de Dirección"></div>
										<button type="button" class="btn primary" id="obtenerDireccion">Obtener Dirección</button>
									</li>
									<li>
										<label>Calle:</label>
										<input type="text" name="direccionP[1][txtCalle]" maxlength="70" autocomplete="off">
									</li>
									<li>
										<label>No. Exterior:</label>
										<input type="text" name="direccionP[1][txtNexterior]" maxlength="10" autocomplete="off">
									</li>
									<li>
										<label>No. Interior:</label>
										<input type="text" name="direccionP[1][txtNinterior]" maxlength="10" autocomplete="off">
									</li>
									<li>
										<label>Colonia:</label>
										<input type="text" name="direccionP[1][txtColonia]" maxlength="70" autocomplete="off">
									</li>
									<li>
										<label>Localidad:</label>
										<input type="text" name="direccionP[1][txtLocalidad]" id="loc" maxlength="70" autocomplete="off">
									</li>
									<li>
										<label>Municipio:</label>
										<input type="text" name="direccionP[1][txtMunicipio]" id="mun" maxlength="70" autocomplete="off">
									</li>
									<li>
										<label>Estado:</label>
										<input type="text" name="direccionP[1][txtEstado]" id="est" maxlength="70" autocomplete="off">
									</li>
									<li>
										<label>País:</label>
										<input type="text" name="direccionP[1][txtPais]" id="pais" maxlength="70" autocomplete="off">
									</li>
									<li>
										<label>Código Postal:</label>
										<input type="text" name="direccionP[1][txtCp]" id="cp" maxlength="5" autocomplete="off" pattern="^[0-9]{4,5}$" title="4 ó 5 digitos">
									</li>
									<li>
										<label>Referencia:</label>
										<input type="text" name="direccionP[1][txtRef]" maxlength="70" autocomplete="off">
									</li>
									<li>
										<label>Ubicación GPS:</label>
										<input type="text" name="direccionP[1][txtUbGps]" maxlength="70" autocomplete="off">
									</li>
									<li>
										<label>Tipo Dirección:</label>
										<input type="text" name="direccionP[1][txtTipDir]" id="tipoDireccion" maxlength="45" autocomplete="off" value="FISCAL Y FISICA" readonly>
									</li>
									<li>&nbsp;</li>
									<li>
										<label>
											<span class="textGuardarProv">¿Agregar dirección fisica?</span>
											<input type="checkbox" name="dirFisica" id="dirFisProv" class="cbGuardarProv">
										</label>
									</li>
									<div id="tipoDir">&nbsp;</div>
								<?php endif; ?>
							<?php endforeach; ?>
							<li>&nbsp;</li>
						</ul>
					<?php else : ?>
						<span>Proveedor no recibido</span>
					<?php endif; ?>
				</div>
				<div class="finanzasformpie">
					<?php if (isset($_REQUEST['proveedor'])) : ?>
						<input type="submit" name="btnRegistrarEgreso" value="Editar" class="btn primary" />
						<input type="button" name="btnCancelar" id="btnCancelarModP" value="Cancelar" class="btneliminar" />
					<?php else : ?>
						<br><br>
					<?php endif; ?>
				</div>
			</form>
		</center>
	</section>
</center>

<!-- Div para agregar nuevos datos de egresos -->
    <div id="nuevoCatProv" class="modal-egresos"></div>
    <div id="fondoCatProv" class="overlay-egresos" onclick="cerrarCatProv()"></div>

<script type="text/javascript" src="../js/direccion_proveedor.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#btnCopiarRS').click(function() {
			valorRazonS = $('#razonSocial').val();
			if (valorRazonS != "") {
				$('#nomProveedor').val(valorRazonS);
			}
		});
		$('#formProvee').submit(function(p) {
			$("#modificarProveedor").html("<center><div><img src='../images/loader_blue.gif'></div></center>");
			p.preventDefault();
			$.post('modificar_proveedor_guardar.php', $('#formProvee').serialize())
			.done(function(data) {
				$('#modificarProveedor').html(data);
			});
		});
		$('#btnCancelarModP').click(function(){
			var msjConfirm = confirm('¿Desea cancelar la modificación?');
			if (msjConfirm == true) {
				$.fancybox.close();
			}
		});
		// Botón obtener Fecha de Pago.
		$('#obtenerDireccion').click(function() {
			$('#opcDireccion').dialog({
				resizable: false,
				autoOpen: true,
				modal: true,
				width: 642,
				height: 372,
				show: "fold",
				hide: "fade"
			});
			$.post('opciones_direccion.php')
			.done(function(data) {
				$('#opcDireccion').html(data);
			});
		});
	});
</script>
