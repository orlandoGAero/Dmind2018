<?php
	// Sesión
    require_once('../sesion.php');
    
	require ('../../../../conexion.php');
	require ('../config_egresos.php');
	$class_eg = new config_egresos();
	$idOr = $_GET['idOri'];
	$Dat_modOr = $class_eg -> obtDatEditdori($idOr);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Origen</title>
</head>
<body>
	<form action="" id="form_or" method="POST" target="_self">
		<h2 class="formarriba">Editar Origen</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txt_idor" value="<?=$idOr?>">
				<label>Origen :</label><br>
				<input type="text" name="nom_or" value="<?=$Dat_modOr['nom_origen']?>" required/><br><br>
			</div>
		</center>
		
		<center>
			<div style="background:#16555B;" class="formabajo"><br>
				<input type="submit" name="btn_des" value="Modificar" class="btn primary" />
			</div>
		</center>
	</form>
	<div id="result"></div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#form_or").submit(function(edit) {
			edit.preventDefault();
			$("#result").load("modificar_origen.php?" + $("#form_or").serialize());
		});
	});
</script>