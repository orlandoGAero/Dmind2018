<?php 
	require_once('../../class/egresos.php');
	$classEgresos = new egresos();

	if (isset($_REQUEST['idE'])) {
		$idEg = $_REQUEST['idE'];

		$ModE = $classEgresos -> datosEditarEgreso($idEg);
	}
 ?>
<select name="sltDestino">
	<?php if($ModE['destino'] == "") :?>
		<option value="" selected="">Elige</option>
		<!-- Todos los destinos registrados -->
		<?php $datosDestino = $classEgresos -> listaDestinos() ?>
		<?php foreach($datosDestino as $destino) :?>
			<option value="<?=$destino['nom_destino']?>"><?=$destino['nom_destino']?></option>
		<?php endforeach; ?>
	<?php else :?>
		<option value="<?=$ModE['destino']?>"><?=$ModE['destino']?></option>
		<!-- Destinos Diferentes al Seleccionado -->
		<?php $DiffDatosDestino = $classEgresos -> listaDestinosDiff($ModE['destino']) ?>
		<?php foreach($DiffDatosDestino as $DiffDestino) :?>
			<option value="<?=$DiffDestino['nom_destino']?>"><?=$DiffDestino['nom_destino']?></option>
		<?php endforeach; ?>
	<?php endif; ?>
</select>