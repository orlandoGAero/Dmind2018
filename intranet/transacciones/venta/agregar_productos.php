<link rel=stylesheet href="../../css/formatocotizacion.css" type="text/css">
<?php
require('../../conexion.php');
  session_start();
  // Manejamos en sesión el nombre del usuario que se ha logeado
  if(!isset($_SESSION["usuario"])){
    header("location:../");  
  }
  $_SESSION["usuario"];
  // Termina inicio de sesión
  
  require('funciones_ventas.php');
  $funcVentas = new funciones_ventas();

  $idVenta = $_REQUEST['txtNumVenta1'];
  $idProducto = $_REQUEST['sltModeloProd'];
  $idInventario = $_REQUEST['sltNumSerie'];
  $notaProdAdd = $_REQUEST['txtNotaDescrip'];
  $precioPr = $_REQUEST['txtPrice'];

// Obtiene el tipo de moneda.
$moneda = $funcVentas -> obtenerTipoMonedaVenta($idVenta);
// Obtiene el NOMBRE de la MONEDA PREDETERMINADA del TIPO de CAMBIO.
$DatosNomMoneda = $funcVentas -> monedaPredeterminada();
$nomMoneda = $DatosNomMoneda['nombre_moneda'];
// Obtiene el VALOR según la  MONEDA PREDETERMINADA.
$valorTipoCambio = $funcVentas -> obtenerValorTipoCambio($nomMoneda);

  echo "<input type='hidden' name='txtTipoMoneda' id='moneda' value='$moneda' readonly>";
  if($moneda == 2){
    /*Se cambia el valor de la moneda a 1, ya que antes de agregar un producto a la venta, el precio de este viene siempre en dolares; pero si el usuario decide hacer la venta en pesos y quiere agregar otro producto despúes de hacer el cambio, este ya se guarde con el precio en pesos y no en dólares como es por default. */
    $monedaEnDolares = 1;
    $precioPrEnPesos = $funcVentas -> pesosMexicanos($monedaEnDolares,$precioPr);
    $funcVentas -> guardarProductosAgregadosVenta($idVenta,$idProducto,$idInventario,$notaProdAdd,$precioPrEnPesos,2);
    // El número dos hacer referencia a la moneda Pesos
  }else{
    $funcVentas -> guardarProductosAgregadosVenta($idVenta,$idProducto,$idInventario,$notaProdAdd,$precioPr,$moneda);
  }
?>
<?php $datosProductsAdd = $funcVentas -> tmpObtenerDetalleVenta($idVenta) ?>
<input type="hidden" id="registros" value="1" readonly>
<table cellpadding="0" cellspacing="0">
  <tr>
    <th>CANTIDAD</th>
    <th>DESCRIPCIÓN</th>
    <th>PRECIO UNITARIO</th>
    <th>IMPORTE</th>
    <th>&nbsp;</th>
  </tr>
  <?php foreach($datosProductsAdd as $prodAdd) :?>
    <tr>
      <td>
        <input type="hidden" name="txtIdDetVentaTmp" value="<?=$prodAdd['id_vent_det_tmp']?>" readonly>
        <input type="hidden" name="txtCantidadPr[]" value="<?=$prodAdd['cantProd']?>" readonly>
        <?=$prodAdd['cantProd']?>
      </td>
      <td style="text-align:left;">
        <input type="hidden" name="txtIdInvTmp[]" value="<?=$prodAdd['id_inv_tmp']?>" readonly>
        <input type="hidden" name="txtIdPr[]" value="<?=$prodAdd['id_producto_tmp']?>" readonly>
        <b><?=$prodAdd['nombre']?></b>
        <?=$prodAdd['nombre_marca']?>
        <?=$prodAdd['modelo']?>
        <?=$prodAdd['descripcion']."."?>
        <b><?="<br>".$prodAdd['noserie']."<br>"?></b>
        <?php $notaProducto = explode('[br]', $prodAdd['notaDescr']) ?>
        <?php foreach($notaProducto as $notaProd) :?>
          <?php if($notaProd != NULL) :?>
            <?=$notaProd."<br>"?>
          <?php endif ?>
        <?php endforeach ?>
      </td>
      <td>
        <b>$</b><?=number_format($prodAdd['precio_unitario_tmp'],2,'.',',')?>
      </td>
      <td>
        <b>$</b><?=number_format(($prodAdd['cantProd']*$prodAdd['precio_unitario_tmp']),2,'.',',')?>
      </td>
      <?php if($prodAdd['cantProd'] >= 2) :?>
        <td>
          <?php $id = $prodAdd['id_vent_det_tmp']; ?> 
          <a href="eliminar_productos.php?id_p=<?=$id?>" class="btn-eliminar">
            <img src="../../images/delete-24.png" title="Borrar Producto" />
          </a>
        </td>
        <div id="fade" class="overlay" onclick="document.getElementById('dialog-del').style.display='none';document.getElementById('fade').style.display='none'"></div>
        <div id='dialog-del' class="modal"></div>
      <?php elseif($prodAdd['cantProd'] == 1) :?>
        <td>
          <form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
            <input type="hidden" name="txt_idV" value="<?=$prodAdd['id_vent_det_tmp']?>" readonly>
            <button type="button" class="borrar_s" style="background:transparent;border:none;width:auto;height:auto;cursor:pointer;">  
              <img src="../../images/delete-24.png" title="Borrar Producto" />
            </button>
          </form>
        </td>
      <?php endif; ?>
    </tr>
  <?php endforeach; ?>
</table>
<table id="operaciones">
  <tr>
    <td class="izqOperac">Tipo de Cambio: <b>$</b><?=$valorTipoCambio?> <b>USD</b></td>
    <td class="azulOperac">SUBTOTAL:</td>
    <td class="costos">
      <?php $SubtotalVenta = $funcVentas -> tmpSubtotalVenta($idVenta) ?>
        <input type="hidden" name="txtSubtotalSinFormato" id="subtotalSinFormato" value="<?=$SubtotalVenta?>" readonly />
        <b>$</b><input type="text" name="txtSubtotal"  id="subtotal" style="width:6.5em; height:1em;text-align:right;" value="<?=$SubtotalVenta?>" readonly />
    </td>
  </tr>
  <tr>
    <td class="izqOperac">
      <?php if($moneda == 1) :?>
          Moneda: <b>USD</b>
      <?php elseif($moneda == 2) :?>  
          Moneda: <b>MXN</b>
      <?php endif; ?>
    </td>
    <td class="costos" colspan="2">
      <?php $Impuestos = $funcVentas -> obtenerImpuestos() ?>
      <select name="sltImpuesto" id="NomImpuesto" class="impuestos" required>
        <?php foreach($Impuestos as $impuesto) :?>
          <option value="<?=$impuesto['id_impuesto']?>"><?=$impuesto['nombre_impuesto']?></option>
        <?php endforeach; ?>
      </select>
      <?php if(isset($_REQUEST['impuesto'])) :?>
          <input type="text" name="txtImpuesto" id="impuesto" style="width:2em;height:1em;text-align:right;" value="<?=$_REQUEST['impuesto']?>"><b>%</b>
        <?php else :?>
          <input type="text" name="txtImpuesto" id="impuesto" style="width:2em;height:1em;text-align:right;" value="0"><b>%</b>
        <?php endif; ?>
    </td>
  </tr>
  <tr>
    <td class="izqOperac"></td>
    <td class="azulOperac radiusBottomIzq">TOTAL:</td>
    <td class="costos radiusBottomDer">
      <input type="hidden" name="txtTotalSinFormato" id="totalSinFormato" readonly />
      <b>$</b><input type="text" name="txtTotal" id="total" style="width:6.5em; height:1em;text-align:right;" readonly />
    </td>
  </tr>
</table>
<!-- Funciones de Registrar Venta -->
<script type="text/javascript">
  var $ = jQuery.noConflict();
  $(document).ready(function($) {
   // Función para abrir ventana emergente, si hay mas de dos productos
  $('.btn-eliminar').on("click",function(event) {
    event.preventDefault();
    var url = $(this).attr("href");
    $('#dialog-del').load(url);
    document.getElementById('dialog-del').style.display='block';
    document.getElementById('fade').style.display='block'
  });
  // Función para borrar un producto
   $('.borrar_s').on("click",function(){
      if (confirm('¿Desea eliminar el registro?')) {
        formborrar = this.form;
        $('#tablaProductos').load('borrar_producto_single.php',$(formborrar).serialize());
        // Llamando otra Función.
            actualizaNumSeries();
      }
    });
    /* Activa o Desactiva los botones de Quitar Productos y Cambio de Moneda,
        dependiendo si hay productos agregados. */
    var txtDetalleVenta = $("#registros").val();
    if (txtDetalleVenta != 0) {
      $("#borrtodo").removeAttr('disabled');
      $("#pesosM").removeAttr('disabled');
      $("#dolaresA").removeAttr('disabled');
    }
    // Mostrar informacion del Cliente
    $("#nombreCliente").change(function() {
      $("#datosCliente").load('datoscliente.php?idCliente='+$("#nombreCliente").val());
      if($("#nombreCliente").val() != 0 && txtDetalleVenta != 0){
        $("#btnVender").removeAttr('disabled');
        $("#btnImprimir").removeAttr('disabled');
        $("#IDcliente").val($("#nombreCliente").val());
      }else{
        $("#btnVender").attr('disabled','disabled');
        $("#btnImprimir").attr('disabled','disabled');
      }
    });
    // FUNCIÓN que formatea una cantidad monetaria. 
    function addComma(nStr){
      nStr += '';
      x = nStr.split('.');
      x1 = x[0];
      x2 = x.length > 1 ? '.' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
      }
      return x1 + x2;
    }
    // Valida si el IMPUESTO esta vació, este muestra un 0.
      $("#impuesto").focusout(function(event) {
        if($("#impuesto").val() == ""){
          $("#impuesto").val(0);
        }
      });
    // FUNCIÓN que calcula el precio TOTAL de la VENTA.
      function calcularTotalVenta(subTotalVent,porcentImpuestoVent,tipoImpuestoVent){
        if (porcentImpuestoVent == "") {
              porcentImpuestoVent = 0;
        }
            var impuestoDecimales = (parseFloat(porcentImpuestoVent)/ 100);
            var calcularTotal = (parseFloat(subTotalVent) * parseFloat(impuestoDecimales));
            if(tipoImpuestoVent == 1 || tipoImpuestoVent == 2){
              var resultadoFinal = (parseFloat(subTotalVent) + parseFloat(calcularTotal));
            }else if(tipoImpuestoVent == 3){
              var resultadoFinal = (parseFloat(subTotalVent) - parseFloat(calcularTotal));
            }
            $("#totalSinFormato").val(parseFloat(resultadoFinal));
            $("#total").val(addComma(parseFloat(resultadoFinal).toFixed(2)));
            // $("#porcentIva").val(porcentImpuestoVent);
      }
    // FUNCIÓN que obtiene el porcentaje según el ID del IMPUESTO.
      function porcentajeImpuesto(idImpuesto){
        if (idImpuesto == 1) {
          $("#impuesto").val(16);
        }else{
          $("#impuesto").val(0);
        }
      }
    // TIPO IMPUESTO.
      var tipoImpuesto = $("#NomImpuesto").val();
    // MOSTRAR valor del IMPUESTO.
      porcentajeImpuesto(tipoImpuesto);
    // Calcular TOTAL con IMPUESTO.
        var subtotalV = $("#subtotal").val();
        $("#subtotal").val(addComma(parseFloat(subtotalV).toFixed(2)));
        var impuestoV = $("#impuesto").val();
        calcularTotalVenta(subtotalV,impuestoV,tipoImpuesto);
    // FUNCIÓN que obtiene el porcentaje al cambiar el ID del IMPUESTO.
      $("#NomImpuesto").change(function() {
        var tipoImpuesto = $("#NomImpuesto").val();
        porcentajeImpuesto(tipoImpuesto);
        var subtotal = $("#subtotalSinFormato").val();
            var impuesto = $("#impuesto").val();
            var tipoImpuesto = $("#NomImpuesto").val();
            calcularTotalVenta(subtotal,impuesto,tipoImpuesto);
      });
      // FUNCIÓN que CALCULA el TOTAL al ingresar un valor en la caja de texto del IMPUESTO.
        $("#impuesto").keyup(function() {
            var subtotal = $("#subtotalSinFormato").val();
            var impuesto = $("#impuesto").val();
            var tipoImpuesto = $("#NomImpuesto").val();
            calcularTotalVenta(subtotal,impuesto,tipoImpuesto);
        });
  });
</script>