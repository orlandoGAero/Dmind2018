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
?>

<?php $idInv = $_REQUEST['idInventario'] ?>

<?php if($idInv != "") :?>
  <?php $precioProd = $funcVentas -> obtenerPrecioMoneda($idInv) ?>
  <label>Precio: </label>
  <b style="color:#000;">US$</b><input type="text" name="txtPrice" required id="costoProd" value="<?=$precioProd?>" readonly>
<?php else :?>
  <label>Precio: </label>
  <input type="text" name="txtPrice" value="" required id="costoProd" readonly>
<?php endif; ?>
<script type="text/javascript">
    var precio = $("#costoProd").val();    
    if (precio != "") {
      $("#addProduct").removeAttr('disabled');
    }else{
      $("#addProduct").attr('disabled', 'disabled');
    }
</script>