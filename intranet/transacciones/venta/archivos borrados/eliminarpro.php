<?php
include("../../conexion.php");
$descripcion =$_GET["descripcion"];
$id_venta =$_GET["id_venta"];

	$sql="DELETE FROM detalle_venta WHERE descripcion='$descripcion' and id_venta='$id_venta' ";
	mysql_query($sql);
?>
<?php

$sql="SELECT count(id_venta) FROM detalle_venta WHERE id_venta= $id_venta";
$result=mysql_query("$sql");
while ($row = mysql_fetch_array($result)){
    $reg=$row[0];

    }
$sql="SELECT SUM(importe) FROM detalle_venta WHERE id_venta= $id_venta";
$result=mysql_query("$sql");
while ($row = mysql_fetch_array($result)){
     $subt=$row[0];
    }
if($reg>=1){
$sql="SELECT iva FROM venta WHERE id_venta= $id_venta";
$result=mysql_query("$sql");
while ($row = mysql_fetch_array($result)){
     $row["iva"];
     $iv=$row["iva"];
    }
  $iva=$iv*.01;//iva del subtotal
  $cuent=$subt*$iva;
  $tot= $cuent+$subt; 
  $tot;

	$sent = "UPDATE venta SET subtotal='$subt',total='$tot' WHERE id_venta='$id_venta'";
	mysql_query($sent);
	echo $sent;
	
}else{
	if($reg==0){

	$sent = "UPDATE venta SET subtotal='0',total='0' WHERE id_venta='$id_venta'";
	mysql_query($sent);
	}
}


	header("location: ./?venta=$id_venta");
?>
