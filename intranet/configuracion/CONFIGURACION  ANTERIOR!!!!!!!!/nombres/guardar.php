<?php
	include("../../conexion.php");
	$query="SELECT MAX(id_nombre) FROM nombres";
	$result=mysql_query($query);
	while($fila=mysql_fetch_array($result))
	{
	if($fila[0]=="NULL"){
		$id=1;
	}else{
	$id=$fila[0]+1;
	}
	}
	$nombre=$_GET["nombre"];

	$query="INSERT INTO nombres VALUES ($id,'$nombre')";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>