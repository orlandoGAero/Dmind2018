<?php 
	// Sesión
    require_once('../../sesion.php');
    require ('classTiposP.php');
    $fnTiposP = new TiposP();
?>
<?php
	$band = 0;
	if($fnTiposP -> registrarTipoProducto($_REQUEST['txtTipProd'])) {
		$band = 0;
	}
	else {
		if(isset($fnTiposP -> msjErr)) echo"<div class='errorConfig'><h3>".$fnTiposP -> msjErr."</h3></div>";
		if(isset($fnTiposP -> msjCap)) echo"<div class='captionConfig'><h3>".$fnTiposP -> msjCap."</h3></div>";
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
					$('#tbTiposProd').load('recargar_tabla_tiposp.php');
				}
			});
		</script>
	";
?>