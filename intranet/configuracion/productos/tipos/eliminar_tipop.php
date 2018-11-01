<?php
	// Sesión
    require_once('../../sesion.php');
    if($sesion != 1){
	   	require ('classTiposP.php');
    	$fnTiposP = new TiposP();
	    require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	    $idTipProd = decrypt($_REQUEST['txtIdTipProd'],"tiposProductoDM");
	    if($fnTiposP -> eliminarTipoProducto($idTipProd)){
			if(isset($fnTiposP -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnTiposP -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnTiposP -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnTiposP -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tbTiposProd"><?php require 'tabla_tiposp.php' ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>