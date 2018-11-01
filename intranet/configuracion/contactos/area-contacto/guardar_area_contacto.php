<?php 
	// Sesión
    require_once('../../sesion.php');
    require ('classAreasContacto.php');
    $fnAreasContacto = new AreasContacto();
?>
<?php
	$band = 0;
	if($fnAreasContacto -> registrarAreaContacto($_REQUEST['txtNameAreaCont'])) {
		$band = 0;
	}
	else {
		if(isset($fnAreasContacto -> msjErr)) echo"<div class='errorConfig'><h3>".$fnAreasContacto -> msjErr."</h3></div>";
		if(isset($fnAreasContacto -> msjCap)) echo"<div class='captionConfig'><h3>".$fnAreasContacto -> msjCap."</h3></div>";
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
					$('#tbAreasContact').load('recargar_tabla_areas_contacto.php');
				}
			});
		</script>
	";
?>