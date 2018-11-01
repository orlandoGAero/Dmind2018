<?php
	// Sesión
    require_once('../../sesion.php');
    if($sesion != 1){
	    require ('classDirecciones.php');
    	$fnDirecciones = new Direcciones();
	    require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	    $idDir = decrypt($_REQUEST['txtidDir'],"direccionesDM");
	    if($fnDirecciones -> eliminarDireccion($idDir)){
			if(isset($fnDirecciones -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnDirecciones -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnDirecciones -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnDirecciones -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tb_dir"><?php require 'tabla_direcciones.php'; ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>