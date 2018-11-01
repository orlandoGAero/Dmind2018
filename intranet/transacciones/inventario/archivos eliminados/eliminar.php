<?php 
include ("../../conexion.php");
$id_inv=$_GET["id_inv"];
$id_tra=$_GET["id_tra"];
$id_pro=$_GET["id_pro"];

echo "inv <br>";
echo $id_inv;
echo "<br>id_tra <br>";
echo $id_tra;
echo "<br>id_pro<br>";
echo $id_pro;


$eliminar="DELETE FROM inventario WHERE id_inventario='$id_inv'";
$eliminar=mysql_query($eliminar);


$eliminar2="DELETE FROM transacciones WHERE id_transaccion='$id_tra'";
$eliminar2=mysql_query($eliminar2);



$query="SELECT exit_inventario from productos where id_producto='$id_pro'";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result))
{	
 	$tot=$fila["exit_inventario"];
 $total=$tot-1;
}


$sql="UPDATE productos SET exit_inventario=$total where id_producto='$id_pro'";
$sql=mysql_query($sql);




header("location: ./");
?>
