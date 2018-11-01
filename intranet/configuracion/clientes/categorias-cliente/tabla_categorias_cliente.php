<?php require_once("../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datCatClie = $fnCatClie -> obtenerCategoriasCliente() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Categoría</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datCatClie as $catClie) : ?>
			<tr>
				<td><?=$catClie['id_categoria_cliente']?></td>
				<td style="text-align: left;"><?=$catClie['nombre_categoria_cliente']?></td>
				<td width="5%">
					<!--id -->
					<?php $idCatClie = encrypt($catClie['id_categoria_cliente'],"categoriasClienteDM") ?>
					<a href="actualizar_categoria_cliente.php?IDcategoria=<?=$idCatClie?>" class="EditCatClie"><img src="../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtIdCatClie" readonly value="<?=$idCatClie?>" />
						<button type="button" class="deleteCatClie">
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
		$('.deleteCatClie').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tb_catClient').load('eliminar_categoria_cliente.php',$(formDel).serialize());
			}
		});
		$('.EditCatClie').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>