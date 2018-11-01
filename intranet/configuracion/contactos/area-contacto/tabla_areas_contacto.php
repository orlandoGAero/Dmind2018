<?php require_once("../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datAreasContacto = $fnAreasContacto -> obtenerAreasContacto() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Área</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datAreasContacto as $areasContacto) : ?>
			<tr>
				<td><?=$areasContacto['id_areacontacto']?></td>
				<td style="text-align: left;"><?=$areasContacto['nombre_areacontacto']?></td>
				<td width="5%">
					<!--id -->
					<?php $idAreaContact = encrypt($areasContacto['id_areacontacto'],"areasContactoDM") ?>
					<a href="actualizar_area_contacto.php?IDarea=<?=$idAreaContact?>" class="EditAreaCont"><img src="../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtIdAreaCont" readonly value="<?=$idAreaContact?>" />
						<button type="button" class="deleteAreaCont">
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
		$('.deleteAreaCont').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tbAreasContact').load('eliminar_area_contacto.php',$(formDel).serialize());
			}
		});
		$('.EditAreaCont').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>