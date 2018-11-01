<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Digital Mind</title>
  <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
	<link rel="stylesheet" href="../css/menu.css" />
	<link rel="stylesheet" href="../css/formularios.css" />
	<style type="text/css">
	table tr{
	text-align: justify;
	}
	table th{
		font-weight: bold;
	}

	table td{
		padding: 2px;
	}
	table tr b{
		font-size: 12px;
		margin-top:8px;
	}
	.ps{
		font-weight: bold;
	}
	</style>
</head>

<body>

	<header>
		<img src="../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
	</header>
	
	<nav>
		<ul>
			<li><a href="../Home" alt="Inicio" title="Inicio"><img src="../images/home.png"/></a></li>
			<a href="./"><li><img src="../images/volver.png" alt="">Atras</li></a><li></li><li></li><li></li>
			<li><a href="../salir.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../images/lock.png"/></a></li>
		</ul>
	</nav>

	<section id="contenido">
		<section id="principal">

<?php
include("../conexion.php");
$id_cont=$_GET["id_cont"]; 
//$query="SELECT * FROM contactos WHERE id_contacto='$id'";
$query="SELECT * FROM contactos C
			LEFT JOIN direcciones D ON C.id_direccion = D.id_direccion
			LEFT JOIN areacontacto B ON C.id_areacontacto = B.id_areacontacto
					WHERE id_contacto ='$id_cont'";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){?>
<div style="padding:10px; background:#fff;border-radius:10px;width:400px;">
<center>
<h4>Datos del contacto</h4><hr>
	  <table style="text-align:justify;">
	    <tr><td><b>Nombre :</b></td><td><?php echo $fila["nombre"] ?></td></tr>
		<tr><td><b>Movil :</b></td><td> <?php echo $fila["movil"] ?></td></tr>
		<tr><td><b>Fecha de alta :</b> </td><td><?php echo $fila["fecha_alta"] ?></td></tr>
		<tr><td><b>Email Personal :</b> </td><td><?php echo $fila["email_personal"] ?></td></tr>
		<tr><td><b>Email Institucional :</b></td><td> <?php echo $fila["email_institucion"] ?></td></tr>
		<tr><td><b>Facebook :</b></td><td> <?php echo $fila["facebook"] ?></td></tr>
		<tr><td><b>Area Contacto :</b></td><td> <?php echo $fila["nombre_areacontacto"] ?></td></tr>
		<tr><td><b>Dirección Web :</b></td><td> <?php echo $fila["direccion_web"] ?></td></tr>
		<tr><td><b>Tel. Casa :</b></td><td> <?php echo $fila["telefono_casa"] ?></td></tr>
		<tr><td><b>Twitter :</b> </td><td><?php echo $fila["twitter"] ?></td></tr>
		<tr><td><b>Tal. Oficina</b></td><td><?PHP echo $fila["tel_oficina"]; ?></td></tr>
		<tr><td><b>Skype</b></td><td><?PHP echo $fila["skype"]; ?></td></tr>
		<tr><td><b>Tel. Emergencia</b></td><td><?PHP echo $fila["tel_emergencia"]; ?></td></tr>
		</table>
		<br>
		<hr>
		<h4>Direccion</h4>
		<table style="width:200px;">
		
		<tr><td class="ps">Calle</td><td><?php echo $fila["calle"]; ?></td></tr>
		<tr><td class="ps">Municipio</td><td><?php echo $fila["municipio"]; ?></td></tr>
		<tr><td class="ps">No. Ext</td><td><?php echo $fila["num_ext"]; ?></td></tr>
		<tr><tr class="ps"><td>No. Int</td><td><?php echo $fila["estado"]; ?></td></tr>
		<tr><td class="ps">Estado</td><td><?php echo $fila["num_int"]; ?></td></tr>
		<tr><td class="ps">Pais</td><td><?php echo $fila["pais"]; ?></td></tr>
		<tr><td class="ps">Colonia/Delegación</td><td><?php echo $fila["colonia"]; ?></td></tr>
		<tr><td class="ps">Localidad</td><td><?php echo $fila["cod_postal"]; ?></td></tr>
		<tr><td class="ps">GPS Ubicación</td><td><?php echo $fila["localidad"]; ?></td></tr>
		<tr><td class="ps">C.P.</td><td><?php echo $fila["gps_ubicacion"]; ?></td></tr>
		<tr><td class="ps">Sucursal.</td><td><?php echo $fila["sucursal"]; ?></td></tr>
		<tr><td class="ps">Referencia</td><td><?php echo $fila["referencia"]; ?></td></tr>
	  </table>
<?php }?>
<hr>
			<h4>Clientes</h4>
			<table>
				
				<?php
					$query="SELECT C.id,D.id_cliente,razonSocial from clientexcontacto C 
					inner join clientes D on C.id_cliente=D.id_cliente WHERE C.id_contacto='$id_cont'";
					$result=mysql_query($query);
					while($fila=mysql_fetch_array($result)){
					echo "<tr><td><b>RAZÓN SOCIAL:</b> ".$fila[2]." </td></tr>";
					}
				?>
				
			</table>
<?php 
$query="select sum(id_cliente) from clientexcontacto where id_contacto=$id_cont";		
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	$nu=$fila[0];
}
if($nu==0){
	echo "<h5>No Existe Ninguno</h5><br><br>";
}
?>
		<a class="btn" style="background:rgba(0,191,255,.9);font-weigth:bold;" href="./">Salir</a>
</center>
		</section>
	</section>
</body>
</html>