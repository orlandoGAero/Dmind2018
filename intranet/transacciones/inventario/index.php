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
	    <section id="botones">
		    <a href="agregar_inv.php" class="nuevo fancyAdd"><b class="nuevos">Nuevo</b></a>
		     <a href="../venta"><b class="btnVentas">Ventas</b></a>
		</section>   
		<div id="tb_inv">
			<?php if(isset($_GET['n']) && isset($_GET['m'])): ?>
				<?php
					require ('classInventario.php');
					$funInv = new Inventario(); 
				?>
				<?php include 'tabla_inv_filtrada.php'; ?>
			<?php else: ?>
				<?php include 'tabla_inv.php'; ?>
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
</script>