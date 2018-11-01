<img src="images/falla.png" width="100%" height="100%">
<?php
include ("../conexion.php");
$query="SELECT MAX(id_contacto) FROM contactos";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	if($fila[0]=="NULL"){
		$id_contacto=1;
	}else{
	$id_contacto=$fila[0]+1;
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
$nom_clie=$_GET["nom_clie"];
$fecha=$_GET["fecha"];
$tel_movil=$_GET["tel_movil"];
$tel_oficina=$_GET["tel_oficina"];
$tel_casa=$_GET["tel_casa"];
$tel_emerg=$_GET["tel_emerg"];
$email_personal=$_GET["email_personal"];
$email_institucion=$_GET["email_institucion"];
$facebook=$_GET["facebook"];
$web=$_GET["web"];
$twiter=$_GET["twiter"];
$skype=$_GET["skype"];
$area_cont=$_GET["area_cont"];

	$Guardar="INSERT INTO contactos VALUES ('$id_contacto','$nom_clie','$fecha','$id_direccion','$area_cont',
		     '$tel_casa','$tel_oficina','$tel_emerg','$tel_movil','$email_personal','$email_institucion','$facebook',
		     '$web','$twiter','$skype')";
	$Guardar=mysql_query($Guardar)or die(mysql_error());

$calle=$_GET["calle"];
$num_ext=$_GET["num_ext"];
$num_int=$_GET["num_int"];
$colonia=$_GET["colonia"];
$localidad=$_GET["localidad"];
$referencia=$_GET["referencia"];
$minicipio=$_GET["minicipio"];
$estado=$_GET["estado"];
$pais=$_GET["pais"];
$cod_postal=$_GET["cod_postal"];
$gps_ubicacion=$_GET["gps_ubicacion"];

$quer="INSERT INTO direcciones VALUES ('$id_direccion','$calle','$num_ext','$num_int','$colonia',
	   '$localidad','$referencia','$minicipio','$estado','$pais','$cod_postal',NULL,'$gps_ubicacion')";
$quer=mysql_query($quer)or die(mysql_error());

	header("location: ./");
?>
