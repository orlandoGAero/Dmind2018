<?php require_once("../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datUsuarios = $fnUsuarios -> obtenerUsuarios() ) : ?>
	<table class="datos-bd">
		<tr>
			<th>Id</th>
			<th>Usuario</th>
			<th>Email</th>
			<th>Tipo</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($datUsuarios as $fnUsuarios) : ?>
			<tr>
				<td><?=$fnUsuarios['id_usuario']?></td>
				<td><?=$fnUsuarios['usuario']?></td>
				<td><?=$fnUsuarios['email']?></td>
				<td><?=$fnUsuarios['tipo']?></td>
				<td width="5%">
					<!--id -->
					<?php $idUser = encrypt($fnUsuarios['id_usuario'],"usuariosDM") ?>
					<a href="actualizar_usuario.php?IDusuario=<?=$idUser?>" class="EditUser"><img src="../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtIdUser" readonly value="<?=$idUser?>" />
						<button type="button" class="deleteUser">
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
		$('.deleteUser').click(function(){
			if (confirm('¿Desea eliminar el usuario?')) {
				formDel = this.form;
				$('#tb_users').load('eliminar_usuario.php',$(formDel).serialize());
			}
		});
		$('.EditUser').fancybox({
			'transitionIn':'none',
			'transitionOut':'none',
			'width':350,
			'height':190,
			'type':'ajax'
		});
	});
</script>