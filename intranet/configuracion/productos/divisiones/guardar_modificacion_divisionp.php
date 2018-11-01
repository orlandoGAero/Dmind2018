<?php 
	// Sesión
    require_once('../../sesion.php');
   	require ('classDivisiones.php');
    $fnDivisiones = new Divisiones();
?>
<?php
	$band = 0;
	if($fnDivisiones -> modificarDivisionProducto($_REQUEST['txtIDDivProd'],$_REQUEST['txtNameDivProd'])) {
		$band = 0;
	}
	else {
		if(isset($fnDivisiones -> msjErr)) echo"<div class='errorConfig'><h3>".$fnDivisiones -> msjErr."</h3></div>";
		if(isset($fnDivisiones -> msjCap)) echo"<div class='captionConfig'><h3>".$fnDivisiones -> msjCap."</h3></div>";
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
					$('#tbDivisionesProd').load('recargar_tabla_divisionp.php');
				}
			});
		</script>
	";
?>