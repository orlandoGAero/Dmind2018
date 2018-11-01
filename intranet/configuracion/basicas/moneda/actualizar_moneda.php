<?php
	// Sesión
    require_once('../../sesion.php');
    require ('classMonedas.php');
    $fnMonedas = new Monedas();
	require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	$idMoneda = decrypt($_GET['IDmoneda'],"monedasDM");
    $DatosMoneda = $fnMonedas -> obtenerDatoMoneda($idMoneda);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Moneda</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_moneda" method="POST" target="_self">
		<h2 class="formarriba">Editar Moneda</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txtIDMoneda" value="<?=$idMoneda?>">
				<label>Nombre Moneda:</label><br>
				<input type="text" name="txtNameMoneda" value="<?=$DatosMoneda['nombre_moneda']?>" required/><br><br>
				<label>Valor:</label><br>
				<input type="text" name="txtValorMoneda" value="<?=$DatosMoneda['valor']?>" required/><br><br>
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
			$(':input','#form_moneda')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		});
		$("#form_moneda").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_modificacion_moneda.php?" + $("#form_moneda").serialize());
		});
	});
</script>