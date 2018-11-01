<?php require_once("../../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datStVenta = $fnStVenta -> obtenerStatusVenta() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Status</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datStVenta as $stVenta) : ?>
			<tr>
				<td><?=$stVenta['id_status_venta']?></td>
				<td style="text-align: left;"><?=$stVenta['nombre_status_venta']?></td>
				<td width="5%">
					<!--id -->
					<?php $idStVenta = encrypt($stVenta['id_status_venta'],"statusVentaDM") ?>
					<a href="actualizar_status_venta.php?IDstatus=<?=$idStVenta?>" class="EditStVent"><img src="../../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtIdStVenta" readonly value="<?=$idStVenta?>" />
						<button type="button" class="deleteStVent">
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
		$('.deleteStVent').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tb_staVnt').load('eliminar_status_venta.php',$(formDel).serialize());
			}
		});
		$('.EditStVent').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>