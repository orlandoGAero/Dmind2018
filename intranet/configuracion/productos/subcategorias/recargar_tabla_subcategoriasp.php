<?php
	// Sesión
    require_once('../../sesion.php');
    require ('classSubcategoriaProducto.php');
    $fnSubcatProducto = new SubcategoriaProducto();
?>
<div id="tbSubcatProduct"><?php require 'tabla_subcategoriasp.php' ?></div>