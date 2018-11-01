<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Digital Mind</title>
  <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
	<link rel="stylesheet" href="../css/estilos.css" />
	<link rel="stylesheet" href="../../css/menu.css" />
	<link rel="stylesheet" href="../../css/formularios.css" />
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
			<a href="./"><li><img src="../../images/volver.png" alt="">Atras</li></a><li></li><li></li><li></li>
			<li><a href="../../salir.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../../images/lock.png"/></a></li>
		</ul>
	</nav>

	<section id="contenido">
		<section id="principal">
<?php
include("../../conexion.php");
$id_inv=$_GET["id_inv"]; 
$query="SELECT I.id_inventario,I.id_estado,I.no_serie,I.no_factura,I.pedido_de_importacion,
		I.id_estado,E.nombre_estado,I.id_ubicacion,U.nombre_ubicacion,I.color,P.id_proveedor,P.nom_proveedor,
		I.id_producto,D.modelo, T.id_transaccion,T.fecha,T.id_operacion,T.id_tipo_transaccion,
		Y.nombre_tipo_transaccion,T.descripcion,C.id_categoria,D.id_marca,D.id_categoria,C.nombre_categoria,D.id_subcategoria,
		S.nombre_subcategoria,D.id_tipo,D.id_nombre,D.modelo FROM transacciones T 
		INNER JOIN inventario I on T.id_operacion=I.id_inventario 
		INNER JOIN proveedores P on I.id_proveedor=P.id_proveedor
		INNER JOIN ubicaciones U on I.id_ubicacion=U.id_ubicacion  
		INNER JOIN productos D on I.id_producto=D.id_producto 
		INNER JOIN categorias C on D.id_categoria=C.id_categoria 
		INNER JOIN subcategorias S on D.id_subcategoria=S.id_subcategoria 
		INNER JOIN tipo_transaccion Y on T.id_tipo_transaccion=Y.id_tipo_transaccion 
		INNER JOIN estados E on I.id_estado=E.id_estado
  		WHERE T.id_tipo_transaccion=1 and I.id_inventario='$id_inv'";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
$id_prov=$fila["id_proveedor"];
$nom_prov=$fila["nom_proveedor"];
$id_cat=$fila["id_categoria"];
$nom_cat=$fila["nombre_categoria"];
$id_sub=$fila["id_subcategoria"];
$nom_sub=$fila["nombre_subcategoria"];
$id_tipo=$fila["id_tipo"];

$id_nom=$fila["id_nombre"];

$id_marc=$fila["id_marca"];
$id_prod=$fila["id_producto"];
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
<h1>Editando Producto Inventariado</h1>
<form action="actualizar.php" style="background:rgba(255,255,255,.95);heigth:600px;width:500px; padding:20px;border-radius:10px;">
<center>
<input type="hidden" name="id_inventario" value="<?php echo $_GET["id_inv"]; ?>">
	<table class="editar">
		<tr><td>Proveedor <br>
		<select name="id_proveedor">
		<option value="<?php echo $id_prov ?>"><?php echo $nom_prov ?></option>
			<?php
					$consulta="SELECT * FROM proveedores where not id_proveedor=$id_prov";
					$result=mysql_query($consulta);
					while($fila=mysql_fetch_array($result))
					{
						echo "<option value='",$fila["id_proveedor"],"'>",$fila["nom_proveedor"],"</option>";
					}
			?>
			</select>
			</td>
			<td align="center"><b>Status:</b> <br>
					<select name="id_status" style="width:120px;appearance: none;-moz-appearance: none;-o-appearance: none;">
					<?php
						$consulta=mysql_query("SELECT * FROM status where id_status=4");
						if($fila=mysql_fetch_array($consulta)){
							do{
								echo'<option value="'.$fila["id_status"].'">'.$fila["nombre_status"].'</option>';
							}
							while($fila=mysql_fetch_array($consulta));
						echo '</select>';
						}
					?></td></tr>
				<tr><td>
					<hr>
				</td>
				<td>
					<hr>
				</td></tr>
					<tr><td><b style>Producto</b></td></tr>
			<tr><td>
					  <label> Categoria:</label>
			    
			<select id="categoria">
			<option value="<?php echo $id_cat ?>"><?php echo $nom_cat ?></option>
			<?php 
			$query = "SELECT id_categoria, nombre_categoria FROM categorias where not id_categoria=$id_cat";
			$result=mysql_query($query);
			while($fila=mysql_fetch_array($result))
			{
				echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
			}
			 ?>
					</select>
				</td>
				<td>	
					  <label> Subcategoria:</label>
					<select id="subcategoria">
			<?php
			$query = "SELECT id_subcategoria, nombre_subcategoria FROM subcategorias where id_subcategoria=$id_sub";
			$result=mysql_query($query);
			while($fila=mysql_fetch_array($result))
			{
				echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
			}
			$query = "SELECT id_subcategoria, nombre_subcategoria FROM subcategorias where not id_subcategoria=$id_sub";
			$result=mysql_query($query);
			while($fila=mysql_fetch_array($result))
			{
				echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
			}
			 ?>
					</select>
			</td></tr>
<tr>
	<td><label>División:</label>
	<select id="divisiones">
			<?php 
			$query = "SELECT D.id_division, nombre_division FROM productos P
					  inner join division D on P.id_division=D.id_division
					  where id_producto=$id_prod";
			$result=mysql_query($query);
			while($fila=mysql_fetch_array($result))
			{
				echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
			}
			 ?>
	</select>
	</td>
</tr>
			<tr><td style="color:transparent;">'</td></tr>
			<tr><td>	
					<label>Nombre:</label>
					<select id="nombres">
			<?php
			$query = "SELECT id_nombre, nombre FROM nombres where id_nombre=$id_nom";
			$result=mysql_query($query);
			while($fila=mysql_fetch_array($result))
			{
				echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
			}
			$query = "SELECT id_nombre, nombre FROM nombres where not id_nombre=$id_nom and id_marca=$id_marc";
			$result=mysql_query($query);
			while($fila=mysql_fetch_array($result))
			{
				echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
			}
			 ?>
					
					</select>
			</td>
			<td>
					<label>Tipo:</label><br>
					<select id="tipos">
					<option value="0">Elija</option>
					</select>

			</td></tr>
			<tr><td style="color:transparent">'</td></tr>
			<tr>
			<td>
					  <label>Marca:</label><br>
					  <select id="marcas">
			<?php
			$query = "SELECT distinct P.id_marca, M.nombre_marca FROM productos P 
					inner join marcas M on P.id_marca=M.id_marca where id_producto=$id_prod";
			$result=mysql_query($query);
			while($fila=mysql_fetch_array($result))
			{
				echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
				$nomarc=$fila[0];
			}
			$query = "SELECT distinct id_marca, nombre_marca FROM marcas where id_categoria=$id_cat and not id_marca=$nomarc";
			$result=mysql_query($query);
			while($fila=mysql_fetch_array($result))
			{
				echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
			}
			 ?>
					  </select>     
			</td>
			<td>	
					  <label>Modelo:</label><br>
					     <select id="modelos" class="producto" name='id_producto'>
						<option value="<?php echo $id_prod; ?>"><?php echo $mod; ?></option>
					    </select>

			</td></tr>
			<tr>
				<td><b>No. Serie:</b>
				<input type="text" name="no_serie" value="<?php echo $no_ser; ?>" />
				</td>
			</tr>
			<tr>
				<td><b>Pedido de importacion:</b><br>
				<input type="text" name="pedido_de_importacion" value="<?php echo $pedi ?>" />
				</td>
				<td><b>Numero de factura compra:</b><br>
				<input type="text" name="no_factura" value="<?php echo $no_fact ?>" />
				</td>
			</tr>
					<tr><td><br>Estado:
					<select name="id_estado">
					<option value="<?php echo $id_est ?>"><?php echo $nom_est ?></option>
					<?php
						$consulta=mysql_query("SELECT * FROM estados where not id_estado=$id_est");
						if($row=mysql_fetch_array($consulta)){
							do{
								echo'<option value="'.$row["id_estado"].'">'.$row["nombre_estado"].'</option>';
							}
							while($row=mysql_fetch_array($consulta));
						}
					?>
					</select>
					<td><b>Ubicacion</b>
					<select name="id_ubicacion">
					<option value="<?php echo $id_ub ?>"><?php echo $nom_ub ?></option>
					<?php
						$consulta=mysql_query("SELECT * FROM ubicaciones where not id_ubicacion=$id_ub");
						if($row=mysql_fetch_array($consulta)){
							do{
								echo'<option value="'.$row["id_ubicacion"].'">'.$row["nombre_ubicacion"].'</option>';
							}
							while($row=mysql_fetch_array($consulta));
						}

					?>
					</select>
					</td></tr>
					<tr><td><br>Color:<input type="text" name="color" value="<?php echo $color ?>" /></td></tr>
					<tr><td>
	<hr>
</td>
<td>
	<hr>
</td></tr>
				</table>
<table>
					<tr><th>Transacción 
<?php 

			$query = "SELECT id_transaccion,fecha,O.id_tipo_transaccion,nombre_tipo_transaccion,descripcion FROM transacciones T 
					  INNER JOIN tipo_transaccion O on T.id_tipo_transaccion=O.id_tipo_transaccion 
					  where T.id_transaccion=$id_trans";
			$result=mysql_query($query);
			while($fila=mysql_fetch_array($result))
			{
				echo "<input value='",$fila[0],"' type='text' name='id_transaccion' style='width:20px;' readonly='readonly'/>";
				$fecha=$fila[1];
				$id_tip=$fila[2];
				$nom_tip=$fila[3];
				$desc=$fila[4];
			}
 ?>
					</th></tr>
					<tr>
						<td align="center"><b>Nombre de transaccion</b> <br>	
						<select name="nom_trans" style="width:110px;appearance: none;-moz-appearance: none;-o-appearance: none;">
							<option value="<?php echo $id_tip ?>"><?php echo $nom_tip ?></option>
						</select>
					</tr>
					<tr>
						<td align="center"><b>Fecha:</b> <br>	
						<input type="text" name="fecha" value="<?php echo $fecha ?>" readonly="readonly" style="width:80px;"></td>
					</tr>

					<tr><td align="center">
					  <label> Tipo transacción:</label><br>
			    
					<select name="id_tipo_transaccion" style="width:110px;appearance: none;-moz-appearance: none;-o-appearance: none;">
					
					<option value="<?php echo $id_tip ?>"><?php echo $nom_tip; ?></option>
			<?php 
			$query = "SELECT distinct I.id_tipo_transaccion,nombre_tipo_transaccion FROM transacciones I 
					  INNER JOIN tipo_transaccion T on I.id_tipo_transaccion=T.id_tipo_transaccion where not I.id_tipo_transaccion=$id_tip";
			$result=mysql_query($query);
			while($fila=mysql_fetch_array($result))
			{
				echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
			}
			 ?>
					</select>
				</td>
				<td>	
					</tr>
					<tr>
						<td align="center"><b>Descripcion:</b><br>
						<textarea name="descripcion" cols="60" rows="5" style="resize:none;"><?php echo $desc; ?></textarea>
						</td>
					</tr>
</table>
</center>
		<input type="submit" class="btn primary" value="Guardar" name="Guardar" />
		<a class="btneliminar" href="./">Cancelar</a>
</form>

		</section>
	</section>
</body>
</html>