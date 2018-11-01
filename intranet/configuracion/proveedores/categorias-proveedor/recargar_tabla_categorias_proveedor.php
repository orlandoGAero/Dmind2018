<?php
	// Sesión
    require_once('../../sesion.php');
    require ('classCategoriasProveedor.php');
    $fnCatProv = new CategoriasProveedor();
?>
<div id="tb_catProv"><?php require 'tabla_categorias_proveedor.php' ?></div>