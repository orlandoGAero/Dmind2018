<?php

     ob_start();
?>

<style type="text/css">
<!--
.ecnabezado{
    background: #CCDDCC;
}
.cotz{
    color: #0E4A7C;
    font-weight: bold;
    text-align: center;
    font-size: 13px;
    padding: 4px;
    width: 160px; 
    border-left: solid 1px #000; 
    border-top: solid 1px #000; 
    border-right: solid 1px #000; 
    border-bottom: solid 1px #000;  
}
.foli{
    margin-top: -2px;
}
.atenc{
    margin-left: 40px;
    color: white;
    background: #0E4A7C;
}
.nomdue{
    margin-left: 300px;
    color: white;
    background: #0E4A7C;
}
.medlinea{
    font-size: 1px;
    height: 1px;
    width: 250mm;
    background: #0E4A7C;
}
.datosclie{
    padding: 5px;
    margin-top: -2px;
    font-size: 12px;
    width: 220px;
    height: 11em;
    border-top: solid .5mm #0E4A7C;
    border-bottom: solid;
    border-left: solid .5mm #0E4A7C; border-bottom: solid .5mm #0E4A7C;
}
.datoscotizador{
    padding: 5px;
    font-size: 12px;
    width: 220px;
    height: 11em;
    border-top: solid .5mm #0E4A7C;
    border-bottom: solid;
    border-left: solid .5mm #0E4A7C;
    border-bottom: solid .5mm #0E4A7C;
}
table{
    width: 700px;
}
table th{
    padding: 5px;
    color: white;
    background: #0E4A7C;
}
.cantidad{
    width: 60px;
}
.descripcion{
    width: 300px;
    text-align: justify;
}
.desc{
    padding-left: 10px;
    padding-top: 5px;
}
.preciou{
    width: 10em;
}
.importe{
    width: 100px;
}
.noborde{
    border-bottom: 0px;
}
.operaciones{
    width: 130px;
    margin: 0px 0px 0px 533px;
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
.cli{
    width: 400px;
    background: #fff;
    color: #000;
}
.co{
     background: #fff;
    color: #000;   
}

-->
</style>
<page backtop="5mm" backbottom="7mm" backleft="7mm" pagegroup="new">
        <table>
            <tr>
                <td>
                    <img class="icono" src="../Imagenes/banner.png" width="450" height="90" >
                </td>
                <td>
                    <div class="cotz">
<?php
include ('../../conexion.php');
$id_cotizacion=$_GET["id_cotizacion"];
$query = "SELECT $id_cotizacion, fecha, id_cliente  FROM cotizacion where id_cotizacion=$id_cotizacion";
$result = mysql_query($query);

    while ($fila = mysql_fetch_array($result))
    {
        echo "<b  class='titu'>COTIZACION DIGITAL</b><p class='foli'>COT ", $fila[0], "</p>";
        echo "FECHA : ", $fila['fecha'], " ";
        $fecha=$fila['fecha'];
    }
?>
                    </div>
                </td>
            </tr>
        </table>

<?php
$query = "SELECT id_cliente  FROM cotizacion where id_cotizacion=$id_cotizacion";
$result = mysql_query($query) or die ("la consulta fallo:".mysql_error());

    while ($fila = mysql_fetch_array($result))
    {
        $id_cliente=$fila[0];
    }
?>
<?php //detalles del cliente
$sql="SELECT C.id_cotizacion, nombre_cliente, calle, num_ext,num_int,colonia,localidad, municipio, D.estado, pais, cod_postal,F.rfc from cotizacion C
       inner join clientes on C.id_cliente=clientes.id_cliente 
       inner join datos_fiscales F on clientes.id_datfiscal=F.id_datfiscal
       inner join direcciones D on F.id_direccion=D.id_direccion where id_cotizacion=$id_cotizacion";
$result=mysql_query("$sql");
?>
<b class="atenc">EN ATENCION A</b>
<b class="nomdue">COTIZACIÓN DE</b>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td class="cli">
<div class="datosclie">
<?php
    while ($fila = mysql_fetch_array($result))
    {
        $nombre=$fila['nombre_cliente'];
        echo "<h5>", $fila['nombre_cliente'], "</h5>";
        echo "<div> RFC: <b>", $fila['rfc'], "</b></div>";
        echo "<div> Dirección: <b>", $fila['calle'], "</b></div>";
        echo "<div> Colonia: <b>", $fila['colonia'], "</b></div>";
        echo "<div> Localidad: <b>", $fila['localidad'], "</b></div>";
        echo "<div> Municipio: <b>", $fila['municipio'], "</b></div>";
        echo "<div> Estado: <b>", $fila['estado'], "</b></div>";
        echo "<div> C.P./ PAIS: <b>", $fila['cod_postal'], " ", $fila['pais'],"</b></div>";
}
?>
</div>
</td>
<td>
<div class='datoscotizador'>
 <h5>EMANUEL ESPEJEL RODRIGUEZ</h5>
 <div>RFC:<b> EERE780924Q89</b></div>
 <div>Dirección:<b> MANUEL VILLA VERDE 1 40 B</b></div>
 <div>Colonia:<b> CARLOS HANK GONZALES</b></div>
 <div>Localidad:<b> </b></div>
 <div>Municipio:<b>TOLUCA </b></div>
 <div>Estado:<b> EDO. DE MÉXICO</b></div>
 <div>C.P. /Pais:<b> 50026 / MÉXICO</b></div>
</div>
</td>
</tr>
</table>
<br>
<table cellpadding="0" cellspacing="0" border=".5" width="100%">
<tr>
<th class='cantidad'>CANTIDAD</th>
<th class="descripcion">DESCRIPCION</th>
<th>PRECIO UNITARIO</th>
<th class="importe">IMPORTE</th>
</tr>
<?php
$id_cotizacion=$_GET["id_cotizacion"];
$query = "SELECT  id_cotizacion, descripcion, precio, cantidad, importe FROM detalle_cotizacion where id_cotizacion=$id_cotizacion";
$result = mysql_query($query);
$cuantos=mysql_num_rows($result);
?>
<?php
    while ($fila = mysql_fetch_array($result))
    {
        echo "<tr>";
        echo "<td align='center'>", $fila['cantidad'], "</td>";
        echo "<td class='desc'>", $fila['descripcion'], "</td>";
        echo "<td align='center'>", $fila['precio'], "</td>";
        echo "<td align='center'>", $fila['importe'], "</td>";
        echo "</tr>";
}
?>
</table>
<div class="operaciones">
<?php
$sql="SELECT SUM(importe) FROM detalle_cotizacion WHERE id_cotizacion= $id_cotizacion";
$result=mysql_query("$sql");
?>
<b> SUBTOTAL:</b>
<?php 
while ($fila = mysql_fetch_array($result)){
     
     $subt=$fila[0]; 
    }
    //rowspan="2"

$sql="SELECT subtotal,iva,total FROM cotizacion WHERE id_cotizacion= $id_cotizacion";
$result=mysql_query("$sql");

while ($fila = mysql_fetch_array($result)){
 echo "<b class='num1'>$",$fila["subtotal"],"</b>";
 $iv=$fila["iva"];
  $iva=$iv*.01;//iva del subtotal
    $cuent=$subt*$iva;
  echo "<br><b> I.V.A: </b>";
  echo '<b class="num2">$';
  echo $cuent;
  echo '</b>';
  echo "<br><b> TOTAL: </b>";
  echo '<b class="num3">$';
  echo $fila["total"];
  echo '</b>';
    }
?> 
</div>
<div class="nota">
   Notas: <br>
-Las cantidades expresadas en la presente cotización no incluyen IVA en precios unitarios <br>
-Las cantidades expresadas en la presente cotización estan sujetos a cambio sin previo aviso <br>
-Las cantidades expresadas en la presente cotización están representadas en pesos mexicanos M.N <br>
</div>
<p class="footer">
Cableado Estructurado – Fibra óptica – UTP – telefonía análoga y digital – Conmutadores – Telefonía IP – Router – Switch - POE - Cuarto de
comunicaciones – servidores – Firewall – Proxy – Servidor WEB Mail – Bases de Datos – Desarrollo –hosting - Programación WEB – PHP –
Java – Linux – Conectividad inalámbrica – Redes PAN LAN WAN MAN – Wireless – Micro Ondas - WIMAX – Seguridad Informática –
Sistemas de vigilancia y monitoreo – CCTVIP – DVR – NVR – cámaras IP – Enlaces dedicados - Torres de comunicaciones – auto
soportadas – Arriostradas – tratamiento de datos – QoS – balanceo de cargas – IPs Publicas 
        </p>
</page>
<!--
    <div class="div div1">Exemple de div</div>
    <div class="div div2">Exemple de div</div>
    <div class="div div3">Exemple de div</div>
    <div class="div div4">Exemple de div</div>
    <div class="div div5">Exemple de div</div>
    <div class="div div6">Exemple de div</div>
    <div class="div div7">Exemple de div</div>
    <div class="div div8">Exemple de div</div>
<page pageset="old">
    Ceci est la page 2 du groupe 1
    </page>
<page_header>
  </page_footer>
-->
<?php
     $content = ob_get_clean();
    // convert to PDF
    require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('Cotizacion-'.$id_cotizacion.'-'.$nombre.'-'.$fecha.'.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>