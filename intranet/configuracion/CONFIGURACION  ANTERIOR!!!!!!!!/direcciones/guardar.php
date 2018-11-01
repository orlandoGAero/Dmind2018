<?php
	include("../../conexion.php");
	$query="SELECT MAX(id_direccion) FROM direcciones";
	$result=mysql_query($query);
	while($fila=mysql_fetch_array($result))
	{
	if($fila[0]=="NULL"){
		$id=1;
	}else{
	$id=$fila[0]+1;
	}
	}
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

	$query="INSERT INTO direcciones 
			VALUES ($id,'$calle','$num_ext','$num_int','$colonia',
					'$localidad','$referencia','$municipio','$estado',
					'$pais','$cod_postal','$sucursal','$gps_ubicacion')";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>