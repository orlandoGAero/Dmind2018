<?php
include("../../conexion.php");
$id_venta =$_GET["id_venta"];
$moneda =$_GET["moneda"];
$iva =$_GET["iva"];
$tipo=$_GET["tipo"];



if($tipo=="Fiscal") {
  $query="update venta set tipo_venta='$tipo' where id_venta=$id_venta";
  $result=mysql_query("$query");
  echo $query;
}
if($tipo=="Nota") {
  $query="update venta set tipo_venta='$tipo' where id_venta=$id_venta";
  $result=mysql_query("$query");
  echo $query;
}
if ($iva>=0) {
	$sql = "UPDATE venta SET iva='$iva' WHERE id_venta=$id_venta";
	mysql_query($sql);
	echo $sql;
}
echo "<br>";
if ($moneda>0) {
  $sql = "UPDATE venta SET id_moneda='$moneda' WHERE id_venta=$id_venta";
  mysql_query($sql);
  echo $sql;
}


$sql="SELECT * FROM moneda where id_moneda=$moneda";
$result=mysql_query("$sql");
while ($fila = mysql_fetch_array($result)){
  $valor=$fila["valor"];
}

 ///para guardar el iva y total
$sql="SELECT SUM(importe) FROM detalle_venta WHERE id_venta= $id_venta";
$result=mysql_query("$sql");
?>
<?php 
while ($row = mysql_fetch_array($result)){
     $subt=$row[0]; 
    }
    //rowspan="2"
$sql="SELECT iva,total FROM venta WHERE id_venta=$id_venta";
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


$sql="update venta set subtotal='$subt',total='$tot' where id_venta='$id_venta'";
$result=mysql_query("$sql");
header("location: ./?venta=$id_venta");
?>