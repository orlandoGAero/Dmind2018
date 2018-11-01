<?php
	// Sesión
    require_once('../../sesion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Agregar Datos Fiscales</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="formRegDatF" method="POST" target="_self">
		<h2 class="formarriba">Nuevo Dato Fiscal</h2>
		<center>
			<div class="camps"><br>
				<label>Razón Social:</label><br>
				<input type="text" name="txtRazSoc" maxlength="75" required/><br><br>
				<label>RFC:</label><br>
				<input type="text" name="txtRfc" maxlength="13" required/><br><br>
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
		$("#formRegDatF").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_datfiscales.php?" + $("#formRegDatF").serialize());
		});
	});
</script>