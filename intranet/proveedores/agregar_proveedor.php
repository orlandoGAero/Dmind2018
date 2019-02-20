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
<div id="registrarProveedor"></div>
<center>
	<section id="contenidoFinanz">
		<center>
			<form method="POST" class="finanzasform" id="formProvee" target="_self">
				<div class="finanzasformtitulo">
					<h2>Registrar Proveedor</h2>
				</div>
				<div class="finanzasformcontenido">
					<span><i style="padding-left:450px;" >*&nbsp;Datos Requeridos</i></span>
					<ul>
						<li><span class="azul">Datos Generales</span></li>
						<li>
							<label>Nombre:<span>&nbsp;*</span></label>
							<input type="text" name="txtNomP" maxlength="75" autocomplete="off" required>
						</li>
						<li>
							<label>Teléfono:</label>
							<input type="text" name="txtTelP" maxlength="10" autocomplete="off" pattern="^[0-9]{10}$" title="10 digitos">
						</li>
						<li>
							<label>Correo Electrónico:</label>
							<input type="text" name="txtEmailP" maxlength="75" autocomplete="off" pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,5})+$" title="usuario@empresa.com">
						</li>
						<li>
							<label>Dirección Web:</label>
							<input type="text" name="txtUrlP" maxlength="75" autocomplete="off" value="http://">
						</li>
						<li>
							<label>Categoría:</label>
							<div id="selectCatPv" style="display: inline-block;">
								<?php include_once 'datosSelCatPvReg.php'; ?>
							</div>
							<button type="button" id="btnCatProv" name="btnCatProvReg" class="botonesDatos" onclick="nuevaCatProv()">
                                	Nueva Categoría
                            	</button>
						</li>
						<li>&nbsp;</li>
						<li><span class="azul">Datos Fiscales</span></li>
						<li>
							<label>Razón Social:<span>&nbsp;*</span></label>
							<input type="text" name="txtRazSocP" maxlength="75" autocomplete="off" required>
						</li>
						<li>
							<label>RFC:<span>&nbsp;*</span></label>
							<input type="text" name="txtrRfcP" maxlength="13" autocomplete="off" required>
						</li>
						<li>
							<label>Tipo Razón Social:</label>
							<select name="sltTipRazSocP" >
								<option value="">Elige</option>
								<option value="MORAL">MORAL</option>
								<option value="FÍSICA">FÍSICA</option>
							</select>
						</li>
						<li>&nbsp;</li>
						<li><span class="azul">Datos Bancarios</span></li>
						<li>
							<label>Banco:</label>
							<input type="text" name="txtBancoP" maxlength="50" autocomplete="off">
						</li>
						<li>
							<label>Sucursal:</label>
							<input type="text" name="txtSucursalP" maxlength="50" autocomplete="off">
						</li>
						<li>
							<label>Titular:</label>
							<input type="text" name="txtTitularP" maxlength="50" autocomplete="off">
						</li>
						<li>
							<label>No. Cuenta:</label>
							<select name="sltNumCuentaP">
								<option value="">Elige</option>
								<?php foreach ($fnProv -> cuentasBancariasProv() as $numCuentaP) : ?>
									<option value="<?=$numCuentaP['id_cbancarias_p']?>"><?=$numCuentaP['num_cbancaria_p']?></option>
								<?php endforeach; ?>
							</select>
						</li>
						<li>
							<label>No. Clabe Interbancaria:</label>
							<input type="text" name="txtNumClaInterP" maxlength="18" autocomplete="off">
						</li>
						<li>
							<label>Tipo Cuenta:</label>
							<input type="text" name="txtTipCuentaP" maxlength="25" autocomplete="off">
						</li>
						<li>&nbsp;</li>
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
						<li>&nbsp;</li>
					</ul>
				</div>
				<div class="finanzasformpie">
					<input type="submit" name="btnRegistrarEgreso" value="Registrar" class="btn primary" />
					<input type="button" value="Limpiar" id="btnReset" class="btn" />
					<input type="button" name="btnCancelar" id="btnCancelarRegP" value="Cancelar" class="btneliminar" />
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
		$('#formProvee').submit(function(p) {
			$("#registrarProveedor").html("<center><div><img src='../images/loader_blue.gif'></div></center>");
			p.preventDefault();
			$.post('agregar_proveedor_guardar.php', $('#formProvee').serialize())
			.done(function(data) {
				$('#registrarProveedor').html(data);
			});
		});
		$('#btnReset').click(function(){
			$(':input','#formProvee')
			.not(':button, :submit, :reset, #tipoDireccion')
			.val('')
			.removeAttr('checked');
			// 	.removeAttr('selected');
		});
		$('#btnCancelarRegP').click(function(){
			var msjConfirm = confirm('¿Desea cancelar el registro?');
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
