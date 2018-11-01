<?php
include ('../../conexion.php');
$id_producto=$_GET["id_producto"];
$no_serie=$_GET["no_serie"];
$marca=$_GET["marca"];


$query = "SELECT descripcion, modelo, nombre_marca, N.nombre,id_producto FROM productos P
          inner join marca_productos M on P.id_marca=M.id_marca
          inner join nombres N on P.id_nombre=N.id_nombre
          WHERE P.id_marca=$marca and id_producto=$id_producto";
$result = mysql_query($query);
  while ($fila = mysql_fetch_array($result))
  {
 $pro = $fila[0];
 $modelo = $fila[1];
 $marca =$fila[2];
 $nombre =$fila[3];
  }

$id_venta=$_GET["venta"];
$nota=$_GET["nota"];
$cantidad=$_GET["cantidad"];
$precio=$_GET["precio"];
$importe=$_GET["importe"];

$sql="insert into detalle_venta values('$id_venta','$nombre-$modelo $no_serie $pro $marca','$nota','$id_producto','$no_serie','$cantidad','$precio','$importe')";
$result=mysql_query("$sql");
echo $sql;

 ///para guardar el iva y total
$sql="SELECT SUM(importe) FROM detalle_venta WHERE id_venta=$id_venta";
$result=mysql_query("$sql");
?>
<?php 
while ($fila = mysql_fetch_array($result)){
     $subt=$fila[0]; 
    }
    //rowspan="2"
$sql="SELECT iva,total FROM venta WHERE id_venta= $id_venta";
$result=mysql_query("$sql");
while ($fila = mysql_fetch_array($result)){
     $fila["iva"];
     $iv=$fila["iva"];
    }
  $iva=$iv*.01;//iva del subtotal
  $cuent=$subt*$iva;
  $tot= $cuent+$subt; 
  $tot;


$sql="update venta set subtotal='$subt',total='$tot' where id_venta='$id_venta'";
$result=mysql_query("$sql");

header("location: ./?venta=$id_venta");
?>
