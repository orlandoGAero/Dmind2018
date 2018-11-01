<?PHP 
	include("../../conexion.php");
	$id_categoria_cliente=$_GET["id_categoria_cliente"];
	$nombre_categoria_cliente=$_GET["nombre_categoria_cliente"];

	$query="UPDATE categoria_cliente SET nombre_categoria_cliente='$nombre_categoria_cliente' WHERE id_categoria_cliente='$id_categoria_cliente'";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>