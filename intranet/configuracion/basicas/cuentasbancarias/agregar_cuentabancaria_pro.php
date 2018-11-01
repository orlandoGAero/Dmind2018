<?php
	// Sesión
    require_once('../../sesion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Agregar Cuenta Bancaria</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="formRegCueBa" method="POST" target="_self">
		<h2 class="formarriba">Nueva Cuenta Bancaria</h2>
		<center>
			<div class="camps"><br>
				<label>No. de Cuenta:</label><br>
				<input type="text" name="txtNumCuentaB" maxlength="18" required/><br><br>
			</div>
		</center>
		<center>
			<div style="background:#16555B;" class="formabajo"><br>
				<input type="submit" value="Registrar" class="btn primary" />
				<input type="reset" value="Limpiar" class="btn" />
			</div>
		</center>
	</form>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#formRegCueBa").submit(function(guardar) {
			guardar.preventDefault();
			$.post('guardar_cuentabancaria_pro.php', $("#formRegCueBa").serialize())
			.done(function(data) {
				$('#result').html(data);
			});
		});
	});
</script>