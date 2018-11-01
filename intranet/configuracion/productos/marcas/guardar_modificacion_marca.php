<?php 
	// Sesión
    require_once('../../sesion.php');
    require ('classMarcas.php');
    $fnMarcas = new Marcas();
?>
<?php
	$band = 0;
	if($fnMarcas -> modificarMarca($_REQUEST['txtIDMarca'],$_REQUEST['txtNameMarca'])) {
		$band = 0;
	}
	else {
		if(isset($fnMarcas -> msjErr)) echo"<div class='errorConfig'><h3>".$fnMarcas -> msjErr."</h3></div>";
		if(isset($fnMarcas -> msjCap)) echo"<div class='captionConfig'><h3>".$fnMarcas -> msjCap."</h3></div>";
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
					$('#tbMarcas').load('recargar_tabla_marcas.php');
				}
			});
		</script>
	";
?>