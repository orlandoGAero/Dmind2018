<?php
	session_start();
	// Manejamos en sesión el nombre del usuario que se ha logeado
	if(!isset($_SESSION["usuario"])){
		header("location:../");  
	}
	$_SESSION["usuario"];
	// Termina inicio de sesión
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title>Finanzas</title>
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="../css/menuinicio.css">
	<link rel="stylesheet" type="text/css" href="../css/menu.css">
</head>
<body>
	<?php include "../menu.php" ?>
	<h1 style="text-align:center;">
		<a href="../Home">
			<img class="atras" src="../images/atras.png" title="Regresar">
		</a> Finanzas
	</h1>
	<center>
		<div class="menu">
			<ul>
				<li><a href="egresos/"><div id="iconoEgresos"></div>Egresos</a></li>
				<li><a href="ingresos/"><div id="iconoIngresos"></div>Ingresos</a></li>
				<li><a href="saldos/listar_saldos.php"><div id="iconoSaldos"></div>Saldos</a></li>
			</ul>
		</div>
	</center>
</body>
</html>