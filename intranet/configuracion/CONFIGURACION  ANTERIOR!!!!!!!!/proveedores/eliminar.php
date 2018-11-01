<?php 
	include ("../../conexion.php");
	$id_prov=$_GET["id_prov"];
	$Eliminar="DELETE FROM proveedores WHERE id_proveedor='$id_prov'";
	$Eliminar=mysql_query($Eliminar);

	$eliminarconts="DELETE FROM proveedorxcontacto WHERE id_proveedor='$id_prov'";
	$eliminarconts=mysql_query($eliminarconts);

	$id_dirp=$_GET["id_dirp"];
	$eliminadirecfiscal="DELETE FROM direcciones WHERE id_direccion='$id_dirp'";
	$eliminadirecfiscal=mysql_query($eliminadirecfiscal);

	$id_dirf=$_GET["id_dirf"];
	$eliminardirfisica="DELETE FROM direcciones WHERE id_direccion='$id_dirf'";
	$eliminardirfisica=mysql_query($eliminardirfisica);

	$id_datfis=$_GET["id_datfis"];
	$elimdats_fiscales="DELETE FROM datos_fiscales WHERE id_datfiscal='$id_datfis'";
	$elimdats_fiscales=mysql_query($elimdats_fiscales);	

	$dat_banc=$_GET["dat_banc"];
	$eliminarbanc="DELETE FROM datos_bancarios WHERE id_bancarios='$dat_banc'";
	$eliminarbanc=mysql_query($eliminarbanc);

	header("location: ./");
?>
