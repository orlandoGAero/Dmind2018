<?php
session_start();
//manejamos en sesion el nombre del usuario que se ha logeado
if (!isset($_SESSION["usuario"])){
    header("location:../");  
}
$_SESSION["usuario"];
//termina inicio de sesion
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Digital Mind</title>
  <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
	<link rel="stylesheet" href="../css/estilos.css" />
	<link rel="stylesheet" href="../css/menu.css" media="screen" />
	<link rel="stylesheet" href="../css/tabla.css" media="screen" />
	<link rel="stylesheet" href="../css/formularios.css" media="screen" />
	<script type="text/javascript" src="../js/jquery-2.1.4.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
	$(".cambiar").click(function(){
		$("#todo").css("display","block");
		$(".nuevocont").css("display","none");
		setTimeout(function() {
		$(".cargand").css("display","none");
		}, 500);
		setTimeout(function() {
		$("#actualiza").slideDown("low");
		$(".cerrar").css("display","block");
	}, 1000);
	});

	$(".agregar").click(function(){
		$("#todo").css("display","block");
		$("#actualiza").css("display","none");
		setTimeout(function() {
		$(".cargand").css("display","none");
		}, 500);
		setTimeout(function() {
		$(".nuevocont").slideDown("low");
		$(".cerrar").css("display","block");
	}, 1000);
	});

	$(".acept").click(function(){
		$(".todasacciones").css("display","none");
		$("#todo").css("display","block");
		setTimeout(function() {
		$(".cargand").css("display","none");
		}, 500);
		setTimeout(function() {
		$(".nuevocont").slideDown("low");
		$(".cerrar").css("display","block");
	}, 1000);
	});

	$(".ok").click(function(){
	$(".todasacciones").css("display","none");	
	});
	$(".cerrar").click(function(){
	$(".cerrar").css("display","none");
	$("#todo").css("display","none");
	});

	var res = $(".resp").val();	
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
    <a href="./editar.php?id_clie=<?php echo $_GET["id_clie"]; ?>"><button class="ok">Aceptar</button></a>
	</section>
</div>



	<header>
		<img src="../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
	</header>

	<nav>
		<ul>
			<li><a href="../Home" alt="Inicio" title="Inicio"><img src="../images/home.png"/></a></li>
			<a href="javascript:window.history.back();"><li><img src="../images/volver.png" /><b>Atras</b></li></a><li></li><li></li><li></li>
			<li><a href="../logout.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../images/lock.png"/></a></li>
		</ul>
	</nav>
	<section id="contenido">
		<section id="principal">

<h1>Editando Cliente</h1>
<?php
include("../conexion.php");
$id_clie=$_GET["id_clie"];
$query="SELECT * FROM clientes C WHERE id_cliente=$id_clie";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
?>
<div style="background:rgba(255,255,255,.95);padding:15px; border-radius:10px;">
<form action="actualizar.php" >
<h4>Datos del Cliente:</h4>
<input type="hidden" name="id_clie" value="<?php echo $id_clie ?>" readonly />
	<b>Nombre:</b>
		<input name="nom_clie" type="text" value="<?php echo $fila[1] ?>" />
<b>Telefono:</b>
<input type="text" name="telefono" value="<?php echo $fila["telefono"]; ?>" /><br><br>
	<b>Categoria:</b>
	<select name="id_categoria_cli"><br>
<?php $id_cat=$fila["id_categoria_cliente"]; 
}
?>
<?php 
$query="SELECT * FROM categoria_cliente where id_categoria_cliente=$id_cat";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	echo "<option value='",$fila[0],"'>",$fila[1],"</option>";
}

 $query="SELECT * FROM categoria_cliente where not id_categoria_cliente=$id_cat";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	echo "<option value='",$fila[0],"'>",$fila[1],"</option>";
}

 ?>
 <?php
 $id_clie=$_GET["id_clie"];
$query="SELECT * FROM clientes C WHERE id_cliente=$id_clie";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
?>

		</select>
	<b>Direccion Web:</b>
	<input type="text" name="web" value="<?php echo $fila["direccion_web"] ?>" /><br>
<?php
}
?>
<hr> 
<?php
$query="SELECT C.id_datfiscal,razon_social,rfc,tipo_razon_social,C.id_contacto,D.id_direccion,C.id_bancarios FROM clientes C
		inner join datos_fiscales D on C.id_datfiscal=D.id_datfiscal
		inner join direcciones on C.id_direccion=direcciones.id_direccion WHERE id_cliente=$id_clie";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
 ?>
<h4>Datos Fiscales</h4>
<table>
<tr>
<td>
<input type="hidden" value="<?php echo $fila[0] ?>" name="id_datfiscal">
		Razon Social
</td>
<td>
		<input type="text" name="razonsocial" value="<?php echo $fila[1] ?>"/><br><br>
</td>
<td>
		RFC
</td>
<td>
		<input type="text" name="rfc" value="<?php echo $fila[2] ?>"/>
</td>
<td>
		Tipo Razon Social
</td>
<td>
<?php 
if($fila[3]=="Social"){
?>
<select name="tipoRason_Soc">
	<option value="Social">Social</option>
	<option value="Moral">Moral</option>
</select><br><br>
<?php
}else{
 ?>
 <select name="tipoRason_Soc">
	<option value="Moral">Moral</option>
	<option value="Social">Social</option>
</select><br><br>
<?php
}
?>
</td>
<td>
<?php
$id_fisc=$fila[0];
$id_banc=$fila["id_bancarios"];
 }

$query="SELECT * FROM datos_fiscales 
		inner join direcciones on datos_fiscales.id_direccion=direcciones.id_direccion 
		WHERE id_datfiscal=$id_fisc";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
 ?>
 </td>
 </tr>
 <tr>
 <td>
		<input type="hidden" name="fid_direc" value="<?php echo $fila["id_direccion"] ?>">
		E-mail:
</td><td>
		<input type="text" name="femail" value="<?php echo $fila["email"] ?>"/><br><br>

</td>
<td>
		<input type="hidden" name="fid_direc" value="<?php echo $fila["id_direccion"] ?>">
		Pais:
</td><td>
		<input type="text" name="fpais" value="<?php echo $fila["pais"] ?>"/><br><br>

</td>
<td>
		Estado
</td><td>
		<input type="text" name="festado" value="<?php echo $fila["estado"] ?>"/><br><br>

</td>
</tr>
<tr>
<td>
		Municipio:
</td><td>
		<input type="text" name="fmunicipio" value="<?php echo $fila["municipio"] ?>"/>
</td>
<td>
		Localidad:
</td><td>
		<input type="text" name="flocalidad" value="<?php echo $fila["localidad"] ?>"/><br><br>
</td><td>
		Codigo Postal:
</td><td>
		<input type="text" name="fcod_postal" value="<?php echo $fila["cod_postal"] ?>"/>
</td>
</tr>
<tr>
<td>
		Colonia/Delegación:
</td><td>
		<input type="text" name="fcolonia" value="<?php echo $fila["colonia"] ?>"/><br><br>
</td><td>
		Calle:
</td><td>
		<input type="text" name="fcalle" value="<?php echo $fila["calle"] ?>"/>
</td>
</tr>
<tr>
<td>
		No. Ext:
</td><td>
		<input type="text" name="fnum_ext" value="<?php echo $fila["num_ext"] ?>"/><br><br>
</td><td>
		No. Int:
</td><td>
		<input type="text" name="fnum_int" value="<?php echo $fila["num_int"] ?>"/>
</td>
</tr>
<tr>
<td>
		Referencias
</td>
<td>
		<input type="text" name="freferencia" value="<?php echo $fila["referencia"] ?>"/>
</td>
</tr>
</table>
<?php 
}
$query="SELECT * FROM datos_bancarios where id_bancarios=$id_banc";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
 ?>
		<hr>
<h4>Datos Bancarios:</h4>
 <table>
 <tr>
<td>
		<input type="hidden" name="id_bancarios" value="<?php echo $fila["id_bancarios"] ?>"/>
	Nombre Banco:<input type="text" name="nombre_banco" value="<?php echo $fila["nombre_banco"] ?>"/><br><br>

</td>
<td>
		Sucursal:<input type="text" name="bsucursal" value="<?php echo $fila["sucursal"] ?>">
</td>
</tr>
<tr>
<td>
		Titular:<input type="text" name="titular" value="<?php echo $fila["titular"] ?>"><br><br>
</td>
<td>
		No. cuenta:<input type="text" name="no_cuenta" value="<?php echo $fila["no_cuenta"] ?>"><br><br>
</td>
</tr>
<tr>
<td>
		Clave Interbancaria:<input type="text" name="clave_interbancaria" value="<?php echo $fila["clave_interbancaria"] ?>">
</td>
<td>
		tipo_cuenta:<input type="text" name="tipo_cuenta" value="<?php echo $fila["tipo_cuenta"] ?>">
</td>
</tr>
</table>
		<hr>
<?php 
}
$query="SELECT C.id_direccion,calle,num_ext,num_int,colonia,localidad,referencia,municipio,estado,pais,
		cod_postal,sucursal FROM clientes C
		inner join direcciones on C.id_direccion=direcciones.id_direccion WHERE id_cliente=$id_clie";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
 ?>

<h4>Dirección Fisica</h4>
		<input type="hidden" name="id_direc" value="<?php echo $fila[0] ?>">
 <table>
 <tr>
<td>
		Pais:
</td><td>
		<input type="text" name="pais" value="<?php echo $fila["pais"] ?>"/><br><br>

</td>
<td>
		Estado
</td><td>
		<input type="text" name="estado" value="<?php echo $fila["estado"] ?>"/><br><br>

</td><td>
		Municipio:
</td><td>
		<input type="text" name="municipio" value="<?php echo $fila["municipio"] ?>"/>
</td>
</tr>
<tr>
<td>
		Localidad:
</td><td>
		<input type="text" name="localidad" value="<?php echo $fila["localidad"] ?>"/><br><br>
</td><td>
		Codigo Postal:
</td><td>
		<input type="text" name="cod_postal" value="<?php echo $fila["cod_postal"] ?>"/>
</td>
<td>Sucursal:</td>
<td>
		<input type="text" name="sucursal" value="<?php echo $fila["sucursal"] ?>"/>
</td>
</tr>
<tr>
<td>
		Colonia/Delegación:
</td><td>
		<input type="text" name="colonia" value="<?php echo $fila["colonia"] ?>"/><br><br>
</td><td>
		Calle:
</td><td>
		<input type="text" name="calle" value="<?php echo $fila["calle"] ?>"/>
</td>
</tr>
<tr>
<td>
		No. Ext:
</td><td>
		<input type="text" name="num_ext" value="<?php echo $fila["num_ext"] ?>"/><br><br>
</td><td>
		No. Int:
</td><td>
		<input type="text" name="num_int" value="<?php echo $fila["num_int"] ?>"/>
</td>
</tr>
<tr>
<td>
		Referencias
</td>
<td>
		<input type="text" name="referencia" value="<?php echo $fila["referencia"] ?>"/>
</td>
</tr>
</table>
		<hr>
<?php } ?>
<div style=" margin-top:30px; background:rgba(0,0,0,.5); width:45%; border-radius:5px; text-align:center; color:#000;">
			<h3 style="color:#000; background:rgba(0,191,255,.5)">Contactos</h3>
<center>
<?php
$id=$_GET["id_clie"];
include("../conexion.php");
$query="SELECT C.id,nombre,movil,nombre_areacontacto,C.id_contacto from clientexcontacto C 
		inner join contactos on C.id_contacto=contactos.id_contacto 
		inner join areacontacto on contactos.id_areacontacto=areacontacto.id_areacontacto 
		WHERE id_cliente=$id_clie";
		
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
?>
<table class="datos" style="width:240px;">
<tr>
<th>Nombre</th>
<th>Area</th>
<th>Telefono</th>
<th></th>
<th></th>
<th></th>
<th></th>
</tr>
<?php
  echo "<tr>";
  echo "<td align='center'>", $fila[1]; "</td>";
  echo "<td align='center'>", $fila[3]; "</td>";
  echo "<td align='center'>", $fila[2]; "</td>";
  echo "<td align='center'><img src='../images/actua.png' class='cambiar' style='width:20px; height:20px;' />";
  echo "<a class='cambiar' style='text-decoration:none'>Cambiar</a></td>";
  echo "<td><a href='quitarcontacto.php?id_cont=";
  echo $fila[4];
  echo "&";
  echo "id_clie=";
  echo $_GET["id_clie"];
  echo "'>";
  echo "<img src='../images/eliminar.png' style='margin-top:0px;' heigth='10'/>quitar</a><td>";
  echo "</tr>";
}
?>
</table>
<?php 
$query="select count(id_cliente) from clientexcontacto where id_cliente=$id_clie";		
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	$nu=$fila[0];
}
if($nu==0){
	echo "<h3>No Existe Ninguno</h3>";
	echo "<img src='../images/addcontact.png' class='agregar' style='cursor:pointer' />";
}

 ?>
<br><br>
</center>
</div>
<br><br>	
		<br><input type="submit" class="btn primary" value="Guardar"/>
		<a class="btneliminar" href="./">Cancelar</a>
</form>
</div>

   </section>
	</section>

<div id="todo">
<img src="../images/loadingAnimation.gif" class="cargand"><br>
<div class="nuevocont" style="display:none">
<br>
<br><br>
<br>
<br>
	<h1 style="text-align:center;">Agregar Contacto</h1>
<center>
<div class="scrollbar" id="barra" style="heigth:700px;">
<table class="datos" id="actual" style="width:60%;">
<tr>
<th>Id</th>
<th>Nombre</th>
<th>Area</th>
<th>Municipio</th>
<th>Telefono</th>
<th>........</th>
</tr>
<?php 
include("../conexion.php");
$query="SELECT C.id_contacto,C.nombre,nombre_areacontacto,municipio,C.movil FROM contactos C
		inner join areacontacto A on C.id_areacontacto=A.id_areacontacto 
		inner join direcciones D on C.id_direccion=D.id_direccion order by id_contacto asc";
		
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
  echo "<tr>";
  echo "<td align='center'>", $fila[0]; "</td>";
  echo "<td align='center'>", $fila[1]; "</td>";
  echo "<td align='center'>", $fila[2]; "</td>";
  echo "<td align='center'>", $fila[3]; "</td>";
  echo "<td align='center'>", $fila[4]; "</td>";
  echo "<td><a href='nuevocontacto.php?id_cont=";
  echo $fila[0];
  echo "&";
  echo "id_clie=";
  echo $_GET["id_clie"];
  echo "'>";
  echo "<img src='../images/add.png' style='margin-top:0px;' alt='Elegir'/></a></td>";
  echo "</tr>";
}
?>
 </table>
 	<div class="contbarra"></div>
    </div>
</center>
</div>
<div id="actualiza" style="display:none">
<br>
<br><br>
<br>
<br>
	<h1 style="text-align:center;">Cambiar Contacto</h1>
<center>
<div class="scrollbar" id="barra" style="heigth:700px;">
<table class="datos" id="actual" style="width:60%;">
<tr>
<th>Id</th>
<th>Nombre</th>
<th>Area</th>
<th>Municipio</th>
<th>Telefono</th>
<th>........</th>
</tr>
<?php 
include("../conexion.php");
$query="SELECT C.id_contacto,C.nombre,nombre_areacontacto,municipio,C.movil FROM contactos C
		inner join areacontacto A on C.id_areacontacto=A.id_areacontacto
		inner join direcciones D on C.id_direccion=D.id_direccion order by id_contacto asc";
		
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
  echo "<tr>";
  echo "<td align='center'>", $fila[0]; "</td>";
  echo "<td align='center'>", $fila[1]; "</td>";
  echo "<td align='center'>", $fila[2]; "</td>";
  echo "<td align='center'>", $fila[3]; "</td>";
  echo "<td align='center'>", $fila[4]; "</td>";
  echo "<td><a href='actualizacontacto.php?id_cont=";
  echo $fila[0];
  echo "&";
  echo "id_clie=";
  echo $_GET["id_clie"];
  echo "'>";
  echo "<img src='../images/cambia.png' style='margin-top:0px;' alt='Elegir'/></a></td>";
  echo "</tr>";
}
 ?>
 </table>
 	<div class="contbarra"></div>
    </div>
</center>
</div>
<b class="cerrar">Cerrar</b>
</div>
</body>
</html>