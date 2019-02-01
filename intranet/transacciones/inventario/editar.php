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
  <title>Digital Mind</title>
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
			</a>Editando Producto Inventariado
		</h1>
		<section id="principal">
			<?php
				include("../../conexion.php");
				require_once("../../libs/encrypt_decrypt_strings_urls.php");
				$id_inv= decrypt(htmlspecialchars($_GET["product"]),"intranetdminventario");
				$query="SELECT 
						  I.no_serie,
						  I.no_factura,
						  I.pedido_de_importacion,
						  I.id_estado,
						  E.nombre_estado,
						  I.id_ubicacion,
						  U.nombre_ubicacion,
						  I.color,
						  P.nom_proveedor,
						  PRO.modelo,
						  T.id_transaccion,
						  C.nombre_categoria,
						  S.nombre_subcategoria,
						  D.nombre_division,
						  N.nombre,
						  TIP.nombre_tipo,
						  M.nombre_marca
						FROM
						  transacciones T 
						  INNER JOIN inventario I 
						    ON T.id_inventario = I.id_inventario 
						  INNER JOIN proveedores P 
						    ON I.id_proveedor = P.id_proveedor 
						  INNER JOIN ubicaciones U 
						    ON I.id_ubicacion = U.id_ubicacion 
						  INNER JOIN productos PRO 
						    ON I.id_producto = PRO.id_producto 
						  INNER JOIN categorias C 
						    ON PRO.id_categoria = C.id_categoria 
						  INNER JOIN subcategorias S 
						    ON PRO.id_subcategoria = S.id_subcategoria
						  INNER JOIN division D
						    ON PRO.id_division = D.id_division 
						  INNER JOIN nombres N
						    ON PRO.id_nombre = N.id_nombre
						  INNER JOIN tipos TIP
						    ON PRO.id_tipo = TIP.id_tipo
						  INNER JOIN marca_productos M
						    ON PRO.id_marca = M.id_marca
						  INNER JOIN estados E 
						    ON I.id_estado = E.id_estado 
						WHERE T.id_tipo_transaccion = 1 
						  AND I.id_inventario = '$id_inv';";
				$result=mysql_query($query);
				while($fila=mysql_fetch_array($result)){
					$nom_prov=$fila["nom_proveedor"];
					$nom_cat=$fila["nombre_categoria"];
					$nom_sub=$fila["nombre_subcategoria"];
					$nom_div=$fila["nombre_division"];
					$nom_prod=$fila["nombre"];
					$nom_tipo=$fila["nombre_tipo"];
					$nom_marc=$fila["nombre_marca"];
					$mod=$fila["modelo"];
					$no_ser=$fila["no_serie"];
					$no_fact=$fila["no_factura"];
					$pedi=$fila["pedido_de_importacion"];
					$color=$fila["color"];
					$id_ub=$fila["id_ubicacion"];
					$nom_ub=$fila["nombre_ubicacion"];
					$id_est=$fila["id_estado"];
					$nom_est=$fila["nombre_estado"];
					$id_trans=$fila["id_transaccion"];
				}
			?>
		
			<form action="" method="POST" id="formEditInv" target="_self" style="background:rgba(255,255,255,.95);heigth:600px; width:500px; padding:20px; border-radius:10px;">
				<input type="hidden" name="idInventario" value="<?=$id_inv?>" readonly>
				<center>
					<table>
						<tr>
							<td>
								<label>Proveedor:</label>
							</td>
							<td>
								<label>Status:</label>
							</td>
						</tr>
						<tr>
							<td width="247px">
								<!-- PROVEEDOR -->
								<input type="text" value="<?=$nom_prov?>" readonly>
							</td>
							<td>
								<!-- STATUS -->
								<?php
									$consulta=mysql_query("SELECT nombre_status FROM status_inventario where nombre_status = 'inventariado'");
									$fila=mysql_fetch_array($consulta);
								?>
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
							  	<input type="text" value="<?=$nom_cat?>" readonly>
							</td>
							<td>	
								<label>Subcategoría:</label>
								<input type="text" value="<?=$nom_sub?>" readonly>
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
								<input type="text" value="<?=$nom_div?>" readonly>
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
								<input type="text" value="<?=$nom_prod?>" readonly>
							</td>
							<td>
								<!-- TIPO -->
								<input type="text" value="<?=$nom_tipo?>" readonly>
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
								<input type="text" value="<?=$nom_marc?>" readonly>
							</td>
							<td>	
								<!-- MODELO -->
							    <input type="text" value="<?=$mod?>" readonly>
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
								<input type="text" value="<?=$no_ser?>" readonly>
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
									<input type="text" name="pedidoImportacion" value="<?php echo $pedi ?>" maxlength="35" class="inputOculto mPImport" id="txt_pi" required/>
									<img src="../../images/notapplies-24.png" title="N/A" class="btnPedImport pointer mt6">
								</div>
							</td>
							<td>
								<!-- NÚMERO DE FACTURA COMPRA -->
								<input type="text" name="noFactura" value="<?php echo $no_fact ?>" maxlength="12" style="height:27px;"/>
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
									<option value="<?php echo $id_est ?>"><?php echo $nom_est ?></option>
									<?php
										$consulta=mysql_query("SELECT id_estado,nombre_estado FROM estados WHERE NOT id_estado=".$id_est." ORDER BY nombre_estado;");
										if($row=mysql_fetch_array($consulta)){
											do{
												echo'<option value="'.$row["id_estado"].'">'.$row["nombre_estado"].'</option>';
											}
											while($row=mysql_fetch_array($consulta));
										}
									?>
								</select>
							<td>
								<!-- UBICACIÓN -->
								<select name="idUbicacion" required>
									<option value="<?php echo $id_ub ?>"><?php echo $nom_ub ?></option>
									<?php
										$consulta=mysql_query("SELECT id_ubicacion,nombre_ubicacion FROM ubicaciones WHERE NOT id_ubicacion=".$id_ub." ORDER BY nombre_ubicacion ;");
										if($row=mysql_fetch_array($consulta)){
											do{
												echo'<option value="'.$row["id_ubicacion"].'">'.$row["nombre_ubicacion"].'</option>';
											}
											while($row=mysql_fetch_array($consulta));
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
								<input type="text" value="<?=$color?>" readonly>
							</td>
						</tr>
						<tr> <td><hr></td> <td><hr></td> </tr>
					</table>
				
					<table>
						<tr>
							<th>Transacción
								<?php 
									$query = "SELECT id_transaccion,fecha_alta,O.id_tipo_transaccion,nombre_tipo_transaccion,descripcion FROM transacciones T 
											  INNER JOIN tipo_transaccion O on T.id_tipo_transaccion=O.id_tipo_transaccion 
											  where T.id_transaccion=$id_trans";
									$result=mysql_query($query);
									while($fila=mysql_fetch_array($result)){
										echo "<input value='",$fila[0],"' type='text' name='idTransaccion' style='width:20px;' readonly='readonly'/>";
										$fecha=$fila[1];
										$id_tip=$fila[2];
										$nom_tip=$fila[3];
										$desc=$fila[4];
									}
								 ?>
							</th>
						</tr>
						<tr>
							<td align="center">
								<b>Fecha:</b> <br>	
								<?php $fechaTrans = date_format(date_create($fecha),'d-m-Y H:i:s'); ?>
								<input type="text" value="<?php echo $fechaTrans ?>" readonly="readonly" style="width:150px;">
							</td>
						</tr>

						<tr>
							<td align="center">
								<label> Tipo transacción:</label><br>
								<input type="text" value="<?=$nom_tip?>" readonly />
							</td>
						</tr>
						<tr>
							<td align="center"><b>Nota:</b><br>
								<textarea name="descripcion" cols="60" rows="5" style="resize:none;"><?php echo $desc; ?></textarea>
							</td>
						</tr>
					</table>
				</center>
				<input type="submit" class="btn primary" value="Modificar" name="Modificar" />
				<a class="btneliminar" href="./">Cancelar</a>
			</form>
			<div id="editarInv"></div>
		</section>
	</section>
</body>
</html>
<script type="text/javascript">
	var $ = jQuery.noConflict();
	$(document).ready(function(){
		$('#formEditInv').submit(function(editar) {
			editar.preventDefault();
			$("#editarInv").load("actualizar.php?" + $("#formEditInv").serialize());
		});

		$('.btnPedImport').click(function(){
			$('#txt_pi').val('N/A');
		});
	});
</script>
