<?php
	session_start();
	//manejamos en sesion el nombre del usuario que se ha logeado
	if (!isset($_SESSION["usuario"])){
	    header("location:../");  
	}
	$_SESSION["usuario"];
	//termina inicio de sesion
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title>Clonar</title>
	<link rel="shortcut icon" type="image/x-icon" href="../../images/favicon.ico" />
	<link rel="stylesheet" href="../../css/estilos.css" />
	<link rel="stylesheet" href="../../css/menu.css" />
	<link rel="stylesheet" href="../../css/formularios.css" />
	<link rel="stylesheet" href="../../css/mensajes.css" />
	<script type="text/javascript" src="../../js/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="../../js/configuracion.js"></script>
</head>

<body>
	<header>
		<img src="../../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
	</header>

	<nav>
		<ul>
			<li><a href="../" alt="Inicio" title="Inicio"><img src="../../images/home.png"/></a></li>
			<li></li><li></li><li></li><li></li>
			<li><a href="../../salir.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../../images/lock.png"/></a></li>
		</ul>
	</nav>

	<section id="contenido">
		<h1 style="text-align:center;">
			<a href="index.php">
				<img class="atras" src="../../images/atras.png" alt="Atras">
			</a>Clonar Producto Inventariado
		</h1>
		<section id="principal">

<?php
	include("../../conexion.php");
	require_once("../../libs/encrypt_decrypt_strings_urls.php");
	$id_inv= decrypt(htmlspecialchars($_GET["product"]),"intranetdminventario");
	$query="SELECT 
			  INV.id_inventario,
			  #INV.id_status,
			  #SI.nombre_status,
			  PROV.id_proveedor,
			  PROV.nom_proveedor,
			  PROD.id_categoria,
			  C.nombre_categoria,
			  PROD.id_subcategoria,
			  S.nombre_subcategoria,
			  PROD.id_division,
			  DI.nombre_division,
			  INV.id_producto,
			  PROD.id_nombre,
			  NM.nombre,
			  PROD.id_tipo,
			  TP.nombre_tipo,
			  PROD.id_marca,
			  M.nombre_marca,
			  PROD.modelo,
			  INV.pedido_de_importacion,
			  INV.no_factura,
			  INV.id_estado,
			  E.nombre_estado,
			  INV.id_ubicacion,
			  U.nombre_ubicacion,
			  INV.color,
			  TR.descripcion
			FROM
			 inventario INV
			  #INNER JOIN status_inventario SI
			    #ON INV.id_status = SI.id_status
			  INNER JOIN proveedores PROV 
			    ON INV.id_proveedor = PROV.id_proveedor 
			  INNER JOIN productos PROD 
			    ON INV.id_producto = PROD.id_producto 
			  INNER JOIN categorias C 
			    ON PROD.id_categoria = C.id_categoria 
			  INNER JOIN subcategorias S 
			    ON PROD.id_subcategoria = S.id_subcategoria 
			  INNER JOIN division DI
			    ON PROD.id_division = DI.id_division
			  INNER JOIN nombres NM
			    ON PROD.id_nombre = NM.id_nombre
			  INNER JOIN tipos TP
			    ON PROD.id_tipo = TP.id_tipo
			  INNER JOIN marca_productos M
			    ON PROD.id_marca = M.id_marca
			  INNER JOIN estados E 
			    ON INV.id_estado = E.id_estado
			  INNER JOIN ubicaciones U 
			    ON INV.id_ubicacion = U.id_ubicacion
			  INNER JOIN transacciones TR
			    ON INV.id_inventario = TR.id_inventario
			WHERE INV.id_inventario = '$id_inv'";
	$result=mysql_query($query);
	while($fila=mysql_fetch_array($result)){
		// $id_status_inv = $fila["id_status"];
		// $nom_status_inv = $fila["nombre_status"];
		$id_prov = $fila["id_proveedor"];
		$nom_prov = $fila["nom_proveedor"];
		$id_cat = $fila["id_categoria"];
		$nom_cat = $fila["nombre_categoria"];
		$id_sub = $fila["id_subcategoria"];
		$nom_sub = $fila["nombre_subcategoria"];
		$id_div = $fila["id_division"];
		$nom_div = $fila["nombre_division"];
		$id_prod = $fila["id_producto"];
		$id_nom = $fila["id_nombre"];
		$nom_prod = $fila["nombre"];
		$id_tipo = $fila["id_tipo"];
		$nom_tipo = $fila["nombre_tipo"];
		$id_marc = $fila["id_marca"];
		$nom_marc = $fila["nombre_marca"];
		$mod = $fila["modelo"];
		$pedi = $fila["pedido_de_importacion"];
		$no_fact = $fila["no_factura"];
		$id_est = $fila["id_estado"];
		$nom_est = $fila["nombre_estado"];
		$id_ub = $fila["id_ubicacion"];
		$nom_ub = $fila["nombre_ubicacion"];
		$color = $fila['color'];
		$desc = $fila['descripcion'];
	}
?>

<form action="" method="POST" id="formClon" target="_self" style="background:rgba(255,255,255,.95);heigth:600px;width:500px; padding:20px;border-radius:10px;">
	<center>
		<table class="editar">
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
					<select name="idProveedor">
						<option value="<?=$id_prov?>"><?=$nom_prov?></option>
						<?php
							$consulta="SELECT id_proveedor,nom_proveedor FROM proveedores WHERE NOT id_proveedor= ".$id_prov;
							$result=mysql_query($consulta);
							while($fila=mysql_fetch_array($result)){
								echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
							}
						?>
					</select>
				</td>
				<td>
					<!-- STATUS -->
					<?php
						$consulta = "SELECT id_status,nombre_status FROM status_inventario WHERE id_status = 4;";
						$resultado = mysql_query($consulta);
						while ($fila = mysql_fetch_array($resultado)) {
							$idStatusInv = $fila['id_status'];
							$nomStatusInv = $fila['nombre_status'];
						}
					?>
					<input type="hidden" name="idStatus" value="<?=$idStatusInv?>" readonly>
					<input type="text" value="<?=$nomStatusInv?>" readonly>					
				</td>
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
			    		<select id="categoria">
							<option value="<?php echo $id_cat ?>"><?php echo $nom_cat ?></option>
							<?php 
							$query = "SELECT pro.id_categoria, cat.nombre_categoria 
									  FROM categorias cat INNER JOIN productos pro ON cat.id_categoria=pro.id_categoria
									  WHERE NOT cat.id_categoria = ".$id_cat."
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
						<select id="subcategoria">
							<option value="<?=$id_sub?>"><?=$nom_sub?></option>
							<?php
								$query = "SELECT prod.id_subcategoria, subCat.nombre_subcategoria
										  FROM productos prod INNER JOIN categorias cat ON prod.id_categoria = cat.id_categoria
											INNER JOIN subcategorias subCat ON prod.id_subcategoria = subCat.id_subcategoria
										  WHERE NOT prod.id_subcategoria = ".$id_sub." AND prod.id_categoria = ".$id_cat;
								$result=mysql_query($query);
								while($fila=mysql_fetch_array($result)){
									echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
								}
							?>
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
						<select id="divisiones">
							<option value="<?=$id_div?>"><?=$nom_div?></option>
							<?php 
								$query = "SELECT P.id_division, D.nombre_division 
                    					  FROM productos P INNER JOIN division D ON P.id_division=D.id_division
                    					  WHERE P.id_categoria = ".$id_cat." AND P.id_subcategoria = ".$id_sub." AND P.id_division != ".$id_div ;
								$result=mysql_query($query);
								while($fila=mysql_fetch_array($result)){
									echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
								}
							?>
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
						<select id="nombres">
							<option value="<?=$id_nom?>"><?=$nom_prod?></option>
							<?php
								$query = "SELECT P.id_nombre, N.nombre 
                    					  FROM productos P INNER JOIN nombres N ON P.id_nombre=N.id_nombre 
                    					  WHERE P.id_categoria = ".$id_cat." AND P.id_subcategoria = ".$id_sub. " AND P.id_division = ".$id_div."
                    					   AND P.id_nombre != ".$id_nom;
								$result=mysql_query($query);
								while($fila=mysql_fetch_array($result)){
									echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
								}
							?>
						</select>
					</td>
					<td>
						<!-- TIPO -->
						<select id="tipos">
							<option value="<?=$id_tipo?>"><?=$nom_tipo?></option>
							<?php
								$sql = "SELECT P.id_tipo, T.nombre_tipo 
					                    FROM productos P INNER JOIN tipos T ON P.id_tipo=T.id_tipo 
					                    WHERE P.id_categoria = ".$id_cat." 
					                     AND P.id_subcategoria = ".$id_sub." 
					                     AND P.id_division = ".$id_div."
					                     AND P.id_nombre = ".$id_nom."
					                     AND P.id_tipo != ".$id_tipo;
								$result=mysql_query($sql);
								while($fila=mysql_fetch_array($result)){
									echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
								}
					 		?>
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
					  	<select id="marcas">
					  		<option value="<?=$id_marc?>"><?=$nom_marc?></option>
							<?php
								$query = "SELECT P.id_marca, M.nombre_marca 
                    					  FROM productos P INNER JOIN marca_productos M ON P.id_marca=M.id_marca 
					                      WHERE P.id_categoria = ".$id_cat." 
					                       AND P.id_subcategoria = ".$id_sub." 
					                       AND P.id_division = ".$id_div."
					                       AND P.id_nombre = ".$id_nom."
					                       AND P.id_tipo = ".$id_tipo."
					                       AND P.id_marca != ".$id_marc;
								$result=mysql_query($query);
								while($fila=mysql_fetch_array($result)){
									echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
								}
							?>
					 	</select>     
					</td>
					<td>	
						<!-- MODELO -->
					    <select id="modelos" class="producto" name='idProducto'>
							<option value="<?=$id_prod?>"><?=$mod?></option>
							<?php
								$query = "SELECT id_producto,modelo FROM productos
					                      WHERE id_categoria = ".$id_cat." 
					                       AND id_subcategoria = ".$id_sub." 
					                       AND id_division = ".$id_div."
					                       AND id_nombre = ".$id_nom."
					                       AND id_tipo = ".$id_tipo."
					                       AND id_marca = ".$id_marc."
					                       AND modelo != '".$mod."';";
								$result = mysql_query($query);
								while ($filas = mysql_fetch_array($result)) {
									echo "<option value='".$filas[0]."'>".$filas[1]."</option>";
								}
							?>
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
					<td colspan="2">
						<!-- NO. SERIE -->
						<div id="inputBoton">
							<input type="text" name="noSerie" maxlength="14" required class="inputOculto mSerie" id="serie" />
							<img src="../../images/barcode-32.png" title="Generar No. Serie Interno" class="bntInterno pointer mt3">
						</div>
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
							<input type="text" class="inputOculto mPImport" id="txt_pi" name="pedidoImportacion" maxlength="35" required value="<?=$pedi?>" />
							<img src="../../images/notapplies-24.png" title="N/A" class="btnPedImport pointer mt6">
						</div>
					</td>
					<td>
						<!-- NÚMERO DE FACTURA COMPRA -->
						<input type="text" name="noFactura" maxlength="12" value="<?=$no_fact?>" />
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
							<option value="<?=$id_est?>"><?=$nom_est?></option>
							<?php
								$consulta=mysql_query("SELECT id_estado,nombre_estado FROM estados WHERE NOT id_estado=".$id_est." ORDER BY nombre_estado");
								if($row=mysql_fetch_array($consulta)){
									do{
										echo'<option value="'.$row["id_estado"].'">'.$row["nombre_estado"].'</option>';
									}while($row=mysql_fetch_array($consulta));
								}
							?>
						</select>
					<td>
						<!-- UBICACIÓN -->
						<select name="idUbicacion" required>
							<option value="<?=$id_ub?>"><?=$nom_ub?></option>
							<?php
								$consulta=mysql_query("SELECT id_ubicacion,nombre_ubicacion FROM ubicaciones WHERE NOT id_ubicacion=".$id_ub." ORDER BY nombre_ubicacion");
								if($row=mysql_fetch_array($consulta)){
									do{
										echo'<option value="'.$row["id_ubicacion"].'">'.$row["nombre_ubicacion"].'</option>';
									}while($row=mysql_fetch_array($consulta));
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
						<input type="text" name="color"  value="<?=$color?>" />
					</td>
				</tr>
			<tr>
			<tr> <td><hr></td> <td><hr></td> </tr>
		</table>
	
		<table>
			<tr>
				<th>Transacción 
					<?php 
						$query = "SELECT id_transaccion FROM transacciones ORDER BY id_transaccion DESC LIMIT 1";
						$result=mysql_query($query);
						while($fila=mysql_fetch_array($result)){
							echo "<input value='",$fila[0]+1,"' type='text' name='idTransaccion' style='width:20px;' readonly />";
						}

						$query = "SELECT id_tipo_transaccion,nombre_tipo_transaccion FROM tipo_transaccion WHERE id_tipo_transaccion = 1;";
						$result=mysql_query($query);
						while($fila=mysql_fetch_array($result))
						{
							$id_tip=$fila[0];
							$nom_tip=$fila[1];
						}
					 ?>
				</th>
			</tr>
			<tr>
						<td align="center"><b>Fecha:</b> <br>	
						<?php date_default_timezone_set('America/Mexico_City') ?>
						<input type="text" name="fecha" value="<?php echo date("d-m-Y H:i:s"); ?>" readonly="readonly" style="width:auto;"></td>
					</tr>

					<tr><td align="center">
					  <label> Tipo transacción:</label><br>
					  <input type="hidden" name="idTipoTransaccion" value="<?=$id_tip?>" readonly />
					  <input type="text" value="<?=$nom_tip?>" readonly />
				</td>
				<td>	
					</tr>
					<tr>
						<td align="center"><b>Descripción:</b><br>
						<textarea name="descripcion" cols="60" rows="5" style="resize:none;"><?=$desc?></textarea>
						</td>
					</tr>
</table>
</center>
		<input type="submit" class="btn primary" value="Guardar" name="Guardar" />
		<a class="btneliminar" href="./">Cancelar</a>
</form>
<div id="divClon"></div>

		</section>
	</section>
</body>
</html>
<script type="text/javascript">
	var $ = jQuery.noConflict();
	// $(document).ready(function(){
		$('#formClon').submit(function(clon) {
			clon.preventDefault();
			$("#divClon").load("guardarclon.php?" + $("#formClon").serialize());
		});

		$('.bntInterno').click(function() {
			var numSerieInterno = 0;
			$.post('generar_noserie_interno.php', {numSerieInterno}, function(obtenerFecha) {
				$('#serie').val(obtenerFecha);
			});
		});

		$('.btnPedImport').click(function(){
			$('#txt_pi').val('N/A');
		});
	// });
</script>