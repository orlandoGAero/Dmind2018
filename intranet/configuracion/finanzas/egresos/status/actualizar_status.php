<?php
	// Sesión
    require_once('../sesion.php');
    
	require ('../../../../conexion.php');
	require ('../config_egresos.php');
	$class_eg = new config_egresos();
	$idSt = $_GET['idSta'];
	$Dat_modSt = $class_eg -> obtDatEditdsta($idSt);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Status</title>
</head>
<body>
	<form action="" id="form_st" method="POST" target="_self">
		<h2 class="formarriba">Editar Status</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txt_idsta" value="<?=$idSt?>">
				<label>Status :</label><br>
				<input type="text" name="nom_sta" value="<?=$Dat_modSt['nom_status']?>" required/><br><br>
			</div>
		</center>
		
		<center>
			<div style="background:#16555B;" class="formabajo"><br>
				<input type="submit" name="btn_st" value="Modificar" class="btn primary" />
			</div>
		</center>
	</form>
	<div id="result"></div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#form_st").submit(function(edit) {
			edit.preventDefault();
			$("#result").load("modificar_status.php?" + $("#form_st").serialize());
		});
	});
</script>