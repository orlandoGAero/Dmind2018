<?php
	//Clase de Saldos.
	require '../../class/saldos.php';
	$fnSaldos = new saldos();
	$totalEgreso = $_REQUEST['precioTotalE'];
	$egresoId = $_REQUEST['idEgreso'];
	$saldoId = $_REQUEST['idSaldo'];
	$cargoSaldo = $_REQUEST['cargoDeSaldo'];
	$fecPagoEgreso = $_REQUEST['fecSaldo'];
	$cuentaBancariaEgreso = $_REQUEST['numCueB'];
	// Buscar si se han registrado pagos parciales.
	$resultadoBusqueda = $fnSaldos -> buscarPagosParcialesE($egresoId);
	// Función para registrar pagos parciales. Relacionar un egreso con varios saldos.
	$fnSaldos -> registrarPagosParcialesE($egresoId, $saldoId, $fecPagoEgreso, $cuentaBancariaEgreso, $totalEgreso, $cargoSaldo);
    // Suma total de los pagos parciales registrados.
	$totalCargos = $fnSaldos -> totalPagosParciales($egresoId);
?>

<script type='text/javascript'>
	$(document).ready(function() {
		// Definición de variables.
    	var preTot = <?=$totalEgreso?>, // Precio total de la factura.
    	    preTotCar = <?=$totalCargos?>, // Precio total de los cargos del saldo.
    	    relacionEgSa = <?=$resultadoBusqueda?>; // Búsqueda de pagos agregados.
    	// Si no se ha agregado un pago, carga la fecha de pago y el número de cuenta en el input text correspondiente. 
    	if (relacionEgSa == 0) {
	    	$('#FechaHoraPago').val('<?=$fecPagoEgreso?>'); // Agrega el valor de la Fecha Hora Pago.
	    	$('#numCuenta').val('<?=$cuentaBancariaEgreso?>'); // Agrega el valor del Número de Cuenta.
    	}
    	// Si el precio total coincide con el total de pagos abonados, el status cambia a PAGADO.
    	if(preTot == preTotCar) {
    		$('#statusEgreso').html("<option value='PAGADO' selected>PAGADO</option>").fadeIn();
    		$('#obtenerCargoS').remove(); // Si se completa el pago, remueve el botón de Obtener Cargo.
    	} else { // Si el precio total no coincide con el total de pagos abonados, el status se define como PARCIALIDAD.
    		$('#statusEgreso').html("<option value='PARCIALIDAD' selected>PARCIALIDAD</option>").fadeIn();
    	}
    	// Actualiza la tabla de los pagos agregados.
    	$.post('pagos_parciales.php', {egreso: <?=$egresoId?>, totalFacturaE: preTot}).
    	done(function(result) {
    		$('#pagosParcialesAgregados').html(result);
    	});
    	// Cierra la ventana modal.
    	$('#opcionesCargoSaldo').dialog('close');
	});
</script>