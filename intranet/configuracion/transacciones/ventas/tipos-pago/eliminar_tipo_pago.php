<?php
	// Sesión
    require_once('../../../sesion.php');
    if($sesion != 1){
	   	require ('classTiposPago.php');
    	$fnTiposPago = new TiposPago();
	    require_once("../../../../libs/encrypt_decrypt_strings_urls.php");
	    $idTipoPago = decrypt($_GET['txtIdTipoPago'],"tiposPagoDM");
	    if($fnTiposPago -> eliminarTipoPago($idTipoPago)){
			if(isset($fnTiposPago -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnTiposPago -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnTiposPago -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnTiposPago -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tbTiposPagos"><?php require 'tabla_tipos_pago.php' ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>