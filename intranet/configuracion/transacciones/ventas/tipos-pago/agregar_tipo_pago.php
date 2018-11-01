<?php
	// Sesión
    require_once('../../../sesion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Agregar Forma de Pago</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_tipoPago" method="POST" target="_self">
		<h2 class="formarriba">Nueva Forma de Pago</h2>
		<center>
			<div class="camps"><br>
				<label>Nombre:</label><br>
				<input type="text" name="txtNameFormaPago" required/><br><br>
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
		$("#form_tipoPago").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_tipo_pago.php?" + $("#form_tipoPago").serialize());
		});
	});
</script>