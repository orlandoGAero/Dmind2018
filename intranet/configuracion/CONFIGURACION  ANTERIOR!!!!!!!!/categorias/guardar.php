<?php
	include("../../conexion.php");
	$query="SELECT MAX(id_categoria) FROM categorias";
	$result=mysql_query($query);
	while($fila=mysql_fetch_array($result))
	{
	if($fila[0]=="NULL"){
		$id=1;
	}else{
	$id=$fila[0]+1;
	}
	}
	$nombre_categoria=$_GET["nombre_categoria"];

	$query="INSERT INTO categorias VALUES ($id,'$nombre_categoria')";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>