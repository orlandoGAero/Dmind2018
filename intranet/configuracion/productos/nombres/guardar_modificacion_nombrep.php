<?php 
	// Sesión
    require_once('../../sesion.php');
   	require ('classNombresP.php');
    $fnNombresP = new NombresP();
?>
<?php
	$band = 0;
	if($fnNombresP -> modificarNombreProducto($_REQUEST['txtIDNomProd'],$_REQUEST['txtNomProd'])) {
		$band = 0;
	}
	else {
		if(isset($fnNombresP -> msjErr)) echo"<div class='errorConfig'><h3>".$fnNombresP -> msjErr."</h3></div>";
		if(isset($fnNombresP -> msjCap)) echo"<div class='captionConfig'><h3>".$fnNombresP -> msjCap."</h3></div>";
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
					$('#tbNombresProd').load('recargar_tabla_nombresp.php');
				}
			});
		</script>
	";
?>