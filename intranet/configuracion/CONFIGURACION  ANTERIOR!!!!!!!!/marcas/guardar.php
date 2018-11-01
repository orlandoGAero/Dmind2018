<?php  
	include("../../conexion.php");
  $query="SELECT MAX(id_marca) FROM marcas";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result))
  {
  if($fila[0]=="NULL"){
    $id=1;
  }else{
  $id=$fila[0]+1;
  }
  }
	$nombre_marca=$_GET["nombre_marca"];

	$query="INSERT INTO marcas VALUES ('$id','$nombre_marca','0')";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>