<?php
	// Sesión
	require_once('../sesion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Agregar Concepto</title>
</head>
<body>
	<form action="" id="form_con" method="POST" target="_self">
		<h2 class="formarriba">Nuevo Concepto</h2>
		<center>
			<div class="camps"><br>
				<label>Concepto :</label><br>
				<input type="text" name="nom_con" required/><br><br>
			</div>
		</center>
		
		<center>
			<div style="background:#16555B;" class="formabajo"><br>
				<input type="submit" name="btn_co" id="btn_co" value="Registrar" class="btn primary" />
				<input type="reset" value="Limpiar" id="btn_limpiar" class="btn" />
			</div>
		</center>
	</form>
	<div id="result"></div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#form_con").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_concepto.php?" + $("#form_con").serialize());
		});
	});
</script>