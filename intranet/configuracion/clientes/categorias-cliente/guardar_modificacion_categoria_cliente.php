<?php 
	// Sesión
    require_once('../../sesion.php');
    require ('classCategoriasCliente.php');
    $fnCatClie = new CategoriasCliente();
?>
<?php
	$band = 0;
	if($fnCatClie -> modificarCategoriaCliente($_REQUEST['txtIDcatClie'],$_REQUEST['txtNameCatClie'])) {
		$band = 0;
	}
	else {
		if(isset($fnCatClie -> msjErr)) echo"<div class='errorConfig'><h3>".$fnCatClie -> msjErr."</h3></div>";
		if(isset($fnCatClie -> msjCap)) echo"<div class='captionConfig'><h3>".$fnCatClie -> msjCap."</h3></div>";
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
					$('#tb_catClient').load('recargar_tabla_categorias_cliente.php');
				}
			});
		</script>
	";
?>