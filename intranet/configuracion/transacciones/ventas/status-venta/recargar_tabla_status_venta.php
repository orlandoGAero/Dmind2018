<?php
	// Sesión
    require_once('../../../sesion.php');
    require ('classStatusVenta.php');
    $fnStVenta = new StatusVenta();;
?>
<div id="tb_staVnt"><?php require 'tabla_status_venta.php' ?></div>