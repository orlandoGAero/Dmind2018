<?php
	// Sesión
    require_once('../../sesion.php');
    require ('cl_datosfiscales.php');
    $fnDatFis = new datosFiscales();
?>
<div id="tbDatosFiscales"><?php require 'tabla_datfiscales.php' ?></div>