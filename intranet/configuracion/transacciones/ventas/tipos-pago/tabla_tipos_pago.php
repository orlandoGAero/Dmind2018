<?php require_once("../../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datTiposPago = $fnTiposPago -> obtenerTiposPago() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Forma de Pago</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datTiposPago as $tiposPago) : ?>
			<tr>
				<td><?=$tiposPago['id_tipo_pago']?></td>
				<td style="text-align: left;"><?=$tiposPago['nom_tipo_pago']?></td>
				<td width="5%">
					<!--id -->
					<?php $idTiposPago = encrypt($tiposPago['id_tipo_pago'],"tiposPagoDM") ?>
					<a href="actualizar_tipo_pago.php?IDformaPago=<?=$idTiposPago?>" class="EditTipoPago"><img src="../../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtIdTipoPago" readonly value="<?=$idTiposPago?>" />
						<button type="button" class="deleteTipoPago">
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
		$('.deleteTipoPago').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tbTiposPagos').load('eliminar_tipo_pago.php',$(formDel).serialize());
			}
		});
		$('.EditTipoPago').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>