<?php
	// Sesión
    require_once('../../../sesion.php');
    require ('classTiposPago.php');
    $fnTiposPago = new TiposPago();
	require_once("../../../../libs/encrypt_decrypt_strings_urls.php");
	$idTipoPago = decrypt($_GET['IDformaPago'],"tiposPagoDM");
    $DatosTipoPago = $fnTiposPago -> obtenerDatoTipoPago($idTipoPago);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Forma de Pago</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_formaPago" method="POST" target="_self">
		<h2 class="formarriba">Editar Forma de Pago</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txtIDFormaPago" value="<?=$idTipoPago?>">
				<label>Nombre:</label><br>
				<input type="text" name="txtNameFormaPago" value="<?=$DatosTipoPago['nom_tipo_pago']?>" required/><br><br>
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
			$(':input','#form_formaPago')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		});
		$("#form_formaPago").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_modificacion_tipo_pago.php?" + $("#form_formaPago").serialize());
		});
	});
</script>