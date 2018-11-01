<?PHP 
	include("../../conexion.php");
	$id_marca=$_GET["id_marca"];
	$nombre_marca=$_GET["nombre_marca"];

	$query="UPDATE marcas SET nombre_marca='$nombre_marca' WHERE id_marca='$id_marca'";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>