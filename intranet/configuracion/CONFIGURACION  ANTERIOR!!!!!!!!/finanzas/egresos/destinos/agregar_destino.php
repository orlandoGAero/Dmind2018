<?php
	// Sesión
    require_once('../sesion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Agregar Destino</title>
</head>
<body>
	<form action="" id="form_des" method="POST" target="_self">
		<h2 class="formarriba">Nuevo Destino</h2>
		<center>
			<div class="camps"><br>
				<label>Destino :</label><br>
				<input type="text" name="nom_des" required/><br><br>
			</div>
		</center>
		
		<center>
			<div style="background:#16555B;" class="formabajo"><br>
				<input type="submit" name="btn_des" id="btn_des" value="Registrar" class="btn primary" />
				<input type="reset" value="Limpiar" id="btn_limpiar" class="btn" />
			</div>
		</center>
	</form>
	<div id="result"></div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#form_des").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_destino.php?" + $("#form_des").serialize());
		});
	});
</script>