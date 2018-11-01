<?php
	// Sesión
    require_once('../../../sesion.php');
    if($sesion != 1){
	   	require ('classUbicacionesInv.php');
    	$fnUbicacionesInv = new UbicacionesInv();
	    require_once("../../../../libs/encrypt_decrypt_strings_urls.php");
	    $idUbInv = decrypt($_REQUEST['txtIdUbicInv'],"ubicacionesInventarioDM");
	    if($fnUbicacionesInv -> eliminarUbicacionInventario($idUbInv)){
			if(isset($fnUbicacionesInv -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnUbicacionesInv -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnUbicacionesInv -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnUbicacionesInv -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tbUbicacionesInv"><?php require 'tabla_ubicacionesi.php' ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>