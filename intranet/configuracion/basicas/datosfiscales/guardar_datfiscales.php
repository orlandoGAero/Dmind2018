<?php 
	// Sesión
    require_once('../../sesion.php');
    require ('cl_datosfiscales.php');
    $fnDatFis = new datosFiscales();
?>
<?php
	$band = 0;
	if($fnDatFis -> registrarDatosFiscales($_REQUEST['txtRazSoc'], $_REQUEST['txtRfc'])) {
		$band = 0;
	}
	else {
		if(isset($fnDatFis -> msjErr)) echo"<div class='errorConfig'><h3>".$fnDatFis -> msjErr."</h3></div>";
		if(isset($fnDatFis -> msjCap)) echo"<div class='captionConfig'><h3>".$fnDatFis -> msjCap."</h3></div>";
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
					$('#tbDatosFiscales').load('recargar_tabla_datfiscales.php');
				}
			});
		</script>
	";
?>