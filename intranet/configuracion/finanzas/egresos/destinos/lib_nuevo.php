<?php
	// Sesión
    require_once('../sesion.php');
    
	require ('../../../../conexion.php');
	require ('../config_egresos.php');
	$class_eg = new config_egresos();
?>

<div id="tb_des"><?php require 'tabla_destino.php'; ?></div>