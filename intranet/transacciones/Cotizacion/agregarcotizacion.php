<?php
include ('../../Conexion.php');

$query="DELETE FROM cotizacion WHERE not guardada=1";
$result=mysql_query("$query");

$query = "SELECT MAX(id_cotizacion) FROM cotizacion";
$result = mysql_query($query) or die ("la consulta fallo:".mysql_error());
  while ($row = mysql_fetch_array($result))
  {
	if($row[0]=="NULL"){
		$nueva=1;
	}else{
	$nueva=$row[0]+1;
	}
 	$regis = $row[0];
  }

$query="DELETE FROM detalle_cotizacion WHERE id_cotizacion>$regis";
$result=mysql_query("$query");

$fecha=date("Y-m-d");
//echo $fecha;
$sql="insert into cotizacion values($nueva,'$nueva','$fecha','0','2','0','0','0','1','0')";
$result=mysql_query("$sql");


header("location: ./?id_cotizacion=$nueva");
?>