<?php include("../conexion.php");
$id_clie=$_GET["id_clie"];
$id_cont=$_GET["id_cont"];
$query ="SELECT count(id_contacto) from clientexcontacto WHERE id_contacto=$id_cont";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	$resp=$fila[0];
}

if ($resp==0) {
      $GuardarC="INSERT INTO clientexcontacto VALUES (null,'$id_clie','$id_cont')";
      $GuardarC=mysql_query($GuardarC)or die(mysql_error());
       header("location: ./editar.php?id_clie=$id_clie&resp=si");
}else{
header("location: ./editar.php?id_clie=$id_clie&resp=no");
}?>