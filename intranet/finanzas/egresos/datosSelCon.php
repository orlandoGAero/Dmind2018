<?php 
	require_once('../../class/egresos.php');
	$classEgresos = new egresos();

	if (isset($_REQUEST['idE'])) {
		$idEg = $_REQUEST['idE'];

		$ModE = $classEgresos -> datosEditarEgreso($idEg);
	}
 ?>
<select name="sltConcepto">
	<?php if($ModE['concepto'] == "") :?>
		<option value="" selected="">Elige</option>
		<!-- Todos los conceptos registrados -->
		<?php $datosConceptos = $classEgresos -> listaConceptos() ?>
		<?php foreach($datosConceptos as $concepto) :?>
			<option value="<?=$concepto['nom_concepto']?>"><?=$concepto['nom_concepto']?></option>
		<?php endforeach ?>
	<?php else :?>
		<option value="<?=$ModE['concepto']?>"><?=$ModE['concepto']?></option>
		<!-- Conceptos Diferentes al Seleccionado -->
		<?php $DiffDatosConceptos = $classEgresos -> listaConceptosDiff($ModE['concepto']) ?>
		<?php foreach($DiffDatosConceptos as $Diffconcepto) :?>
			<option value="<?=$Diffconcepto['nom_concepto']?>"><?=$Diffconcepto['nom_concepto']?></option>
		<?php endforeach ?>
	<?php endif; ?>
</select>
