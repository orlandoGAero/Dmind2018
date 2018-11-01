<?php
	 // Sesión
    require_once('../../../sesion.php');
    require ('classStatusVenta.php');
	$fnStVenta = new StatusVenta();
	require_once("../../../../libs/encrypt_decrypt_strings_urls.php");
	$idStVenta = decrypt($_GET['IDstatus'],"statusVentaDM");
    $DatosStVenta = $fnStVenta -> obtenerDatoStatusVenta($idStVenta);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Status Venta</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_stVnt" method="POST" target="_self">
		<h2 class="formarriba">Editar Status Venta</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txtIDstVenta" value="<?=$idStVenta?>">
				<label>Nombre Status:</label><br>
				<input type="text" name="txtNameStVnt" value="<?=$DatosStVenta['nombre_status_venta']?>" required/><br><br>
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
			$(':input','#form_stVnt')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		});
		$("#form_stVnt").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_modificacion_status_venta.php?" + $("#form_stVnt").serialize());
		});
	});
</script>