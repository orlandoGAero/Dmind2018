<?php
	// Sesión
    require_once('../../sesion.php');
    if($sesion != 1){
	    require ('classCategoriasProveedor.php');
    	$fnCatProv = new CategoriasProveedor();
	    require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	    $idCatProv = decrypt($_REQUEST['txtIdCatProv'],"categoriasProveedorDM");
	    if($fnCatProv -> eliminarCategoriaProveedor($idCatProv)){
			if(isset($fnCatProv -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnCatProv -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnCatProv -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnCatProv -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tb_catProv"><?php require 'tabla_categorias_proveedor.php'; ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>