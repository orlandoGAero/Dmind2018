<?php
    require ('classDirecciones.php');
    $fnDirecciones = new Direcciones();
?>
<?php include ('../../head.php'); ?>
<body>
    <div id="cargando"></div>
	<?php include ('../../nav.php'); ?>
    <div id="menuopcion"><?php include('../../menu_individual.php') ?></div>
    <h1 style="text-align:center; color:rgba(0,191,255,.9);">
    	<a href="../../">
			<img class="atras" src="../../../images/atras.png" title="Regresar">
		</a>Direcciones
    </h1>
    <center>
    	<section id="botones">
		    <a href="agregar_direccion.php" class="nuevo dirAdd"><b class="nuevos">Nueva</b></a>
    	</section>
    	<section>
    		<center>
    			<div id="tb_dir"><?php require 'tabla_direcciones.php'; ?></div>
    		</center>
    	</section>
    </center>
</body>
</html>
<script type="text/javascript">
    var $ = jQuery.noConflict();
	$(document).ready(function(){
		$('.dirAdd').fancybox({
			'autoSize':false,
			'transitionIn':'none',
			'transitionOut':'none',
			'width':362,
			'height':590,
			'type':'ajax'
		});
	});
    $(window).load(function() {
        $('#cargando').hide();
    });
</script>