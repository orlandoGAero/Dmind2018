<?php
	// Sesión
    require_once('../../sesion.php');
    if($sesion != 1){
	   	require ('classUnidadesP.php');
    	$fnUnidadesP = new UnidadesP();
	    require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	    $idUnidProd = decrypt($_REQUEST['txtIdUnidProd'],"unidadesProductoDM");
	    if($fnUnidadesP -> eliminarUnidadProducto($idUnidProd)){
			if(isset($fnUnidadesP -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnUnidadesP -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnUnidadesP -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnUnidadesP -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tbUnidadesProd"><?php require 'tabla_unidadesp.php' ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>