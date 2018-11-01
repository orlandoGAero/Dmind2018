<?php
	 // Sesión
    require_once('../sesion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Agregar Clasificación</title>
</head>
<body>
	<form action="" id="form_cl" method="POST" target="_self">
		<h2 class="formarriba">Nueva Clasificación</h2>
		<center>
			<div class="camps"><br>
				<label>Clasificación :</label><br>
				<input type="text" name="nom_cl" required/><br><br>
			</div>
		</center>
		
		<center>
			<div style="background:#16555B;" class="formabajo"><br>
				<input type="submit" name="btn_cl" id="btn_cl" value="Registrar" class="btn primary" />
				<input type="reset" value="Limpiar" id="btn_limpiar" class="btn" />
			</div>
		</center>
	</form>
	<div id="result"></div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#form_cl").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_clasificacion.php?" + $("#form_cl").serialize());
		});
	});
</script>