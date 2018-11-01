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
    <title>Ventas de producto</title>
    <meta charset="utf-8" />
  <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico" />
  <link rel="stylesheet" href="../../css/estilos.css" />
  <link rel="stylesheet" href="../../css/menu.css" />
  <link rel="stylesheet" href="../../css/scroll.css" />
  <link rel="stylesheet" href="../../css/tabla.css" />
  <link rel="stylesheet" href="../../css/formularios.css" />
  <script type="text/javascript" src="../../js/jquery-2.1.4.js"></script>
  <script type="text/javascript" src="../../js/configuracion.js"></script>
</head>
    <body>
  <header>
    <img src="../../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
  </header>
    <nav>
    <ul>
      <li><a href="../../Home" alt="Inicio" title="Inicio"><img src="../../images/home.png"/></a></li>
      <a href="./"><li><img src="../../images/volver.png" /><b>Atras</b></li></a><li></li><li></li><li><spam style="color:#fff;"><?php echo $_SESSION["usuario"]; ?></spam></li>
      <li><a href="../../salir.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../../images/lock.png"/></a></li>
    </ul>
  </nav>
  <h1 style="text-align:center;">Inventario del Producto</h1>
  <section id="contenido">
    <section id="principal">
<?php  
include ("../../conexion.php");
  $id_pro=$_GET["id_pro"];
  $no_serie=$_GET["no_serie"];

  $sql="SELECT P.id_producto, C.nombre_categoria, S.nombre_subcategoria,
            nombre,no_serie, M.nombre_marca, P.modelo, P.precio from inventario I
          inner join productos P on I.id_producto=P.id_producto
            inner join categorias C on P.id_categoria=C.id_categoria 
            inner join subcategorias S on P.id_subcategoria=S.id_subcategoria 
            inner join marca_productos M on P.id_marca=M.id_marca 
            inner join nombres N on P.id_nombre=N.id_nombre
            where P.id_producto=$id_pro and no_serie=$no_serie and id_status=4";
  $result=mysql_query($sql);
  $conta=mysql_num_rows($result);
  if($conta==0){
      echo "<br><br><img src='../../images/noinvent.jpg' style='border-radius:10px;-moz-border-radius:10px;' />";
  }else{
?>
<div class="scrollbar" id="barra">

<table class="datos" id="allregistros">
        <tr>
          <th>ID</th>
          <th>CATEGORIA</th>
          <th>SUBCATEGORIA</th>
          <th>NOMBRE</th>
          <th>MODELO</th>
          <th>NO. SERIE</th>
          <th>MARCA</th>
          <th>PRECIO</th>
          <th></th>
        </tr>
<?php
  while($fila=mysql_fetch_array($result)){
       echo "<tr>";
       echo '<td align="center">'.$fila["id_producto"].'</td>';
       echo '<td align="center">'.$fila["nombre_categoria"].'</td>';
       echo '<td align="center">'.$fila["nombre_subcategoria"].'</td>';
       echo '<td align="center">'.$fila["nombre"].'</td>';
       echo '<td align="center">'.$fila["modelo"].'</td>';
       echo '<td align="center">'.$fila["no_serie"].'</td>';
       echo '<td align="center">'.$fila["nombre_marca"].'</td>';
       echo '<td align="center">'.$fila["precio"].'</td>';
       echo "</tr>";
  }
}
?>
</table>
<?php echo "<h1 style='color:#fff;'>Hay ",$conta," existencias</h1>"; ?>
<div class="contbarra"></div>
 </div>
<?php 
 ?>
    </body>
</html>
