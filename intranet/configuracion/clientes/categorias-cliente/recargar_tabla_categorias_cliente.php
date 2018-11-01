<?php
	// Sesión
    require_once('../../sesion.php');
    require ('classCategoriasCliente.php');
    $fnCatClie = new CategoriasCliente();
?>
<div id="tb_catClient"><?php require 'tabla_categorias_cliente.php' ?></div>