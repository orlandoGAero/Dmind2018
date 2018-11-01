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
	<title>Intranet - Digital Mind</title>
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
	<link rel="stylesheet" href="../css/estilos.css" />
	<link rel="stylesheet" href="../css/menuinicio.css" />
	<link rel="stylesheet" href="../css/menu.css" media="screen" />
</head>
<body>
<?php include ("../menu.php"); ?>
	<section id="contenido">
		<section id="principal">
			<div class="menu">
				<ul>
					<li><a href="../proveedores"><div id="icono4"></div>PROVEEDORES</a></li>
					<li><a href="../clientes"><div id="icono1"></div>CLIENTES</a></li>
					<li><a href="../contactos"><div id="icono3"></div>CONTACTOS</a></li>
				</ul>
			</div>
			<div class="menu">
				<ul>
					<li><a href="../productos"><div id="icono2"></div>PRODUCTOS</a></li>
					<li><a href="../transacciones"><div id="icono5"></div>TRANSACCÍÓN</a></li>
                    <li><a href="../finanzas"><div id="iconoFinanzas"></div>FINANZAS</a> </li>
					<li><a href="../configuracion"><div id="icono9"></div><small>CONFIGURACIÓN</small></a></li>
					<!--<li><a href="#"><div id="icono10"></div></a></li>-->
				</ul>
			</div>

		</section>
	</section>

	<footer style="text-align:center;">
		<a href="#">Inicio</a> |
		<a href="#">Digital Mind</a> |
		<a href="../salir.php">Cerrar Sesion</a>
	</footer>
</body>
</html>