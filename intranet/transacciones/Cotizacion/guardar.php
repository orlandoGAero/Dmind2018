<?php 
include ('../../Conexion.php');
$sql="UPDATE cotizacion SET guardada=1";
$result=mysql_query("$sql");


header("location: ../registrocotizaciones.php");
 ?>