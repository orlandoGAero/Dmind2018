<?php
	// Sesión
    require_once('../../sesion.php');
    if($sesion != 1){
	   	require ('classSubcategoriaProducto.php');
    	$fnSubcatProducto = new SubcategoriaProducto();
	    require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	    $idSubcatProd = decrypt($_REQUEST['txtIdSubcatProd'],"subcategoriasProductoDM");
	    if($fnSubcatProducto -> eliminarSubcategoriaProducto($idSubcatProd)){
			if(isset($fnSubcatProducto -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnSubcatProducto -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnSubcatProducto -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnSubcatProducto -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tbSubcatProduct"><?php require 'tabla_subcategoriasp.php' ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>