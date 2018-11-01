<?php 
	// Sesión
    require_once('../../../sesion.php');
    require ('classTiposPago.php');
    $fnTiposPago = new TiposPago();
?>
<?php
	$band = 0;
	if($fnTiposPago -> registrarTipoPago($_REQUEST['txtNameFormaPago'])) {
		$band = 0;
	}
	else {
		if(isset($fnTiposPago -> msjErr)) echo"<div class='errorConfig'><h3>".$fnTiposPago -> msjErr."</h3></div>";
		if(isset($fnTiposPago -> msjCap)) echo"<div class='captionConfig'><h3>".$fnTiposPago -> msjCap."</h3></div>";
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
					$('#tbTiposPagos').load('recargar_tabla_tipos_pago.php');
				}
			});
		</script>
	";
?>