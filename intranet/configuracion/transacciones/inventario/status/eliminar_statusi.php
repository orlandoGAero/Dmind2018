<?php
	// Sesión
    require_once('../../../sesion.php');
    if($sesion != 1){
	   	require ('classStatusInv.php');
    	$fnStatusInv = new StatusInv();
	    require_once("../../../../libs/encrypt_decrypt_strings_urls.php");
	    $idStInv = decrypt($_REQUEST['txtIdStInv'],"statusInventarioDM");
	    if($fnStatusInv -> eliminarStatusInventario($idStInv)){
			if(isset($fnStatusInv -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnStatusInv -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnStatusInv -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnStatusInv -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tbStatusInv"><?php require 'tabla_statusi.php' ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>