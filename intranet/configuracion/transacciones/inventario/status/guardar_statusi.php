<?php 
	// Sesión
    require_once('../../../sesion.php');
    require ('classStatusInv.php');
    $fnStatusInv = new StatusInv();
?>
<?php
	$band = 0;
	if($fnStatusInv -> registrarStatusInventario($_REQUEST['txtStatusInv'])) {
		$band = 0;
	}
	else {
		if(isset($fnStatusInv -> msjErr)) echo"<div class='errorConfig'><h3>".$fnStatusInv -> msjErr."</h3></div>";
		if(isset($fnStatusInv -> msjCap)) echo"<div class='captionConfig'><h3>".$fnStatusInv -> msjCap."</h3></div>";
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
					$('#tbStatusInv').load('recargar_tabla_statusi.php');
				}
			});
		</script>
	";
?>