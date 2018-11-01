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
<center>
<br>
<form action="actualiza.php" class="regusuario" style="width:70%; heigth:50%">> 
	<h2 class="formarriba" style="width:70%; heigth:50%">EDITAR DIRECCIÓN</h2>
<div class="camps" style="width:70%; heigth:50%">
<?php
  $id_direccion=$_GET["id_direccion"];
  include ('../../Conexion.php');
  $query="select * from direcciones where id_direccion=$id_direccion";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
  	echo '<input type="hidden" name="id_direccion" value="'.$fila["id_direccion"].'" /><br><br>';
	echo '<label>Calle :</label>';
	echo '<input name="calle" type="text" value="'.$fila["calle"].'"/><br><br>';
	echo '<label>No.EXT :</label>';
	echo '<input type="text" name="num_ext" value="'.$fila["num_ext"].'"/><br>';
	echo '<label>No.INT :</label>';
	echo '<input type="text" name="num_int" value="'.$fila["num_int"].'"/><br>';
	echo '<label>Colonia :</label>';
	echo '<input type="text" name="colonia" value="'.$fila["colonia"].'"/><br>';
	echo '<label>Localidad :</label>';
	echo '<input type="text" name="localidad" value="'.$fila["localidad"].'"/><br>';
	echo '<label>Referencia :</label>';
	echo '<input type="text" name="referencia" value="'.$fila["referencia"].'"/><br>';
	echo '<label>Municipio :</label>';
	echo '<input type="text" name="municipio" value="'.$fila["municipio"].'"/><br>';
	echo '<label>Estado :</label>';
	echo '<input type="text" name="estado" value="'.$fila["estado"].'"/><br>';
	echo '<label>Pais :</label>';
	echo '<input type="text" name="pais" value="'.$fila["pais"].'"/><br>';
	echo '<label>Codigo Postal :</label>';
	echo '<input type="text" name="cod_postal" value="'.$fila["cod_postal"].'"/><br>';
	echo '<label>Sucursal :</label>';
	echo '<input type="text" name="sucursal" value="'.$fila["sucursal"].'"/><br>';
	echo '<label>Ubicacion GPS :</label>';
	echo '<input type="text" name="gps_ubicacion" value="'.$fila["gps_ubicacion"].'"/><br><br><br>';
  }
?>
</div>
<div class="formabajo" style="width:70%; heigth:50%">
		<input type="submit" name="enviar" value="Guardar" class="boton" />
		<input type="reset" value="Limpiar" /><br><br>
</div>

<a href="./">
	<b class="cerrar">Cancelar</b>
</a>
</form>
</center>