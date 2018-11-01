<?php
	// Sesión
    require_once('../../sesion.php');
    require ('classTiposP.php');
    $fnTiposP = new TiposP();
	require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	$idTipProd = decrypt($_GET['IDtipo'],"tiposProductoDM");
    $DatosTipProd = $fnTiposP -> obtenerDatoTipoProducto($idTipProd);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Tipo</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_tipoProd" method="POST" target="_self">
		<h2 class="formarriba">Editar Tipo</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txtIDTipProd" value="<?=$idTipProd?>">
				<label>Nombre Tipo:</label><br>
				<input type="text" name="txtNameTipProd" value="<?=$DatosTipProd['nombre_tipo']?>" required/><br><br>
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
			$(':input','#form_tipoProd')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		});
		$("#form_tipoProd").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_modificacion_tipop.php?" + $("#form_tipoProd").serialize());
		});
	});
</script>