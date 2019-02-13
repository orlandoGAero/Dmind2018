<?php 
	require_once('../../class/egresos.php');
	$classEgresos = new egresos();

	$datosClasif = $classEgresos -> listaClasificaciones();
 ?>
 <select name="sltClasificacion">
	<option value="" selected>Elige</option>
	<?php foreach($datosClasif as $clasif) :?>
		<option value="<?=$clasif['nom_clasifi']?>"><?=$clasif['nom_clasifi']?></option>
	<?php endforeach; ?>
</select>