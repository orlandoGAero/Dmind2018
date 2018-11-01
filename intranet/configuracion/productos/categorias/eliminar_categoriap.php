<?php
	// Sesión
    require_once('../../sesion.php');
    if($sesion != 1){
	   	require ('classCategoriaProducto.php');
    	$fnCatProducto = new CategoriaProducto();
	    require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	    $idCatProd = decrypt($_REQUEST['txtIdCatProd'],"categoriasProductoDM");
	    if($fnCatProducto -> eliminarCategoriaProducto($idCatProd)){
			if(isset($fnCatProducto -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnCatProducto -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnCatProducto -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnCatProducto -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tbCatProduct"><?php require 'tabla_categoriasp.php' ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>