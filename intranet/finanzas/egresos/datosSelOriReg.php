<?php
	require_once('../../class/egresos.php');
	$classEgresos = new egresos();

	$datosOrigen = $classEgresos -> listaOrigenes();
?>
<select name="sltOrigen" id="">
	<option value="" selected>Elige</option>
	<?php foreach($datosOrigen as $origen) :?>
		<option value="<?=$origen['nom_origen']?>"><?=$origen['nom_origen']?></option>
	<?php endforeach; ?>
</select>