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
		$idClasif = $_REQUEST['txt_idcl'];
		if($class_eg -> eliminar_clasifi($idClasif)){
			if(isset($class_eg -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$class_eg -> msjErr."</h3></div>";
			if(isset($class_eg -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$class_eg -> msjOk."</h3></div>";
		}
	}
?>
<div id="tb_cla"><?php require 'tabla_clasificacion.php'; ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(4000);
    },5000);
    setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(4000);
    },5000);
</script>