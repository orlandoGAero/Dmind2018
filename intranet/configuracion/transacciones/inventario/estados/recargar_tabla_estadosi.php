<?php
	// Sesión
    require_once('../../../sesion.php');
    require ('classEstadosInv.php');
    $fnEstadosInv = new EstadosInv();
?>
<div id="tbEstadosInv"><?php require 'tabla_estadosi.php' ?></div>