<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title>Digital Mind</title>
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
	<link rel="stylesheet" href="../css/menu.css" media="screen" />
	<link rel="stylesheet" href="../css/tabla.css" media="screen" />
	<link rel="stylesheet" href="../css/formularios.css" media="screen" />
</head>

<body>

	<header>
		<img src="../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
	</header>

	<nav>
		<ul>
			<li><a href="../Home" alt="Inicio" title="Inicio"><img src="../images/home.png"/></a></li>
			<a href="./"><li><img src="../images/volver.png" /><b>Atras</b></li></a><li></li><li></li><li></li>
			<li><a href="../logout.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../images/lock.png"/></a></li>
		</ul>
	</nav>

	<section id="contenido">
		<section id="principal">

<?php
$id_clie=$_GET["id_clie"]; include("../conexion.php");
$query="SELECT C.id_cliente, C.nombre_cliente,C.razonSocial, rfc,calle,num_ext,num_int,colonia,localidad,referencia,
		municipio,estado,pais,cod_postal,sucursal,tipo_razon_social FROM clientes C
		inner join datos_fiscales D on C.id_datfiscal=D.id_datfiscal
		inner join direcciones B on C.id_direccion=B.id_direccion
	    WHERE id_cliente='$id_clie'";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){?>

<form action="" method="post">
	<table class="detalle">
		<tr><th>Nombre</th><td><?php echo $fila["1"]; ?></td></tr>
		<tr><th>Razon Social</th><td><?php echo $fila["2"]; ?></td></tr>
		<tr><th>RFC</th><td><?php echo $fila["3"]; ?></td></tr>
		<tr><th>Calle</th><td><?php echo $fila["4"]; ?></td></tr>
		<tr><th>No. Ext</th><td><?php echo $fila["5"]; ?></td></tr>
		<tr><th>No. Int</th><td><?php echo $fila["6"]; ?></td></tr>
		<tr><th>Colonia/Delegación</th><td><?php echo $fila["7"]; ?></td></tr>
		<tr><th>Localidad</th><td><?php echo $fila["8"]; ?></td></tr>
		<tr><th>Referencias</th><td><?php echo $fila["9"]; ?></td></tr>
		<tr><th>Municipio</th><td><?php echo $fila["10"]; ?></td></tr>
		<tr><th>Estado</th><td><?php echo $fila["11"]; ?></td></tr>
		<tr><th>Pais</th><td><?php echo $fila["12"]; ?></td></tr>
		<tr><th>C.P.</th><td><?php echo $fila["13"]; ?></td></tr>
		<tr><th>Sucursal</th><td><?php echo $fila["14"]; ?></td></tr>
		<tr><th>Tipo Razon Social</th><td><?php echo $fila["15"]; ?></td></tr>
		<tr><td></td><td><a class="btn primary" href="./">Salir</a></td><td></td></tr>
	</table>
</form>
<?php }?>
<div style="background:rgba(255,255,255,.3); width:490px; border-radius:5px; text-align:center">
			<h3 >Contactos</h3>				
<center>
<?php
$id=$_GET["id_clie"];
include("../conexion.php");
$query="SELECT C.id,nombre,movil,email_personal,nombre_areacontacto from clientexcontacto C 
		inner join contactos on C.id_contacto=contactos.id_contacto 
		inner join areacontacto on contactos.id_areacontacto=areacontacto.id_areacontacto 
		WHERE id_cliente=$id_clie";
		
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
?>
<table class="datos" style="width:380px;">
<tr>
<th>Nombre</th>
<th>Telefono</th>
<th>Email</th>
<th>Area</th>
</tr>
<?php
  echo "<tr>";
  echo "<td align='center'>", $fila[1]; "</td>";
  echo "<td align='center'>", $fila[2]; "</td>";
  echo "<td align='center'>", $fila[3]; "</td>";
  echo "<td align='center'>", $fila[4]; "</td>";
  echo "</tr>";
}
?>
</table>
<?php 
$query="select sum(id_cliente) from clientexcontacto where id_cliente=$id_clie";		
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	$nu=$fila[0];
}
if($nu==0){
	echo "<h3>No Existe Ninguno</h3>";
}

 ?>
<br><br>
</center>
</div>

		</section>
	</section>

</body>
</html>