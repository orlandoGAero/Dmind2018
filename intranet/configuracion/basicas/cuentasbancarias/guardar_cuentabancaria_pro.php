<?php 
	// Sesión
    require_once('../../sesion.php');
    require ('cl_cuentabancaria_pro.php');
    $fnCueBan = new cuentasBancarias();
?>
<?php
	$band = 0;
	if($fnCueBan -> registrarCuentaBancaria($_REQUEST['txtNumCuentaB'])) {
		$band = 0;
	}
	else {
		if(isset($fnCueBan -> msjErr)) echo"<div class='errorConfig'><h3>".$fnCueBan -> msjErr."</h3></div>";
		if(isset($fnCueBan -> msjCap)) echo"<div class='captionConfig'><h3>".$fnCueBan -> msjCap."</h3></div>";
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
					$.post('recargar_tabla_cuentasbancarias_pro.php')
					.done(function(data) {
						$('#tb_cuentasBancarias').html(data);
					});
				}
			});
		</script>
	";
?>