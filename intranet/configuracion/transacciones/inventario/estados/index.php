<?php
    require ('classEstadosInv.php');
    $fnEstadosInv = new EstadosInv();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Lista de Clasificaciones</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../../images/favicon.ico">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../../../../css/menu.css"/>
    <link rel="stylesheet" href="../../../../css/tabla.css"/>
    <link rel="stylesheet" type="text/css" href="../../../../css/formularios.css" />
    <link rel="stylesheet" type="text/css" href="../../../../css/mensajes.css" />
    <link rel="stylesheet" type="text/css" href="../../../../css/menu_individual_config.css" />
    <!-- jQuery -->
    <script type="text/javascript" src="../../../../js/jquery-1.7.1.min.js" ></script>
    <!-- FancyBox-->
    <!-- CSS --><link rel="stylesheet" type="text/css" href="../../../../libs/fancyBox/source/jquery.fancybox.css"> 
    <!-- JS --><script type="text/javascript" src="../../../../libs/fancyBox/source/jquery.fancybox.js" ></script>
</head>

<body>
	<header>
        <img src="../../../../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
    </header>
    <nav>
        <ul>
            <li><a href="../../../../Home" alt="Inicio" title="Inicio"><img src="../../../../images/home.png"/></a></li>
            <li></li>
            <li></li>
            <li></li>
            <li><spam style="color:#fff;"><?php /*echo $_SESSION["usuario"]; */?></spam></li>
            <li><a href="../../../../salir.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../../../../images/lock.png"/></a></li>
        </ul>
    </nav>
    <div id="menuopcion"><?php include('../../../menu_individual.php') ?></div>
    <h1 style="text-align:center; color:rgba(0,191,255,.9);">
    	<a href="../../">
			<img class="atras" src="../../../../images/atras.png" title="Regresar">
		</a>Estados
    </h1>
    <center>
    	<section id="botones">
		    <a href="agregar_estadoi.php" class="nuevo estadoInvAdd"><b class="nuevos">Nuevo</b></a>
    	</section>
    	<section>
    		<center>
    			<div id="tbEstadosInv"><?php require 'tabla_estadosi.php' ?></div>
    		</center>
    	</section>
    </center>
</body>
</html>
<script type="text/javascript">
    var $ = jQuery.noConflict();
	$(document).ready(function(){
		$('.estadoInvAdd').fancybox({
			'autoSize':true,
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>