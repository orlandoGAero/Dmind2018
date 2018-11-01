<?php
	// Sesión
    require_once('../../sesion.php');
    require ('classDivisiones.php');
    $fnDivisiones = new Divisiones();
	require_once("../../../libs/encrypt_decrypt_strings_urls.php");
	$idDivProd = decrypt($_GET['IDdivision'],"divisionesProductoDM");
    $DatosDivProd = $fnDivisiones -> obtenerDatoDivisionProducto($idDivProd);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar División</title>
</head>
<body>
	<div id="result"></div>
	<form action="" id="form_divisionProd" method="POST" target="_self">
		<h2 class="formarriba">Editar División</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txtIDDivProd" value="<?=$idDivProd?>">
				<label>Nombre División:</label><br>
				<input type="text" name="txtNameDivProd" value="<?=$DatosDivProd['nombre_division']?>" required/><br><br>
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
			$(':input','#form_divisionProd')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		});
		$("#form_divisionProd").submit(function(guardar) {
			guardar.preventDefault();
			$("#result").load("guardar_modificacion_divisionp.php?" + $("#form_divisionProd").serialize());
		});
	});
</script>