<?php require_once("../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datTiposTrans = $fnTiposTransaccion -> obtenerTiposTransaccion() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Tipo</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datTiposTrans as $tiposTrans) : ?>
			<tr>
				<td><?=$tiposTrans['id_tipo_transaccion']?></td>
				<td style="text-align: left;"><?=$tiposTrans['nombre_tipo_transaccion']?></td>
				<td width="5%">
					<!--id -->
					<?php $idTipoTrans = encrypt($tiposTrans['id_tipo_transaccion'],"tiposTransaccionDM") ?>
					<a href="actualizar_tipost.php?IDtipo=<?=$idTipoTrans?>" class="EditTipoTrans"><img src="../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtIdTipoTrans" readonly value="<?=$idTipoTrans?>" />
						<button type="button" class="deleteTipoTrans">
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
		$('.deleteTipoTrans').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tbTiposTransaccion').load('eliminar_tipost.php',$(formDel).serialize());
			}
		});
		$('.EditTipoTrans').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>