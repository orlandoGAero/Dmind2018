<?php
	// Sesión
    require_once('../../sesion.php');
    if($sesion != 1){
	   require ('classMarcas.php');
    	$fnMarcas = new Marcas();
	    require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	    $idMarca = decrypt($_REQUEST['txtIdMarca'],"marcasProductosDM");
	    if($fnMarcas -> eliminarMarca($idMarca)){
			if(isset($fnMarcas -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnMarcas -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnMarcas -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnMarcas -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tbMarcas"><?php require 'tabla_marcas.php' ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>