<?php
	// Sesión
    require_once('../../sesion.php');
    require ('classMarcas.php');
    $fnMarcas = new Marcas();
	require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	$idMarca = decrypt($_GET['IDmarca'],"marcasProductosDM");
    $DatosMarca = $fnMarcas -> obtenerDatoMarca($idMarca);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Marca</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_marca" method="POST" target="_self">
		<h2 class="formarriba">Editar Marca</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txtIDMarca" value="<?=$idMarca?>">
				<label>Nombre Marca:</label><br>
				<input type="text" name="txtNameMarca" value="<?=$DatosMarca['nombre_marca']?>" required/><br><br>
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
			$(':input','#form_marca')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		});
		$("#form_marca").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_modificacion_marca.php?" + $("#form_marca").serialize());
		});
	});
</script>