<?php
	// Sesión
	require_once('../sesion.php');
	
	require ('../../../../conexion.php');
	require ('../config_egresos.php');
	$class_eg = new config_egresos();
?>

<div id="tb_con"><?php require 'tabla_concepto.php'; ?></div>