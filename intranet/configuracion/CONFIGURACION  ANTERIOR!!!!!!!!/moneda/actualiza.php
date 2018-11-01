<?PHP 
	include("../../conexion.php");
	$id_moneda=$_GET["id_moneda"];
	$nombre_moneda=$_GET["nombre_moneda"];
	$valor=$_GET["valor"];

	$query="UPDATE moneda SET nombre_moneda='$nombre_moneda', valor='$valor' WHERE id_moneda='$id_moneda'";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>