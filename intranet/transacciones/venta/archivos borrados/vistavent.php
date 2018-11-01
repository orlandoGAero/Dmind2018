<?php header("Content-type: text/html; charset=utf-8"); ?>
<?php 
include ('../../conexion.php');
 ?>
 <!DOCTYPE html>
<html>
  <head>
      <title>Digital Mind</title>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" type="image/x-icon" href="../../images/favicon.ico" />
        <link rel=stylesheet href="../../css/scroll.css" type="text/css">
        <link rel=stylesheet href="../../css/formatocotizacion.css" type="text/css">
</head>
<body background="../imagenes/bg.jpg">
  <header>
    <img src="../../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
  </header>

  <nav>
    <ul>
      <li><a href="../../Home" alt="Inicio" title="Inicio"><img src="../../images/home.png"/></a></li>
      <li></li><li></li><li></li><li></li>
      <li><a href="../../salir.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../../images/lock.png"/></a></li>
    </ul>
  </nav>
<article>
<img class="icono" src="../Imagenes/banner.png" >
<br>
<div><spam>
<?php
$id_venta=$_GET["venta"];
$query = "SELECT id_venta, fecha FROM venta where id_venta=$id_venta";
$result = mysql_query($query) or die ("la consulta fallo:".mysql_error());

    while ($fila = mysql_fetch_array($result))
    {
        echo "COTIZACION DIGITAL<br> COT ", $fila[0], "<br> ";
        echo "FECHA : ", $fila['fecha'], " ";
}
?></spam>
</div>
<table><tr>
<td>
<div class="datosclie" id="camposclie" style="padding-left:10px; padding-top:15px;">
<h3>EN ATENCION A</h3>
<br>
<?php
$query="SELECT V.id_venta, nombre_cliente, calle, num_ext,num_int, localidad, municipio, D.estado, pais, cod_postal,F.rfc from venta V
       inner join clientes on V.id_cliente=clientes.id_cliente 
       inner join datos_fiscales F on clientes.id_datfiscal=F.id_datfiscal
       inner join direcciones D on F.id_direccion=D.id_direccion where id_venta=$id_venta";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result))
{
    echo "<li>", $fila['nombre_cliente'],"</li>";
    echo "<br>";
    echo "<li>RFC:<b>", $fila['rfc'],"</b></li>";
    echo "<li>Dirección:<b>", $fila['calle']," ", $fila['num_ext']," ", $fila['num_int'],"</b></li>";
    echo "<li>Colonia:<b>", $fila['localidad'],"</b></li>";
    echo "<li>Localidad:<b>", $fila['localidad'],"</b></li>";
    echo "<li>Municipio:<b>", $fila['municipio'],"</b></li>";
    echo "<li>Estado:<b>", $fila['estado'],"</b></li>";
    echo "<li>C.P. /Pais:<b>", $fila['cod_postal'],"/", $fila['pais'],"</b></li>";
    } 
?>
</div>
</td>
<td colspan="2" class="vacio"></td>
<td>
<div class="datoscotizador" style="padding:10px;">
    <h3>COTIZACIÓN DE</h3><br>
    <li>EMANUEL ESPEJEL RODRIGUEZ</li>
    <br>
    <li>RFC:</spam><b> EERE780924Q89</b></li>
    <li>Dirección:<b> MANUEL VILLA VERDE 1 40 B</b></li>
    <li>Colonia:<b> CARLOS HANK GONZALES</b></li>
    <li>Localidad:<b> </b></li>
    <li>Municipio:<b>TOLUCA </b></li>
    <li>Estado:<b> EDO. DE MÉXICO</b></li>
    <li>C.P. /Pais:<b> 50026 / MÉXICO</b></li>
</div>
</td>
</tr></table>
<section>
<table cellpadding="0" cellspacing="0" class="products" style="margin-top:-30px; margin-left:-10px;">
<tr>
<th class="cantidad">CANTIDAD</th>
<th>DESCRIPCION</th>
<th>PRECIO UNITARIO</th>
<th>IMPORTE</th>

</tr>
<?php
$query="SELECT * FROM detalle_venta 
          where id_venta=$id_venta";
$result=mysql_query($query);
while($row=mysql_fetch_array($result))
{
        echo "<tr>";
        echo "<td class='cantidad'>", $row['cantidad'], "</td>";
        echo "<td class='desc'>", $row['descripcion']," ", $row['nota'] ,"</td>";
        echo "<td class='preciou'>", $row['precio'], "</td>";
        echo "<td class='importe'>", $row['importe'], "</td>";
        echo "</tr>";
}
?>
</table>
<aside class="operacionesvista">
<?php
$sql="SELECT SUM(importe) FROM detalle_venta WHERE id_venta= $id_venta";
$result=mysql_query("$sql");
?>
<b> SUBTOTAL:</b>
<?php 
while ($row = mysql_fetch_array($result)){
     
     $subt=$row[0]; 
    }
    //rowspan="2"
?>
<?php
$sql="SELECT subtotal,iva,total FROM venta WHERE id_venta= $id_venta";
$result=mysql_query("$sql");
while ($fila = mysql_fetch_array($result)){
 echo "<b class='num1'>$",number_format($fila["subtotal"], 2, '.', ''),"</b>";
 $iv=$fila["iva"];
  $iva=$iv*.01;//iva del subtotal
    $cuent=$subt*$iva;
  echo "<br><b> I.V.A: </b>";
  echo '<b class="num2">$';
  echo number_format($cuent, 2, '.', '');
  echo '</b>';
  echo "<br><b> TOTAL: </b>";
  echo '<b class="num3">$';
  echo number_format($fila["total"], 2, '.', '');
  echo '</b>';
    }
?> 
</aside>
</article>
 
<div id="botones">
<br>
<a href="./registroventas.php"><div id="buscotizacion">Buscar Cotizacion</div></a>
<br>
<br>
<br>
<br>
<br>
<br>
<a href="pdfvent.php?venta=<?php echo $_GET["venta"]; ?>" target="_blank"><button id="guardar"> Imprimir </button></a><br>
</section>
<br>
        <a href="agregarcotizacion.php"><button id="nuevacot">Nueva Cotizacion</button></a><br>
        <a href="../registrocotizaciones.php"><button id="atras">Salir</button></a><br>
<br><br>

</div>
  <br><br>
</body>
</html>