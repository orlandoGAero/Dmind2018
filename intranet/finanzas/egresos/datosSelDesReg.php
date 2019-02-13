<?php
	require_once('../../class/egresos.php');
	$classEgresos = new egresos();
	 
	$datosDestino = $classEgresos -> listaDestinos();
?>
<select name="sltDestino" id="">
	<option value="" selected>Elige</option>
	<?php foreach($datosDestino as $destino) :?>
		<option value="<?=$destino['nom_destino']?>"><?=$destino['nom_destino']?></option>
	<?php endforeach; ?>
</select>