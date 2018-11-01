<?PHP 
	include("../../conexion.php");
	$id_unidad=$_GET["id_unidad"];
	$nombre_unidad=$_GET["nombre_unidad"];

	$query="UPDATE unidades SET nombre_unidad='$nombre_unidad' WHERE id_unidad='$id_unidad'";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>