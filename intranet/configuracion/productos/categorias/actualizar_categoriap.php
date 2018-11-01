<?php
	// Sesión
    require_once('../../sesion.php');
    require ('classCategoriaProducto.php');
    $fnCatProducto = new CategoriaProducto();
	require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	$idCatProd = decrypt($_GET['IDcategoria'],"categoriasProductoDM");
    $DatosCatProd = $fnCatProducto -> obtenerDatoCategoriaProducto($idCatProd);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Categoría</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_catProd" method="POST" target="_self">
		<h2 class="formarriba">Editar Categoría</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txtIDCatProd" value="<?=$idCatProd?>">
				<label>Nombre Categoría:</label><br>
				<input type="text" name="txtNameCatProd" value="<?=$DatosCatProd['nombre_categoria']?>" required/><br><br>
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
			$(':input','#form_catProd')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		});
		$("#form_catProd").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_modificacion_categoriap.php?" + $("#form_catProd").serialize());
		});
	});
</script>