<?php
	// Sesión
    require_once('../../../sesion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Agregar Status Venta</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_stVnt" method="POST" target="_self">
		<h2 class="formarriba">Nuevo Status Venta</h2>
		<center>
			<div class="camps"><br>
				<label>Nombre Status:</label><br>
				<input type="text" name="txtNameStVnt" required/><br><br>
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
		$("#form_stVnt").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_status_venta.php?" + $("#form_stVnt").serialize());
		});
	});
</script>