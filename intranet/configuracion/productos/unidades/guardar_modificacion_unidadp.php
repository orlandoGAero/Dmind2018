<?php 
	// Sesión
    require_once('../../sesion.php');
   	require ('classUnidadesP.php');
    $fnUnidadesP = new UnidadesP();
?>
<?php
	$band = 0;
	if($fnUnidadesP -> modificarUnidadProducto($_REQUEST['txtIDUnidProd'],$_REQUEST['txtNameUnidProd'])) {
		$band = 0;
	}
	else {
		if(isset($fnUnidadesP -> msjErr)) echo"<div class='errorConfig'><h3>".$fnUnidadesP -> msjErr."</h3></div>";
		if(isset($fnUnidadesP -> msjCap)) echo"<div class='captionConfig'><h3>".$fnUnidadesP -> msjCap."</h3></div>";
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
					$('#tbUnidadesProd').load('recargar_tabla_unidadesp.php');
				}
			});
		</script>
	";
?>