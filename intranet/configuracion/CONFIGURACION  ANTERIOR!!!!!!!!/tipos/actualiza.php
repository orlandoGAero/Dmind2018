<?PHP 
	include("../../conexion.php");
	$id_tipo=$_GET["id_tipo"];
	$nombre_tipo=$_GET["nombre_tipo"];

	$query="UPDATE tipos SET nombre_tipo='$nombre_tipo' WHERE id_tipo='$id_tipo'";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>