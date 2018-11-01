<?php if($datDes = $class_eg -> obtener_destino() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Destino</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datDes as $destiny) : ?>
			<tr>
				<td><?=$destiny['id_destino']?></td>
				<td style="text-align: left;"><?=$destiny['nom_destino']?></td>
				<td width="5%">
					<!--id -->
					<?php $idDest = $destiny['id_destino'] ?>
					<a href="actualizar_destino.php?idDes=<?=$idDest?>" class="EditDes"><img src="../../../../images/editar.png" title="Editar" class="editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txt_idDest" readonly value="<?=$idDest?>" />
						<button type="button" class="deletedes">
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

		$('.deletedes').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tb_des').load('eliminar_destino.php',$(formDel).serialize());
			}
		});

		$('.EditDes').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>
