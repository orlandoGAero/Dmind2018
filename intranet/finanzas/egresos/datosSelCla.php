<?php 
	require_once('../../class/egresos.php');
	$classEgresos = new egresos();

	if (isset($_REQUEST['idE'])) {
		$idEg = $_REQUEST['idE'];

		$ModE = $classEgresos -> datosEditarEgreso($idEg);
	}
 ?>
<select name="sltClasificacion">
	<?php if($ModE['clasificacion'] == "") :?>
		<option value="" selected="">Elige</option>
		<!-- Todas las clasificaciones registradas -->
		<?php $datosClasif = $classEgresos -> listaClasificaciones() ?>
		<?php foreach($datosClasif as $clasif) :?>
			<option value="<?=$clasif['nom_clasifi']?>"><?=$clasif['nom_clasifi']?></option>
		<?php endforeach ?>
	<?php else :?>
		<option value="<?=$ModE['clasificacion']?>"><?=$ModE['clasificacion']?></option>
		<!-- Clasificaciones Diferentes a la Seleccionada -->
		<?php $DiffDatosClasif = $classEgresos -> listaClasificacionesDiff($ModE['clasificacion']) ?>
		<?php foreach($DiffDatosClasif as $DiffClasif) :?>
			<option value="<?=$DiffClasif['nom_clasifi']?>"><?=$DiffClasif['nom_clasifi']?></option>
		<?php endforeach; ?>
	<?php endif; ?>
</select>
