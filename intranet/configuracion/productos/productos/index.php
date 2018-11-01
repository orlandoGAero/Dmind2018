<?php
    require ('classProductos.php');
    $fnProd = new Productos();
?>
<?php include ('../../head.php'); ?>
<body>
	<?php include ('../../nav.php'); ?>
    <div id="menuopcion"><?php include('../../menu_individual.php') ?></div>
    <h1 style="text-align:center; color:rgba(0,191,255,.9);">
    	<a href="../../">
			<img class="atras" src="../../../images/atras.png" title="Regresar">
		</a>Productos
    </h1>
    <center>
    	<section id="botones">
		    <a href="../../../productos/" class="nuevo"><b class="nuevos">Módulo Productos</b></a>
    	</section>
    	<section>
    		<center>
    			<div id="tb_product"><?php require 'tabla_productos.php'; ?></div>
    		</center>
    	</section>
    </center>
</body>
</html>