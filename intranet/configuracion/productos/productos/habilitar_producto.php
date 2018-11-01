<?php
	// Sesión
    require_once('../../sesion.php');
    if($sesion != 1){
	    require ('classProductos.php');
    	$fnProd = new Productos();
	    require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	    $idProd = decrypt($_REQUEST['txtIdProd'],"productosDM");
	    if($fnProd -> habilitarProducto($idProd)){
			if(isset($fnProd -> msjOk)) echo"<div class='successConfig'><h3>".$fnProd -> msjOk."</h3></div>";
	    }
	}
?>
<div id="tb_product"><?php require 'tabla_productos.php'; ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.successConfig').fadeOut(3000);
    },3500);
</script>