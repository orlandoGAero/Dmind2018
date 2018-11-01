<?php 
	// Sesión
    require_once('../../../sesion.php');
    require ('classStatusVenta.php');
    $fnStVenta = new StatusVenta();
?>
<?php
	$band = 0;
	if($fnStVenta -> modificarStatusVenta($_REQUEST['txtIDstVenta'],$_REQUEST['txtNameStVnt'])) {
		$band = 0;
	}
	else {
		if(isset($fnStVenta -> msjErr)) echo"<div class='errorConfig'><h3>".$fnStVenta -> msjErr."</h3></div>";
		if(isset($fnStVenta -> msjCap)) echo"<div class='captionConfig'><h3>".$fnStVenta -> msjCap."</h3></div>";
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
					$('#tb_staVnt').load('recargar_tabla_status_venta.php');
				}
			});
		</script>
	";
?>