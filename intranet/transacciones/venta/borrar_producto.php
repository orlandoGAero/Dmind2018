<?php
	require('../../conexion.php');
	require('funciones_ventas.php');

	$funcVentas = new funciones_ventas();

	if(isset($_REQUEST['casilla'])){

		$id_checkbox = $_REQUEST['casilla'];

		foreach($id_checkbox as $idp) :
			$band = 0;
			if ($obtidp = $funcVentas -> borrar_producto($idp)){
				$band = 0;
			}
		endforeach;

	} else {
		$band = 1;
		echo "Seleccione al menos un producto, para eliminar";
	}

	echo "
	<script type='text/javascript'>
		var del = jQuery.noConflict();
		del(function() {
			var flag = ".$band.";
			if (flag == 0) {
				del('#tablaProductos').load('recargar_venta_detalle.php');
			}
		});
	</script>";
?>
