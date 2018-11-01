<?php require_once("../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datCueBan = $fnCueBan -> obtenerCuentasBancarias() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Número de Cuentas Bancarias</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datCueBan as $cueBancarias) : ?>
			<tr>
				<td><?=$cueBancarias['id_cbancarias_p']?></td>
				<td><?=$cueBancarias['num_cbancaria_p']?></td>
				<td width="5%">
					<!--id -->
					<?php $idCueBancaria = encrypt($cueBancarias['id_cbancarias_p'], "cbancariaID") ?>
					<a href="actualizar_cuentabancaria_pro.php?cuentabancaria=<?=$idCueBancaria?>" class="EditCueBank"><img src="../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtIdCuentaB" readonly value="<?=$idCueBancaria?>" />
						<button type="button" class="deleteCueBank">
							<img src="../../../images/eliminar.png" title="Borrar" alt="Borrar">
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
		$('.deleteCueBank').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$.post('eliminar_cuentabancaria_pro.php', $(formDel).serialize())
				.done (function(data) {
					$('#tb_cuentasBancarias').html(data);
				});
			}
		});
		$('.EditCueBank').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>