<?PHP 
	include("../../conexion.php");
	$id_estado=$_GET["id_estado"];
	$nombre_estado=$_GET["nombre_estado"];

	$query="UPDATE estados SET nombre_estado='$nombre_estado' WHERE id_estado='$id_estado'";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>