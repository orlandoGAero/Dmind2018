<?php require_once("../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datFiscales = $fnDatFis -> obtenerDatosFiscales() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Razón Social</th>
			<th>RFC</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datFiscales as $dFiscales) : ?>
			<tr>
				<td><?=$dFiscales['id_dfiscales_e']?></td>
				<td><?=$dFiscales['razon_social_e']?></td>
				<td ><?=$dFiscales['rfc_e']?></td>
				<td width="5%">
					<!--id -->
					<?php $idDatosFiscales = encrypt($dFiscales['id_dfiscales_e'], "dfiscalesID") ?>
					<a href="actualizar_datfiscales.php?datosfiscales=<?=$idDatosFiscales?>" class="EditDatF"><img src="../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtIdDatF" readonly value="<?=$idDatosFiscales?>" />
						<button type="button" class="deleteDatF">
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
		$('.deleteDatF').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tbDatosFiscales').load('eliminar_datfiscales.php',$(formDel).serialize());
			}
		});
		$('.EditDatF').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>