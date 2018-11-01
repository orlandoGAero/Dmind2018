<?php
	// Sesión
    require_once('../../sesion.php');
    require ('classNombresP.php');
    $fnNombresP = new NombresP();
	require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	$idNomProd = decrypt($_GET['IDnombre'],"nombresProductoDM");
    $DatosNombreProd = $fnNombresP -> obtenerDatoNombreProducto($idNomProd);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Nombre</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_nombreProd" method="POST" target="_self">
		<h2 class="formarriba">Editar Nombre</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txtIDNomProd" value="<?=$idNomProd?>">
				<label>Nombre:</label><br>
				<input type="text" name="txtNomProd" value="<?=$DatosNombreProd['nombre']?>" required/><br><br>
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
			$(':input','#form_nombreProd')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		});
		$("#form_nombreProd").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_modificacion_nombrep.php?" + $("#form_nombreProd").serialize());
		});
	});
</script>