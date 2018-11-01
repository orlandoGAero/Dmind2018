<?php require_once("../../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datUbicacionesInv = $fnUbicacionesInv -> obtenerUbicacionesInventario() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Ubicación</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datUbicacionesInv as $ubicacionInv) : ?>
			<tr>
				<td><?=$ubicacionInv['id_ubicacion']?></td>
				<td style="text-align: left;"><?=$ubicacionInv['nombre_ubicacion']?></td>
				<td width="5%">
					<!--id -->
					<?php $idUbicInv = encrypt($ubicacionInv['id_ubicacion'],"ubicacionesInventarioDM") ?>
					<a href="actualizar_ubicacioni.php?IDubicacion=<?=$idUbicInv?>" class="EditUbInv"><img src="../../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtIdUbicInv" readonly value="<?=$idUbicInv?>" />
						<button type="button" class="deleteUbicInv">
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
		$('.deleteUbicInv').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tbUbicacionesInv').load('eliminar_ubicacioni.php',$(formDel).serialize());
			}
		});
		$('.EditUbInv').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>