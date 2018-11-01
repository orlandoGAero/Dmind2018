<?php 
	// Sesión
    require_once('../../sesion.php');
    require ('classCategoriasProveedor.php');
    $fnCatProv = new CategoriasProveedor();
?>
<?php
	$band = 0;
	if($fnCatProv -> registrarCategoriaProveedor($_REQUEST['txtNameCatProv'])) {
		$band = 0;
	}
	else {
		if(isset($fnCatProv -> msjErr)) echo"<div class='errorConfig'><h3>".$fnCatProv -> msjErr."</h3></div>";
		if(isset($fnCatProv -> msjCap)) echo"<div class='captionConfig'><h3>".$fnCatProv -> msjCap."</h3></div>";
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
					$('#tb_catProv').load('recargar_tabla_categorias_proveedor.php');
				}
			});
		</script>
	";
?>