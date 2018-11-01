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
<form action="actualiza.php" class="regusuario"> 
	<h2 class="formarriba">EDITAR MARCA</h2>
<div class="camps">
	<br><label>Nombre :</label>
<?php
  $id_marca=$_GET["id_marca"];
  include ('../../Conexion.php');
  $query="select distinct id_marca, nombre_marca from marcas where id_marca=$id_marca";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
  	echo '<input type="hidden" name="id_marca" value="'.$fila["id_marca"].'" /><br><br>';
  	echo '<input name="nombre_marca" value="'.$fila["nombre_marca"].'" type="text"/><br><br><br>';
?>
<?php
  }
?>
<?php
  $query="select M.id_marca, M.nombre_marca, M.id_categoria, nombre_categoria from marcas M 
  		  inner join categorias on M.id_categoria=categorias.id_categoria where id_marca=$id_marca";
  echo "<b>Sus Categorias</b><br><br>";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
  	echo '<b>'.$fila["nombre_categoria"].'';
  	echo '</b><a href="quitar.php?nombre_marca='.$fila["nombre_marca"].'&id_marca='.$fila["id_marca"].'&id_categoria='.$fila["id_categoria"].'" class="padd">quitar</a><br><br>';	
  }
  echo '<br><br><b class="newcateg" style="cursor:pointer">Agregar</b><img src="../../images/add.png" class="newcateg" style="cursor:pointer" />';
  ?>
  <br><br>
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
<div id="catego">
	<form action="agregarcategoria.php" class="newca">
	<input type="hidden" name="id_marca" value="<?php echo $_GET["id_marca"]; ?>">
<?php 
  $id_marca=$_GET["id_marca"];
  $query="select distinct nombre_marca from marcas where id_marca=$id_marca";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
  ?>
	<input type="hidden" value="<?php echo $fila[0] ?>" name="nombre_marca">
<?php 
}
   ?>
		<select name="id_categoria">
<?php //este se utiliza para llenar el combo de categorias
  $query="select * from categorias";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
  	echo '<option value="'.$fila["id_categoria"].'">'.$fila["nombre_categoria"].'</option>';	
  }
  ?>	
		</select><br>
		<input type="submit" value="Agregar">
	</form>
</div>
</body>
</html>