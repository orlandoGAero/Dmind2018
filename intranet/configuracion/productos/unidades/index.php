<?php
    require ('classUnidadesP.php');
    $fnUnidadesP = new UnidadesP();
?>
<?php include ('../../head.php'); ?>
<body>
	<?php include ('../../nav.php'); ?>
    <div id="menuopcion"><?php include('../../menu_individual.php') ?></div>
    <h1 style="text-align:center; color:rgba(0,191,255,.9);">
    	<a href="../../">
			<img class="atras" src="../../../images/atras.png" title="Regresar">
		</a>Unidades
    </h1>
    <center>
    	<section id="botones">
		    <a href="agregar_unidadp.php" class="nuevo unidadProdAdd"><b class="nuevos">Nueva</b></a>
    	</section>
    	<section>
    		<center>
    			<div id="tbUnidadesProd"><?php require 'tabla_unidadesp.php' ?></div>
    		</center>
    	</section>
    </center>
</body>
</html>
<script type="text/javascript">
    var $ = jQuery.noConflict();
	$(document).ready(function(){
		$('.unidadProdAdd').fancybox({
			'autoSize':true,
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>