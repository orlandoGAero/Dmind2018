<?php 
	// Sesión
    require_once('../../../sesion.php');
   	require ('classUbicacionesInv.php');
    $fnUbicacionesInv = new UbicacionesInv();
?>
<?php
	$band = 0;
	if($fnUbicacionesInv -> modificarUbicacionInventario($_REQUEST['txtIDUbInv'],$_REQUEST['txtNameUbInv'])) {
		$band = 0;
	}
	else {
		if(isset($fnUbicacionesInv -> msjErr)) echo"<div class='errorConfig'><h3>".$fnUbicacionesInv -> msjErr."</h3></div>";
		if(isset($fnUbicacionesInv -> msjCap)) echo"<div class='captionConfig'><h3>".$fnUbicacionesInv -> msjCap."</h3></div>";
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
					$('#tbUbicacionesInv').load('recargar_tabla_ubicacionesi.php');
				}
			});
		</script>
	";
?>