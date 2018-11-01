<?php
	session_start();
	//manejamos en sesion el nombre del usuario que se ha logeado
	if (!isset($_SESSION["usuario"])){
	    header("location:../");  
	}
	$_SESSION["usuario"];
	//termina inicio de sesion
	include 'classProveedores.php';
	$fnProv = new Proveedores();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Digital Mind</title>
  <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="../css/estilos.css" />
	<link rel="stylesheet" type="text/css" href="../css/mensajes.css" />
	<link rel="stylesheet" type="text/css" href="../css/menu.css" />
	<link rel="stylesheet" type="text/css" href="../css/formularios.css" />
	<link rel="stylesheet" type="text/css" href="../libs/dataTables/css/datatables.css">
	<link rel="stylesheet" type="text/css" href="../libs/fancyBox/source/jquery.fancybox.css">
	<!-- Jquery UI -->
	<link rel="stylesheet" type="text/css" href="../libs/jQueryUI/css/jquery-ui.css">
</head>

<body>
	<?php include ("../menu.php"); ?>
	<h1 style="text-align:center; color:rgba(0,191,255,.9);">
    	<a href="../home">
			<img class="atras" src="../images/atras.png" alt="Regresar" title="Regresar">
		</a> Proveedores
    </h1>

	<section id="contenido">
		<section id="botones">
			<b><a href="agregar_proveedor.php" class="nuevos provAdd">Nuevo</a></b>
		</section>		
		<center>
			<div id="lista-proveedores">
				<?php include 'listar_proveedores.php' ?>
			</div>
		</center>
	</section>
	<!-- <script type="text/javascript" src="../js/configuracion.js"></script> -->
	<!-- *** FancyBox funciona con jquery v1.7.1 *** -->
	<script type="text/javascript">
		$(document).ready(function() {
		    // FancyBox (Ventana Flotante)
			$('.provAdd').fancybox({
				'scrolling':'auto',
				'autoSize':false,
				'transitionIn':'none',
				'transitionOut':'none',
				'width':700,
				'height':600,
				'type':'ajax'
			});
		});
	</script>
</body>
</html>