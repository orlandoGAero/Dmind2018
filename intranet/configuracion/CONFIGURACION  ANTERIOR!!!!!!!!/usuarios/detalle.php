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
	<title>Detalle</title>
	<link rel="shortcut icon" type="image/x-icon" href="../favicon.ico" />
	<link rel="stylesheet" href="../css/estilos.css" />
</head>

<body>
	<header>
		<img src="../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
	</header>

	<section id="contenido">
		<section id="principal">

<?PHP
include("../conexion.php");
$id=$_GET["id"]; 
$link=$enlace;
$query="SELECT * FROM usuarios WHERE usuario_id='$id'";
$result=mysql_query($query,$link);
while($row=mysql_fetch_array($result)){?>

<h1><a href="../configuracion" alt="Salir" title="Salir"><img src="../images/salir.png" height="25px" /></a> Detalle de <?PHP echo $row["1"]; ?></h1>
<form action="" method="post">
	<table class="detalle">
		<tr><th></th><td></td></tr>
		<tr><th width="200px">Usuario</th><td width="300px"><?PHP echo $row["1"]; ?></td></tr>
		<tr><th>Contraseña</th><td><input type="password" name="usuario_clave" value="<?PHP echo $row["2"]; ?>" readonly /></td></tr>
		<tr><th>Email</th><td><?PHP echo $row["3"]; ?></td></tr>
		<tr><th>Fecha Registro</th><td><?PHP echo $row["4"]; ?></td></tr>
	</table>

</form>
<?PHP }?>

		</section>
	</section>
</body>
</html>