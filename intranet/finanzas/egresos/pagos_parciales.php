<?php
	//Clase Saldos
	require '../../class/saldos.php';
	$fnSaldos = new saldos();
?>
<?php if($infoPagosP = $fnSaldos -> pagosParciales($_REQUEST['egreso'])) : ?>
	<span class="azul">Pagos Agregados</span>
	<br><br>
	<table cellspacing="0" cellpadding="2" class="display" width="auto">
		<thead>
			<tr>
				<th>Fecha de Pago</th>
				<th>Cargo</th>
			</tr>
		</thead>
		<tbody>
			<?php $totalAbonado = 0; ?>
			<?php foreach($infoPagosP as $pagosP) : ?>
				<tr>
					<td>
						<?php $fPagoEgreso= $pagosP['fecha_pago'] ?>
						<?php $fPagoEgreso = date_format(date_create($fPagoEgreso),'d-m-Y') ?>
						<?=$fPagoEgreso?>
					</td>
					<td><b>$</b><?=number_format($pagosP['cargos_s'], 2)?></td>
					<?php $totalAbonado += $pagosP['cargos_s']; ?>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table><p>
		<i>Total Abonado:</i> <b>$</b><?=number_format($totalAbonado, 2)?>
		&nbsp;
		<?php $totalXpagar = number_format(($_REQUEST['totalFacturaE'] - $totalAbonado), 2); ?>
		<i>Por Pagar:</i> <b>$</b><?=$totalXpagar?>
		<input type="hidden" id="porPagar" value="<?=str_replace(',', '', $totalXpagar)?>" readonly>
	</p>
<?php endif; ?>