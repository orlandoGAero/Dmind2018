<?php require_once("../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datDivisionProd = $fnDivisiones -> obtenerDivisionesProducto() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datDivisionProd as $divisionProd) : ?>
			<tr>
				<td><?=$divisionProd['id_division']?></td>
				<td style="text-align: left;"><?=$divisionProd['nombre_division']?></td>
				<td width="5%">
					<!--id -->
					<?php $idDivisionProd = encrypt($divisionProd['id_division'],"divisionesProductoDM") ?>
					<a href="actualizar_divisionp.php?IDdivision=<?=$idDivisionProd?>" class="EditDivProd"><img src="../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtIdDivProd" readonly value="<?=$idDivisionProd?>" />
						<button type="button" class="deleteDivProd">
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
		$('.deleteDivProd').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tbDivisionesProd').load('eliminar_divisionp.php',$(formDel).serialize());
			}
		});
		$('.EditDivProd').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>