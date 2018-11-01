<?php
	require('../../class/egresos.php');
	$classEgresos = new egresos();
	$rfcEmisorEgre = $_REQUEST['txtRfcEmisor'];
	$classEgresos -> obtenerRFCProveedores($rfcEmisorEgre);
	if(isset($classEgresos -> msjErr)){
		echo"<div class='error position-error'><h3>".$classEgresos -> msjErr."</h3></div>";
		echo "<script>$('#guardarProv').removeAttr('checked');</script>";
	}
?>
<script type="text/javascript">
	setTimeout(function(){
		$('.error').fadeOut(1000);
	},5000);
</script>