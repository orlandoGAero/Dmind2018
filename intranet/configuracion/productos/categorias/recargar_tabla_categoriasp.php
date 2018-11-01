<?php
	// Sesión
    require_once('../../sesion.php');
    require ('classCategoriaProducto.php');
    $fnCatProducto = new CategoriaProducto();
?>
<div id="tbCatProduct"><?php require 'tabla_categoriasp.php' ?></div>