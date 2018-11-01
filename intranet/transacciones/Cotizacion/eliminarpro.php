<?php
include("../../conexion.php");
$descripcion =$_GET["descripcion"];
$id_cotizacion =$_GET["id_cotizacion"];

	$sql="DELETE FROM detalle_cotizacion WHERE descripcion='$descripcion' and id_cotizacion='$id_cotizacion' ";
	mysql_query($sql);
?>
<?php

$sql="SELECT count(id_cotizacion) FROM detalle_cotizacion WHERE id_cotizacion= $id_cotizacion";
$result=mysql_query("$sql");
while ($row = mysql_fetch_array($result)){
    $reg=$row[0];

    }
$sql="SELECT SUM(importe) FROM detalle_cotizacion WHERE id_cotizacion= $id_cotizacion";
$result=mysql_query("$sql");
while ($row = mysql_fetch_array($result)){
     $subt=$row[0];
    }
if($reg>=1){
$sql="SELECT iva FROM cotizacion WHERE id_cotizacion= $id_cotizacion";
$result=mysql_query("$sql");
while ($row = mysql_fetch_array($result)){
     $row["iva"];
     $iv=$row["iva"];
    }
  $iva=$iv*.01;//iva del subtotal
  $cuent=$subt*$iva;
  $tot= $cuent+$subt; 
  $tot;

	$sent = "UPDATE cotizacion SET subtotal='$subt',total='$tot' WHERE id_cotizacion='$id_cotizacion'";
	mysql_query($sent);
	echo $sent;
	
}else{
	if($reg==0){

	$sent = "UPDATE cotizacion SET subtotal='0',total='0' WHERE id_cotizacion='$id_cotizacion'";
	mysql_query($sent);
	}
}


	header("location: ./?id_cotizacion=$id_cotizacion");
?>
