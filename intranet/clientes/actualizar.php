<?php
include("../conexion.php");
$id_clie=$_GET["id_clie"];
$nom_clie=$_GET["nom_clie"];
$razonsocial=$_GET["razonsocial"];
$telefono=$_GET["telefono"];
$id_categoria_cli=$_GET["id_categoria_cli"];
$web=$_GET["web"];
//actualiza info del cliente
$query="UPDATE clientes SET nombre_cliente='$nom_clie',razonSocial='$razonsocial',
		telefono='$telefono',id_categoria_cliente='$id_categoria_cli',direccion_web='$web'
		WHERE id_cliente=$id_clie";
mysql_query($query) or die(mysql_error());

$id_datfiscal=$_GET["id_datfiscal"];
$rfc=$_GET["rfc"];
$tipoRason_Soc=$_GET["tipoRason_Soc"];
$femail=$_GET["femail"];
$sql="UPDATE datos_fiscales SET razon_social='$razonsocial',rfc='$rfc',
		tipo_razon_social='$tipoRason_Soc',email='$femail'
		WHERE id_datfiscal=$id_datfiscal";
mysql_query($sql) or die(mysql_error());


//para actualizar los datos bancarios

$id_bancarios=$_GET["id_bancarios"];
$nombre_banco=$_GET["nombre_banco"];
$bsucursal=$_GET["bsucursal"];
$titular=$_GET["titular"];
$no_cuenta=$_GET["no_cuenta"];
$clave_interbancaria=$_GET["clave_interbancaria"];
$tipo_cuenta=$_GET["tipo_cuenta"];

$sent="UPDATE datos_bancarios SET id_bancarios='$id_bancarios',nombre_banco='$nombre_banco',
		sucursal='$bsucursal',titular='$titular',no_cuenta='$no_cuenta',clave_interbancaria='$clave_interbancaria',tipo_cuenta='$tipo_cuenta'
		WHERE id_bancarios=$id_bancarios";
mysql_query($sent) or die(mysql_error());

//para actualizar la direccion fiscal
$fid_direc=$_GET["fid_direc"];
$fcalle=$_GET["fcalle"];
$fnum_ext=$_GET["fnum_ext"];
$fnum_int=$_GET["fnum_int"];
$fcolonia=$_GET["fcolonia"];
$flocalidad=$_GET["flocalidad"];
$freferencia=$_GET["freferencia"];
$fmunicipio=$_GET["fmunicipio"];
$festado=$_GET["festado"];
$fpais=$_GET["fpais"];
$fcod_postal=$_GET["fcod_postal"];

$sent="UPDATE direcciones SET calle='$fcalle',num_ext='$fnum_ext',num_int='$fnum_int',
	   colonia='$fcolonia',localidad='$flocalidad',referencia='$freferencia',municipio='$fmunicipio',
	   estado='$festado',pais='$fpais',cod_postal='$fcod_postal'
	   WHERE id_direccion=$fid_direc";
mysql_query($sent) or die(mysql_error());

//para actualizar la direccion del cliente
$id_direc=$_GET["id_direc"];
$calle=$_GET["calle"];
$num_ext=$_GET["num_ext"];
$num_int=$_GET["num_int"];
$colonia=$_GET["colonia"];
$localidad=$_GET["localidad"];
$referencia=$_GET["referencia"];
$municipio=$_GET["municipio"];
$estado=$_GET["estado"];
$pais=$_GET["pais"];
$cod_postal=$_GET["cod_postal"];
$sucursal=$_GET["sucursal"];
$gps_ubicacion=$_GET["gps_ubicacion"];

$sent="UPDATE direcciones SET calle='$calle',num_ext='$num_ext',num_int='$num_int',
	   colonia='$colonia',localidad='$localidad',referencia='$referencia',municipio='$municipio',
	   estado='$estado',pais='$pais',cod_postal='$cod_postal',sucursal='$sucursal',gps_ubicacion='$gps_ubicacion'
	   WHERE id_direccion=$id_direc";
mysql_query($sent) or die(mysql_error());


header("location: ./detalle.php?id_clie=$id_clie");
?>

