<?php
	require('../../class/saldos.php');
	$fnSaldos = new saldos();
	$saldosNumCuenta = array_combine($_REQUEST['txtIdSaldo'], $_REQUEST['numCuenta']);
	$fnSaldos -> agregarCuentaBancaria($saldosNumCuenta);
?>
<?php if(isset($fnSaldos -> agregado)) : ?>
	<?php if ($fnSaldos -> agregado == "correctamente") : ?>
		<script type="text/javascript">window.location.replace('listar_saldos.php')</script>
	<?php endif; ?>
<?php endif; ?>