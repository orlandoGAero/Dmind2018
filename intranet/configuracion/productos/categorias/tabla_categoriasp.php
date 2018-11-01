<?php require_once("../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datCatProducto = $fnCatProducto -> obtenerCategoriasProducto() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Categoría</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datCatProducto as $catProducto) : ?>
			<tr>
				<td><?=$catProducto['id_categoria']?></td>
				<td style="text-align: left;"><?=$catProducto['nombre_categoria']?></td>
				<td width="5%">
					<!--id -->
					<?php $idCatProd = encrypt($catProducto['id_categoria'],"categoriasProductoDM") ?>
					<a href="actualizar_categoriap.php?IDcategoria=<?=$idCatProd?>" class="EditCatProd"><img src="../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtIdCatProd" readonly value="<?=$idCatProd?>" />
						<button type="button" class="deleteCatProd">
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
		$('.deleteCatProd').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tbCatProduct').load('eliminar_categoriap.php',$(formDel).serialize());
			}
		});
		$('.EditCatProd').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>