<?php
	// Sesión
    require_once('../../../sesion.php');
    require ('classStatusInv.php');
    $fnStatusInv = new StatusInv();
	require_once("../../../../libs/encrypt_decrypt_strings_urls.php");
	$idStInv = decrypt($_GET['IDstatus'],"statusInventarioDM");
    $DatosStatusInv = $fnStatusInv -> obtenerDatoStatusInventario($idStInv);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Status</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_statusInv" method="POST" target="_self">
		<h2 class="formarriba">Editar Status</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txtIDStInv" value="<?=$idStInv?>">
				<label>Nombre Status:</label><br>
				<input type="text" name="txtNameStInv" value="<?=$DatosStatusInv['nombre_status']?>" required/><br><br>
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
			$(':input','#form_statusInv')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		});
		$("#form_statusInv").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_modificacion_statusi.php?" + $("#form_statusInv").serialize());
		});
	});
</script>