<?php
	include("../../conexion.php");
	$query="SELECT MAX(id_unidad) FROM unidades";
	$result=mysql_query($query);
	while($fila=mysql_fetch_array($result))
	{
	if($fila[0]=="NULL"){
		$id=1;
	}else{
	$id=$fila[0]+1;
	}
	}
	$nombre_unidad=$_GET["nombre_unidad"];

	$query="INSERT INTO unidades VALUES ($id,'$nombre_unidad')";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>