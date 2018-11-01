<?php
	// Sesión
    require_once('../../../sesion.php');
    require ('classTiposVenta.php');
    $fnTipVenta = new TiposVenta();
	require_once("../../../../libs/encrypt_decrypt_strings_urls.php");
	$idTipVenta = decrypt($_GET['IDtipo'],"TiposVentaDM");
    $DatosTipVenta = $fnTipVenta -> obtenerDatoTipoVenta($idTipVenta);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Tipo Venta</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_tipVnt" method="POST" target="_self">
		<h2 class="formarriba">Editar Tipo Venta</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txtIDTipVenta" value="<?=$idTipVenta?>">
				<label>Nombre Tipo:</label><br>
				<input type="text" name="txtNameTipVnt" value="<?=$DatosTipVenta['nom_tipo_venta']?>" required/><br><br>
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
			$(':input','#form_tipVnt')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		});
		$("#form_tipVnt").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_modificacion_tipo_venta.php?" + $("#form_tipVnt").serialize());
		});
	});
</script>