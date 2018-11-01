<?php
	// Sesión
    require_once('../../sesion.php');
    if($sesion != 1){
	   	require ('classNombresP.php');
    	$fnNombresP = new NombresP();
	    require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	    $idNomProd = decrypt($_REQUEST['txtIdNomProd'],"nombresProductoDM");
	    if($fnNombresP -> eliminarNombreProducto($idNomProd)){
			if(isset($fnNombresP -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnNombresP -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnNombresP -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnNombresP -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tbNombresProd"><?php require 'tabla_nombresp.php' ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>