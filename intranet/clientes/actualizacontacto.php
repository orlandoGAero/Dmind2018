<?php
include("../conexion.php");
$id_clie=$_GET["id_clie"];
$id_cont=$_GET["id_cont"];
$query ="SELECT count(id_contacto) from clientexcontacto WHERE not id_cliente=$id_clie";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	$resp=$fila[0];
}
if ($resp==1) {
header("location: ./editar.php?id_clie=$id_clie&resp=no");
}else{
if ($resp==0) {
$sent="UPDATE clientexcontacto SET id_contacto=$id_cont WHERE id_cliente=$id_clie";
mysql_query($sent);
header("location: ./editar.php?id_clie=$id_clie&resp=si");
}
}
?>