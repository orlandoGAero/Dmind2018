<?PHP 
	include("../../conexion.php");
	$id_categoria=$_GET["id_categoria"];
	$nombre_categoria=$_GET["nombre_categoria"];

	$query="UPDATE categorias SET nombre_categoria='$nombre_categoria' WHERE id_categoria='$id_categoria'";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>