<?php
    require ('classTiposP.php');
    $fnTiposP = new TiposP();
?>
<?php include ('../../head.php'); ?>
<body>
	<?php include ('../../nav.php'); ?>
    <div id="menuopcion"><?php include('../../menu_individual.php') ?></div>
    <h1 style="text-align:center; color:rgba(0,191,255,.9);">
    	<a href="../../">
			<img class="atras" src="../../../images/atras.png" title="Regresar">
		</a>Tipos
    </h1>
    <center>
    	<section id="botones">
		    <a href="agregar_tipop.php" class="nuevo tipoProdAdd"><b class="nuevos">Nuevo</b></a>
    	</section>
    	<section>
    		<center>
    			<div id="tbTiposProd"><?php require 'tabla_tiposp.php' ?></div>
    		</center>
    	</section>
    </center>
</body>
</html>
<script type="text/javascript">
    var $ = jQuery.noConflict();
	$(document).ready(function(){
		$('.tipoProdAdd').fancybox({
			'autoSize':true,
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>