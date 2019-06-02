<?php
	session_start();
	// Manejamos en sesión el nombre del usuario que se ha logeado
	if(!isset($_SESSION["usuario"])){
		header("location:../");  
	}
	$_SESSION["usuario"];
	// Termina inicio de sesión

	include_once('../../class/ingresos.php');
	$classIngresos = new ingresos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title>Lista de Ingresos</title>
	<link rel="shortcut icon" type="image/x-icon" href="../../images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="../../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../../css/mensajes.css">
    <link rel="stylesheet" type="text/css" href="../../css/busqueda.css">
    <link rel="stylesheet" type="text/css" href="../../css/formularios.css">
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
		</a>Ingresos
    </h1>

    <div style="margin-left: 12.5%">
        <form id="formBuscar">
            <input type="text" name="txt_fechaEg" placeholder="Fecha" onClick="(this.type='date')" onMouseOut="(this.type='text')" id="date" class="form-control">
            <input type="text" name="txt_rfcEg" placeholder="RFC Emisor">
            <input type="text" name="txt_raSoEg" placeholder="Razón Social Emisor">
            <input type="text" name="txt_serieEg" placeholder="Serie">
            <input type="text" name="txt_folioEg" placeholder="Folio">
            <input type="number" name="txt_subEg" placeholder="Subtotal">
            <input type="number" name="txt_ivaEg" placeholder="IVA">
            <input type="number" name="txt_totalEg" placeholder="Total">
            <input type="text" name="txt_metPaEg" placeholder="Método de Pago">
            <input type="text" name="txt_fePaEg" placeholder="Fecha de Pago" onMouseOver="(this.type='date')" onMouseOut="(this.type='text')" id="date" class="form-control">
            <input type="text" name="txt_cuentaEg" placeholder="Cuenta">
            <input type="text" name="txt_concepEg" placeholder="Concepto">
            <input type="text" name="txt_clasifEg" placeholder="Clasificación">
            <input type="text" name="txt_statusEg" placeholder="Status">
            <input type="submit" class="btnBuscar" value="Buscar"/>
            <input type="reset" value="Limpiar" class="btn">
        </form>
    </div>
    <center>

    	<section id="botones">
            <button type="button" class="btnMostrarAll" id="mostrarTodoI">Mostrar ingresos</button>
    		<a href="registrar_ingresos.php" class="ingresosAdd">
    			<b class="nuevos">Nuevo</b>
    		</a>
    		<a class="cargarVarios">
				<b class="nuevos">Cargar Varios XML</b>
			</a>
    	</section>
    	 
    	<div id="lista_ingresos" style="margin-top: 50px">
            <div id="cargando-res"></div>
    	</div>
        <div id="mensajes"></div>

    </center>
    <!-- Div para ventanas modal -->
    <div class="modal-egresos" id="modalVariosXml">
    	<div id="contenidoVariosXml"></div>
    </div>
    <div id="fondoIn" class="overlay"></div>
	<script src="js/index.js"></script>
</body>
</html>
