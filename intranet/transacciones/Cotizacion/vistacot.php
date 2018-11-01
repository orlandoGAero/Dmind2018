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
$id_cotizacion=$_GET["id_cotizacion"];
$query = "SELECT id_cotizacion, fecha FROM cotizacion where id_cotizacion=$id_cotizacion";
$result = mysql_query($query) or die ("la consulta fallo:".mysql_error());

    while ($row = mysql_fetch_array($result))
    {
        echo "COTIZACION DIGITAL<br> COT ", $row[0], "<br> ";
        echo "FECHA : ", $row['fecha'], " ";
}
?>
</spam>
</div>
<table><tr>
<td>
<div class="datosclie" id="camposclie" style="padding-left:10px; padding-top:15px;">
<h3>EN ATENCION A</h3>
<br>
<?php
$id_cotizacion=$_GET["id_cotizacion"];
$query="SELECT C.id_cotizacion, nombre_cliente, calle, num_ext,num_int, localidad, municipio, D.estado, pais, cod_postal,F.rfc from cotizacion C
       inner join clientes on C.id_cliente=clientes.id_cliente 
       inner join datos_fiscales F on clientes.id_datfiscal=F.id_datfiscal
       inner join direcciones D on F.id_direccion=D.id_direccion where id_cotizacion=$id_cotizacion";
$result=mysql_query($query);
while($row=mysql_fetch_array($result))
{
    echo "<li>", $row['nombre_cliente'],"</li>";
    echo "<br>";
    echo "<li>RFC:</spam><b>", $row['rfc'],"</b></li>";
    echo "<li>Dirección:<b>", $row['calle']," ", $row['num_ext']," ", $row['num_int'],"</b></li>";
    echo "<li>Colonia:<b>", $row['localidad'],"</b></li>";
    echo "<li>Localidad:<b>", $row['localidad'],"</b></li>";
    echo "<li>Municipio:<b>", $row['municipio'],"</b></li>";
    echo "<li>Estado:<b>", $row['estado'],"</b></li>";
    echo "<li>C.P. /Pais:<b>", $row['cod_postal'],"/", $row['pais'],"</b></li>";
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
$id_cotizacion=$_GET["id_cotizacion"];
$query="SELECT * FROM detalle_cotizacion 
          where id_cotizacion=$id_cotizacion";
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
$id_cotizacion=$_GET["id_cotizacion"];
$sql="SELECT SUM(importe) FROM detalle_cotizacion WHERE id_cotizacion= $id_cotizacion";
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
$id_cotizacion=$_GET["id_cotizacion"];
$sql="SELECT subtotal,iva,total FROM cotizacion WHERE id_cotizacion= $id_cotizacion";
$result=mysql_query("$sql");
?>
<?php
while ($row = mysql_fetch_array($result)){
 echo "<b class='num1'>$",$row["subtotal"],"</b>";
 $iv=$row["iva"];
  $iva=$iv*.01;//iva del subtotal
    $cuent=$subt*$iva;
  echo "<br><b> I.V.A: </b>";
  echo '<b class="num2">$';
  echo $cuent;
  echo '</b>';
  echo "<br><b> TOTAL: </b>";
  echo '<b class="num3">$';
  echo $row["total"];
  echo '</b>';
    }
?> 
</aside>
</article>
 
<div id="botones">
<br>
<a href="../registrocotizaciones.php"><div id="buscotizacion">Buscar Cotizacion</div></a>
<br>
<br>
<br>
<br>
<br>
<br>
<a href="pdfcot.php?id_cotizacion=<?php echo $_GET["id_cotizacion"]; ?>" target="_blank"><button id="guardar"> Imprimir </button></a><br>
</section>
<br>
        <a href="agregarcotizacion.php"><button id="nuevacot">Nueva Cotizacion</button></a><br>
        <a href="../registrocotizaciones.php"><button id="atras">Salir</button></a><br>
<br><br>

</div>
</body>
</html>