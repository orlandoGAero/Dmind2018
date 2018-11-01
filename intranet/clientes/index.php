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
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
	<link rel="stylesheet" href="../css/menu.css" />
	<link rel="stylesheet" href="../css/tabla.css" />
	<link rel="stylesheet" href="../css/formularios.css" />
	<link rel="stylesheet" href="../css/mensajes.css" />
	<link rel="stylesheet" type="text/css" href="../css/busqueda.css" />
	<script type="text/javascript" src="../js/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="../js/configuracion.js"></script>
	 <!-- DataTables -->
    	<!-- CSS --><link rel="stylesheet" type="text/css" href="../libs/dataTables/css/datatables.css">
    	<!-- JS --><script type="text/javascript" src="../libs/dataTables/js/jquery.dataTables.js" ></script>
    	<!-- JS Filtrar Columnas --><script type="text/javascript" src="../libs/dataTables/js/dataTables.columnFilter.js" ></script>
</head>
<body>
	<?php include ("../menu.php") ?>
	<h1 style="text-align:center;">
		<a href="../Home"><img class="atras" src="../images/atras.png" alt="Atras"></a> Clientes
	</h1>
	<section id="contenido">
		<form action="buscar.php">
			<label>Buscar :</label>
			<input name="buscar" type="text" list="lista"  title="Ingresa descripcion para buscar">
			<button class="buscar">.</button>
		</form>
		<section id="botones">
			<b class="nuevos">Nuevo</b>
			<b class="updateCli">Actualizar</b>
		</section>
		<!-- <div class="scrollbar" id="barra" style="width:1050px;"> -->
		<div id="tbClientes"><?php require 'lista_clientes.php' ?></div>
		<!-- DIV contbarra -->
		<div class="contbarra"></div>
 		<!-- </div> -->
	</section>
	<div class="todasacciones"></div>
	<b class="cerrar">Cerrar</b>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function() {
		$(".updateCli").click(function() {
			$('#tbClientes').html('<div><img src="../images/loader_blue.gif"/></div>');
			$.post('cargar_clientes.php', function(data) {
				$("#tbClientes").html(data);
			});
		});
	});
</script>