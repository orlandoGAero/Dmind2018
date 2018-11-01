<?php require_once("../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datCatProv = $fnCatProv -> obtenerCategoriasProveedor() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Categoría</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datCatProv as $catProv) : ?>
			<tr>
				<td><?=$catProv['id_cat_prov']?></td>
				<td style="text-align: left;"><?=$catProv['nombre_cat_prov']?></td>
				<td width="5%">
					<!--id -->
					<?php $idCatProv = encrypt($catProv['id_cat_prov'],"categoriasProveedorDM") ?>
					<a href="actualizar_categoria_proveedor.php?IDcategoria=<?=$idCatProv?>" class="EditCatProv"><img src="../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtIdCatProv" readonly value="<?=$idCatProv?>" />
						<button type="button" class="deleteCatProv">
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
		$('.deleteCatProv').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tb_catProv').load('eliminar_categoria_proveedor.php',$(formDel).serialize());
			}
		});
		$('.EditCatProv').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>