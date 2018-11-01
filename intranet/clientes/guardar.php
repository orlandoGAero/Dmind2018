<img src="images/falla.png" width="100%" height="100%">
<?php
include ("../conexion.php");
$query="SELECT MAX(id_cliente) FROM clientes";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	if($fila[0]=="NULL"){
		$id_cliente=1;
	}else{
		$id_cliente=$fila[0]+1;
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

$nom_clie=$_GET["nom_clie"];
$razonsocial=$_GET["razonsocial"];
$fecha=$_GET["fecha"];
$telefono=$_GET["telefono"];
$id_categoria_cli=$_GET["id_categoria_cli"];
$web=$_GET["web"];

$Guardar="INSERT INTO clientes VALUES ('$id_cliente','$nom_clie','$razonsocial','$fecha','$id_datfiscal','$id_direccion',
		  '$telefono','0','$id_bancarios','$id_categoria_cli','$web')";
$Guardar=mysql_query($Guardar)or die(mysql_error());



//Para guardar los datos fiscales
//$id_datfiscal
//$razonsocial=$_GET["razonsocial"];
$rfc=$_GET["rfc"];
$email=$_GET["email"];
$tipoRason_Soc=$_GET["tipoRason_Soc"];
$id_direccion_fiscal=$id_direccion+1;

$sql="INSERT INTO datos_fiscales VALUES ('$id_datfiscal','$razonsocial','$rfc','$tipoRason_Soc','$id_direccion_fiscal','$email')";
$sql=mysql_query($sql)or die(mysql_error());

$nom_banco=$_GET["nom_banco"];
$sucursal=$_GET["sucursal"];
$titular=$_GET["titular"];
$no_cuenta=$_GET["no_cuenta"];
$clav_inter=$_GET["clav_inter"];
$tipo_cuenta=$_GET["tipo_cuenta"];

//para guardar la datos bancarios
$query="INSERT INTO datos_bancarios VALUES ('$id_bancarios','$nom_banco','$sucursal','$titular','$no_cuenta',
	   '$clav_inter','$tipo_cuenta')";
$query=mysql_query($query)or die(mysql_error());

//para la direccion fiscal
$fpais=$_GET["fpais"];
$fmunicipio=$_GET["fmunicipio"];
$festado=$_GET["festado"];
$flocalidad=$_GET["flocalidad"];
$fcod_postal=$_GET["fcod_postal"];
$fcolonia=$_GET["fcolonia"];
$fcalle=$_GET["fcalle"];
$fnum_ext=$_GET["fnum_ext"];
$fnum_int=$_GET["fnum_int"];
$freferencia=$_GET["freferencia"];

$quer="INSERT INTO direcciones VALUES ('$id_direccion_fiscal','$fcalle','$fnum_ext','$fnum_int','$fcolonia',
	   '$flocalidad','$freferencia','$fmunicipio','$festado','$fpais','$fcod_postal',NULL,'$fgps_ubicacion')";
$quer=mysql_query($quer)or die(mysql_error());


//para guardar la dirección
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

$quer="INSERT INTO direcciones VALUES ('$id_direccion','$calle','$num_ext','$num_int','$colonia',
	   '$localidad','$referencia','$municipio','$estado','$pais','$cod_postal','$sucursal','$gps_ubicacion')";
$quer=mysql_query($quer);


header("location: ./");
?>
