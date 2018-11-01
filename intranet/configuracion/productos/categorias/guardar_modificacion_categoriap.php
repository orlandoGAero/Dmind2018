<?php 
	// Sesión
    require_once('../../sesion.php');
    require ('classCategoriaProducto.php');
    $fnCatProducto = new CategoriaProducto();
?>
<?php
	$band = 0;
	if($fnCatProducto -> modificarCategoriaProducto($_REQUEST['txtIDCatProd'],$_REQUEST['txtNameCatProd'])) {
		$band = 0;
	}
	else {
		if(isset($fnCatProducto -> msjErr)) echo"<div class='errorConfig'><h3>".$fnCatProducto -> msjErr."</h3></div>";
		if(isset($fnCatProducto -> msjCap)) echo"<div class='captionConfig'><h3>".$fnCatProducto -> msjCap."</h3></div>";
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
					$('#tbCatProduct').load('recargar_tabla_categoriasp.php');
				}
			});
		</script>
	";
?>