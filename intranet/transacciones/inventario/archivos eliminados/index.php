<?php  include ("../../configuracion/head.php");?>
<body>
	<header>
		<img src="../../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
		<!-- jQuery -->
    		<script type="text/javascript" src="../../js/jquery-1.7.1.min.js" ></script>
		<!-- FancyBox-->
			<!-- CSS --><link rel="stylesheet" type="text/css" href="../../libs/fancyBox/source/jquery.fancybox.css">	
			<!-- JS --><script type="text/javascript" src="../../libs/fancyBox/source/jquery.fancybox.js" ></script>
	</header>
	<nav>
		<ul>
			<li><a href="../../Home" alt="Inicio" title="Inicio"><img src="../../images/home.png"/></a></li>
			<a href="../"><li><img src="../../images/volver.png" /><b>Atras</b></li></a><li></li><li></li><li><spam style="color:#fff;"><?php echo $_SESSION["usuario"]; ?></spam></li>
			<li><a href="../../salir.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../../images/lock.png"/></a></li>
		</ul>
	</nav>
<?php  include ("../../conexion.php");?>

<center>
	<h1> Inventario</h1>
    <form action="buscar.php">
        <label>Buscar :</label>
        <input name="buscar" type="text" list="lista"  title="Ingresa descripcion para buscar" />
        <button class="buscar">.</button>
    </form> 
    <section id="botones">
	    <a href="agregar_inv.php" class="nuevo fancyAdd"><b class="nuevos">Nuevo</b></a>
	</section>   

	<div id="tb_inv"><?php require 'tabla_inv.php'; ?></div>
</center>

<!-- <b class="cerrar">Cerrar</b> -->
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		var $ = jQuery.noConflict();
		$('.fancyAdd').fancybox({
			'autoSize':false,
			'transitionIn':'none',
			'transitionOut':'none',
			'width':580,
			'height':1100,
			'type':'ajax'
		});
	});
</script>