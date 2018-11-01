<?php 
include ("../conexion.php");
$id_clie=$_GET["id_clie"];

$eliminar="DELETE FROM clientes WHERE id_cliente='$id_clie'";
$eliminar=mysql_query($eliminar);

$id_dfis=$_GET["id_dfis"];
$sql="DELETE FROM direcciones WHERE id_direccion='$id_dfis'";
$sql=mysql_query($sql);

$id_dcli=$_GET["id_dcli"];
$query="DELETE FROM direcciones WHERE id_direccion='$id_dcli'";
$query=mysql_query($query);


$sent="DELETE FROM proveedorxcontacto WHERE id_cliente='$id_clie'";
$sent=mysql_query($sent);

$mys="DELETE FROM clientexcontacto WHERE id_cliente='$id_clie'";
$mys=mysql_query($mys);

$id_datfis=$_GET["id_datfis"];
$elimdats_fiscales="DELETE FROM datos_fiscales WHERE id_datfiscal='$id_datfis'";
$elimdats_fiscales=mysql_query($elimdats_fiscales);	

$dat_banc=$_GET["dat_banc"];
$eliminarbanc="DELETE FROM datos_bancarios WHERE id_bancarios='$dat_banc'";
$eliminarbanc=mysql_query($eliminarbanc);

header("location: ./");
?>
