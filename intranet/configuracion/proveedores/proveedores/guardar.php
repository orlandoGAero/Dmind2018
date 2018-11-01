<?php
include ("../../../conexion.php");
$query="SELECT MAX(id_proveedor) FROM proveedores";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
		if($fila[0]=="NULL"){
		$id_proveedor=1;
	}else{
	$id_proveedor=$fila[0]+1;
	}
}
$query="SELECT MAX(id_datfiscal) FROM datos_fiscales";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	if($fila[0]=="NULL"){
		$id_datfiscal=1;
	}else{
	$id_datfiscal=$fila[0]+1;
	}
}
$query="SELECT MAX(id_direccion) FROM direcciones";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	if($fila[0]=="NULL"){
		$id_direccion=1;
	}else{
	$id_direccion=$fila[0]+1;
	}
}
$query="SELECT MAX(id_bancarios) FROM datos_bancarios";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	if($fila[0]=="NULL"){
		$id_bancarios=1;
	}else{
	$id_bancarios=$fila[0]+1;
	}
}

$nom_prov=$_GET["nom_prov"];
$razonsocial=$_GET["razonsocial"];
$fecha=$_GET["fecha"];
$telefono=$_GET["telefono"];
$id_categoria_cli=$_GET["id_categoria_prov"];
$web=$_GET["web"];

$Guardar="INSERT INTO proveedores VALUES ('$id_proveedor','$nom_prov','$fecha','$id_datfiscal','$id_direccion',
		  '$id_bancarios',NULL,'$telefono','$id_categoria_cli','$web')";
$Guardar=mysql_query($Guardar);



//Para guardar los datos fiscales
//$id_datfiscal
//$razonsocial=$_GET["razonsocial"];
$rfc=$_GET["rfc"];
$email=$_GET["email"];
$tipoRason_Soc=$_GET["tipoRason_Soc"];
$id_direccion_fiscal=$id_direccion+1;

$sql="INSERT INTO datos_fiscales VALUES ('$id_datfiscal','$razonsocial','$rfc','$tipoRason_Soc','$id_direccion_fiscal','$email')";
$sql=mysql_query($sql);
$nom_banco=$_GET["nom_banco"];
$sucursal=$_GET["sucursal"];
$titular=$_GET["titular"];
$no_cuenta=$_GET["no_cuenta"];
$clav_inter=$_GET["clav_inter"];
$tipo_cuenta=$_GET["tipo_cuenta"];

//para guardar la datos bancarios
$query="INSERT INTO datos_bancarios VALUES ('$id_bancarios','$nom_banco','$sucursal','$titular','$no_cuenta',
	   '$clav_inter','$tipo_cuenta')";
$query=mysql_query($query);

//para la direccion fiscal
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
$sql="INSERT INTO direcciones VALUES ('$id_direccion_fiscal','$fcalle','$fnum_ext','$fnum_int','$fcolonia',
	   '$flocalidad','$freferencia','$fmunicipio','$festado','$fpais','$fcod_postal',NULL,NULL)";

$sql=mysql_query($sql);


//para guardar la dirección
$calle=$_GET["calle"];
$num_ext=$_GET["num_ext"];
$num_int=$_GET["num_int"];
$colonia=$_GET["colonia"];
$localidad=$_GET["localidad"];
$referencia=$_GET["referencia"];
$municipio=$_GET["municipio"];
$estado=$_GET["estado"];
$dsucursal=$_GET["dsucursal"];
$pais=$_GET["pais"];
$cod_postal=$_GET["cod_postal"];
$gps_ubicacion=$_GET["gps_ubicacion"];

$quer="INSERT INTO direcciones VALUES ('$id_direccion','$calle','$num_ext','$num_int','$colonia',
	   '$localidad','$referencia','$municipio','$estado','$pais','$cod_postal','$dsucursal','$gps_ubicacion')";
$quer=mysql_query($quer);


header("location: ./");

?>