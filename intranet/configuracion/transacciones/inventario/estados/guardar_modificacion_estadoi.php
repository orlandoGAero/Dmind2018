<?php 
	// Sesión
    require_once('../../../sesion.php');
   	require ('classEstadosInv.php');
    $fnEstadosInv = new EstadosInv();
?>
<?php
	$band = 0;
	if($fnEstadosInv -> modificarEstadoInventario($_REQUEST['txtIDEstInv'],$_REQUEST['txtNameEstInv'])) {
		$band = 0;
	}
	else {
		if(isset($fnEstadosInv -> msjErr)) echo"<div class='errorConfig'><h3>".$fnEstadosInv -> msjErr."</h3></div>";
		if(isset($fnEstadosInv -> msjCap)) echo"<div class='captionConfig'><h3>".$fnEstadosInv -> msjCap."</h3></div>";
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
					$('#tbEstadosInv').load('recargar_tabla_estadosi.php');
				}
			});
		</script>
	";
?>