<?php require_once("../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datUnidadesProd = $fnUnidadesP -> obtenerUnidadesProducto() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Unidad</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datUnidadesProd as $unidadProd) : ?>
			<tr>
				<td><?=$unidadProd['id_unidad']?></td>
				<td style="text-align: left;"><?=$unidadProd['nombre_unidad']?></td>
				<td width="5%">
					<!--id -->
					<?php $idUnidadProd = encrypt($unidadProd['id_unidad'],"unidadesProductoDM") ?>
					<a href="actualizar_unidadp.php?IDunidad=<?=$idUnidadProd?>" class="EditUnidProd"><img src="../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtIdUnidProd" readonly value="<?=$idUnidadProd?>" />
						<button type="button" class="deleteUnidProd">
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
		$('.deleteUnidProd').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tbUnidadesProd').load('eliminar_unidadp.php',$(formDel).serialize());
			}
		});
		$('.EditUnidProd').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>