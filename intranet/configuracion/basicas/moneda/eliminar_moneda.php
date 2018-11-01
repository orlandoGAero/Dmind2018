<?php
	// Sesión
    require_once('../../sesion.php');
    if($sesion != 1){
	   	require ('classMonedas.php');
    	$fnMonedas = new Monedas();
	    require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	    $idMoneda = decrypt($_REQUEST['txtIdMoneda'],"monedasDM");
	    if($fnMonedas -> eliminarMoneda($idMoneda)){
			if(isset($fnMonedas -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnMonedas -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnMonedas -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnMonedas -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tbMonedas"><?php require 'tabla_monedas.php' ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>