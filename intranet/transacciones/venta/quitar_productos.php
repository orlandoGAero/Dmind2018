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
  $funcVentas -> eliminarAllProductos($idVenta);
?>

<?php include 'tabla_venta_detalle.php' ?>
<script type="text/javascript">
  // Cambio de Moneda
  var txtTipoMoneda = $("#moneda").val();
  // Habilitar botón de Cambiar Venta a Pesos si se encuentra en Dolares.
  if (txtTipoMoneda == 1) {
    $("#pesos").show();
    $("#dolares").hide();
  }
  // Habilitar botón de Cambiar Venta a Dólares si se encuentra en Pesos.
  if(txtTipoMoneda == 2) {
    $("#dolares").show();
    $("#pesos").hide();
  }
</script>