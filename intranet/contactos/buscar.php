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
      <a href="./"><li><img src="../images/volver.png" /><b>Atras</b></li></a><li></li><li></li><li><spam style="color:#fff;"><?php echo $_SESSION["usuario"]; ?></spam></li>
      <li><a href="../salir.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../images/lock.png"/></a></li>
    </ul>
  </nav>
  <h1 style="text-align:center;">Busqueda de Producto</h1>
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

  $sql="SELECT id_contacto,nombre,fecha_alta,movil,email_personal,calle,num_ext,num_int,estado,municipio,
    nombre_areacontacto,telefono_casa,tel_oficina,movil,email_personal,D.id_direccion FROM contactos C
    inner join areacontacto A on C.id_areacontacto=A.id_areacontacto
    inner join direcciones D on C.id_direccion=D.id_direccion
    WHERE C.nombre LIKE '%".$b."%'";
  $result=mysql_query($sql);
  $conta=mysql_num_rows($result);
  if($conta==0 || $b ==""){
      echo "<br><br><img src='../images/nohay.jpg' style='border-radius:10px;-moz-border-radius:10px;' />";
  }else{
?>
    <table class="datos" id="allregistros">
        <tr>
          <th>ID</th>
          <th>NOMBRE</th>
          <th>FECHA<b style="color:transparent">-</b>ALTA</th>
          <th>CALLE</th>
          <th>ESTADO</th>
          <th>MUNICIPIO</th>
          <th>AREA</th>
          <th>TELEFONO CASA</th>
          <th>TELEFONO OFICINA</th>
          <th>MOVIL</th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
<?php
  while($fila=mysql_fetch_array($result)){
  echo "<tr>";
  echo "<td>",$fila[0],"</td>";
  echo "<td>",$fila["nombre"],"</td>";
  echo "<td>",$fila["fecha_alta"],"</td>";
  echo "<td>",$fila["calle"]," ",$fila["num_ext"],"/",$fila["num_int"],"</td>";
  echo "<td>",$fila["estado"],"</td>";
  echo "<td>",$fila["municipio"],"</td>";
  echo "<td>",$fila["nombre_areacontacto"],"</td>";
if($fila["telefono_casa"]==""){
  echo "<td>S/n</td>";
}else{
  echo "<td>",$fila["telefono_casa"],"</td>";
}
if($fila["tel_oficina"]==""){
  echo "<td>S/n</td>";
}else{
  echo "<td>",$fila["tel_oficina"],"</td>";
}
if($fila["movil"]==""){
  echo "<td>S/n</td>";
}else{
  echo "<td>",$fila["movil"],"</td>";
}
  echo "<td>",$fila["email_personal"],"</td>";
  echo "<td><a href='editar.php?id_cont=",$fila[0],"'><img src='../images/editar.png' /></a></td>";
  echo "<td><a href='detalle.php?id_cont=",$fila[0],"'><img src='../images/detalle.png' /></a></td>";
  echo "<td><a href='eliminar.php?id_cont=",$fila[0],"&id_dir=",$fila["id_direccion"],"'><img src='../images/eliminar.png' /></a></td>";
  echo "</tr>";

  }
}
?>
    </body>
</html>
