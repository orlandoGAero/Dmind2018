<?php
	include("../../conexion.php");
	$query="SELECT MAX(id_areacontacto) FROM areacontacto";
	$result=mysql_query($query);
	while($fila=mysql_fetch_array($result))
	{
	if($fila[0]=="NULL"){
		$id=1;
	}else{
	$id=$fila[0]+1;
	}
	}
	$nombre_areacontacto=$_GET["nombre_areacontacto"];

	$query="INSERT INTO areacontacto VALUES ($id,'$nombre_areacontacto')";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>