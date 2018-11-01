<?php
	require('../../class/saldos.php');
	$fnSaldos = new saldos();
	$numCuentaBan = $_REQUEST['cuentabancaria'];
?>
<option value="<?=$numCuentaBan?>"><?=$numCuentaBan?></option>
<?php foreach ($fnSaldos -> cuentasBancariasDiff($numCuentaBan) as $cuentaBan) :?>
	<option value='<?=$cuentaBan['num_cbancaria_p']?>'><?=$cuentaBan['num_cbancaria_p']?></option>
<?php endforeach; ?>