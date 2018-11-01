<?php
session_start();
//manejamos en sesion el nombre del usuario que se ha logeado
if (!isset($_SESSION["usuario"])){
    header("location:../");  
}
$_SESSION["usuario"];
//termina inicio de sesion
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Digital Mind</title>
  <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
	<link rel="stylesheet" href="../css/menuinicio.css" />
	<link rel="stylesheet" href="../css/menu.css" />
</head>
<body>
<?php include ("../menu.php"); ?>
	<h1 style="text-align:center;"><a href="../Home">
	<img class="atras" src="../images/atras.png" alt="Atras"></a>Transacciones</h1>
<center>
			<div class="menu">
				<ul>
					<li><a href="inventario"><div id="inventario"></div>Inventario</a></li>	
					<li><a href="venta/"><div id="venta"></div>Venta</a></li>
					<li><a href="registrocotizaciones.php"><div id="cotiza"></div>Cotizacion</a></li>
					<!--<li><a href="historial"><div id="historial"></div>historial</a></li>	-->
				</ul>
			</div>
</center>
</body>
</html>