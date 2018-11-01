<?PHP 
include("../conexion.php");
$id_clie=$_GET["id_clie"];
$id_cont=$_GET["id_cont"];
$query ="SELECT count(id_cliente) from clientexcontacto WHERE not id_contacto=$id_cont and id_cliente=$id_clie";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	$resp=$fila[0];
}
if($resp==1){
	header("location: ./editar.php?id_cont=$id_cont&resp=no");
}else{
if($resp==0){
$sent="UPDATE clientexcontacto SET id_cliente=$id_clie WHERE id_contacto=$id_cont";
mysql_query($sent);
header("location: ./editar.php?id_cont=$id_cont&resp=si");
}
}
?>