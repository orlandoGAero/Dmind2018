<?PHP 
	include("../../conexion.php");
	$id_status=$_GET["id_status"];
	$nombre_status=$_GET["nombre_status"];

	$nombre_status = mb_strtoupper($nombre_status);
	$query="UPDATE status_inventario SET nombre_status='$nombre_status' WHERE id_status='$id_status'";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>