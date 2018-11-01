<?PHP 
	include("../../conexion.php");
	$id_tipo=$_GET["id_tipo"];
	$nombre_tipo=$_GET["nombre_tipo"];

	$query="UPDATE tipo_transaccion SET nombre_tipo_transaccion='$nombre_tipo' WHERE id_tipo_transaccion='$id_tipo'";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>