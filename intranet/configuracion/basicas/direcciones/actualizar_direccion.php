<?php
	 // Sesión
    require_once('../../sesion.php');
    require ('classDirecciones.php');
    $fnDirecciones = new Direcciones();
	require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	$idDir = decrypt($_GET['id_dir'],"direccionesDM");
    $DatosDireccion = $fnDirecciones -> obtenerDatosDireccion($idDir);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Dirección</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_dir" method="POST" target="_self">
		<h2 class="formarriba">Editar Direcci&oacute;n</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txtidDir" value="<?=$idDir?>">
				<label>Calle:</label><br>
				<input type="text" name="txt_calle"  value="<?=$DatosDireccion['calle']?>" required/><br><br>
				<label>No.EXT:</label><br>
				<input type="text" name="txt_ext"   value="<?=$DatosDireccion['num_ext']?>" required/><br><br>
				<label>No.INT:</label><br>
				<input type="text" name="txt_int" value="<?=$DatosDireccion['num_int']?>" /><br><br>
				<label>Colonia:</label><br>
				<input type="text" name="txt_col"  value="<?=$DatosDireccion['colonia']?>"  required/><br><br>
				<label>Localidad:</label><br>
				<input type="text" name="txt_loc"  value="<?=$DatosDireccion['localidad']?>"  required><br><br>
				<label>Referencia:</label><br>
				<input type="text" name="txt_ref" value="<?=$DatosDireccion['referencia']?>" /><br><br>
				<label>Municipio:</label><br>
				<input type="text" name="txt_mun"  value="<?=$DatosDireccion['municipio']?>" required><br><br>
				<label>Estado:</label><br>
				<input type="text" name="txt_est"  value="<?=$DatosDireccion['estado']?>" required><br><br>
				<label>País:</label><br>
				<input type="text" name="txt_pai"  value="<?=$DatosDireccion['pais']?>" required><br><br>
				<label>Código Postal:</label><br>
				<input type="number" name="txt_cp"  value="<?=$DatosDireccion['cod_postal']?>" required><br><br>
				<label>Sucursal:</label><br>
				<input type="text" name="txt_suc" value="<?=$DatosDireccion['sucursal']?>" /><br><br>
				<label>Ubicación GPS:</label><br>
				<input type="text" name="txt_gps" value="<?=$DatosDireccion['gps_ubicacion']?>" /><br><br>
			</div>
		</center>
		<center>
			<div style="background:#16555B;" class="formabajo"><br>
				<input type="submit" value="Modificar" class="btn primary" />
				<input type="button" value="Limpiar" id="btnLimpiar" class="btn" />
			</div>
		</center>
	</form>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#btnLimpiar').click(function(){
			$(':input','#form_dir')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		});
		$("#form_dir").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_modificacion_direccion.php?" + $("#form_dir").serialize());
		});
	});
</script>