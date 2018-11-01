<?php
	include("../../conexion.php");
	$query="SELECT MAX(id_status) FROM status_inventario";
	$result=mysql_query($query);
	while($fila=mysql_fetch_array($result))
	{
	if($fila[0]=="NULL"){
		$id=1;
	}else{
	$id=$fila[0]+1;
	}
	}
	$nombre_status=$_GET["nombre_status"];

	$nombre_status = mb_strtoupper($nombre_status);
	
	$query="INSERT INTO status_inventario VALUES ($id,'$nombre_status')";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>