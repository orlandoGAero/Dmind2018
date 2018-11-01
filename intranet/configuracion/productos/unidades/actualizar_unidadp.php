<?php
	// Sesión
    require_once('../../sesion.php');
    require ('classUnidadesP.php');
    $fnUnidadesP = new UnidadesP();
	require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	$idUniProd = decrypt($_GET['IDunidad'],"unidadesProductoDM");
    $DatosUnidProd = $fnUnidadesP -> obtenerDatoUnidadProducto($idUniProd);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Unidad</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_unidadProd" method="POST" target="_self">
		<h2 class="formarriba">Editar Unidad</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txtIDUnidProd" value="<?=$idUniProd?>">
				<label>Nombre Unidad:</label><br>
				<input type="text" name="txtNameUnidProd" value="<?=$DatosUnidProd['nombre_unidad']?>" required/><br><br>
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
			$(':input','#form_unidadProd')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		});
		$("#form_unidadProd").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_modificacion_unidadp.php?" + $("#form_unidadProd").serialize());
		});
	});
</script>