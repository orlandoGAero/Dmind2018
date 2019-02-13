<?php 
	require_once('../../class/egresos.php');
	$classEgresos = new egresos();

	if (isset($_REQUEST['idE'])) {
		$idEg = $_REQUEST['idE'];

		$ModE = $classEgresos -> datosEditarEgreso($idEg);
	}
 ?>
<select name="sltOrigen">
	<?php if($ModE['origen'] == "") :?>
		<option value="" selected="">Elige</option>
		<!-- Todos los origenes registrados -->
		<?php $datosOrigen = $classEgresos -> listaOrigenes() ?>
		<?php foreach($datosOrigen as $origen) :?>
			<option value="<?=$origen['nom_origen']?>"><?=$origen['nom_origen']?></option>
		<?php endforeach; ?>
	<?php else :?>
		<option value="<?=$ModE['origen']?>"><?=$ModE['origen']?></option>
		<!-- Origenes Diferentes al Seleccionado -->
		<?php $DiffDatosOrigen = $classEgresos -> listaOrigenesDiff($ModE['origen']) ?>
		<?php foreach($DiffDatosOrigen as $DiffOrigen) :?>
			<option value="<?=$DiffOrigen['nom_origen']?>"><?=$DiffOrigen['nom_origen']?></option>
		<?php endforeach; ?>
	<?php endif; ?>
</select>