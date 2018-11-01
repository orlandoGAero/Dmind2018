<?php require_once("../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datMarcas = $fnMarcas -> obtenerMarcas() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Marca</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datMarcas as $marcas) : ?>
			<tr>
				<td><?=$marcas['id_marca']?></td>
				<td style="text-align: left;"><?=$marcas['nombre_marca']?></td>
				<td width="5%">
					<!--id -->
					<?php $idMarca = encrypt($marcas['id_marca'],"marcasProductosDM") ?>
					<a href="actualizar_marca.php?IDmarca=<?=$idMarca?>" class="EditMarca"><img src="../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtIdMarca" readonly value="<?=$idMarca?>" />
						<button type="button" class="deleteMarca">
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
		$('.deleteMarca').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tbMarcas').load('eliminar_marca.php',$(formDel).serialize());
			}
		});
		$('.EditMarca').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>