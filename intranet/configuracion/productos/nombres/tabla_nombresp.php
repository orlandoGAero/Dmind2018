<?php require_once("../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datNombresProd = $fnNombresP -> obtenerNombresProducto() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datNombresProd as $nombreProd) : ?>
			<tr>
				<td><?=$nombreProd['id_nombre']?></td>
				<td style="text-align: left;"><?=$nombreProd['nombre']?></td>
				<td width="5%">
					<!--id -->
					<?php $idNombreProd = encrypt($nombreProd['id_nombre'],"nombresProductoDM") ?>
					<a href="actualizar_nombrep.php?IDnombre=<?=$idNombreProd?>" class="EditNomProd"><img src="../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtIdNomProd" readonly value="<?=$idNombreProd?>" />
						<button type="button" class="deleteNomProd">
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
		$('.deleteNomProd').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDel = this.form;
				$('#tbNombresProd').load('eliminar_nombrep.php',$(formDel).serialize());
			}
		});
		$('.EditNomProd').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>