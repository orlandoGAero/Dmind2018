<?php 
	// Sesión
    require_once('../../sesion.php');
    require ('classTiposTransaccion.php');
    $fnTiposTransaccion = new TiposTransaccion();
?>
<?php
	$band = 0;
	if($fnTiposTransaccion -> registrarTipoTransaccion($_REQUEST['txtNameTipoTrans'])) {
		$band = 0;
	}
	else {
		if(isset($fnTiposTransaccion -> msjErr)) echo"<div class='errorConfig'><h3>".$fnTiposTransaccion -> msjErr."</h3></div>";
		if(isset($fnTiposTransaccion -> msjCap)) echo"<div class='captionConfig'><h3>".$fnTiposTransaccion -> msjCap."</h3></div>";
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
					$('#tbTiposTransaccion').load('recargar_tabla_tipost.php');
				}
			});
		</script>
	";
?>