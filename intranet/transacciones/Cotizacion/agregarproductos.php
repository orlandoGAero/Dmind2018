
<?php
include ('../../conexion.php');
$id_producto=$_GET["id_producto"];
$query = "SELECT descripcion, modelo, nombre_marca, nombre FROM productos P
          inner join marcas on P.id_marca=marcas.id_marca
          inner join nombres on P.id_nombre=nombres.id_nombre
          WHERE P.id_producto=$id_producto";
$result = mysql_query($query);
  while ($row = mysql_fetch_array($result))
  {
 $pro = $row[0];
 $modelo = $row[1];
 $marca =$row[2];
 $nombre =$row[3];
  }
?> 
<?php
$id_cotizacion=$_GET["id_cotizacion"];
$nota=$_GET["nota"];
$cantidad=$_GET["cantidad"];
$precio=$_GET["precio"];
$importe=$_GET["importe"];
$sql="insert into detalle_cotizacion values('$id_cotizacion','$nombre-$modelo $pro $marca','$nota','$id_producto','$cantidad','$precio','$importe')";
$result=mysql_query("$sql");
echo $sql;
?>

<?php ///para guardar el iva y total
$sql="SELECT SUM(importe) FROM detalle_cotizacion WHERE id_cotizacion= $id_cotizacion";
$result=mysql_query("$sql");
?>
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

header("location: ./?id_cotizacion=$id_cotizacion");
?>
