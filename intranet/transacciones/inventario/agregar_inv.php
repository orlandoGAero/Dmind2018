<?php
	session_start();
	//manejamos en sesion el nombre del usuario que se ha logeado
	if (!isset($_SESSION["usuario"])){
	    header("location:../");  
	}
	$_SESSION["usuario"];
	//termina inicio de sesion
?>
<?php 
	require ('classInventario.php');
	$funInv = new Inventario();
?>

<script type="text/javascript" src="../../js/configuracion.js"></script>
<div>
	<center>
		<div id="barra">
			<br/>
			<div style="background:rgba(255,255,255,.95); height:auto; width:550px; border-radius:10px;">
					<h4>Nuevo Inventario</h4>
					<div><a href="" class="abrirTabla"><img src="../../images/save.png" title="Cargar Datos" style="float: right; padding-right: 15px;"></a></div>
					<div id="fade" class="overlay" onclick="document.getElementById('divTabla').style.display='none';document.getElementById('fade').style.display='none'"></div>
					<div id="divTabla" class="modal"></div>
					<div class="remover">
						<form action="" method="POST" id="formInv">
							<center>
								<table style="width: 512px;">
									<tr>
										<td style="width: 250px;">
											<label>Proveedor:</label>
										</td>
										<td>
											<label>Status:</label>
										</td>
									</tr>
									
									<tr>
										<td>
											<!-- PROVEEDOR -->
											<select name="idProveedor" id="proveedor" required>
												<option value="" selected>Selecciona Proveedor</option>
											<?php
												$proveedores = $funInv->getProveedores();
												foreach ( $proveedores as $proveedor) {
													echo'<option value="'.$proveedor["id_proveedor"].'">'.$proveedor["nom_proveedor"].'</option>';
												}
											?>		
											</select>
										</td>
										<td>
											<!-- STATUS -->
											<?php
												$status = $funInv->getStatus();
											?>
											<input type="hidden" name="idStatus" value="<?=$status['id_status']?>" readonly>
											<input type="text" value="<?=$status['nombre_status']?>" readonly>					
										</td>
									</tr>
									<tr><td colspan="2">&nbsp;</td></tr>
									<tr>
										<td>
											<label>Número de factura compra:</label>
										</td>
									</tr>
									<tr>
										<td>
											<!-- NÚMERO DE FACTURA COMPRA -->
											<input type="text" name="noFactura" id="txt_f" style="height:27px;" maxlength="12"/>
										</td>
								
									</tr>
									
									<tr> <td><hr></td> <td><hr></td> </tr>
								</table>
								<table >
									<tr >
										<td colspan="2">
											<b>PRODUCTO</b>
										</td>
									</tr>
									<tr><td colspan="2">&nbsp;</td></tr>
									<tr>
										<td>
											<label> Categoría:</label>
											<select id="categoria" required>
												<option value="">Selecciona categoría</option>
												
												<?php
													$categorias = $funInv->getCategoriasProd();
													foreach ($categorias as $categoria) {
														echo "<option id='cat' value='".$categoria['id_categoria']."'>".$categoria['nombre_categoria']."</option>";
													}
												?>
											</select></div>
										</td>
										<td>	
											<label> Subcategoría:</label>
											<select id="subcategoria" required>
												<option value="">Selecciona Subcategoría</option>
											</select>
										</td>
									</tr>
									<tr><td colspan="2">&nbsp;</td></tr>
									<tr>
										<td>
											<label>División:</label>
										</td>
										<td>
											<label>Nombre:</label>
										</td>
									</tr>
									<tr>
										<!-- DIVISIÓN -->
										<td>
											<select id="divisiones" required>
												<option value="">Selecciona División</option>
											</select>
										</td>
										<td>	
											<!-- NOMBRE -->
											<select id="nombres" required>
												<option value="">Selecciona Nombre</option>
											</select>
										</td>
									</tr>
									<tr><td colspan="2">&nbsp;</td></tr>
									<tr>
										<td>
											<label>Tipo:</label>
										</td>
										<td>
											<label>Marca:</label>
										</td>
									</tr>
									<tr>
										<td>
											<!-- TIPO -->
											<select id="tipos" required>
												<option value="">Selecciona Tipo</option>
											</select>
										</td>
										<td>
										<!-- MARCA -->
										<select id="marcas" required>
											<option value="">Selecciona una marca</option>
										</select>     
										</td>
									</tr>
									<tr><td colspan="2">&nbsp;</td></tr>
									<tr>
										<td>
											<label>Modelo:</label>
										</td>
									</tr>
									<tr>
										
										<td>	
											<!-- MODELO -->
											<select id="modelos" class="producto" name="idProducto" required>
												<option value="">Selecciona un modelo</option>
											</select>
										</td>
									</tr>
									<tr><td colspan="2">&nbsp;</td></tr>
									<tr>
										<td>
											<label>No. Serie:</label>
										</td>
										<td>
											<label>Cantidad:</label>
										</td>
									</tr>
									<tr>
										<td>
											<!-- NO. SERIE -->
											<div id="inputBoton">
												<input type="text" name="noSerie" maxlength="14" required class="inputOculto mSerie" id="serie" />
												<img src="../../images/barcode-32.png" title="Generar No. Serie Interno" class="bntInterno pointer mt3">
											</div>
										</td>
										<td>
											<a id="minCant" style="cursor:pointer;"><img src="../../images/blue_min.png" title="Menos" alt="Menos" style="vertical-align: middle;"></a>
											<input type="text" name="txtCantidad" id="cantidad" class="numbers" value="0" min="0" max="999" maxlength="3" style="width:25px; height:16px; ">
											<a id="maxCant" style="cursor:pointer;"><img src="../../images/blue_max.png" title="Más" alt="Más" style="vertical-align: middle;"></a>
										</td>
									</tr>
									<tr><td colspan="2">&nbsp;</td></tr>
									<tr>
										<td>
											<label>Pedido de importación:</label>
										</td>
										<td>
											<label>Color:</label>
										</td>
									</tr>
									<tr>
										<td>
											<!-- PEDIDO DE IMPORTACIÓN -->
											<div id="inputBoton">
												<input type="text" class="inputOculto mPImport" id="txt_pi" name="pedidoImportacion" maxlength="35" required/>
												<img src="../../images/notapplies-24.png" title="N/A" class="btnPedImport pointer mt6">
											</div>
										</td>
										<td>
											<!-- COLOR -->
											<input type="text" name="color" style="height:27px;" />
										</td>
									</tr>
									<tr><td colspan="2">&nbsp;</td></tr>
									<tr>
										<td>
											<label>Estado:</label>
										</td>
										<td>
											<label>Ubicación:</label>
										</td>
									</tr>
									<tr>
										<td>
											<!-- ESTADO -->
											<select name="idEstado" required>
												<option value="" selected>Selecciona Estado</option>
												<?php
													$estados = $funInv->getEstado();

													foreach ($estados as $estado) {
														echo'<option value="'.$estado["id_estado"].'">'.$estado["nombre_estado"].'</option>';
													}
												?>
											</select>
										<td>
											<!-- UBICACIÓN -->
											<select name="idUbicacion" required>
												<option value="" selected>Selecciona Ubicación</option>
												<?php
													$ubicaciones = $funInv->getUbicacion();

													foreach ($ubicaciones as $ubicacion) {
														echo'<option value="'.$ubicacion["id_ubicacion"].'">'.$ubicacion["nombre_ubicacion"].'</option>';
													}
												?>
											</select>
										</td>
									</tr>
									<tr><td colspan="2">&nbsp;</td></tr>
								</table>
								<table>
									<tr> <td><hr></td> </tr>
									<tr>
										<th>Transacción
											<?php 
												
												$fila = $funInv->getFilaTransaccion();
												if ($fila[0] == 0) {
													$id_i = 1;	
												}
												else{
													$id_i = $fila[0]+1;
												}	
												echo "<input value='" . $id_i . "' type='text' name='idTransaccion' style='width:20px;' readonly />";
											?>
										</th>
									</tr>
									<tr>
										<td align="center">
											<b>Fecha:</b> <br>
											<?php date_default_timezone_set('America/Mexico_City'); ?>
											<input type="text" name="fechaAlta" value="<?php echo date("d-m-Y H:i:s"); ?>" readonly style="width:auto;">
										</td>
									</tr>
									<tr>
										<td align="center">
											<?php 
												$tipoTra = $funInv->getTipoTransaccion(); 
											?>
											<label>Tipo transacción:</label><br>
											<input type="hidden" name="idTipoTransaccion" value="<?=$tipoTra[0]?>" readonly>
											<input type="text" value="<?=$tipoTra[1]?>" readonly>
										</td>
									</tr>
									<tr>
										<td align="center">
											<b>Descripción:</b><br>
											<!-- <textarea name="descripcion" onclick="javascript:storeCaret(this);" cols="60" rows="3" style="resize:none;" class="textarea"></textarea> -->
											<textarea name="descripcion" cols="60" rows="3" style="resize:none;" class="textarea"></textarea>
										</td>
									</tr>
								</table>
							</center>
							<button type="submit" class="btn primary">Guardar</button>
						</form>
					</div>
					<div id="cargar"></div>
					<div id="guardarInv"></div>
			</div>
		</div>
		<!-- <div class="contbarra"></div> -->
	<center>
</div>
<script type="text/javascript">
	var inv = jQuery.noConflict();
	inv(document).ready(function(){
		inv('#formInv').submit(function(guardar) {
			$('#cargar').html('<div><img src="../../images/loader_blue.gif"/></div>');
			guardar.preventDefault();
			inv("#guardarInv").load("guardar.php?" + inv("#formInv").serialize());
		});

		inv('.bntInterno').click(function() {
			var numSerieInterno = 0;
			inv.post('generar_noserie_interno.php', {numSerieInterno}, function(obtenerFecha) {
				inv('#serie').val(obtenerFecha);
			});
		});

		inv('.btnPedImport').click(function(){
			inv('#txt_pi').val('N/A');
		});

		inv('.abrirTabla').on('click',function(abrir) {
			abrir.preventDefault();
			inv('#divTabla').load('tabla_eg.php');
			document.getElementById('divTabla').style.display='block';
			document.getElementById('fade').style.display='block';
		})
		// Disminuir cantidad.
		inv('#minCant').click(function() {
			if (inv('#cantidad').val() != "") {
			 	// Disminuye el valor si es diferente de 0.
			 	if (inv('#cantidad').val() != 0) {
				 	// Disminuye de 1 en 1 su valor.
				 	inv('#cantidad').val(parseInt(inv('#cantidad').val()) - 1);
				}
			}else{
				inv('#cantidad').val(0);
			}
		});
		// Aumentar cantidad.
		inv('#maxCant').click(function() {
			 // Aumenta el valor si es menor a 999.
			 if (inv('#cantidad').val() < 999) {
			 	if (inv('#cantidad').val() != "") {
				 	// Aumenta de 1 en 1 su valor.
				 	inv('#cantidad').val(parseInt(inv('#cantidad').val()) + 1);
				 }else{
				 	inv('#cantidad').val(1);
				 }
			 } 
		});
		// Solo números.
		inv('.numbers').keypress(function(tecla) {
		    if(tecla.charCode < 48 || tecla.charCode > 57) return false;
		});
	});
</script>
