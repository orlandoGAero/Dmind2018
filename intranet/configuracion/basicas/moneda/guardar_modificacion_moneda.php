<?php 
	// Sesión
    require_once('../../sesion.php');
   	require ('classMonedas.php');
    $fnMonedas = new Monedas();
?>
<?php
	$band = 0;
	if($fnMonedas -> modificarMoneda($_REQUEST['txtIDMoneda'],$_REQUEST['txtNameMoneda'],$_REQUEST['txtValorMoneda'])) {
		$band = 0;
	}
	else {
		if(isset($fnMonedas -> msjErr)) echo"<div class='errorConfig'><h3>".$fnMonedas -> msjErr."</h3></div>";
		if(isset($fnMonedas -> msjCap)) echo"<div class='captionConfig'><h3>".$fnMonedas -> msjCap."</h3></div>";
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
					$('#tbMonedas').load('recargar_tabla_monedas.php');
				}
			});
		</script>
	";
?>