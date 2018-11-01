<?php
	// Sesión
    require_once('../../sesion.php');
    if($sesion != 1){
	   	require ('cl_datosfiscales.php');
    	$fnDatFis = new datosFiscales();
	    require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	    $idDatFis = decrypt($_REQUEST['txtIdDatF'], "dfiscalesID");
	    if($fnDatFis -> eliminarDatosFiscales($idDatFis)){
			if(isset($fnDatFis -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnDatFis -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnDatFis -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnDatFis -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tbDatosFiscales"><?php require 'tabla_datfiscales.php' ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>