<?php
include ("../../conexion.php");
  $query = "SELECT MAX(id_producto) from productos";
  $result=mysql_query($query);
	while($fila=mysql_fetch_array($result)){
		$id_producto=$fila[0]+1;
	}

$id_categoria=$_GET["id_categoria"];
$id_subcategoria=$_GET["id_subcategoria"];
$id_division=$_GET["id_division"];
$id_nombre=$_GET["id_nombre"];
$id_tipo=$_GET["id_tipo"];
$id_marca=$_GET["id_marca"];
$modelo=$_GET["modelo"];
$precio=$_GET["precio"];
$id_unidad=$_GET["id_unidad"];
$descripcion=$_GET["descripcion"];

$Guardar="INSERT INTO productos VALUES ('$id_producto','$id_categoria','$id_subcategoria','$id_division',
		 '$id_nombre','$id_tipo','$id_marca','$modelo','$precio','$id_unidad','$descripcion',NULL)";
$Guardar=mysql_query($Guardar)or die(mysql_error());

$id_cotizacion=$_GET["id_cotizacion"];
header("location: ./?id_cotizacion=$id_cotizacion");
?>
