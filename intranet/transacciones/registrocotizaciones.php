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
    <link rel="stylesheet" href="../css/menu.css" />
    <link rel="stylesheet" href="../css/formularios.css" />
    <link rel="stylesheet" href="../css/tabla.css" />
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
    <h1 style="text-align:center; color:rgba(0,191,255,.9);">Cotizaciones</h1>
<center>
        <form action="buscar.php">
        <label>Buscar :</label>
        <input name="buscar" type="text" list="lista"  title="Ingresa descripcion para buscar">
        <button class="buscar">.</button>
        </form>    
    <section>
<a href="Cotizacion/agregarcotizacion.php"><b class="nuevos">Nueva</b></a>
<div class="scrollbar" id="barra">
<center>
<table border="0" cellspacing="0" cellpadding="2" class="datos">
<tr>
<th>Folio </th>
<th>Fecha de captura</th>
<th>Cliente de la cotización</th>
<th></th>
</tr>
<?php 
include ('../conexion.php');

$query="DELETE FROM cotizacion WHERE not guardada=1";
$result=mysql_query("$query");


$query="SELECT nombre_cliente, C.fecha, C.id_cotizacion,C.id_cliente FROM cotizacion C 
        inner join clientes on clientes.id_cliente=C.id_cliente 
        where estado='1' ORDER BY C.id_cotizacion ASC";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result))
{
?>
<tr>
    <td align="center">
    COT <?php echo $fila[2] ?>
    </td>
    <td align="center">
    <?php echo $fila[1] ?>
    </td>
    <td><?php echo $fila[0] ?></td>
    <td>
    <a href="Cotizacion/vistacot.php?id_cotizacion=<?php echo $fila[2]; ?>">
    <img src="../images/detalle.png"/></a>
    
    <a href="Cotizacion/clonar.php?id_cot=<?php echo $fila[2]; ?>&id_clie=<?php echo $fila[3]; ?>" style="text-decoration:none;">
    <img src="../images/copy2.png" width="20" height="20" >Clonar</a>

    <a href="Cotizacion/pdfcot.php?id_cotizacion=<?php echo $fila[2]; ?>" style="text-decoration:none;">
    <img src="../images/filpdf.png" width="20" height="20" >PDF</a>
    
    <a style="text-decoration:none;" href="desactivar.php?id_cot=<?php echo $fila[2]; ?>">
    <img src="../images/inactivo.png" width="20" height="20">quitar</a>
    </td>
    
</tr>
<?php
}
 ?>
</table>
</center>
 <div class="contbarra"></div>
 </div>
