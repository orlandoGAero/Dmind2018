<?php
	include("../../conexion.php");
	$query="SELECT count(id_tipo_transaccion) FROM tipo_transaccion";
	$result=mysql_query($query);
	while($fila=mysql_fetch_array($result))
	{
	if($fila[0]=="NULL"){
		$id=1;
	}else{
	$id=$fila[0]+1;
	}
	}
	$nombre_tipo_transaccion=$_GET["nombre_tipo_transaccion"];

	$query="INSERT INTO tipo_transaccion VALUES ($id,'$nombre_tipo_transaccion')";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>