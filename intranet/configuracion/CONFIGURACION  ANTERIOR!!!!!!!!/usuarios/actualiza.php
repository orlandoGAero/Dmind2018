<?PHP 
	include("../../conexion.php");
	$id_usuario=$_GET["id_usuario"];
	$usuario=$_GET["usuario"];
	$contrasena=$_GET["contrasena"];
	$email=$_GET["email"];
	$tipo=$_GET["tipo"];

	$query="UPDATE usuarios SET
	usuario='$usuario',
	contrasena='$contrasena',
	email='$email',
	tipo='$tipo'
	WHERE id_usuario='$id_usuario'";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>