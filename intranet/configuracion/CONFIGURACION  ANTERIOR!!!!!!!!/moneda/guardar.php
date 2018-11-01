<?php
	include("../../conexion.php");
	$query="SELECT MAX(id_moneda) FROM moneda";
	$result=mysql_query($query);
	while($fila=mysql_fetch_array($result))
	{
	if($fila[0]=="NULL"){
		$id=1;
	}else{
	$id=$fila[0]+1;
	}
	}
	$nombre_moneda=$_GET["nombre_moneda"];
	$valor=$_GET["valor"];

	$sql="INSERT INTO moneda VALUES ('$id','$nombre_moneda','$valor')";
	echo $sql;
	mysql_query($sql) or die(mysql_error());

	header("location: ./");
?>