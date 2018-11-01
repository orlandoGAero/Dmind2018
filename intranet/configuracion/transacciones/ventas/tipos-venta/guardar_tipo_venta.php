<?php 
	// Sesión
    require_once('../../../sesion.php');
    require ('classTiposVenta.php');
    $fnTipVenta = new TiposVenta();;
?>
<?php
	$band = 0;
	if($fnTipVenta -> registrarTipoVenta($_REQUEST['txtNameTipVnt'])) {
		$band = 0;
	}
	else {
		if(isset($fnTipVenta -> msjErr)) echo"<div class='errorConfig'><h3>".$fnTipVenta -> msjErr."</h3></div>";
		if(isset($fnTipVenta -> msjCap)) echo"<div class='captionConfig'><h3>".$fnTipVenta -> msjCap."</h3></div>";
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
					$('#tbTiposVenta').load('recargar_tabla_tipos_venta.php');
				}
			});
		</script>
	";
?>