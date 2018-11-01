<?php 
include ('../../conexion.php');

$query="DELETE FROM cotizacion WHERE not guardada=1";
$result=mysql_query("$query");

$query = "SELECT MAX(id_cotizacion) FROM cotizacion";
$result = mysql_query($query) or die ("la consulta fallo:".mysql_error());
  while ($row = mysql_fetch_array($result))
  {
 	$regis = $row[0];
  }
$query = "SELECT MAX(id_cotizacion) FROM cotizacion";
$result = mysql_query($query) or die ("la consulta fallo:".mysql_error());
  while ($row = mysql_fetch_array($result))
  {
  	$nueva = $row[0]+1;
  }

$query="DELETE FROM detalle_cotizacion WHERE id_cotizacion>$regis";
$result=mysql_query("$query");
// esta registra la nueva cotizacion
$id_clie=$_GET["id_clie"];
$fecha=date("Y-m-d");



$cuantos=$_GET["cuantos"];

for ($p=1; $p <=$cuantos; $p++) {
	$pro=$_GET["p$p"];
	$id_cot=$_GET["id_cot"];
$sql="SELECT distinct D.cantidad,P.precio,N.nombre,P.modelo FROM detalle_cotizacion D
	  inner join productos P on D.id_producto=P.id_producto
	  inner join nombres N on P.id_nombre=N.id_nombre
	  where id_cotizacion=$id_cot and D.id_producto=$pro";
$result=mysql_query($sql);
while($fila=mysql_fetch_array($result)){
  $cantidad= $fila[0];
  $precio= $fila[1];
  $nombre= $fila[2];
  $modelo= $fila[3];
}
$sql="SELECT distinct M.nombre_marca FROM detalle_cotizacion D
inner join productos P on D.id_producto=P.id_producto 
inner join marcas M on P.id_marca=M.id_marca where D.id_producto=$pro";
$result=mysql_query($sql);
while($fila=mysql_fetch_array($result)){
  echo $marca= $fila[0];
}
$importe=$cantidad*$precio;

	$productos = array(); 
	$productos [] =$_GET["p$p"];
foreach ($productos as $key => $valores) {

$sql="insert into detalle_cotizacion values('$nueva','$nombre -$modelo $marca','','$valores','$cantidad','$precio','$importe')";
$sql=mysql_query($sql);
}
}

$sql="insert into cotizacion values($nueva,'$nueva','$fecha','$id_clie','0','0','0','1','0')";
$result=mysql_query("$sql");


 ///para guardar el iva y total
$sql="SELECT SUM(importe) FROM detalle_cotizacion WHERE id_cotizacion= $nueva";
$result=mysql_query("$sql");
?>
<?php 
while ($row = mysql_fetch_array($result)){
     $subt=$row[0]; 
    }
    //rowspan="2"
$sql="SELECT iva,total FROM cotizacion WHERE id_cotizacion= $nueva";
$result=mysql_query("$sql");
?>
<?php
while ($row = mysql_fetch_array($result)){
     $row["iva"];
     $iv=$row["iva"];
    }
  $iva=$iv*.01;//iva del subtotal
  $cuent=$subt*$iva;
  $tot= $cuent+$subt; 
  $tot;


$sql="update cotizacion set subtotal='$subt',total='$tot' where id_cotizacion='$nueva'";
$result=mysql_query("$sql");


header("location: ./?id_cotizacion=$nueva");

 ?>