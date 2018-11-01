<?php
	include("../../conexion.php");
	$fecha_alta=date("d-m-Y");
	$nom_proveedor=$_GET["nom_proveedor"];
	$id_datfiscal=$_GET["id_datfiscal"];
	$id_direccion=$_GET["id_direccion"];
	$telefono=$_GET["telefono"];
	//$id_contacto=$_GET["id_contacto"];
	$id_bancarios=$_GET["id_bancarios"];
	$id_categoria=$_GET["id_categoria"];
	$direccion_web=$_GET["direccion_web"];

$query="INSERT INTO proveedores VALUES ('$id_proveedor',NULL,$fecha_alta','$id_datfiscal',
										'$id_direccion','$telefono','0',
										'$id_bancarios','$id_categoria','$direccion_web')";
mysql_query($query) or die(mysql_error());
?>
<?php
	$id_datfiscal=$_GET["id_datfiscal"];
	$razon_social=$_GET["razon_social"];
	$rfc=$_GET["rfc"];
	$tipo_razon_social=$_GET["tipo_razon_social"];
	$id_direccion=$_GET["id_direccion"];
	$email=$_GET["email"];

$sql="INSERT INTO datos_fiscales VALUES ($id_datfiscal','$razon_social','$rfc','$tipo_razon_social',
										'$id_direccion','$email')";
mysql_query($sql) or die(mysql_error());
//header("location: ./");
?>
<?php
	$id_bancarios=$_GET["id_bancarios"];
	$nombre_banco=$_GET["nombre_banco"];
	$sucursal=$_GET["sucursal"];
	$titular=$_GET["titular"];
	$no_cuenta=$_GET["no_cuenta"];
	$clave_interbancaria=$_GET["clave_interbancaria"];
	$tipo_cuenta=$_GET["tipo_cuenta"];

$sent="INSERT INTO datos_bancarios VALUES ($id_bancarios','$nombre_banco','$sucursal','$titular',
										'$no_cuenta','$clave_interbancaria','$tipo_cuenta')";
mysql_query($sent) or die(mysql_error());
//header("location: ./");
?>