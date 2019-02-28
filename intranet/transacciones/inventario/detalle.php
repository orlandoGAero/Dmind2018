<?php
	session_start();
	//manejamos en sesion el nombre del usuario que se ha logeado
	if (!isset($_SESSION["usuario"])){
	    header("location:../");  
	}
	$_SESSION["usuario"];
	//termina inicio de sesion
?>
<?php  include ("../../conexion.php"); ?>
<?php require_once("../../libs/encrypt_decrypt_strings_urls.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Digital Mind</title>
  <link rel="shortcut icon" type="image/x-icon" href="../../images/favicon.ico" />
	<link rel="stylesheet" href="../../css/estilos.css" />
	<link rel="stylesheet" href="../../css/menu.css" />
	<link rel="stylesheet" href="../../css/tabla.css" />
	<link rel="stylesheet" href="../../css/formularios.css" media="screen" />
	<style type="text/css">
	table tr{
	text-align: justify;
	}
	table th{
		font-weight: bold;
	}

	table td{
		padding: 4px;
	}
	</style>
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
			</a>Detalle Inventario
		</h1><br />
		<section id="principal">

<?php
$id_inv= decrypt(htmlspecialchars($_GET["product"]),"intranetdminventario");
$query="SELECT I.id_inventario,nom_proveedor,nombre,modelo,no_factura,no_serie,pedido_de_importacion,nombre_estado,nombre_status,color,nombre_ubicacion,
  		  T.id_transaccion,T.fecha_alta,T.id_tipo_transaccion,Y.nombre_tipo_transaccion,T.descripcion FROM transacciones T 
  		  INNER JOIN inventario I ON T.id_inventario=I.id_inventario 
  		  INNER JOIN proveedores P ON I.id_proveedor=P.id_proveedor 
  		  INNER JOIN productos D ON I.id_producto=D.id_producto 
  		  INNER JOIN nombres N ON D.id_nombre=N.id_nombre 
  		  INNER JOIN estados E ON I.id_estado=E.id_estado 
  		  INNER JOIN status_inventario S ON I.id_status=S.id_status 
  		  INNER JOIN ubicaciones U ON I.id_ubicacion=U.id_ubicacion
  		  INNER JOIN tipo_transaccion Y ON T.id_tipo_transaccion=Y.id_tipo_transaccion  
  		  WHERE I.id_inventario='$id_inv'";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
?>

<form action="actualizar.php" style="background:#fff;padding:10px;border-radius:7px;">
	<table class="detalle">
		<tr><th>Proveedor</th><td><?php echo $fila["1"]; ?></td></tr>
		<tr><th>Producto</th><td><?php echo $fila["2"]; ?>-<?php echo $fila["3"] ?></td></tr>
		<tr><th>Transacción</th><td><?php echo $fila["nombre_tipo_transaccion"]; ?></td></tr>
		<tr><th>No. Serie</th><td><?php echo $fila["no_serie"]; ?></td></tr>
		<tr><th>Pedido Importación</th><td><?php echo $fila["pedido_de_importacion"]; ?></td></tr>
		<tr><th>No. Factura Compra</th><td><?php echo $fila["no_factura"]; ?></td></tr>
		<tr><th>Estado</th><td><?php echo $fila["nombre_estado"]; ?></td></tr>
		<tr><th>Status</th><td><?php echo $fila["nombre_status"]; ?></td></tr>
		<tr><th>Ubicación</th><td><?php echo $fila["nombre_ubicacion"]; ?></td></tr>
		<tr><th>Color</th><td><?php echo $fila["color"]; ?></td></tr>
		<tr><th>Nota</th><td><?php echo $fila["descripcion"]; ?></td></tr>
	</table>
	<a href="./" class="btn primary">Salir</a>
</form>
<?php }?>

		</section>
	</section>
</body>
</html>