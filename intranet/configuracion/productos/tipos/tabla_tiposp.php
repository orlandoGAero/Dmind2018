<?php require_once("../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datTiposProd = $fnTiposP -> obtenerTiposProducto() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Tipo</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datTiposProd as $tipoProd) : ?>
			<tr>
				<td><?=$tipoProd['id_tipo']?></td>
				<td style="text-align: left;"><?=$tipoProd['nombre_tipo']?></td>
				<td width="5%">
					<!--id -->
					<?php $idTipoProd = encrypt($tipoProd['id_tipo'],"tiposProductoDM") ?>
					<a href="actualizar_tipop.php?IDtipo=<?=$idTipoProd?>" class="EditTipProd"><img src="../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtIdTipProd" readonly value="<?=$idTipoProd?>" />
						<button type="button" class="deleteTipProd">
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
		$('.deleteTipProd').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tbTiposProd').load('eliminar_tipop.php',$(formDel).serialize());
			}
		});
		$('.EditTipProd').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>