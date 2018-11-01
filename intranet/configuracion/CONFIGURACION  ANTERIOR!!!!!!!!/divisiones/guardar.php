<?php
	include("../../conexion.php");
	$query="SELECT MAX(id_division) FROM division";
	$result=mysql_query($query);
	while($fila=mysql_fetch_array($result))
	{
	if($fila[0]=="NULL"){
		$id=1;
	}else{
	$id=$fila[0]+1;
	}
	}
	$nombre_division=$_GET["nombre_division"];

	$query="INSERT INTO division VALUES ($id,'$nombre_division')";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>