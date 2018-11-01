<?php require_once("../../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datEstadosInv = $fnEstadosInv -> obtenerEstadosInventario() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Estado</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datEstadosInv as $estadoInv) : ?>
			<tr>
				<td><?=$estadoInv['id_estado']?></td>
				<td style="text-align: left;"><?=$estadoInv['nombre_estado']?></td>
				<td width="5%">
					<!--id -->
					<?php $idEstadoInv = encrypt($estadoInv['id_estado'],"estadosInventarioDM") ?>
					<a href="actualizar_estadoi.php?IDestado=<?=$idEstadoInv?>" class="EditEstInv"><img src="../../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtIdEstInv" readonly value="<?=$idEstadoInv?>" />
						<button type="button" class="deleteEstInv">
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
		$('.deleteEstInv').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tbEstadosInv').load('eliminar_estadoi.php',$(formDel).serialize());
			}
		});
		$('.EditEstInv').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>