<?php
	// Sesión
    require_once('../../sesion.php');
    require ('classTiposTransaccion.php');
    $fnTiposTransaccion = new TiposTransaccion();
?>
<div id="tbTiposTransaccion"><?php require 'tabla_tipost.php' ?></div>