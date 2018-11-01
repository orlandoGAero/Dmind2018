<?php
     session_start();
    // Manejamos en sesión el nombre del usuario que se ha logeado
    if(!isset($_SESSION["usuario"])){
        header("location:../");  
    }
    $_SESSION["usuario"];
    // Termina inicio de sesión

    // get the HTML
     ob_start();
?>

<style>
<!--


.icono{
    margin-left: 15px;
    margin-top: 15px;
    float: left;
    width: 336px;
    height: 84px;
}

#datosVenta{
    margin: 16px 0 15px 260px;
    padding: 2px;
    width: 140px;
    text-align: center;
    font-weight: bold;
    border: 1px 1px 1px 1px #000;
    border-radius: 5px;
}

.divstatus{
    display:inline-block;
    position:relative;
    padding:2px;
    margin-left:340px;
    margin-bottom: 10px;
}

#ClientVendedor {
    margin-top: 90px;
    width: 100%;
    margin-left: 50%;
}

.sizeMin{
    width: 5%;
}

.limite{
    width: 4%;
}

.tituloAzul{
    background: #4682B4;
    width: 16%;
    height: 17px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    color: #fff;
    font-weight: bold;
    font-size: 12px;
    text-align: center;
}

.borderAzul {
    width: 43%;
    border: 2px solid #4682B4;
    border-radius: 5px;
}

#datosCliente{
    font-size: 11px;
    margin-top: 2px;
    margin-left: 10px;
    border-collapse: collapse;
 }

#datosVendedor{
    font-size: 11px;
    margin-top: 2px;
    margin-left: 10px;
}

.br {
    height: 5px;
}

.nota{
    margin-top: -35px;
    font-family: arial;
    font-style: italic;
    font-size: 10px;
    font-weight: bold;
    width: 500px;
    height: 50px;
    padding-right: 7px;
}
.footer{
    color: #bbb;
    font-size: 11px;
    text-align: center;
}


table#tablaProductos {
    margin-top: 20px;
    margin-left: 38px;
    border-collapse: collapse;
    border-spacing: 0;
}

#tablaProductos th{
    background: #4682B4;
    padding: 0 8px;
    height: 35px;
    border: 1px solid #0E4A7C;
    text-align: center;
}

#tablaProductos td{
    font-size: 11px;
    text-align: center;
    border: 1px #0E4A7C;
}

.minimum {
    width: 14%;
}

.maximum {
    width: 47%;
}

.descripcion {
    text-align: left;
    padding: 5px;
}

table#operaciones {
    margin-top: 0.1px;
    margin-left: 38px;
    border-collapse: collapse;
    border-spacing: 0;
}

.izqOperac {
    width: 66%;
    font-weight: normal;
    font-size: 11.5px;
    font-family: Times, serif;
    text-align: left;
}

.azulOperac {
    background: #4682B4;
    font-weight: bold; 
    font-size: 9.8px;
    text-align: right;
    padding: 2px 5px 2px 0;
    width: 11%;
    border-right: 0.5px solid #4682B4
}

.costos {
    background: #4682B4;
    font-weight: normal; 
    font-size: 9.8px;
    text-align: right;
    padding: 2px 5px 2px 0;
    width: 12%;
}

.radiusTopIzq{
    border-top-left-radius: 7px;
}

.radiusTopDer {
    border-top-right-radius: 7px;
}

.radiusBottomIzq{
    border-bottom-left-radius: 5px;
}

.radiusBottomDer {
    border-bottom-right-radius: 5px;   
}

-->
</style>

<?php
    require_once('/../../conn.php');
    require_once('funciones_ventas.php');

    $connect = new conn();
    $connect -> conectar();

    require_once("../../libs/encrypt_decrypt_strings_urls.php");
    $idVenta= decrypt(htmlspecialchars($_GET["venta"]),"intranetdmventas");
    
    $funcVentas = new funciones_ventas();
    $datosv = $funcVentas -> obtdventa($idVenta);

?>

<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm" pagegroup="new">
    <page_header>
        <img class="icono" src="../Imagenes/banner.png" >
        <div id="datosVenta">
            Nota de Venta <br/>
            VENTA <?=$datosv['id_venta']?><br />
            <?php 
                $fecha = date_format(date_create($datosv['fecha_hora']),'d/m/Y H:i:s');
            ?>
            Fecha: <?=$fecha?>
        </div>
        <div class="divstatus">
            <b><?=$datosv['nombre_status_venta']?></b>
        </div>
    </page_header>

    <table cellspacing="-2" id="ClientVendedor">
        <tr>
            <td class="sizeMin"></td>
            <td class="sizeMin"></td>
            <td class="tituloAzul">EN ATENCIÓN A</td>
            <td class="sizeMin"></td>
            <td class="limite"></td>
            <td class="sizeMin"></td>
            <td class="tituloAzul">VENTA DE</td>
            <td class="sizeMin"></td>
            <td class="sizeMin"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3" class="borderAzul">
                <table id="datosCliente">
                    <?php
                        $datcl = $funcVentas -> datosCliente($datosv['id_cliente']);
                    ?>
                    <tr><td><div style="width: 95%;">Cliente: <b><?=$datosv['nombre_cliente']?></b></div></td></tr>
                    <tr><td class="br"></td></tr>
                    <tr><td>RFC: <b><?=$datcl['rfc']?></b></td></tr>
                    <tr><td>Dirección: <b><?=$datcl['calle'];?> <?=$datcl['num_ext'];?> <?=$datcl['num_int'];?></b></td></tr>
                    <tr><td>Colonia: <b><?=$datcl['colonia']?></b></td></tr>
                    <tr><td>Localidad: <b><?=$datcl['localidad']?></b></td></tr>
                    <tr><td>Municipio: <b><?=$datcl['municipio']?></b></td></tr>
                    <tr><td>Estado: <b><?=$datcl['estado']?></b></td></tr>
                    <tr><td>C.P./País: <b><?=$datcl['cod_postal']?>/<?=$datcl['pais']?></b></td></tr>
                </table>
            </td>
            <td></td>
            <td colspan="3" class="borderAzul">
                <table id="datosVendedor">
                    <tr><td>Vendedor: <b><?=$datosv['nom_vend']?></b></td></tr>
                    <tr><td class="br"></td></tr>
                    <tr><td>RFC: <b>EERE780924Q89</b></td></tr>
                    <tr><td>Dirección: <b>Manuel Villa Verde 1 40B</b></td></tr>
                    <tr><td>Colonia: <b>Carlos Hank González</b></td></tr>
                    <tr><td>Localidad: <b>Toluca</b></td></tr>
                    <tr><td>Municipio: <b>Toluca</b></td></tr>
                    <tr><td>Estado: <b>México</b></td></tr>
                    <tr><td>C.P./País: <b>50026/México</b></td></tr>
                </table>
            </td>
            <td></td>
        </tr>
    </table>
    
    <?php $datosdetv = $funcVentas -> obtdetventa($idVenta) ?>
    <table id="tablaProductos">
      <tr>
        <th class="minimum radiusTopIzq">CANTIDAD</th>
        <th class="maximum">DESCRIPCIÓN</th>
        <th class="minimum">PRECIO UNITARIO</th>
        <th class="minimum radiusTopDer">IMPORTE</th>
      </tr>
      <?php $moneda = $datosv['id_moneda']; ?>
      <?php foreach($datosdetv as $datdetve) :?>
          <tr>
            <td class="minimum"><?=$datdetve['cantp']?></td>
            <td class="maximum descripcion">
                <?php $notaProducto = explode('[br]', $datdetve['notaProd']) ?>
                <b><?=$datdetve['nombre']?></b>
                <?=$datdetve['nombre_marca']?>
                <?=$datdetve['modelo']?>
                <?=$datdetve['descripcion']."."?><b>
                <?="<br>".$datdetve['noserie']."<br>"?>
                </b><?php foreach($notaProducto as $notaProd) if($notaProd != NULL) echo $notaProd."<br />"?>
            </td>
            <td class="minimum">
                <b>$</b><?=number_format($datdetve['precio_unitario'],2,'.',',')?>
            </td>
            <?php $import = $datdetve['precio_unitario']*$datdetve['cantp'] ?>
            <td class="minimum">
                <b>$</b><?=number_format($import,2,'.',',')?>
            </td>
          </tr>
       <?php endforeach; ?>
    </table>

    <table cellspacing="-1" id="operaciones">
        <tr>
            <td class="izqOperac">
                <!-- Obtiene el NOMBRE de la MONEDA PREDETERMINADA del TIPO de CAMBIO. -->
                <?php $DatosNomMoneda = $funcVentas -> monedaPredeterminada(); ?>
                <?php $nomMoneda = $DatosNomMoneda['nombre_moneda'] ?>
                <!-- Obtiene el VALOR según la  MONEDA PREDETERMINADA -->
                <?php $valorTipoCambio = $funcVentas -> obtenerValorTipoCambio($nomMoneda); ?>
                Tipo de cambio: <b>$</b><?=$valorTipoCambio?> <b>USD</b>&nbsp;
                Tipo de venta: <b><?=$datosv['nom_tipo_venta']?></b>&nbsp;
                Forma de pago: <b><?=$datosv['nom_tipo_pago']?></b>
            </td>
            <td class="azulOperac radiusBottomIzq" rowspan="3">
                <?php $nombreImpuesto = $funcVentas -> obtenerNombreImpuesto($datosv['id_impuesto']); ?>
                SUBTOTAL:<br />
                <?=$nombreImpuesto['nombre_impuesto']?>:<br />
                TOTAL:
            </td>
            <td class="costos radiusBottomDer" rowspan="3">
                <!-- Subtotal -->
                <b>$</b><?=number_format($datosv['subtotal'],2,'.',',')?>
                <br />
                <!-- I.V.A -->
                <?=$datosv['iva']?>%
                <br />
                <!-- Total -->
                <b>$</b><?=number_format($datosv['total'],2,'.',',')?>
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
        </tr>
        <tr>
            <td class="izqOperac"></td>
        </tr>
    </table>

    <page_footer>
        <div class="nota">
           Notas: <br>
            -Las cantidades expresadas en la presente cotización no incluyen IVA en precios unitarios. <br>
            -Las cantidades expresadas en la presente cotización estan sujetos a cambio sin previo aviso. <br>
            <?php if($moneda == 1) :?>
            -Las cantidades expresadas en la presente cotización están representadas en dólares americanos USD. <br />
            <?php elseif($moneda == 2) :?>
                -Las cantidades expresadas en la presente cotización están representadas en pesos mexicanos MXN. <br />
            <?php endif; ?>
        </div>
        <p class="footer">
            Cableado Estructurado – Fibra óptica – UTP – telefonía análoga y digital – Conmutadores – Telefonía IP – Router – Switch - POE - Cuarto de
            comunicaciones – servidores – Firewall – Proxy – Servidor WEB Mail – Bases de Datos – Desarrollo –hosting - Programación WEB – PHP –
            Java – Linux – Conectividad inalámbrica – Redes PAN LAN WAN MAN – Wireless – Micro Ondas - WIMAX – Seguridad Informática –
            Sistemas de vigilancia y monitoreo – CCTVIP – DVR – NVR – cámaras IP – Enlaces dedicados - Torres de comunicaciones – auto
            soportadas – Arriostradas – tratamiento de datos – QoS – balanceo de cargas – IPs Publicas 
        </p>
    </page_footer>
</page>

<?php
     $content = ob_get_clean();
    // convert to PDF
    require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'Letter', 'es', true, 'UTF-8');
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('Venta-'.$idVenta.'-'.$fecha.'.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>