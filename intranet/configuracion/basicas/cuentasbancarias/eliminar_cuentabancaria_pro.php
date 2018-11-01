<?php
	// Sesión
    require_once('../../sesion.php');
    if($sesion != 1){
	    require ('cl_cuentabancaria_pro.php');
    	$fnCueBan = new cuentasBancarias();
	    require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	    $idCuenBancaria = decrypt($_REQUEST['txtIdCuentaB'],"cbancariaID");
	    if($fnCueBan -> eliminarCuentaBancaria($idCuenBancaria)){
			if(isset($fnCueBan -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnCueBan -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnCueBan -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnCueBan -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tb_cuentasBancarias"><?php require 'tabla_cuentasbancarias_pro.php' ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>