<?php require_once("../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datMonedas = $fnMonedas -> obtenerMonedas() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Moneda</th>
			<th>Valor</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datMonedas as $moneda) : ?>
			<tr>
				<td><?=$moneda['id_moneda']?></td>
				<td style="text-align: left;"><?=$moneda['nombre_moneda']?></td>
				<td style="text-align: left;"><?=$moneda['valor']?></td>
				<td width="5%">
					<!--id -->
					<?php $idMoneda = encrypt($moneda['id_moneda'],"monedasDM") ?>
					<a href="actualizar_moneda.php?IDmoneda=<?=$idMoneda?>" class="EditMoneda"><img src="../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtIdMoneda" readonly value="<?=$idMoneda?>" />
						<button type="button" class="deleteMoneda">
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
		$('.deleteMoneda').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tbMonedas').load('eliminar_moneda.php',$(formDel).serialize());
			}
		});
		$('.EditMoneda').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>