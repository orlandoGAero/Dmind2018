<?php
	// Sesión
    require_once('../../sesion.php');
    if($sesion != 1){
	    require ('classCategoriasCliente.php');
    	$fnCatClie = new CategoriasCliente();
	    require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	    $idCatClie = decrypt($_REQUEST['txtIdCatClie'],"categoriasClienteDM");
	    if($fnCatClie -> eliminarCategoriaCliente($idCatClie)){
			if(isset($fnCatClie -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnCatClie -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnCatClie -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnCatClie -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tb_catClient"><?php require 'tabla_categorias_cliente.php'; ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>