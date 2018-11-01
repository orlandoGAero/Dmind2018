<?php
	include("../../conexion.php");
	$query="SELECT MAX(id_subcategoria) FROM subcategorias";
	$result=mysql_query($query);
	while($fila=mysql_fetch_array($result))
	{
	if($fila[0]=="NULL"){
		$id=1;
	}else{
	$id=$fila[0]+1;
	}
	}
	$nombre_subcategoria=$_GET["nombre_subcategoria"];

	$query="INSERT INTO subcategorias VALUES ($id,'$nombre_subcategoria')";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>