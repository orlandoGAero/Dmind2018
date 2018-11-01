<?php
    require ('classTiposTransaccion.php');
    $fnTiposTransaccion = new TiposTransaccion();
?>
<?php include ('../../head.php'); ?>
<body>
	<?php include ('../../nav.php'); ?>
    <div id="menuopcion"><?php include('../../menu_individual.php') ?></div>
    <h1 style="text-align:center; color:rgba(0,191,255,.9);">
    	<a href="../../">
			<img class="atras" src="../../../images/atras.png" title="Regresar">
		</a>Tipos Transacción
    </h1>
    <center>
    	<section id="botones">
		    <a href="agregar_tipot.php" class="nuevo tipoTransAdd"><b class="nuevos">Nuevo</b></a>
    	</section>
    	<section>
    		<center>
    			<div id="tbTiposTransaccion"><?php require 'tabla_tipost.php' ?></div>
    		</center>
    	</section>
    </center>
</body>
</html>
<script type="text/javascript">
    var $ = jQuery.noConflict();
	$(document).ready(function(){
		$('.tipoTransAdd').fancybox({
			'autoSize':true,
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>