<?php 
	require_once('../../class/egresos.php');
	$classEgresos = new egresos();

	if (isset($_REQUEST['idE'])) {
		$idEg = $_REQUEST['idE'];

		$ModE = $classEgresos -> datosEditarEgreso($idEg);
	}

 ?>
<select name="sltStatus" id="statusEgreso">
	<?php if($ModE['estado'] == "") :?>
		<option value="" selected="">Elige</option>
		<!-- Todos los status registrados -->
		<?php $datosStatus = $classEgresos -> listaStatus() ?>
		<?php foreach($datosStatus as $status) :?>
			<option value="<?=$status['nom_status']?>"><?=$status['nom_status']?></option>
		<?php endforeach; ?>
	<?php else :echo "hay status";?>
		<option value="<?=$ModE['estado']?>"><?=$ModE['estado']?></option>
		<!-- Status Diferentes al Seleccionado -->
		<?php $DiffDatosStatus = $classEgresos -> listaStatusDiff($ModE['estado']) ?>
		<?php foreach($DiffDatosStatus as $DiffStatus) :?>
			<option value="<?=$DiffStatus['nom_status']?>"><?=$DiffStatus['nom_status']?></option>
		<?php endforeach; ?>
	<?php endif; ?>
</select>

