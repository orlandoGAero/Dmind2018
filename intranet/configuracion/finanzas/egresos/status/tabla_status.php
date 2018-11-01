<?php if($datSt = $class_eg -> obtener_status() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Status</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datSt as $status) : ?>
			<tr>
				<td><?=$status['id_status']?></td>
				<td style="text-align: left;"><?=$status['nom_status']?></td>
				<td width="5%">
					<!--id -->
					<?php $idSt = $status['id_status'] ?>
					<a href="actualizar_status.php?idSta=<?=$idSt?>" class="EditSt"><img src="../../../../images/editar.png" title="Editar" class="editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txt_idSt" readonly value="<?=$idSt?>" />
						<button type="button" class="deletest">
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

		$('.deletest').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tb_sta').load('eliminar_status.php',$(formDel).serialize());
			}
		});

		$('.EditSt').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>
