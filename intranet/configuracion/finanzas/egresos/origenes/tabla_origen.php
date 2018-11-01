<?php if($datOri = $class_eg -> obtener_origen() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Origen</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datOri as $origen) : ?>
			<tr>
				<td><?=$origen['id_origen']?></td>
				<td style="text-align: left;"><?=$origen['nom_origen']?></td>
				<td width="5%">
					<!--id -->
					<?php $idOrig = $origen['id_origen'] ?>
					<a href="actualizar_origen.php?idOri=<?=$idOrig?>" class="EditOr"><img src="../../../../images/editar.png" title="Editar" class="editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txt_idOrig" readonly value="<?=$idOrig?>" />
						<button type="button" class="deleteor">
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

		$('.deleteor').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tb_ori').load('eliminar_origen.php',$(formDel).serialize());
			}
		});

		$('.EditOr').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>
