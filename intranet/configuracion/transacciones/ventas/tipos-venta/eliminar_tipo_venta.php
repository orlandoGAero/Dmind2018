<?php
	// Sesión
    require_once('../../../sesion.php');
    if($sesion != 1){
	    require ('classTiposVenta.php');
    	$fnTipVenta = new TiposVenta();
	    require_once("../../../../libs/encrypt_decrypt_strings_urls.php");
	    $idTipVenta = decrypt($_REQUEST['txtIdTipVenta'],"TiposVentaDM");
	    if($fnTipVenta -> eliminarTipoVenta($idTipVenta)){
			if(isset($fnTipVenta -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnTipVenta -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnTipVenta -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnTipVenta -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tbTiposVenta"><?php require 'tabla_tipos_venta.php'; ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>