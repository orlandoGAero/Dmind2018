<?php 
	// Sesión
	require_once('../sesion.php');

	require ('../../../../conexion.php');
	require ('../config_egresos.php');

	$class_eg = new config_egresos();
?>

<?php
	$band = 0;

	if($class_eg -> registrar_concepto($_REQUEST['nom_con'])) {
		$band = 0;
	}
	else {
		if(isset($class_eg -> msjErr)) echo"<div class='errorConfig'><h3>".$class_eg -> msjErr."</h3></div>";
		if(isset($class_eg -> msjCap)) echo"<div class='captionConfig'><h3>".$class_eg -> msjCap."</h3></div>";
		$band = 1;
	}

echo "
	<script type='text/javascript'>
		$(function() {
			var flag = ".$band.";
			if (flag == 0) {
				jQuery.fancybox.close();
				$('#tb_con').load('lib_nuevo.php');
			}
		});
	</script>
";
?>