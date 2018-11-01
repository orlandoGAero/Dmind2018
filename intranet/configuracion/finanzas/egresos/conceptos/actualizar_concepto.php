<?php
	// Sesión
	require_once('../sesion.php');
	
	require ('../../../../conexion.php');
	require ('../config_egresos.php');
	$class_eg = new config_egresos();
	$idConce = $_GET['idConc'];
	$Dat_modCo = $class_eg -> obtDatEditcon($idConce);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Concepto</title>
</head>
<body>
	<form action="" id="form_con" method="POST" target="_self">
		<h2 class="formarriba">Editar Concepto</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txt_idco" value="<?=$idConce?>">
				<label>Concepto :</label><br>
				<input type="text" name="nom_co" value="<?=$Dat_modCo['nom_concepto']?>" required/><br><br>
			</div>
		</center>
		
		<center>
			<div style="background:#16555B;" class="formabajo"><br>
				<input type="submit" name="btn_co" value="Modificar" class="btn primary" />
			</div>
		</center>
	</form>
	<div id="result"></div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#form_con").submit(function(edit) {
			edit.preventDefault();
			$("#result").load("modificar_concepto.php?" + $("#form_con").serialize());
		});
	});
</script>