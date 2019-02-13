<?php 
	require_once('../../class/egresos.php');
	$classEgresos = new egresos();

	$datosConceptos = $classEgresos -> listaConceptos();
?>
<select name="sltConcepto">
	<option value="" selected>Elige</option>
	<?php foreach($datosConceptos as $concepto) :?>
		<option value="<?=$concepto['nom_concepto']?>"><?=$concepto['nom_concepto']?></option>
	<?php endforeach ?>
</select>