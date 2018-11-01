<?php
	// Sesión
	require_once('../sesion.php');
	
	require ('../../../../conexion.php');
	require ('../config_egresos.php');
	$class_eg = new config_egresos();
?>

<?php 
	$band = 0;
 	if($class_eg->editar_concepto($_REQUEST['txt_idco'],$_REQUEST['nom_co'])) :
 		$band = 0;
  	else :
 ?>
		<?php if(isset($class_eg -> msjErr)) :?><div class="error"><h3><?=$class_eg -> msjErr?></h3></div><?php endif; ?>
		<?php if(isset($class_eg -> msjCap)) :?><div class="caption"><h3><?=$class_eg -> msjCap?></h3></div><?php endif; ?>
<?php
		$band = 1;
	endif;


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
