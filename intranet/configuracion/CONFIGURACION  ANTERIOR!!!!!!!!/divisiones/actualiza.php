<?PHP 
	include("../../conexion.php");
	$id_division=$_GET["id_division"];
	$nombre_division=$_GET["nombre_division"];

	$query="UPDATE division SET nombre_division='$nombre_division' WHERE id_division='$id_division'";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>