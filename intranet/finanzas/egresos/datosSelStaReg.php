<?php 
	require_once('../../class/egresos.php');
	$classEgresos = new egresos();

	$datosStatus = $classEgresos -> listaStatus();
?>
<select name="sltStatus" id="statusEgreso">
	<option value="" selected>Elige</option>
	<?php foreach($datosStatus as $status) :?>
		<option value="<?=$status['nom_status']?>"><?=$status['nom_status']?></option>
	<?php endforeach; ?>
</select>