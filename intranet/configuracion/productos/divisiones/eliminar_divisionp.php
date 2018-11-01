<?php
	// Sesión
    require_once('../../sesion.php');
    if($sesion != 1){
	   	require ('classDivisiones.php');
    	$fnDivisiones = new Divisiones();
	    require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	    $idDivProd = decrypt($_REQUEST['txtIdDivProd'],"divisionesProductoDM");
	    if($fnDivisiones -> eliminarDivisionProducto($idDivProd)){
			if(isset($fnDivisiones -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnDivisiones -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnDivisiones -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnDivisiones -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tbDivisionesProd"><?php require 'tabla_divisionesp.php' ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>