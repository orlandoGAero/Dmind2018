<?php require_once("../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datSubcatProducto = $fnSubcatProducto -> obtenerSubcategoriasProducto() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Subcategoría</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datSubcatProducto as $subcatProducto) : ?>
			<tr>
				<td><?=$subcatProducto['id_subcategoria']?></td>
				<td style="text-align: left;"><?=$subcatProducto['nombre_subcategoria']?></td>
				<td width="5%">
					<!--id -->
					<?php $idSubcatProd = encrypt($subcatProducto['id_subcategoria'],"subcategoriasProductoDM") ?>
					<a href="actualizar_subcategoriap.php?IDsubcategoria=<?=$idSubcatProd?>" class="EditSubcatProd"><img src="../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtIdSubcatProd" readonly value="<?=$idSubcatProd?>" />
						<button type="button" class="deleteSubcatProd">
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
		$('.deleteSubcatProd').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tbSubcatProduct').load('eliminar_subcategoriap.php',$(formDel).serialize());
			}
		});
		$('.EditSubcatProd').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>