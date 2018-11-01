<?php 
	// Sesión
    require_once('../../sesion.php');
    require ('classUsuarios.php');
    $fnUsuarios = new Usuarios();
?>
<?php
	$band = 0;
	if($fnUsuarios -> registrarUsuario($_REQUEST['txtNameUser'],$_REQUEST['txtPassUser'],$_REQUEST['confirmPassword'],$_REQUEST['txtEmailUser'],$_REQUEST['sltTipo'])) {
		$band = 0;
	}
	else {
		if(isset($fnUsuarios -> msjErr)) echo"<div class='errorConfig'><h3>".$fnUsuarios -> msjErr."</h3></div>";
		if(isset($fnUsuarios -> msjCap)) echo"<div class='captionConfig'><h3>".$fnUsuarios -> msjCap."</h3></div>";
		$band = 1;
	}
	echo "
		<script type='text/javascript'>
			setTimeout(function() {
		        $('.errorConfig').fadeOut(2000);
		    },3500);
		    
			setTimeout(function() {
		        $('.captionConfig').fadeOut(2000);
		    },3500);

			$(function() {
				var flag = ".$band.";
				if (flag == 0) {
					jQuery.fancybox.close();
					$('#tb_users').load('recargar_tabla_usuarios.php');
				}
			});
		</script>
	";
?>