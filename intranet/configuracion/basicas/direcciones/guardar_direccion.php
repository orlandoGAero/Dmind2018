<?php 
	// Sesión
    require_once('../../sesion.php');
    require ('classDirecciones.php');
    $fnDirecciones = new Direcciones();
?>
<?php
	$band = 0;
	if($fnDirecciones -> registrarDireccion($_REQUEST['txt_calle'],$_REQUEST['txt_ext'],$_REQUEST['txt_int'],$_REQUEST['txt_col'],$_REQUEST['txt_loc'],$_REQUEST['txt_ref'],$_REQUEST['txt_mun'],$_REQUEST['txt_est'],$_REQUEST['txt_pai'],$_REQUEST['txt_cp'],$_REQUEST['txt_suc'],$_REQUEST['txt_gps'])) {
		$band = 0;
	}
	else {
		if(isset($fnDirecciones -> msjErr)) echo"<div class='errorConfig'><h3>".$fnDirecciones -> msjErr."</h3></div>";
		if(isset($fnDirecciones -> msjCap)) echo"<div class='captionConfig'><h3>".$fnDirecciones -> msjCap."</h3></div>";
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
					$('#tb_dir').load('recargar_tabla_direccion.php');
				}
			});
		</script>
	";
?>