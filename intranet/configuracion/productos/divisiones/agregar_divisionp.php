<?php
	// Sesión
    require_once('../../sesion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Agregar División</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_divisionProd" method="POST" target="_self">
		<h2 class="formarriba">Nueva División</h2>
		<center>
			<div class="camps"><br>
				<label>Nombre División:</label><br>
				<input type="text" name="txtNameDivProd" required/><br><br>
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
		$("#form_divisionProd").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_divisionp.php?" + $("#form_divisionProd").serialize());
		});
	});
</script>