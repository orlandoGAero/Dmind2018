<?php
	// Sesión
    require_once('../../sesion.php');
    require ('classAreasContacto.php');
    $fnAreasContacto = new AreasContacto();
	require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	$idAreaCont = decrypt($_GET['IDarea'],"areasContactoDM");
    $DatosAreaContacto = $fnAreasContacto -> obtenerDatoAreaContacto($idAreaCont);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Área Contacto</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_areaCont" method="POST" target="_self">
		<h2 class="formarriba">Editar Área</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txtIDAreaCont" value="<?=$idAreaCont?>">
				<label>Nombre Área:</label><br>
				<input type="text" name="txtNameAreaCont" value="<?=$DatosAreaContacto['nombre_areacontacto']?>" required/><br><br>
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
			$(':input','#form_areaCont')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		});
		$("#form_areaCont").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_modificacion_area_contacto.php?" + $("#form_areaCont").serialize());
		});
	});
</script>