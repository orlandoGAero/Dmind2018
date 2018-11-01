<?php
	include("../../conexion.php");
	$query="SELECT MAX(id_ubicacion) FROM ubicaciones";
	$result=mysql_query($query);
	while($fila=mysql_fetch_array($result))
	{
	if($fila[0]=="NULL"){
		$id=1;
	}else{
	$id=$fila[0]+1;
	}
	}
	$nombre_ubicacion=$_GET["nombre_ubicacion"];

	$query="INSERT INTO ubicaciones VALUES ($id,'$nombre_ubicacion')";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>