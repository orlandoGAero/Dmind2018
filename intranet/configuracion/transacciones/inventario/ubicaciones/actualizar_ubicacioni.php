<?php
	// Sesión
    require_once('../../../sesion.php');
    require ('classUbicacionesInv.php');
    $fnUbicacionesInv = new UbicacionesInv();
	require_once("../../../../libs/encrypt_decrypt_strings_urls.php");
	$idUbInv = decrypt($_GET['IDubicacion'],"ubicacionesInventarioDM");
    $DatosUbicacionInv = $fnUbicacionesInv -> obtenerDatoUbicacionInventario($idUbInv);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Ubicación</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_ubicacionInv" method="POST" target="_self">
		<h2 class="formarriba">Editar Ubicación</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txtIDUbInv" value="<?=$idUbInv?>">
				<label>Nombre Ubicación:</label><br>
				<input type="text" name="txtNameUbInv" value="<?=$DatosUbicacionInv['nombre_ubicacion']?>" required/><br><br>
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
			$(':input','#form_ubicacionInv')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		});
		$("#form_ubicacionInv").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_modificacion_ubicacioni.php?" + $("#form_ubicacionInv").serialize());
		});
	});
</script>