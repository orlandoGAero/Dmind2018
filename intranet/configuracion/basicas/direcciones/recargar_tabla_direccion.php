<?php
	// Sesión
    require_once('../../sesion.php');
    require ('classDirecciones.php');
    $fnDirecciones = new Direcciones();
?>
<div id="tb_dir"><?php require 'tabla_direcciones.php' ?></div>