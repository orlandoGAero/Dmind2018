<?php
	include("../../conexion.php");
	$query="SELECT MAX(id_estado) FROM estados";
	$result=mysql_query($query);
	while($fila=mysql_fetch_array($result))
	{
	if($fila[0]=="NULL"){
		$id=1;
	}else{
	$id=$fila[0]+1;
	}
	}
	$nombre_estado=$_GET["nombre_estado"];

	$query="INSERT INTO estados VALUES ($id,'$nombre_estado')";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>