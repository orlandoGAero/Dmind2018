<?PHP 
	include("../../conexion.php");
	$id_subcategoria=$_GET["id_subcategoria"];
	$nombre_subcategoria=$_GET["nombre_subcategoria"];

	$query="UPDATE subcategorias SET nombre_subcategoria='$nombre_subcategoria' WHERE id_subcategoria='$id_subcategoria'";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>