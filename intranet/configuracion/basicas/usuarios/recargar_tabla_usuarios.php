<?php
	// Sesión
    require_once('../../sesion.php');
    require ('classUsuarios.php');
    $fnUsuarios = new Usuarios();
?>
<div id="tb_users"><?php require 'tabla_usuarios.php' ?></div>