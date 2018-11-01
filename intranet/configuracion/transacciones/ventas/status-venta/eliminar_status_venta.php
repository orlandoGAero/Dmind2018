<?php
	// Sesión
    require_once('../../../sesion.php');
    if($sesion != 1){
	    require ('classStatusVenta.php');
	    $fnStVenta = new StatusVenta();
	    require_once("../../../../libs/encrypt_decrypt_strings_urls.php");
	    $idStVenta = decrypt($_REQUEST['txtIdStVenta'],"statusVentaDM");
	    if($fnStVenta -> eliminarStatusVenta($idStVenta)){
			if(isset($fnStVenta -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnStVenta -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnStVenta -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnStVenta -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tb_staVnt"><?php require 'tabla_status_venta.php'; ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>