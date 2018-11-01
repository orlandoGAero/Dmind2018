<?php
	// Sesión
    require_once('../../sesion.php');
    if($sesion != 1){
	   	require ('classAreasContacto.php');
    	$fnAreasContacto = new AreasContacto();
	    require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	    $idAreaCont = decrypt($_REQUEST['txtIdAreaCont'],"areasContactoDM");
	    if($fnAreasContacto -> eliminarAreaContacto($idAreaCont)){
			if(isset($fnAreasContacto -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnAreasContacto -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnAreasContacto -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnAreasContacto -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tbAreasContact"><?php require 'tabla_areas_contacto.php' ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>