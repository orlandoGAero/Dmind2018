<?php
	// Sesión
    require_once('../../sesion.php');
    if($sesion != 1){
	    require ('classProductos.php');
    	$fnProd = new Productos();
	    require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	    $idProd = decrypt($_REQUEST['txtIdProd'],"productosDM");
	    if($fnProd -> eliminarProducto($idProd)){
			if(isset($fnProd -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnProd -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnProd -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnProd -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tb_product"><?php require 'tabla_productos.php'; ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>