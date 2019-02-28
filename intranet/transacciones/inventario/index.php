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
		<title>Inventario</title>
		<!-- CSS -->
		<link rel="shortcut icon" type="image/x-icon" href="../../images/favicon.ico" />
		<link rel="stylesheet" href="../../css/estilos.css" />
		<link rel="stylesheet" href="../../css/menu.css" />
		<link rel="stylesheet" href="../../css/tabla.css" />
		<link rel="stylesheet" href="../../css/mensajes.css" />
		<link rel="stylesheet" href="../../css/formularios.css" />
		<link rel="stylesheet" type="text/css" href="../../css/busqueda.css" />
		<!-- jQuery -->
	    <script src="../../js/jquery-2.1.4.js"></script>
	    <script src="../../js/jquery-1.7.1.min.js" ></script>
		<!-- FancyBox-->
			<!-- CSS --><link rel="stylesheet" type="text/css" href="../../libs/fancyBox/source/jquery.fancybox.css">	
			<!-- JS --><script type="text/javascript" src="../../libs/fancyBox/source/jquery.fancybox.js" ></script>
		<!-- DataTables -->
		    <!-- CSS --><link rel="stylesheet" type="text/css" href="../../libs/dataTables/css/datatables.css">
		    <!-- JS --><script type="text/javascript" src="../../libs/dataTables/js/jquery.dataTables.js" ></script>
		    <!-- JS Filtrar Columnas --><script type="text/javascript" src="../../libs/dataTables/js/dataTables.columnFilter.js" ></script>
	</head>
	<body>
		<header>
			<img src="../../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
		</header>
		<nav>
			<ul>
				<li><a href="../../Home" alt="Inicio" title="Inicio"><img src="../../images/home.png"/></a></li>
				<li></li><li></li><li></li>
				<li><spam style="color:#fff;"><?php echo $_SESSION["usuario"]; ?></spam></li>
				<li><a href="../../salir.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../../images/lock.png"/></a></li>
			</ul>
		</nav>
		
		<center>
			<h1 style="text-align:center;"><a href="../">
			<img class="atras" src="../../images/atras.png" alt="Atras"></a> Inventario</h1>
		</center>

		<div style="margin-left: 12.5%">
    		<form action="" id="formBuscar">
    			<input type="text" name="txt_provInv" placeholder="Proveedor">
    			<input type="text" name="txt_prodInv" placeholder="Producto">
    			<input type="text" name="txt_tipoInv" placeholder="Tipo">
    			<input type="text" name="txt_marInv" placeholder="Marca">
    			<input type="text" name="txt_noSeInv" placeholder="No Serie">
    			<input type="text" name="txt_facInv" placeholder="Factura / Compra">
    			<input type="text" name="txt_estInv" placeholder="Estado">
    			<input type="text" name="txt_staInv" placeholder="Status">
    			<input type="text" name="txt_ubiInv" placeholder="Ubicación">
    			<input type="submit" class="btnBuscar" value="Buscar"/>
    		</form>
    	</div>

	    <section id="botones">
	    	<button type="button" class="btnMostrarAll" id="mostrarTodo">Mostrar Inventario</button>
		    <a href="agregar_inv.php" class="nuevo fancyAdd"><b class="nuevos">Nuevo</b></a>
		     <a href="../venta"><b class="btnVentas">Ventas</b></a>
		</section> 

		<div id="tb_inv" style="margin-top: 50px">
			<div id="cargando-res"></div>
			<?php if(isset($_GET['n']) && isset($_GET['m'])): ?>
				<?php
					require ('classInventario.php');
					$funInv = new Inventario(); 
				?>
				<?php include 'tabla_inv_filtrada.php'; ?>
			<?php endif; ?>
		</div>
	</body>
</html>
<script type="text/javascript">
	var modInv = jQuery.noConflict();
	modInv(document).ready(function(){
		modInv('.fancyAdd').fancybox({
			'autoSize':false,
			'transitionIn':'none',
			'transitionOut':'none',
			'width':580,
			'height':1100,
			'type':'ajax'
		});
	});

	modInv("#mostrarTodo").click(function() {
		modInv("#cargando-res").html("<center><img src='../../images/esperando.svg' width='450' height='30' /></center>");
		modInv.ajax({
			url: 'tabla_inv.php',
			type: 'post',
			dataType: 'html'
		})
		.done(function(res) {
			modInv("#tb_inv").html(res);
		})
	});

	modInv("#formBuscar").submit(function(e) {
		modInv("#cargando-res").html("<center><img src='../../images/esperando.svg' /></center>")
		e.preventDefault();
		modInv.ajax({
			url: 'busquedad_filtrada.php',
			type: 'post',
			dataType: 'html',
			data: modInv("#formBuscar").serialize(),
		})
		.done(function(res) {
			modInv("#tb_inv").html(res);
		})
	});
</script>