<?php
	$sesion = 0;
	session_start();
	//manejamos en sesion el nombre del usuario que se ha logeado
	if (!isset($_SESSION["usuario"])){
	    header("location:../../../../"); 
	    $sesion = 1; 
	}
	$_SESSION["usuario"];
	//termina inicio de sesion

	if($sesion != 1){
		require ('../../../../conexion.php');
		require ('../config_egresos.php');
		$class_eg = new config_egresos();
		$idCon = $_REQUEST['txt_idCon'];
		if($class_eg -> eliminar_concepto($idCon)){

		}else {
			if(isset($class_eg -> msjErr)) echo"<div class='error'><h3>".$class_eg -> msjErr."</h3></div>";
			if(isset($class_eg -> msjOk)) echo"<div class='success'><h3>".$class_eg -> msjCap."</h3></div>";
		}
	}

?>
	<div id="tb_con"><?php require 'tabla_concepto.php'; ?></div>