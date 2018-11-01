<?php 
	// Sesión
    require_once('../../sesion.php');
    require ('classSubcategoriaProducto.php');
    $fnSubcatProducto = new SubcategoriaProducto();
?>
<?php
	$band = 0;
	if($fnSubcatProducto -> registrarSubcategoriaProducto($_REQUEST['txtNameSubcatProd'])) {
		$band = 0;
	}
	else {
		if(isset($fnSubcatProducto -> msjErr)) echo"<div class='errorConfig'><h3>".$fnSubcatProducto -> msjErr."</h3></div>";
		if(isset($fnSubcatProducto -> msjCap)) echo"<div class='captionConfig'><h3>".$fnSubcatProducto -> msjCap."</h3></div>";
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
					$('#tbSubcatProduct').load('recargar_tabla_subcategoriasp.php');
				}
			});
		</script>
	";
?>