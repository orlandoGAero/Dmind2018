<?php if($datCo = $class_eg -> obtener_concept() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Concepto</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datCo as $concept) : ?>
			<tr>
				<td><?=$concept['id_concepto']?></td>
				<td style="text-align: left;"><?=$concept['nom_concepto']?></td>
				<td width="5%">
					<!--id -->
					<?php $idCon = $concept['id_concepto'] ?>
					<a href="actualizar_concepto.php?idConc=<?=$idCon?>" class="EditCo"><img src="../../../../images/editar.png" title="Editar" class="editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txt_idCon" readonly value="<?=$idCon?>" />
						<button type="button" class="deletecon">
							<img src="../../../../images/eliminar.png" title="Borrar" class="eliminar">
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
		$('.deletecon').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tb_con').load('eliminar_concepto.php',$(formDel).serialize());
			}
		});

		$('.EditCo').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>
