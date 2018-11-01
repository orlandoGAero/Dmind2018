<?php
	// Sesión
    require_once('../../sesion.php');
    require ('classSubcategoriaProducto.php');
    $fnSubcatProducto = new SubcategoriaProducto();
	require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	$idSubcatProd = decrypt($_GET['IDsubcategoria'],"subcategoriasProductoDM");
    $DatosSubcatProd = $fnSubcatProducto -> obtenerDatoSubcategoriaProducto($idSubcatProd);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Subcategoría</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_subcatProd" method="POST" target="_self">
		<h2 class="formarriba">Editar Subcategoría</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txtIDSubcatProd" value="<?=$idSubcatProd?>">
				<label>Nombre Subcategoría:</label><br>
				<input type="text" name="txtNameSubcatProd" value="<?=$DatosSubcatProd['nombre_subcategoria']?>" required/><br><br>
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
			$(':input','#form_subcatProd')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		});
		$("#form_subcatProd").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_modificacion_subcategoriap.php?" + $("#form_subcatProd").serialize());
		});
	});
</script>