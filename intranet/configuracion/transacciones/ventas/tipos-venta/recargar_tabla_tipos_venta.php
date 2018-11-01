<?php
	// Sesión
    require_once('../../../sesion.php');
    require ('classTiposVenta.php');
    $fnTipVenta = new TiposVenta();
?>
<div id="tbTiposVenta"><?php require 'tabla_tipos_venta.php' ?></div>