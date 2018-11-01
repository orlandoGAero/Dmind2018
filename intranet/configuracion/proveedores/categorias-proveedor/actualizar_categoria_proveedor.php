<?php
	 // Sesión
    require_once('../../sesion.php');
    require ('classCategoriasProveedor.php');
    $fnCatProv = new CategoriasProveedor();
	require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	$idCatprov = decrypt($_GET['IDcategoria'],"categoriasProveedorDM");
    $DatosCatProv = $fnCatProv -> obtenerDatoCategoriaProveedor($idCatprov);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Categoría Proveedor</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_catProv" method="POST" target="_self">
		<h2 class="formarriba">Editar Categoría Proveedor</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txtIDcatProv" value="<?=$idCatprov?>">
				<label>Nombre Categoría:</label><br>
				<input type="text" name="txtNameCatProv" value="<?=$DatosCatProv['nombre_cat_prov']?>" required/><br><br>
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
			$(':input','#form_catProv')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		});
		$("#form_catProv").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_modificacion_categoria_proveedor.php?" + $("#form_catProv").serialize());
		});
	});
</script>