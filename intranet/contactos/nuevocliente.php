<?php 
include("../conexion.php");
$id_clie=$_GET["id_clie"];
$id_cont=$_GET["id_cont"];
$query ="SELECT count(id_contacto) from clientexcontacto where id_cliente=$id_clie";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	$resp=$fila[0];
}
$query ="SELECT count(id_cliente) from clientexcontacto where id_contacto=$id_cont";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	$respc=$fila[0];
}
if(($resp==0) && ($respc==0)){
	$GuardarC="INSERT INTO clientexcontacto VALUES (NULL,$id_clie,$id_cont)";
	mysql_query($GuardarC);
	header("location: ./editar.php?id_cont=$id_cont&resp=si");
}else{
if(($respc==1) && ($respc==0)){
	header("location: ./editar.php?id_cont=$id_cont&resp=no");
}else{
	if(($resp==1)&& ($respc==1)){
		header("location: ./editar.php?id_cont=$id_cont&resp=no");	
	}else{
		if(($resp==0)&& ($respc==1)){
			header("location: ./editar.php?id_cont=$id_cont&resp=no");		
		}else{
			header("location: ./editar.php?id_cont=$id_cont&resp=no");
		}
	}
}
}
 ?>