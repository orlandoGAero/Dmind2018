<?php
	session_start();
	// Manejamos en sesión el nombre del usuario que se ha logeado
	if(!isset($_SESSION["usuario"])){
		header("location:../");  
	}
	$_SESSION["usuario"];
	// Termina inicio de sesión

	require('../../class/saldos.php');
	$fnSaldos = new saldos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title>Lista de Saldos</title>
	<link rel="shortcut icon" type="image/x-icon" href="../../images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="../../css/menu.css" >
    <link rel="stylesheet" type="text/css" href="../../css/mensajes.css" />
    <link rel="stylesheet" type="text/css" href="../../css/busqueda.css" />
    <link rel="stylesheet" type="text/css" href="../../css/formularios.css" />
    <link rel="stylesheet" type="text/css" href="../../css/estilos.css">
  	<!-- jQuery -->
    <script type="text/javascript" src="../../js/jquery-1.7.1.min.js" ></script>
    <!-- FancyBox-->
		<!-- CSS --><link rel="stylesheet" type="text/css" href="../../libs/fancyBox/source/jquery.fancybox.css">	
		<!-- JS --><script type="text/javascript" src="../../libs/fancyBox/source/jquery.fancybox.js" ></script>
    <!-- DataTables -->
    	<!-- CSS --><link rel="stylesheet" type="text/css" href="../../libs/dataTables/css/datatables.css">
    	<!-- JS --><script type="text/javascript" src="../../libs/dataTables/js/jquery.dataTables.js" ></script>
    	<!-- JS Filtrar Columnas --><script type="text/javascript" src="../../libs/dataTables/js/dataTables.columnFilter.js" ></script>
    <!-- Jquery UI Calendario -->
		<!-- CSS --><link rel="stylesheet" type="text/css" href="../../libs/jQueryUI/css/jquery-ui.css">
		<!-- JS --><script type="text/javascript" src="../../libs/jQueryUI/js/jquery-ui.js"></script>
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
    	<a href="../">
			<img class="atras" src="../../images/atras.png" title="Regresar">
		</a>Saldos
    </h1>

    <center>
    	<section id="botones">
    		<b><a href="registrar_saldos.php" class="nuevos saldosAdd">Nuevo</a></b>
    	</section>
    	 
    	<div id="lista-saldos">
    		<?php if( $datosSaldos = $fnSaldos -> obtenerDatosSaldos() ) :?>
				<section>
					<div id="tabla-saldos">
						<?php include 'tabla_saldos.php'; ?>
					</div>
				</section>
			<?php else :?>
				<div class="vacio">
					(Sin registros)
				</div>
			<?php endif; ?>
    	</div>
    </center>
</body>
</html>

<script type='text/javascript'>
	// var egresos = jQuery.noConflict();
	$(document).ready(function(){
		$('.saldosAdd').fancybox({
			'scrolling':'auto',
			'autoSize':false,
			'transitionIn':'none',
			'transitionOut':'none',
			'width':950,
			'height':600,
			'type':'ajax'
		});
	});
</script>
