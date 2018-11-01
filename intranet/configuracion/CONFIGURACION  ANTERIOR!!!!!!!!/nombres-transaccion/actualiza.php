<?PHP 
	include("../../conexion.php");
	$id_nombre=$_GET["id_nombre"];
	$nombre=$_GET["nombre"];

	$query="UPDATE nombres SET nombre='$nombre' WHERE id_nombre='$id_nombre'";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>