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
	if (isset($_REQUEST['completarpago'])) {
		$completarPagoEgreso = $_REQUEST['completarpago'];
	} else {
		$completarPagoEgreso = NULL;
	}
	// Función para registrar pagos completos. Relacionar un saldo con varios egresos.
	$fnSaldos -> registrarPagosCompletosE($egresoId, $saldoId, $fecPagoEgreso, $cuentaBancariaEgreso, $totalEgreso, $cargoSaldo, $completarPagoEgreso);
?>
<?php if (isset($fnSaldos -> msjAlerta)): ?>
	<div class='error'><h3><?=$fnSaldos -> msjAlerta?></h3></div>
<?php endif ?>
<script type='text/javascript'>
	$(document).ready(function() {
		// Definición de variables.
    	var preTotCar = <?=$cargoSaldo?>, // Precio total de los cargos del saldo.
    	    preTot = <?=$totalEgreso?>; // Precio total de la factura.
    	// Si el precio del cargo es mayor al precio total de la factura, el status cambia a PAGADO.
    	if(preTotCar >= preTot) {
            $('#FechaHoraPago').val('<?=$fecPagoEgreso?>'); // Agrega el valor de la Fecha Hora Pago.
            $('#numCuenta').val('<?=$cuentaBancariaEgreso?>'); // Agrega el valor del Número de Cuenta.
    		$('#statusEgreso').html("<option value='PAGADO' selected>PAGADO</option>").fadeIn();
    		$('#obtenerCargoS').remove(); // Remueve el botón de Obtener Cargo.
            // Cierra la ventana modal.
            $('#opcionesCargoSaldo').dialog('close');
    	}
    	// Mensaje error.
    	setTimeout(function(){
			$('.error').fadeOut(1000);
		},5000);
	});
</script>