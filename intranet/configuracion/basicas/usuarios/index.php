<?php
    require ('classUsuarios.php');
    $fnUsuarios = new Usuarios();
?>
<?php include ('../../head.php'); ?>
<body>
	<?php include ('../../nav.php'); ?>
    <div id="menuopcion"><?php include('../../menu_individual.php') ?></div>
    <h1 style="text-align:center; color:rgba(0,191,255,.9);">
    	<a href="../../">
			<img class="atras" src="../../../images/atras.png" title="Regresar">
		</a>Usuarios
    </h1>
    <center>
    	<section id="botones">
		    <a href="agregar_usuario.php" class="nuevo usAdd"><b class="nuevos">Nuevo</b></a>
    	</section>
    	<section>
    		<center>
    			<div id="tb_users"><?php require 'tabla_usuarios.php'; ?></div>
    		</center>
    	</section>
    </center>
</body>
</html>
<script type="text/javascript">
    var $ = jQuery.noConflict();
	$(document).ready(function(){
		$('.usAdd').fancybox({
			'autoSize':true,
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>