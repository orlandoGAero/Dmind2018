<?PHP 
	include("../../conexion.php");
	$id_areacontacto=$_GET["id_areacontacto"];
	$nombre_areacontacto=$_GET["nombre_areacontacto"];

	$query="UPDATE areacontacto SET nombre_areacontacto='$nombre_areacontacto' WHERE id_areacontacto='$id_areacontacto'";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>