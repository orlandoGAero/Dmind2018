<?php 
include ('../../conexion.php');

$cuantos=$_GET["cuantos"];
for($p=1; $p <=$cuantos; $p++){
echo	$pro=$_GET["p$p"];
echo "<br>";
echo	$ser=$_GET["s$p"];
echo "<br>";
echo	$id_venta=$_GET["id_venta"];


$sql="SELECT D.cantidad,D.id_producto,D.no_serie,P.exit_inventario FROM detalle_venta D
	  inner join productos P on D.id_producto=P.id_producto
	  where id_venta=$id_venta and D.id_producto=$pro and no_serie=$ser";
$result=mysql_query($sql);
while($fila=mysql_fetch_array($result)){
echo "<br>Cantidad :";
echo  $cantidad= $fila["cantidad"];
echo "<br>serie :";
echo  $no_serie= $fila["no_serie"];
echo  $existencias= $fila["exit_inventario"];
}
$exitactuales=$existencias-$cantidad;
//actualiza las existencias
$sql="update productos set exit_inventario=$exitactuales where id_producto=$pro";
$sql=mysql_query($sql);

//actualiza el estado de cada inventario con el id del producto
for($vender=1; $vender <=$cantidad; $vender++){
$sql="update inventario set id_status=5 where id_producto=$pro and no_serie=$no_serie";
$sql=mysql_query($sql);
echo $sql;
}
}
$id_venta=$_GET['id_venta'];
header("location: ./vistavent.php?venta=$id_venta");
 ?>