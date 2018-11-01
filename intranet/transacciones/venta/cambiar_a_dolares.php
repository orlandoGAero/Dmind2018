<?php
  session_start();
  // Manejamos en sesión el nombre del usuario que se ha logeado
  if(!isset($_SESSION["usuario"])){
    header("location:../");  
  }
  $_SESSION["usuario"];
  // Termina inicio de sesión

  require('../../conexion.php');
  require('funciones_ventas.php');

  $funcVentas = new funciones_ventas();
  $idVenta = $_REQUEST['txtNumVenta3'];
  $funcVentas -> cambiarVentaAdolares($idVenta);
?>

<?php include 'tabla_venta_detalle.php' ?>