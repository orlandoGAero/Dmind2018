<?php
	 // Sesión
    require_once('../sesion.php');
    
	require ('../../../../conexion.php');
	require ('../config_egresos.php');
	$class_eg = new config_egresos();
?>

<div id="tb_cla"><?php require 'tabla_clasificacion.php'; ?></div>