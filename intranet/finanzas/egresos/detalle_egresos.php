<?php
	session_start();
	// Manejamos en sesión el nombre del usuario que se ha logeado
	if(!isset($_SESSION["usuario"])){
		header("location:../");  
	}
	$_SESSION["usuario"];
	// Termina inicio de sesión
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Digital Mind</title>
		<link rel="shortcut icon" type="image/x-icon" href="../../images/favicon.ico" />
		<link rel="stylesheet" type="text/css" media="screen" href="../../css/menu.css"/>
		<link rel="stylesheet" type="text/css" media="screen" href="../../css/formularios.css"/>
		<link rel="stylesheet" type="text/css" media="screen" href="../../css/tabla.css"/>
		<link rel=stylesheet type="text/css" href="../../css/formatocotizacion.css"/>
		<link rel=stylesheet type="text/css" href="../../css/detallecomprobantef.css"/>
		<link rel="stylesheet" type="text/css" href="../../css/detallelista.css"/>
	</head>
	<body>

		<header>
			<img src="../../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
		</header>

		<nav>
			<ul>
				<li><a href="../../Home" alt="Inicio" title="Inicio"><img src="../../images/home.png"/></a></li>
				<li></li>
	            <li></li>
	            <li></li>
	            <li><spam style="color:#fff;"><?php echo $_SESSION["usuario"]; ?></spam></li>
				<li><a href="../../salir.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../../images/lock.png"/></a></li>
			</ul>
		</nav>

		 <h1 style="text-align:center; color:rgba(0,191,255,.9);">
	    	<a href="listar_egresos.php">
				<img class="atras" src="../../images/atras.png" title="Regresar">
			</a>Detalle Egresos
	    </h1>
	    <section id="vistaDetalleE">
	    	<form method="post" target="_self">
	    		<ul>
	    			<li>
	    				<input type="hidden" id="claveEgreso" value="<?=$_REQUEST['egreso']?>" readonly>
			    		<label>Ver detalle como:</label>
			    		<select id="tipoVistaDetEgr">
			    			<option value="factura">Factura</option>
			    			<option value="lista">Lista</option>
			    		</select>
	    			</li>
	    		</ul>
	    	</form>
	    </section>
		<div id="detalle-egreso" align="center">
			<?php include 'detalle_egreso_factura.php' ?>
		</div>
	</body>
</html>
<script type="text/javascript" src="../../js/jquery-2.1.4.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tipoVistaDetEgr').change(function() {
			var tVista = $(this).val(),
				idEgreso = $('#claveEgreso').val();
			if (tVista == 'lista') {
				$('#detalle-egreso').html("<div align='center'><img src='../../images/loader_blue.gif'></div>");
				$.post('detalle_egreso_lista.php', {egreso: idEgreso}).
				done(function(data) {
					$('#detalle-egreso').html(data);
				});
			} else if(tVista == 'factura'){
				$('#detalle-egreso').html("<div align='center'><img src='../../images/loader_blue.gif'></div>");
				$.post('detalle_egreso_factura.php', {egreso: idEgreso}).
				done(function(data) {
					$('#detalle-egreso').html(data);
				});
			}
		});
	});
</script>