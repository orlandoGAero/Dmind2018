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
  if( $funcVentas -> eliminarAllProductos($idVenta) ){
    echo "<script type='text/javascript'>
        window.location.href = 'index.php';
      </script>";
  }

?>

<?php include 'tabla_venta_detalle.php' ?>