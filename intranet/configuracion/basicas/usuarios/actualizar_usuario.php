<?php
	 // Sesión
    require_once('../../sesion.php');
    require ('classUsuarios.php');
    $fnUsuarios = new Usuarios();
	require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	$idUser = decrypt($_GET['IDusuario'],"usuariosDM");
    $DatosUsuario = $fnUsuarios -> obtenerDatoUsuario($idUser);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Usuario</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_user" method="POST" target="_self">
		<h2 class="formarriba">Editar Usuario</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txtIDuser" value="<?=$idUser?>">
				<label>Usuario:</label><br>
				<input type="text" name="txtNameUser" value="<?=$DatosUsuario['usuario']?>" required/><br><br>
				<label>Email:</label><br>
				<input name="txtEmailUser" type="email" value="<?=$DatosUsuario['email']?>" required/><br><br>
				<label>Tipo:</label><br>
				<select name="sltTipo">
					<option value="administrador">Administrador</option>
				</select><br><br>
			</div>
		</center>
		<center>
			<div style="background:#16555B;" class="formabajo"><br>
				<input type="submit" value="Modificar" class="btn primary" />
				<input type="button" value="Limpiar" id="btnLimpiar" class="btn" />
			</div>
		</center>
	</form>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#btnLimpiar').click(function(){
			$(':input','#form_user')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		});
		$("#form_user").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_modificacion_usuario.php?" + $("#form_user").serialize());
		});
	});
</script>