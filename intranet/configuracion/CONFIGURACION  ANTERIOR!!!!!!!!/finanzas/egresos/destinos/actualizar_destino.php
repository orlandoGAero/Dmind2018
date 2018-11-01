<?php
	// Sesión
    require_once('../sesion.php');
    
	require ('../../../../conexion.php');
	require ('../config_egresos.php');
	$class_eg = new config_egresos();
	$idDesti = $_GET['idDes'];
	$Dat_modDe = $class_eg -> obtDatEditdes($idDesti);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Destino</title>
</head>
<body>
	<form action="" id="form_des" method="POST" target="_self">
		<h2 class="formarriba">Editar Destino</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txt_iddes" value="<?=$idDesti?>">
				<label>Destino :</label><br>
				<input type="text" name="nom_des" value="<?=$Dat_modDe['nom_destino']?>" required/><br><br>
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
		$("#form_des").submit(function(edit) {
			edit.preventDefault();
			$("#result").load("modificar_destino.php?" + $("#form_des").serialize());
		});
	});
</script>