<?php  
  include("../../conexion.php");
  $id_marca=$_GET["id_marca"];
  $id_categoria=$_GET["id_categoria"];
  $nombre_marca=$_GET["nombre_marca"];
	$query="INSERT INTO marcas VALUES ('$id_marca','$nombre_marca','$id_categoria')";
	mysql_query($query);
  echo $query;
	header("location: ./editar.php?id_marca=$id_marca");
?>