<?php
	$codigoPostalDir = $_REQUEST['codigoP'];
	$localidadDir = $_REQUEST['nomLocalidad'];
	$municipioDir = $_REQUEST['nomMunicipio'];
	$estadoDir = $_REQUEST['nomEstado'];
	echo "<script type='text/javascript'>
		$(document).ready(function() {
	    	$('#cp').val('".$codigoPostalDir."');
	    	$('#loc').val('".$localidadDir."');
	    	$('#mun').val('".$municipioDir."');
	    	$('#est').val('".$estadoDir."');
	    	$('#pais').val('MÉXICO');
	    	$('#opcDireccion').dialog('close');
		});
	</script>";
?>