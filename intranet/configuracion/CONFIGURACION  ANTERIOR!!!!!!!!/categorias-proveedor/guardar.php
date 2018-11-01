<?php
	include("../../conexion.php");
	$query="SELECT MAX(id_categoria_cliente) FROM categoria_cliente";
	$result=mysql_query($query);
	while($fila=mysql_fetch_array($result))
	{
	if($fila[0]=="NULL"){
		$id=1;
	}else{
	$id=$fila[0]+1;
	}
	}
	$nombre_categoria_cliente=$_GET["nombre_categoria_cliente"];

	$query="INSERT INTO categoria_cliente VALUES ($id,'$nombre_categoria_cliente')";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>