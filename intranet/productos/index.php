<?php
session_start();
//manejamos en sesion el nombre del usuario que se ha logeado
if (!isset($_SESSION["usuario"])){
    header("location:../");  
}
$_SESSION["usuario"];
//termina inicio de sesion
?>
<?php include("../conexion.php") ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title>Productos</title>
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
	<link rel="stylesheet" href="../css/estilos.css" />
	<link rel="stylesheet" href="../css/menu.css" />
	<link rel="stylesheet" href="../css/tabla.css" />
	<link rel="stylesheet" href="../css/formularios.css" />
	<link rel="stylesheet" href="../css/mensajes.css" />
	<link rel="stylesheet" type="text/css" href="../css/busqueda.css" />
	<!-- jQuery -->
    <script type="text/javascript" src="../js/jquery-1.7.1.min.js" ></script>
	<!-- FancyBox-->
	<!-- CSS --><link rel="stylesheet" type="text/css" href="../libs/fancyBox/source/jquery.fancybox.css">
	<!-- JS --><script type="text/javascript" src="../libs/fancyBox/source/jquery.fancybox.js" ></script>
	<!-- DataTables -->
    <!-- CSS --><link rel="stylesheet" type="text/css" href="../libs/dataTables/css/datatables.css">
    <!-- JS --><script type="text/javascript" src="../libs/dataTables/js/jquery.dataTables.js" ></script>
    <!-- JS Filtrar Columnas --><script type="text/javascript" src="../libs/dataTables/js/dataTables.columnFilter.js" ></script>
</head>

<body>
<?php include ("../menu.php"); ?>
<h1 style="text-align:center;">
	<a href="../Home"><img class="atras" src="../images/atras.png" alt="Atras"></a> Productos
</h1>
<center>
	<form action="buscar.php">
		<label class="labelSearch">Buscar:</label>
		<input name="buscar" type="text" id="nameSearch" placeholder="Nombre del producto" title="Ingresa nombre del producto">
	</form>
	
	<section id="botones">
	    <a href="registrar_producto.php" class="addProducto"><b class="nuevos">Nuevo</b></a>
	    <a href="../transacciones/inventario"><b class="btnInventory">Inventario</b></a>
	</section> 
	<div id="tablaProductos">
		<?php include 'lista_productos.php' ?>
	</div>
</center>

<script type="text/javascript">
	var iprod = jQuery.noConflict();
	iprod(document).ready(function(){
		iprod('.addProducto').fancybox({
			'autoSize':false,
			'transitionIn':'none',
			'transitionOut':'none',
			'width':590,
			'height':600,
			'type':'ajax'
		});
	iprod('#nameSearch').keyup(function() {
		var nameProd = iprod('#nameSearch').val();
		iprod.post('buscar.php', {nombrePro: nameProd}, function(data) {
			iprod('#tablaProductos').html(data);
		});
	});
	});
</script>

</body>
</html>