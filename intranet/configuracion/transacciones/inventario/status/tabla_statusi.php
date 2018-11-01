<?php require_once("../../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datStatusInv = $fnStatusInv -> obtenerStatusInventario() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Status</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datStatusInv as $statusInv) : ?>
			<tr>
				<td><?=$statusInv['id_status']?></td>
				<td style="text-align: left;"><?=$statusInv['nombre_status']?></td>
				<td width="5%">
					<!--id -->
					<?php $idStatusInv = encrypt($statusInv['id_status'],"statusInventarioDM") ?>
					<a href="actualizar_statusi.php?IDstatus=<?=$idStatusInv?>" class="EditStInv"><img src="../../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtIdStInv" readonly value="<?=$idStatusInv?>" />
						<button type="button" class="deleteStInv">
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
		$('.deleteStInv').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tbStatusInv').load('eliminar_statusi.php',$(formDel).serialize());
			}
		});
		$('.EditStInv').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>