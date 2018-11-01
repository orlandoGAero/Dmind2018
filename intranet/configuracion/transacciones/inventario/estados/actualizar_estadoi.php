<?php
	// Sesión
    require_once('../../../sesion.php');
    require ('classEstadosInv.php');
    $fnEstadosInv = new EstadosInv();
	require_once("../../../../libs/encrypt_decrypt_strings_urls.php");
	$idEstInv = decrypt($_GET['IDestado'],"estadosInventarioDM");
    $DatosEstadosInv = $fnEstadosInv -> obtenerDatoEstadoInventario($idEstInv);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Estado</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_estadoInv" method="POST" target="_self">
		<h2 class="formarriba">Editar Estado</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txtIDEstInv" value="<?=$idEstInv?>">
				<label>Nombre Estado:</label><br>
				<input type="text" name="txtNameEstInv" value="<?=$DatosEstadosInv['nombre_estado']?>" required/><br><br>
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
			$(':input','#form_estadoInv')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		});
		$("#form_estadoInv").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_modificacion_estadoi.php?" + $("#form_estadoInv").serialize());
		});
	});
</script>