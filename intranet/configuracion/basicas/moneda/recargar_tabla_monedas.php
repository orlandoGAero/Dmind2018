<?php
	// Sesión
    require_once('../../sesion.php');
    require ('classMonedas.php');
    $fnMonedas = new Monedas();
?>
<div id="tbMonedas"><?php require 'tabla_monedas.php' ?></div>