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
	<title>Usuarios</title>
	<link rel="shortcut icon" type="image/x-icon" href="../favicon.ico" />
	<link rel="stylesheet" href="../../css/estilos.css" />
	<link rel="stylesheet" href="../../css/menu.css" />
	<link rel="stylesheet" href="../../css/tabla.css" />
	<link rel="stylesheet" href="../../css/formularios.css" />
	<script type="text/javascript" src="../../js/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="../../js/editar.js"></script>
</head>
<body>
	<header>
		<img src="../../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
	</header>
		<nav>
		<ul>
			<li><a href="../../configuracion" alt="Inicio" title="Inicio"><img src="../../images/home.png"/></a></li>
			<li></li><li></li><li></li><li><spam style="color:#fff;"><?php echo $_SESSION["usuario"]; ?></spam></li>
			<li><a href="../../salir.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../../images/lock.png"/></a></li>
		</ul>
	</nav>
<?php
  include ('../../Conexion.php');
  $id_moneda=$_GET["id_moneda"];
  $query = "select * from moneda where id_moneda=$id_moneda";
  $result=mysql_query($query);
?>
<center>
<br>
<form action="actualiza.php" class="regusuario"> 
	<h2 class="formarriba">EDITAR MONEDA</h2>
<div class="camps">
	<br><label>Nombre :</label>
<?php
  while($fila=mysql_fetch_array($result))
  {
  	echo '<input type="hidden" name="id_moneda" value="'.$fila["id_moneda"].'" /><br><br>';
  	echo '<input name="nombre_moneda" value="'.$fila["nombre_moneda"].'" type="text"/><br><br><br>';
  	echo '<input name="valor" value="'.$fila["valor"].'" type="text"/><br><br><br>';
?>
<?php
  }
?>
</div>
<div class="formabajo"><br>
		<input type="submit" name="enviar" value="Guardar" class="boton" />
		<input type="reset" value="Limpiar" /><br><br>
</div>

<a href="./">
	<b class="cerrar">Cancelar</b>
</a>
</form>
</center>