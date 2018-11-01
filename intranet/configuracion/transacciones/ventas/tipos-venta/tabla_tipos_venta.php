<?php require_once("../../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datTipVenta = $fnTipVenta -> obtenerTiposVenta() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Tipo</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datTipVenta as $tipVenta) : ?>
			<tr>
				<td><?=$tipVenta['id_tipo_venta']?></td>
				<td style="text-align: left;"><?=$tipVenta['nom_tipo_venta']?></td>
				<td width="5%">
					<!--id -->
					<?php $idTipVenta = encrypt($tipVenta['id_tipo_venta'],"TiposVentaDM") ?>
					<a href="actualizar_tipo_venta.php?IDtipo=<?=$idTipVenta?>" class="EditTipVent"><img src="../../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtIdTipVenta" readonly value="<?=$idTipVenta?>" />
						<button type="button" class="deleteTipVent">
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
		$('.deleteTipVent').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tbTiposVenta').load('eliminar_tipo_venta.php',$(formDel).serialize());
			}
		});
		$('.EditTipVent').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>