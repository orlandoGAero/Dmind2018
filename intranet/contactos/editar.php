<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Digital Mind</title>
  <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
	<link rel="stylesheet" href="../css/estilos.css" />
	<link rel="stylesheet" href="../css/menu.css" />
	<link rel="stylesheet" href="../css/tabla.css" />
	<link rel="stylesheet" href="../css/formularios.css" />
	<script type="text/javascript" src="../js/jquery-2.1.4.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
	
	$(".cambiar").click(function(){
		$("#todo").css("display","block");
		$(".nuevoclie").css("display","none");
		setTimeout(function() {
		$(".cargand").css("display","none");
		}, 500);
		setTimeout(function() {
		$(".actualiza").slideDown("low");
		$(".cerrar").css("display","block");
	}, 1000);
	});
	$(".agregar").click(function(){
		$("#todo").css("display","block");
		$(".actualiza").css("display","none");
		setTimeout(function() {
		$(".cargand").css("display","none");
		}, 500);
		setTimeout(function() {
		$(".nuevoclie").slideDown("low");
		$(".cerrar").css("display","block");
	}, 1000);
	});

	$(".cerrar").click(function(){
	$(".cerrar").css("display","none");
	$("#todo").css("display","none");
	});
	var res = $(".resp").val();	
	$(".acept").click(function(){
		$(".todasacciones").css("display","none");
		$("#todo").css("display","block");
		setTimeout(function() {
		$(".cargand").css("display","none");
		}, 500);
		setTimeout(function() {
		$(".actualiza").slideDown("low");
		$(".cerrar").css("display","block");
	}, 1000);
	});

	if(res=="no"){
	$(".todasacciones").css("display","block");
	$(".alerta").css("display","block");
	}
	if(res=="si"){
	$(".todasacciones").css("display","block");
	$(".alertacorr").css("display","block");
	}

	});
	</script>	
	<style type="text/css">
	table tr{
	text-align: justify;
	}
	table th{
		font-weight: bold;
	}

	table td{
		padding: 4px;
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
<input type="hidden" class="resp" value="<?php echo $_GET["resp"]; ?>" />

<div class="todasacciones" style="top:0;">
	<section class="alerta"><br>
		<b>Este contacto no puede vincularse</b>
    <br>
    <b>por que ya esta vinculado a otro</b>
    <br><br><br>
    <button class="acept">Aceptar</button>
	</section>
	<section class="alertacorr"><br>
		<b>El contacto fue vinculado</b>
    <br>
    	<b>Correctamente</b>
    <br><br><br>
    <a href="./editar.php?id_cont=<?php echo $_GET["id_cont"]; ?>"><button class="ok">Aceptar</button></a>
	</section>
</div>

	<header>
		<img src="../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
	</header>
	<nav>
		<ul>
			<li><a href="../Home" alt="Inicio" title="Inicio"><img src="../images/home.png"/></a></li>
			<a href="javascript:window.history.back();"><li><img src="../images/volver.png" alt="">Atras</li></a><li></li><li></li><li></li>
			<li><a href="../logout.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../images/lock.png"/></a></li>
		</ul>
	</nav>

	<section id="contenido">
		<section id="principal">
<form action="actualizar.php">
<?php
include("../conexion.php");
$id_cont=$_GET["id_cont"]; 
//$query="SELECT * FROM contactos WHERE id_contacto='$id'";
$query="SELECT * FROM contactos C
			LEFT JOIN direcciones D ON C.id_direccion = D.id_direccion
			LEFT JOIN areacontacto B ON C.id_areacontacto = B.id_areacontacto
					WHERE id_contacto=$id_cont";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
?>
<div style="padding:10px; background:#fff;border-radius:10px;width:400px;position:absolute;">
<input type="hidden" name="id_cont" value="<?php echo $_GET["id_cont"] ?>"/>
<h4>Datos del contacto</h4><hr>
	  <table style="text-align:justify;">
	    <tr><td><b>Nombre :</b></td>
	    <td><input type="text" name="nom_clie" value="<?php echo $fila["nombre"] ?>" /></td></tr>
		<tr><td><b>Movil :</b></td>
		<td> <input type="text" name="tel_movil" value="<?php echo $fila["movil"] ?>" /></td></tr>
		<tr><td><b>Email Personal :</b> </td>
		<td><input type="text" name="email_personal" value="<?php echo $fila["email_personal"] ?>" /></td></tr>
		<tr><td><b>Email Institucional :</b></td>
		<td> <input type="text" name="email_institucion" value="<?php echo $fila["email_institucion"] ?>" /></td></tr>
		<tr><td><b>Facebook :</b></td>
		<td> <input type="text" name="facebook" value="<?php echo $fila["facebook"] ?>" /></td></tr>
		<tr><td><b>Dirección Web :</b></td>
		<td> <input type="text" name="web" value="<?php echo $fila["direccion_web"] ?>" /></td></tr>
		<tr><td><b>Tel. Casa :</b></td>
		<td> <input type="text" name="tel_casa" value="<?php echo $fila["telefono_casa"] ?>" /></td></tr>
		<tr><td><b>Twitter :</b> </td>
		<td><input type="text" name="twiter" value="<?php echo $fila["twitter"] ?>" /></td></tr>
		<tr><td><b>Tal. Oficina:</b></td>
		<td><input type="text" name="tel_oficina" value="<?php echo $fila["tel_oficina"]; ?>" /></td></tr>
		<tr><td><b>Skype:</b></td>
		<td><input type="text" name="skype" value="<?php echo $fila["skype"]; ?>" /></td></tr>
		<tr><td><b>Tel. Emergencia:</b></td>
		<td><input type="text" name="tel_emerg" value="<?php echo $fila["tel_emergencia"]; ?>"/></td></tr>
		<tr><td><b>AreaCategoria:</b></td> <?php $cat=$fila["id_areacontacto"]; ?>
<?php } ?>
<td>
<select name="id_areacontacto">
<?php 
$query="SELECT * FROM areacontacto where id_areacontacto=$cat";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	echo "<option value='",$fila[0],"'>",$fila[1],"</option>";
}
$query="SELECT * FROM areacontacto where not id_areacontacto=$cat";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	echo "<option value='",$fila[0],"'>",$fila[1],"</option>";
}
 ?>
 </select>
 </td>
		</tr>
		</table>
</div>
<br>
<?php 
$query="SELECT * FROM contactos C
			LEFT JOIN direcciones D ON C.id_direccion = D.id_direccion
			LEFT JOIN areacontacto B ON C.id_areacontacto = B.id_areacontacto
					WHERE id_contacto=$id_cont";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
?>
<div style="padding:10px; background:#fff;border-radius:10px;margin-left:430px;width:400px;">
<h4>Direccion</h4>
<input type="hidden" name="id_direc" value="<?php echo $fila["id_direccion"] ?>">
		<hr>
		<table style="width:200px;">
		<tr><td class="ps">Calle:</td>
		<td><input type="text" name="calle" value="<?php echo $fila["calle"]; ?>" /></td></tr>
		<tr><td class="ps">Municipio:</td>
		<td><input type="text" name="municipio" value="<?php echo $fila["municipio"]; ?>" /></td></tr>
		<tr><td class="ps">No. Ext:</td>
		<td><input type="text" name="num_ext" value="<?php echo $fila["num_ext"]; ?>" /></td></tr>
		<tr><tr class="ps"><td>No. Int:</td>
		<td><input type="text" name="num_int" value="<?php echo $fila["num_int"]; ?>" /></td></tr>
		<tr><td class="ps">Estado:</td>
		<td><input type="text" name="estado" value="<?php echo $fila["estado"]; ?>" /></td></tr>
		<tr><td class="ps">Pais:</td>
		<td><input type="text" name="pais" value="<?php echo $fila["pais"]; ?>" /></td></tr>
		<tr><td class="ps">Colonia/Delegación:</td>
		<td><input type="text" name="colonia" value="<?php echo $fila["colonia"]; ?>" /></td></tr>
		<tr><td class="ps">Localidad:</td>
		<td><input type="text" name="localidad" value="<?php echo $fila["localidad"]; ?>" /></td></tr>
		<tr><td class="ps">GPS Ubicación:</td>
		<td><input type="text" name="gps_ubicacion" value="<?php echo $fila["gps_ubicacion"]; ?>" /></td></tr>
		<tr><td class="ps">Codigo Postal:</td>
		<td><input type="text" name="cod_postal" value="<?php echo $fila["cod_postal"]; ?>" /></td></tr>
		<tr><td class="ps">Sucursal:</td>
		<td><input type="text" name="sucursal" value="<?php echo $fila["sucursal"]; ?>" /></td></tr>
		<tr><td class="ps">Referencia:</td>
		<td><input type="text" name="referencia" value="<?php echo $fila["referencia"]; ?>" /></td></tr>
	  </table>
<?php }?>
</div>
<button class="btn" style="margin-left:320px;">Guardar Cambios</button>
</form>
<?php 
$query="select sum(id_cliente) from clientexcontacto where id_contacto=$id_cont";		
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	$nu=$fila[0];
}
if($nu==0){
	echo "<div style='margin-left:430px;'>";
	echo "<h3>No Existe Ninguno</h3>";
	echo "<img src='../images/addcontact.png' class='agregar' style='cursor:pointer' /></div>";
}else{
?>
<br>

<!--oiahsioahsioashihasiohsaiohiaoooooooooooooooooooooo -->
<div style="margin-left:430px; margin-top:30px; background:rgba(255,255,255,.9); width:450px; border-radius:5px; text-align:center; color:#000;font-size:13px;">
			<h3 style="color:#000; background:rgba(0,191,255,.5)">Clientes</h3><br>
<?php
$query="SELECT C.id,D.id_cliente,razonSocial from clientexcontacto C 
		inner join clientes D on C.id_cliente=D.id_cliente WHERE C.id_contacto='$id_cont'";
		
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
?>
<?php
  echo "<h5>RAZÓN SOCIAL</h5><br>";
  echo "<b>", $fila[2]; "</b>";
  echo "<br><br><img src='../images/actua.png' class='cambiar' style='width:20px; height:20px;' />";
  echo "<a class='cambiar' style='text-decoration:none'>Cambiar</a>";
  echo "<b><a href='quitarcliente.php?id_cont=";
  echo $_GET["id_cont"];
  echo "&";
  echo "id_clie=";
  echo $fila[1];
  echo "'>";
  echo "<img src='../images/eliminar.png' style='margin-top:0px;' heigth='10'/>quitar</a><b>";
}
}
 ?>
 </table>
<br><br>
</div>
<!--Funciones ocultas-->
<div id="todo">

<img src="../images/loadingAnimation.gif" class="cargand"><br>
<center>
<div class="nuevoclie" style="display:none;">
<br><br><br>
<br><br>
<h1 style="text-align:center;">Agregar Cliente</h1>
 <div class="scrollbar" id="barra" style="heigth:700px;">
	<table class="datos" id="actual" style="width:60%;">
		<tr>
		<th>Id</th>
		<th>Nombre</th>
		<th>Razon Social</th>
		<th>RFC</th>
		<th>Estado</th>
		<th>Municipio</th>
		</tr>
		<?php 
		$query="SELECT C.id_cliente, C.nombre_cliente,C.razonSocial,rfc,municipio,estado FROM clientes C 
				inner join datos_fiscales D on C.id_datfiscal=D.id_datfiscal
				inner join direcciones B on C.id_direccion=B.id_direccion order by id_cliente asc";		
		$result=mysql_query($query);
		while($fila=mysql_fetch_array($result)){
		  echo "<tr>";
		  echo "<td align='center'>", $fila[0]; "</td>";
		  echo "<td align='center'>", $fila[1]; "</td>";
		  echo "<td align='center'>", $fila[2]; "</td>";
		  echo "<td align='center'>", $fila[3]; "</td>";
		  echo "<td align='center'>", $fila[4]; "</td>";
		  echo "<td><a href='nuevocliente.php?id_cont=";
		  echo $_GET["id_cont"];
		  echo "&";
		  echo "id_clie=";
		  echo $fila[0];
		  echo "'>";
		  echo "<img src='../images/add.png' style='margin-top:0px;' alt='Elegir'/></a></td>";
		  echo "</tr>";
		}
		?>
    </table>
 <div class="contbarra"></div>
</div>
</div>
<div class="actualiza" style="display:none;">
	<br><br><br>
	<br><br>
	<h1 style="text-align:center;">Cambiar Contacto</h1>
 <div class="scrollbar" id="barra" style="heigth:700px;">
 <table class="datos" id="actual" style="width:80%;">
	<tr>
	<th>Id</th>
	<th>Nombre</th>
	<th>Razon Social</th>
	<th>RFC</th>
	<th>Estado</th>
	<th>Municipio</th>
	<th>........</th>
	</tr>
	<?php 
	$query="SELECT C.id_cliente, C.nombre_cliente,C.razonSocial,rfc,municipio,estado FROM clientes C 
			inner join datos_fiscales D on C.id_datfiscal=D.id_datfiscal
			inner join direcciones B on C.id_direccion=B.id_direccion order by id_cliente asc";
			
	$result=mysql_query($query);
	while($fila=mysql_fetch_array($result)){
	  echo "<tr>";
	  echo "<td align='center'>", $fila[0]; "</td>";
	  echo "<td align='center'>", $fila[1]; "</td>";
	  echo "<td align='center'>", $fila[2]; "</td>";
	  echo "<td align='center'>", $fila[3]; "</td>";
	  echo "<td align='center'>", $fila[4]; "</td>";
	  echo "<td align='center'>", $fila[5]; "</td>";
	  echo "<td><a href='actualizacliente.php?id_cont=";
	  echo $_GET["id_cont"];
	  echo "&";
	  echo "id_clie=";
	  echo $fila[0];
	  echo "'>";
	  echo "<img src='../images/cambia.png' style='margin-top:0px;' alt='Elegir'/></a></td>";
	  echo "</tr>";
	}
	 ?>
 </table>
	<div class="contbarra"></div>
</div>
</div>
<b class="cerrar">Cerrar</b>
		</section>
	</section>

</body>
</html>