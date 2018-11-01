<?php
session_start();
//manejamos en sesion el nombre del usuario que se ha logeado
if (!isset($_SESSION["usuario"])){
    header("location:../../");  
}
$_SESSION["usuario"];
//termina inicio de sesion
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Digital Mind</title>
  <link rel="shortcut icon" type="image/x-icon" href="../../images/favicon.ico" />
    <link rel="stylesheet" href="../../css/menu.css" />
    <link rel="stylesheet" href="../../css/formularios.css" />
    <link rel="stylesheet" href="../../css/tabla.css" />
</head>
<body>
    <header>
        <img src="../../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
    </header>
        <nav>
        <ul>
            <li><a href="../../Home" alt="Inicio" title="Inicio"><img src="../../images/home.png"/></a></li>
            <a href="../"><li><img src="../../images/volver.png" /><b>Atras</b></li></a><li></li><li></li><li><spam style="color:#fff;"><?php echo $_SESSION["usuario"]; ?></spam></li>
            <li><a href="../../salir.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../../images/lock.png"/></a></li>
        </ul>
    </nav>
    <h1 style="text-align:center; color:rgba(0,191,255,.9);">Ventas</h1>
<center>
        <form action="buscar.php">
        <label>Buscar :</label>
        <input name="buscar" type="text" list="lista"  title="Ingresa descripcion para buscar">
        <button class="buscar">.</button>
        </form>    
    <section>
<a href="agregarventa.php"><b class="nuevos">Nueva</b></a>
<div class="scrollbar" id="barra">
<center>
<table border="0" cellspacing="0" cellpadding="2" class="datos">
<tr>
<th>Folio </th>
<th>Fecha de captura</th>
<th align="justify">Cliente de la cotización</th>

<th></th>
</tr>
<?php 
include ('../../conexion.php');


$query="SELECT nombre_cliente, V.fecha,V.hora, V.id_venta,C.id_cliente FROM venta V 
        inner join clientes C on V.id_cliente=C.id_cliente 
        where guardado='1' ORDER BY V.id_venta ASC";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result))
{
?>
<tr>
    <td align="center">
    COT <?php echo $fila["id_venta"] ?>
    </td>
    <td align="center">
    <?php echo $fila["fecha"] ?>  <?php echo $fila["hora"] ?>
    </td>
    <td><?php echo $fila["nombre_cliente"] ?></td>
    <td>
    <a href="./vistavent.php?venta=<?php echo $fila["id_venta"]; ?>">
    <img src="../../images/detalle.png"/></a>
    
    <a target="blank" href="pdfvent.php?venta=<?php echo $fila[3]; ?>" style="text-decoration:none;">
    <img src="../../images/filpdf.png" width="20" height="20" >PDF</a>
    
    </td>
    
</tr>
<?php
}
 ?>
</table>
</center>
 <div class="contbarra"></div>
 </div>
