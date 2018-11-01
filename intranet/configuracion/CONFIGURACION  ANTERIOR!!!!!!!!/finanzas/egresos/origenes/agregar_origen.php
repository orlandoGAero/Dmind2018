<?php
	// Sesión
    require_once('../sesion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Agregar Origen</title>
</head>
<body>
	<form action="" id="form_or" method="POST" target="_self">
		<h2 class="formarriba">Nuevo Origen</h2>
		<center>
			<div class="camps"><br>
				<label>Origen :</label><br>
				<input type="text" name="nom_ori" required/><br><br>
			</div>
		</center>
		
		<center>
			<div style="background:#16555B;" class="formabajo"><br>
				<input type="submit" name="btn_or" id="btn_or" value="Registrar" class="btn primary" />
				<input type="reset" value="Limpiar" id="btn_limpiar" class="btn" />
			</div>
		</center>
	</form>
	<div id="result"></div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#form_or").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_origen.php?" + $("#form_or").serialize());
		});
	});
</script>