<?php
	 // Sesión
    require_once('../sesion.php');
    
	require ('../../../../conexion.php');
	require ('../config_egresos.php');
	$class_eg = new config_egresos();
	$idClasif = $_GET['idCla'];
	$Dat_modCl = $class_eg -> obtDatEditcla($idClasif);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Clasificación</title>
</head>
<body>
	<form action="" id="form_cl" method="POST" target="_self">
		<h2 class="formarriba">Editar Clasificación</h2>
		<center>
			<div class="camps"><br>
				<input type="hidden" name="txt_idcl" value="<?=$idClasif?>">
				<label>Clasificación :</label><br>
				<input type="text" name="nom_cl" value="<?=$Dat_modCl['nom_clasifi']?>" required/><br><br>
			</div>
		</center>
		
		<center>
			<div style="background:#16555B;" class="formabajo"><br>
				<input type="submit" name="btn_cl" value="Modificar" class="btn primary" />
			</div>
		</center>
	</form>
	<div id="result"></div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#form_cl").submit(function(edit) {
			edit.preventDefault();
			$("#result").load("modificar_clasificacion.php?" + $("#form_cl").serialize());
		});
	});
</script>