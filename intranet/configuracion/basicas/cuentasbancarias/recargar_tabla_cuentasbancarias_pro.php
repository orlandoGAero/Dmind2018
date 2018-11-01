<?php
	// Sesión
    require_once('../../sesion.php');
    require ('cl_cuentabancaria_pro.php');
    $fnCueBan = new cuentasBancarias();
?>
<div id="tb_cuentasBancarias"><?php require 'tabla_cuentasbancarias_pro.php' ?></div>