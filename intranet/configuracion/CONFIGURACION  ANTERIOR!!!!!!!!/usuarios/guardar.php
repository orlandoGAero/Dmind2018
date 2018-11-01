<?PHP 
	include("../../conexion.php");
	$query="SELECT MAX(id_usuario) FROM usuarios";
	$result=mysql_query($query);
	while($fila=mysql_fetch_array($result))
	{
	if($fila[0]=="NULL"){
		$id=1;
	}else{
	$id=$fila[0]+1;
	}
	}
	$usuario=$_GET["usuario"];
	$contrasena=$_GET["contrasena"];
	$email=$_GET["email"];

	$query="INSERT INTO usuarios VALUES ($id,'$usuario','$contrasena','$email',NULL,NULL,NUll,NULL,NUll)";
	mysql_query($query) or die(mysql_error());
	header("location: ./");
?>