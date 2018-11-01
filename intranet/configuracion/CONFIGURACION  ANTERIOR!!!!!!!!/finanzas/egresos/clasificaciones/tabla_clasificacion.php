<?php if($datCl = $class_eg -> obtener_cla() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Clasificación</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datCl as $clasifica) : ?>
			<tr>
				<td><?=$clasifica['id_clasifi']?></td>
				<td style="text-align: left;"><?=$clasifica['nom_clasifi']?></td>
				<td width="5%">
					<!--id -->
					<?php $idCl = $clasifica['id_clasifi'] ?>
					<a href="actualizar_clasificacion.php?idCla=<?=$idCl?>" class="EditCl"><img src="../../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txt_idcl" readonly value="<?=$idCl?>" />
						<button type="button" class="deletecl">
							<img src="../../../../images/eliminar.png" title="Borrar" alt="Borrar">
						</button>
					</form>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<br />
	<?php else :?>
		<div class="vacio">
			(Sin registros)
		</div>
<?php endif; ?>
<script type="text/javascript">
	$(document).ready(function(){

		$('.deletecl').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tb_cla').load('eliminar_clasificacion.php',$(formDel).serialize());
			}
		});

		$('.EditCl').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>
