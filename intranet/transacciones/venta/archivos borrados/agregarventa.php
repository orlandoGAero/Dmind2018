<?php
include ('../../Conexion.php');

$query = "SELECT MAX(id_venta) FROM venta";
$result = mysql_query($query) or die ("la consulta fallo:".mysql_error());
  while ($fila = mysql_fetch_array($result))
  {
  	if($fila[0]=="NULL"){
  		$nueva=1;
  	}else{
 	$nueva = $fila[0]+1;
 	}
 	$regis = $fila[0];
  }

$fecha=date("Y-m-d");
$hora=date("g:i a");

$sql="insert into venta values('$nueva','0','0','1','V-$nueva','$fecha','$hora','0','2','0','0','0','0')";
$result=mysql_query("$sql");

$sent="insert into transacciones values(NULL,'$fecha','$nueva','3',NULL)";
$result=mysql_query("$sent");

header("location: ./?venta=$nueva");
?>