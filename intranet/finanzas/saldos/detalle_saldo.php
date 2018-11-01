<?php
	session_start();
	// Manejamos en sesión el nombre del usuario que se ha logeado
	if(!isset($_SESSION["usuario"])){
		header("location:../");  
	}
	$_SESSION["usuario"];
	// Termina inicio de sesión

	require('../../class/saldos.php');
	$fnSaldos = new saldos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title>Detalle de Saldo</title>
	<link rel="shortcut icon" type="image/x-icon" href="../../images/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="../../css/menu.css" />
	<link rel="stylesheet" type="text/css" href="../../css/tabla.css" />
	<link rel="stylesheet" type="text/css" href="../../libs/dataTables/css/datatables.css" />
	<link rel="stylesheet" type="text/css" href="../../css/pagos_egresos.css" />
</head>
<body>
	<header>
        <img src="../../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
    </header>
    <nav>
        <ul>
            <li><a href="../../Home" alt="Inicio" title="Inicio"><img src="../../images/home.png"/></a></li>
            <li></li>
            <li></li>
            <li></li>
            <li><spam style="color:#fff;"><?php echo $_SESSION["usuario"]; ?></spam></li>
            <li><a href="../../salir.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../../images/lock.png"/></a></li>
        </ul>
    </nav>

    <h1 style="text-align:center; color:rgba(0,191,255,.9);">
    	<a href="listar_saldos.php">
			<img class="atras" src="../../images/atras.png" title="Regresar">
		</a>Detalle Saldo
    </h1>

	<?php if (isset($_GET['saldo'])) : ?>
		<?php $idSaldo = $_GET['saldo']; ?>
		<?php if ($idSaldo != "") : ?>
			<?php $detSaldo = $fnSaldos -> detalleSaldo($idSaldo); ?>
			<?php
				$signoM = "$";
			?>
			<section>
				<table class="detalle">
					<tr>
						<th>Fecha</th>
						<td>
							<?php $fechaSaldo = date_format(date_create($detSaldo['fecha_s']), 'd-m-Y'); ?>
							<?=$fechaSaldo?>
						</td>
					</tr>
					<tr><th>Descripción</th><td><?=$detSaldo['descripcion_s']?></td></tr>
					<tr><th>Referencia</th><td><?=$detSaldo['referencia_s']?></td></tr>
					<tr><th>Cargos</th><td><b><?=$signoM?></b><?=number_format($detSaldo['cargos_s'], 2)?></td></tr>
					<tr><th>Abono</th><td><b><?=$signoM?></b><?=number_format($detSaldo['abonos_s'], 2)?></td></tr>
					<tr><th>Saldo</th><td><b><?=$signoM?></b><?=number_format($detSaldo['saldo'], 2)?></td></tr>
					<tr><th>Clasificación</th><td><?=$detSaldo['clasificacion_s']?></td></tr>
					<tr><th>Número de Cuenta</th><td><?=$detSaldo['num_cbancaria']?></td></tr>
					<tr><th>Estatus</th><td><?=$detSaldo['forma_pago']?></td></tr>
					<tr>
						<th>Fecha Registro</th>
						<td>
							<?php $fechaReg = date_format(date_create($detSaldo['fecha_registro']), 'd-m-Y H:i:s'); ?>
							<?=$fechaReg?>
						</td>
					</tr>
				</table>
			</section>
			<section id="pagos-saldos">
				<?php if ($detSaldo['forma_pago'] == 'parcial') : ?>
					<?php if ($pagoParcialSalEgr = $fnSaldos -> saldoEgresoPagoParcial($idSaldo, $fnSaldos -> obtenerIdEgreso($idSaldo))) : ?>
						<p class="titulo">Pago Parcial de Egreso</p>
						<table cellspacing="0" cellpadding="2" class="display tabla-pagos">
							<thead>
								<tr>
									<th>Fecha Pago</th>
									<th>Razón Social Emisor</th>
									<th>Folio Fiscal</th>
									<th>Monto</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($pagoParcialSalEgr as $pagoParcialE) :?>
									<tr>
										<td>
											<?php $fechaPagoS= $pagoParcialE['fecha_pago'] ?>
											<span style="display: none;"><?=$fechaPagoS?></span>
											<?php $fechaPagoS = date_format(date_create($fechaPagoS),'d-m-Y') ?>
											<?=$fechaPagoS?>
										</td>
										<td><?=$pagoParcialE['razon_social_emisor']?></td>
										<td><?=$pagoParcialE['folio_fiscal']?></td>
										<td><b>$</b><?=number_format($pagoParcialE['cargos_s'], 2)?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php endif; ?>
				<?php elseif (($detSaldo['forma_pago'] == 'completo') || ($detSaldo['forma_pago'] == 'completo-parcial')) : ?>
					<?php if ($pagoCompletoSalEgr = $fnSaldos -> pagosCompletos($idSaldo)) : ?>
						<p class="titulo">Pago Completo de Egreso</p>
						<table cellspacing="0" cellpadding="2" class="display tabla-pagos">
							<thead>
								<tr>
									<th>Fecha Pago</th>
									<th>Razón Social Emisor</th>
									<th>Folio Fiscal</th>
									<th>Monto</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($pagoCompletoSalEgr as $pagoCompletoE) :?>
									<tr>
										<td>
											<?php $fechaPagoS= $pagoCompletoE['fecha_pago'] ?>
											<span style="display: none;"><?=$fechaPagoS?></span>
											<?php $fechaPagoS = date_format(date_create($fechaPagoS),'d-m-Y') ?>
											<?=$fechaPagoS?>
										</td>
										<td><?=$pagoCompletoE['razon_social_emisor']?></td>
										<td><?=$pagoCompletoE['folio_fiscal']?></td>
										<td class="right"><b>$</b><?=number_format($pagoCompletoE['precio_acumulado'], 2)?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<p class="totales">
							<span>Restante:&nbsp;$</span><?=number_format(($detSaldo['cargos_s'] - $fnSaldos -> totalPagosCompletos($idSaldo)), 2)?>
							<span>Total:&nbsp;$</span><?=number_format($fnSaldos -> totalPagosCompletos($idSaldo), 2)?>
						</p>
					<?php endif; ?>
				<?php else : ?>
					<p class="sin-datos">Sin pagos de egresos</p>
				<?php endif; ?>
			</section>
		<?php endif; ?>
	<?php endif; ?>
</body>
</html>