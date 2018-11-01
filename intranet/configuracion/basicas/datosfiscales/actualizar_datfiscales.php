<?php
	// Sesión
    require_once('../../sesion.php');
    require ('cl_datosfiscales.php');
    $fnDatFis = new datosFiscales();
	require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	$idDatosFiscales = decrypt($_GET['datosfiscales'], "dfiscalesID");
    $datFiscales = $fnDatFis -> infoDatoFiscal($idDatosFiscales);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Datos Fiscales</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="formEditDatF" method="POST" target="_self">
		<h2 class="formarriba">Editar Dato Fiscal</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txtIdDatF" value="<?=$idDatosFiscales?>">
				<label>Razón Social:</label><br>
				<input type="text" name="txtRazSoc" maxlength="75" value="<?=$datFiscales['razon_social_e']?>" required/><br><br>
				<label>RFC:</label><br>
				<input type="text" name="txtRfc" maxlength="13" value="<?=$datFiscales['rfc_e']?>" required/><br><br>
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
			$(':input','#formEditDatF')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		});
		$("#formEditDatF").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_modificacion_datfiscales.php?" + $("#formEditDatF").serialize());
		});
	});
</script>