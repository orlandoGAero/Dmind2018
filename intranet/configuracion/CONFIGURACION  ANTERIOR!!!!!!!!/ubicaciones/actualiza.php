<?PHP 
	include("../../conexion.php");
	$id_ubicacion=$_GET["id_ubicacion"];
	$nombre_ubicacion=$_GET["nombre_ubicacion"];

	$query="UPDATE ubicaciones SET nombre_ubicacion='$nombre_ubicacion' WHERE id_ubicacion='$id_ubicacion'";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>