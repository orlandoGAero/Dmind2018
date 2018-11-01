<?php
	// Sesión
    require_once('../../../sesion.php');
   	require ('classTiposPago.php');
    $fnTiposPago = new TiposPago();
?>
<div id="tbTiposPagos"><?php require 'tabla_tipos_pago.php' ?></div>