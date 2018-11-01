<?php
	include("../../conexion.php");
	$id_direccion=$_GET["id_direccion"];
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

	$query="UPDATE direcciones SET calle='$calle', num_ext='$num_ext', num_int='$num_int', colonia='$colonia',
			localidad='$localidad', referencia='$referencia', municipio='$municipio', estado='$estado',
			pais='$pais', cod_postal='$cod_postal',sucursal='$sucursal', gps_ubicacion='$gps_ubicacion'
			WHERE id_direccion=$id_direccion";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>