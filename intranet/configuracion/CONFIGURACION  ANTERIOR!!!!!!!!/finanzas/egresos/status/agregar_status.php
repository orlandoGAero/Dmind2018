<?php
	// Sesión
    require_once('../sesion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Agregar Status</title>
</head>
<body>
	<form action="" id="form_st" method="POST" target="_self">
		<h2 class="formarriba">Nuevo Status</h2>
		<center>
			<div class="camps"><br>
				<label>Status :</label><br>
				<input type="text" name="nom_status" required/><br><br>
			</div>
		</center>
		
		<center>
			<div style="background:#16555B;" class="formabajo"><br>
				<input type="submit" name="btn_s" id="btn_s" value="Registrar" class="btn primary" />
				<input type="reset" value="Limpiar" id="btn_limpiar" class="btn" />
			</div>
		</center>
	</form>
	<div id="result"></div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#form_st").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_status.php?" + $("#form_st").serialize());
		});
	});
</script>