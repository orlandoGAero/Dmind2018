<?php
	include("../../conexion.php");
	$query="SELECT MAX(id_tipo) FROM tipos";
	$result=mysql_query($query);
	while($fila=mysql_fetch_array($result))
	{
	if($fila[0]=="NULL"){
		$id=1;
	}else{
	$id=$fila[0]+1;
	}
	}
	$nombre_tipo=$_GET["nombre_tipo"];

	$query="INSERT INTO tipos VALUES ($id,'$nombre_tipo')";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>