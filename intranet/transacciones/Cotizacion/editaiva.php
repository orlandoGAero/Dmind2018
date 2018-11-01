<?php
include("../../conexion.php");
$id_cotizacion =$_GET["id_cotizacion"];
$iva =$_GET["iva"];
$moneda =$_GET["moneda"];

if ($moneda>0) {
  $sql = "UPDATE cotizacion SET id_moneda='$moneda' WHERE id_cotizacion=$id_cotizacion";
  mysql_query($sql);
  echo $sql;
}

if ($iva>=0) {
	$sql = "UPDATE cotizacion SET iva='$iva' WHERE id_cotizacion = $id_cotizacion";
	mysql_query($sql);
	echo $sql;
	header("location: ./?id_cotizacion=$id_cotizacion");
}
?>
<?php ///para guardar el iva y total
$sql="SELECT SUM(importe) FROM detalle_cotizacion WHERE id_cotizacion= $id_cotizacion";
$result=mysql_query("$sql");
?>
<b> SUBTOTAL:</b>
<?php 
while ($row = mysql_fetch_array($result)){
     $subt=$row[0]; 
    }
    //rowspan="2"
$id_cotizacion=$_GET["id_cotizacion"];
$sql="SELECT iva,total FROM cotizacion WHERE id_cotizacion= $id_cotizacion";
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


$sql="update cotizacion set subtotal='$subt',total='$tot' where id_cotizacion='$id_cotizacion'";
$result=mysql_query("$sql");
echo $sql;
header("location: index.php?id_cotizacion=$id_cotizacion");
?>
