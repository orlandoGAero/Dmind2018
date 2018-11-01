<?php
	// Sesión
    require_once('../../sesion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Agregar Direcci&oacute;n</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_dir" method="POST" target="_self">
		<h2 class="formarriba">Nueva Direcci&oacute;n</h2>
		<center>
			<div class="camps"><br>
				<label>Calle:</label><br>
				<input type="text" name="txt_calle" required/><br><br>
				<label>No.EXT:</label><br>
				<input type="text" name="txt_ext"  required/><br><br>
				<label>No.INT:</label><br>
				<input type="text" name="txt_int"/><br><br>
				<label>Colonia:</label><br>
				<input type="text" name="txt_col"  required/><br><br>
				<label>Localidad:</label><br>
				<input type="text" name="txt_loc"  required><br><br>
				<label>Referencia:</label><br>
				<input type="text" name="txt_ref"/><br><br>
				<label>Municipio:</label><br>
				<input type="text" name="txt_mun" required><br><br>
				<label>Estado:</label><br>
				<input type="text" name="txt_est" required><br><br>
				<label>País:</label><br>
				<input type="text" name="txt_pai" required><br><br>
				<label>Código Postal:</label><br>
				<input type="number" name="txt_cp" required><br><br>
				<label>Sucursal:</label><br>
				<input type="text" name="txt_suc"/><br><br>
				<label>Ubicación GPS:</label><br>
				<input type="text" name="txt_gps"/><br><br>
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
		$("#form_dir").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_direccion.php?" + $("#form_dir").serialize());
		});
	});
</script>