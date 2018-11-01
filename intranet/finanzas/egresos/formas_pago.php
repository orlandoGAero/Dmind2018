<?php
	// Muestra el contenido de acuerdo a la forma de pago.
	if($_REQUEST['tipopago']) :
		$idEgreso = $_REQUEST['egreso'];
		$totalInicial = $_REQUEST['preciototal'];
		$precioTotEgr = $totalInicial;
		switch ($_REQUEST['tipopago']) {
			case 'Si':
				include 'cargos_pago_parcial.php';
				break;
			case 'No':
				include 'cargos_pago_completo.php';
				break;
			default:
				echo "<p class='mensaje'>Hubo un error inesperado, vuelva a intentarlo.</p>";
				break;
		} // Fin Switch.
	endif;
?>