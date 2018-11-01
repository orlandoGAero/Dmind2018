<?php
	// Sesión
    require_once('../../sesion.php');
    require ('classTiposTransaccion.php');
    $fnTiposTransaccion = new TiposTransaccion();
	require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	$idTipoTrans = decrypt($_GET['IDtipo'],"tiposTransaccionDM");
    $DatosTiposTrans = $fnTiposTransaccion -> obtenerDatoTipoTransaccion($idTipoTrans);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Tipo</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_tipoTrans" method="POST" target="_self">
		<h2 class="formarriba">Editar Tipo</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txtIDTipoTrans" value="<?=$idTipoTrans?>">
				<label>Nombre Tipo:</label><br>
				<input type="text" name="txtNameTipoTrans" value="<?=$DatosTiposTrans['nombre_tipo_transaccion']?>" required/><br><br>
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
			$(':input','#form_tipoTrans')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		});
		$("#form_tipoTrans").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_modificacion_tipot.php?" + $("#form_tipoTrans").serialize());
		});
	});
</script>