<?php
	// Sesión
    require_once('../../sesion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Agregar Usuario</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_User" method="POST" target="_self">
		<h2 class="formarriba">Nuevo Usuario</h2>
		<center>
			<div class="camps"><br>
				<label>Usuario:</label><br>
				<input type="text" name="txtNameUser" required/><br><br>
				<label>Contrase&ntilde;a:</label><br>
				<input name="txtPassUser" type="password" required/><br><br>
				<label>Confirmar Contrase&ntilde;a:</label><br>
				<input name="confirmPassword" type="password" required/><br><br>
				<label>Email:</label><br>
				<input name="txtEmailUser" type="email" required/><br><br>
				<label>Tipo:</label><br>
				<select name="sltTipo">
					<option value="administrador">Administrador</option>
				</select><br><br>
			</div>
		</center>
		<center>
			<div style="background:#16555B;" class="formabajo"><br>
				<input type="submit" value="Registrar" class="btn primary" />
				<input type="reset" value="Limpiar" id="btn_limpiar" class="btn" />
			</div>
		</center>
	</form>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#form_User").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_usuario.php?" + $("#form_User").serialize());
		});
	});
</script>