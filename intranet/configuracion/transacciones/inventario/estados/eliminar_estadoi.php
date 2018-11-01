<?php
	// Sesión
    require_once('../../../sesion.php');
    if($sesion != 1){
	   	require ('classEstadosInv.php');
    	$fnEstadosInv = new EstadosInv();
	    require_once("../../../../libs/encrypt_decrypt_strings_urls.php");
	    $idEstInv = decrypt($_REQUEST['txtIdEstInv'],"estadosInventarioDM");
	    if($fnEstadosInv -> eliminarEstadoInventario($idEstInv)){
			if(isset($fnEstadosInv -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnEstadosInv -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnEstadosInv -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnEstadosInv -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tbEstadosInv"><?php require 'tabla_estadosi.php' ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>