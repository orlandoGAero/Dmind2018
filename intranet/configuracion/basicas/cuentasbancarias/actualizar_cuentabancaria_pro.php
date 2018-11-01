<?php
	 // Sesión
    require_once('../../sesion.php');
    require ('cl_cuentabancaria_pro.php');
    $fnCueBan = new cuentasBancarias();
	require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	$idCuentaB = decrypt($_GET['cuentabancaria'], "cbancariaID");
    $datCuentaB = $fnCueBan -> infoCuentaBancaria($idCuentaB);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Cuenta Bancaria</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="formEditCueBan" method="POST" target="_self">
		<h2 class="formarriba">Editar Cuenta Bancaria</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txtIDcueBan" value="<?=$idCuentaB?>">
				<label>No. de Cuenta:</label><br>
				<input type="text" name="txtNumCuentaB" maxlength="18" value="<?=$datCuentaB['num_cbancaria_p']?>" required/><br><br>
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
			$(':input','#formEditCueBan')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		});
		$("#formEditCueBan").submit(function(guardar) {
			guardar.preventDefault();
			$.post('guardar_modificacion_cuentabancaria_pro.php', $("#formEditCueBan").serialize())
			.done(function(data) {
				$('#result').html(data);
			});
		});
	});
</script>