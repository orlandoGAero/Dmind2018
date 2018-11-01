<?php
	session_start();
	//manejamos en sesion el nombre del usuario que se ha logeado
	if (!isset($_SESSION["usuario"])){
	    header("location:../");  
	}
	$_SESSION["usuario"];
	//termina inicio de sesion
?>
<?php  include ("../../conexion.php");?>
<script type="text/javascript" src="../../js/configuracion.js"></script>
<div>
	<center>
		<div id="barra">
			<br/>
			<form action="" method="POST" id="formInv" style="background:rgba(255,255,255,.95); height:auto; width:550px; border-radius:10px;">
				<h4>Nuevo Inventario</h4>
				<div><a href="" class="abrirTabla"><img src="../../images/save.png" title="Cargar Datos" style="float: right; padding-right: 15px;"></a></div>
				<div id="fade" class="overlay" onclick="document.getElementById('divTabla').style.display='none';document.getElementById('fade').style.display='none'"></div>
				<div id="divTabla" class="modal"></div>
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
						<tr>
							<td>
								<!-- PROVEEDOR -->
								<select name="idProveedor" required>
								<?php
									$consulta=mysql_query("SELECT * FROM proveedores");
									if($fila=mysql_fetch_array($consulta)){
										echo'<option value="" selected>Selecciona Proveedor</option>';
										do{
											echo'<option value="'.$fila["id_proveedor"].'">'.$fila["nom_proveedor"].'</option>';
										}
										while($fila=mysql_fetch_array($consulta));
									}
								?>		
								</select>
							</td>
							<td>
								<!-- STATUS -->
								<?php
									$consulta=mysql_query("SELECT * FROM status_inventario WHERE id_status=4");
									$fila=mysql_fetch_array($consulta);
								?>
								<input type="hidden" name="idStatus" value="<?=$fila['id_status']?>" readonly>
								<input type="text" value="<?=$fila['nombre_status']?>" readonly>					
							</td>
						</tr>
						<tr> <td><hr></td> <td><hr></td> </tr>
						<tr>
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
										$query = "SELECT pro.id_categoria, cat.nombre_categoria 
												  FROM categorias cat INNER JOIN productos pro ON cat.id_categoria=pro.id_categoria
												  WHERE pro.descontinuado = 'No'
												  GROUP BY cat.nombre_categoria;";
										$result=mysql_query($query);
										while($fila=mysql_fetch_array($result)){
											echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
										}
									?>
								</select>
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
							<td colspan="2">
								<label>División:</label>
							</td>
						</tr>
						<tr>
							<!-- DIVISIÓN -->
							<td colspan="2">
								<select id="divisiones" required>
									<option value="">Selecciona División</option>
								</select>
							</td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td>
								<label>Nombre:</label>
							</td>
							<td>
								<label>Tipo:</label>
							</td>
						</tr>
						<tr>
							<td>	
								<!-- NOMBRE -->
								<select id="nombres" required>
									<option value="">Selecciona Nombre</option>
								</select>
							</td>
							<td>
								<!-- TIPO -->
								<select id="tipos" required>
									<option value="">Selecciona Tipo</option>
								</select>
							</td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td>
								<label>Marca:</label>
							</td>
							<td>
								<label>Modelo:</label>
							</td>
						</tr>
						<tr>
							<td>
							  <!-- MARCA -->
							  <select id="marcas" required>
							  	<option value="">Selecciona una marca</option>
							  </select>     
							</td>
							<td>	
								<!-- MODELO -->
							    <select id="modelos" class="producto" name="idProducto" required>
							    	<option value="">Selecciona un modelo</option>
							    </select>
							</td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td colspan="2">
								<label>No. Serie:</label>
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
								<label>Número de factura compra:</label>
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
								<!-- NÚMERO DE FACTURA COMPRA -->
								<input type="text" name="noFactura" id="txt_f" style="height:27px;" maxlength="12"/>
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
										$consulta=mysql_query("SELECT id_estado,nombre_estado FROM estados ORDER BY nombre_estado");
										if($fila=mysql_fetch_array($consulta)){
											do{
												echo'<option value="'.$fila["id_estado"].'">'.$fila["nombre_estado"].'</option>';
											}
											while($fila=mysql_fetch_array($consulta));
										}
									?>
								</select>
							<td>
								<!-- UBICACIÓN -->
								<select name="idUbicacion" required>
									<option value="" selected>Selecciona Ubicación</option>
									<?php
										$consulta=mysql_query("SELECT id_ubicacion,nombre_ubicacion FROM ubicaciones ORDER BY nombre_ubicacion");
										if($fila=mysql_fetch_array($consulta)){
											do{
												echo'<option value="'.$fila["id_ubicacion"].'">'.$fila["nombre_ubicacion"].'</option>';
											}
											while($fila=mysql_fetch_array($consulta));
										}
									?>
								</select>
							</td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td colspan="2">
								<label>Color:</label>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<!-- COLOR -->
								<input type="text" name="color" style="height:27px;" />
							</td>
						</tr>
						<tr> <td><hr></td> <td><hr></td> </tr>
					</table>

					<table>
						<tr>
							<th>Transacción
								<?php 
									$query = "SELECT id_transaccion FROM transacciones ORDER BY id_transaccion DESC LIMIT 1";
									$result=mysql_query($query);
										
									$fila = mysql_fetch_array($result);
									
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
									$query = "SELECT * FROM tipo_transaccion where id_tipo_transaccion=1";
									$result=mysql_query($query);
									$fila=mysql_fetch_array($result);
								?>
					  			<label>Tipo transacción:</label><br>
			    				<input type="hidden" name="idTipoTransaccion" value="<?=$fila[0]?>" readonly>
			    				<input type="text" value="<?=$fila[1]?>" readonly>
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
				<div id="cargar"></div>
				<button type="submit" class="btn primary">Guardar</button>
			</form>
			<div id="guardarInv"></div>
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
