<?php
	// Sesión
    require_once('../../sesion.php');
    if($sesion != 1){
	   	require ('classTiposTransaccion.php');
    	$fnTiposTransaccion = new TiposTransaccion();
	    require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	    $idTipoTrans = decrypt($_REQUEST['txtIdTipoTrans'],"tiposTransaccionDM");
	    if($fnTiposTransaccion -> eliminarTipoTransaccion($idTipoTrans)){
			if(isset($fnTiposTransaccion -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnTiposTransaccion -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnTiposTransaccion -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnTiposTransaccion -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tbTiposTransaccion"><?php require 'tabla_tipost.php' ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>