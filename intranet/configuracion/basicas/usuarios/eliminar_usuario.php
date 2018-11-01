<?php
	// Sesión
    require_once('../../sesion.php');
    if($sesion != 1){
	    require ('classUsuarios.php');
    	$fnUsuarios = new Usuarios();
	    require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	    $idUser = decrypt($_REQUEST['txtIdUser'],"usuariosDM");
	    if($fnUsuarios -> eliminarUsuario($idUser)){
			if(isset($fnUsuarios -> msjOk)) echo"<div class='successDeleteConfig'><h3>".$fnUsuarios -> msjOk."</h3></div>";
	    }else{
	    	if(isset($fnUsuarios -> msjErr)) echo"<div class='errorDeleteConfig'><h3>".$fnUsuarios -> msjErr."</h3></div>";
	    }
	}
?>
<div id="tb_users"><?php require 'tabla_usuarios.php'; ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.errorDeleteConfig').fadeOut(3000);
    },3500);
	setTimeout(function() {
        $('.successDeleteConfig').fadeOut(3000);
    },3500);
</script>