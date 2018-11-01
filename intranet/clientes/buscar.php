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
  <link rel="stylesheet" href="../css/estilos.css" />
  <link rel="stylesheet" href="../css/menu.css" />
  <link rel="stylesheet" href="../css/tabla.css" />
  <link rel="stylesheet" href="../css/formularios.css" />
  <script type="text/javascript" src="../js/jquery-2.1.4.js"></script>
  <script type="text/javascript" src="../js/configuracion.js"></script>
</head>
    <body>
  <header>
    <img src="../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
  </header>
    <nav>
    <ul>
      <li><a href="../Home" alt="Inicio" title="Inicio"><img src="../images/home.png"/></a></li>
      <a href="javascript:window.history.back();"><li><img src="../images/volver.png" /><b>Atras</b></li></a><li></li><li></li><li><spam style="color:#fff;"><?php echo $_SESSION["usuario"]; ?></spam></li>
      <li><a href="../salir.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../images/lock.png"/></a></li>
    </ul>
  </nav>
  <h1 style="text-align:center;">Busqueda de Cliente</h1>
  <section id="contenido">
    <section id="principal">
    <form action="buscar.php">
    <label>Buscar :</label>
    <input name="buscar" type="text" list="lista" value="<?php echo $_GET["buscar"] ?>"  title="Ingresa descripcion para buscar">
    <button class="buscar">.</button>
    </form>
<?php  
include ("../conexion.php");
  $b=$_GET["buscar"];

  $sql="SELECT C.id_cliente, C.nombre_cliente,rfc,calle,num_ext,num_int,municipio,estado,nombre_categoria_cliente,
    D.id_direccion,C.id_direccion,D.id_datfiscal,id_bancarios,C.fecha_alta FROM clientes C 
    inner join datos_fiscales D on C.id_datfiscal=D.id_datfiscal
    inner join direcciones B on C.id_direccion=B.id_direccion
    inner join categoria_cliente S on C.id_categoria_cliente=S.id_categoria_cliente
            WHERE C.nombre_cliente LIKE '%".$b."%'";
  $result=mysql_query($sql);
  $conta=mysql_num_rows($result);
  if($conta==0 || $b ==""){
      echo "<br><br><img src='../images/nohay.jpg' style='border-radius:10px;-moz-border-radius:10px;' />";
  }else{
?>
    <table class="datos" id="allregistros">
        <tr>
          <th>NOMBRE</th>
          <th>FECHA<b style="color:transparent">-</b>ALTA</th>
          <th>RFC</th>
          <th>CALLE</th>
          <th>ESTADO</th>
          <th>MUNICIPIO</th>
          <th>CATEGORIA</th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
<?php
  while($fila=mysql_fetch_array($result)){
       echo "<tr>";
       //echo '<td>'.$fila[0].'</td>
       echo '<td>'.$fila["nombre_cliente"].'</td>';
       echo '<td>'.$fila["fecha_alta"].'</td>';
       echo '<td>'.$fila["rfc"].'</td>';
       echo '<td>'.$fila["calle"].' '.$fila["num_ext"].'/'.$fila["num_int"].'</td>';
       echo '<td>'.$fila["estado"].'</td><td>'.$fila["municipio"].'</td><td>'.$fila["nombre_categoria_cliente"].'</td>';
       echo '<td><a href="detalle.php?id_clie='.$fila[0].'"><img src="../images/detalle.png"><a></td>';
       echo '<td><a href="editar.php?id_clie='.$fila[0].'"><img src="../images/editar.png"><a></td>';
       echo '<td><a href="eliminar.php?id_clie='.$fila[0].'&id_dfis='.$fila[8].'&id_dcli='.$fila[9].'&id_datfis='.$fila["id_datfiscal"].'&dat_banc='.$fila["id_bancarios"].'"><img src="../images/eliminar.png"><a></td>';
       echo "</tr>";

  }
}
?>
    </body>
</html>
