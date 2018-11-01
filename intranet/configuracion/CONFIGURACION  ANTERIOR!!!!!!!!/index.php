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
	<link rel="stylesheet" href="../css/menu.css" />
	<script type="text/javascript" src="../js/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="../js/configuracion.js"></script>
	<style type="text/css">
#menuopcion{
	width:170px; 
	float:left; 
	margin-top:10px;
	margin-left:11%;
	background: rgba(0,192,255,.5);	
	padding: 4px;
	border-radius: 5px;
	border: 1px;
}
.opciones{
    background:linear-gradient(top,#0DC2FF,#007095);
    background:-moz-linear-gradient(top,#0DC2FF,#007095);
    background:-o-linear-gradient(top,#0DC2FF,#007095);
    background:-ms-linear-gradient(top,#0DC2FF,#007095);
    background:-webkit-linear-gradient(top,#0DC2FF,#007095);
	border:1px solid #FFF;
	box-shadow: 1px 1px 1px #000;
	color:#111;
	cursor:pointer;
	font-weight:bold;
	margin-top: 3px;
	border-radius: 3px;
	padding:6px;
	text-align: center;
}
.opciones:hover{
	background:#16555B;
	box-shadow: 1px 1px 1px #fff;
	color: #FFF;
}
.acciones{
	display: none;
	border-radius: 5px;
	width: 550px;
	height: auto;
	margin-top:10px;
	margin-left: 28%;
	padding:17px;
	background:rgba(255,255,255,.2);
	color: #FFF;
}
.acciones figure img{
  width: 100px;
  height: 100px;
  float: left;
  background:linear-gradient(top,#0DC2FF,#007095);
  background:-moz-linear-gradient(top,#0DC2FF,#007095);
  background:-o-linear-gradient(top,#0DC2FF,#007095);
  background:-ms-linear-gradient(top,#0DC2FF,#007095);
  background:-webkit-linear-gradient(top,#0DC2FF,#007095);
  border-radius:10px;
  -webkit-box-shadow: 0 1px 4px #777; -moz-box-shadow: 0 1px 4px #777; box-shadow: 0 1px 4px #777;
  transition:transform 0.4s;
  -moz-transition:-moz-transform 0.4s;
  -ms-transition:-ms-transform 0.4s;
  -o-transition:-o-transform 0.4s;
  -webkit-transition:-webkit-transform 0.4s;
}
.acciones img:hover{
	background: #16555B;
  transform:scale(1.1,1.1);
  -moz-transform:scale(1.1,1.1);
  -o-transform:scale(1.1,1.1);
  -ms-transform:scale(1.1,1.1);
  -webkit-transform:scale(1.1,1.1);
  cursor: pointer;
}
.acciones figure{
	margin-left:30px;
	float: left;
}
.acciones figure figcaption p {
	text-align: center;
	font-size: 1.1em;
	font-weight: bold;
	text-shadow:1px 1px 1px #000,
				-1px -.5px 1px #000;
}
.acciones h3{
	font-size: 1.6em;
	color:rgba(0,192,255,1);
	font-weight: bolder;
	text-shadow:1px 1px 1px #000,
				-1px 1px 1px #000,
				2px -2px 1px rgba(233,234,122,.5),
				3px 2px 2px #000,
				2px 2px 2px rgba(0,192,255,.7),
				-4px -1px 4px #fff,
				4px 4px 4px #fff;  
	text-align: center;
	margin: auto;
	width: 200px;
	border:1px solid rgba(0,0,0,.5);
	padding:5px;
	box-shadow: -2px 2px 1px #000;
}
.cent{
	margin-left: 150px;
}
</style>
</head>
<body>
<?php include ("../menu.php"); ?>
	<h1 style="text-align:center;"><a href="../Home">
	<img class="atras" src="../images/atras.png" alt="Atras"></a>Configuración</h1>
	<div id="menuopcion">
		<div id="basicas" class="opciones" >Básicas</div>
		<div id="clientes" class="opciones" >Clientes</div>
		<div id="contactos" class="opciones" >Contactos</div>
		<div id="productos" class="opciones" >Productos</div>
		<div id="inventario" class="opciones" >Inventario</div>
		<div id="proveedores" class="opciones" >Proveedores</div>
		<div id="transacciones" class="opciones" >Transacciones</div>
		<div id="finanzas" class="opciones" >Finanzas</div>
	</div>
<fieldset class="acciones" id="basic">
	 <h3>Usuarios</h3><br>
	 	<a href="usuarios">
		<figure class="cent"><img src="../images/usuarios.png"/>
			<figcaption><p>Usuarios</p></figcaption>
		</figure>
		</a>
		<a href="direcciones">
		<figure><img src="../images/direcciones.png"/>
			<figcaption><p>Direcciones</p></figcaption>
		</figure>
		</a>
</fieldset>
<fieldset class="acciones" id="client">
	 <h3>Clientes</h3><br>
	 	<a href="categorias-cliente">
		<figure class="cent"><img src="../images/categoriaclient.png"/>
			<figcaption><p>Categorias</p></figcaption>
		</figure>
		</a>
</fieldset>
<fieldset class="acciones" id="contact">
		<h3>Contactos</h3><br>
	<a href="area-contacto">
	<figure><img src="../images/areacontacto.png"/>
			<figcaption><p>Áreas</p></figcaption>
	</figure>
	</a>
</fieldset>
<fieldset class="acciones" id="product">
	<h3>Productos</h3><br>
	<a href="categorias">
	<figure><img src="../images/catgorias.png"/>
			<figcaption><p>Categorias</p></figcaption>
	</figure>
	</a>
	<a href="subcategorias">
	<figure><img src="../images/subcategorias.png"/>
			<figcaption><p>Sub Categorias</p></figcaption>
	</figure>
	</a>
	<a href="divisiones">
	<figure><img src="../images/divisiones.png"/>
			<figcaption><p>Divisiones</p></figcaption>
	</figure>
	</a>
	<a href="marcas">
	<figure><img src="../images/marcas.png"/>
			<figcaption><p>Marcas</p></figcaption>
	</figure>
	</a>
	<a href="nombres">
	<figure><img src="../images/nombres.png"/>
			<figcaption><p>Nombres</p></figcaption>
	</figure>
	</a>
	<a href="tipos">
	<figure><img src="../images/tipos.png"/>
			<figcaption><p>Tipos</p></figcaption>
	</figure>
	</a>
	<a href="unidades">
	<figure><img src="../images/unidades.png"/>
			<figcaption><p>Unidades</p></figcaption>
	</figure>
	</a>
</fieldset>

<fieldset class="acciones" id="invent">
	<h3>Inventario</h3><br>
	<a href="estados">
	<figure><img src="../images/estados.png"/>
			<figcaption><p>Estados</p></figcaption>
	</figure>	
	</a>
	<a href="status">
	<figure><img src="../images/status.png"/>
			<figcaption><p>Status</p></figcaption>
	</figure>
	</a>
	<a href="ubicaciones">
	<figure><img src="../images/ubicaciones.png"/>
			<figcaption><p>Ubicación</p></figcaption>
	</figure>
	</a>
</fieldset>

<fieldset class="acciones" id="prov">
		<h3>Proveedores</h3><br>
	<a href="proveedores">
	<figure><img src="../images/proveedor.png"/>
			<figcaption><p>Proveedores</p>
	</figure>
	</a>
	 <a href="categorias-proveedor">
	<figure class="cent"><img src="../images/catproveedor.png"/>
	     	<figcaption><p>Categorias</p></figcaption>
	</figure>
	</a>
</fieldset>


<fieldset class="acciones" id="trans">
		<h3>Transacciones</h3><br>
	<a href="tipo-transaccion">
	<figure>
			<img src="../images/trans.png"/>
			<figcaption><p>Tipo-transacción</p></figcaption>
	</figure>
	</a>
	<a href="moneda">
	<figure><img src="../images/moneda2.png"/>
		<figcaption><p>Moneda</p></figcaption>
	</figure>
	</a>
	<a href="cotizacion">
	<figure><img src="../images/cotizacion.png"/>
			<figcaption><p>Cotización</p></figcaption>
	</figure>
	</a>
<!--	<figure><img src="../images/advertencia.jpg"/>
			<figcaption><p>Pedido</p></figcaption>
	</figure>
	<figure><img src="../images/advertencia.jpg"/>
			<figcaption><p>Compra</p></figcaption>
	</figure>
	<figure><img src="../images/advertencia.jpg"/>
			<figcaption><p>Recibo</p></figcaption>
	</figure>
	<figure><img src="../images/advertencia.jpg"/>
			<figcaption><p>Entrega</p></figcaption>
	</figure>
	<figure><img src="../images/advertencia.jpg"/>
			<figcaption><p>Venta</p></figcaption>
	</figure>
	<figure><img src="../images/advertencia.jpg"/>
			<figcaption><p>Devolución</p></figcaption>
	</figure>
	<figure><img src="../images/advertencia.jpg"/>
			<figcaption><p>Compra</p></figcaption>
	</figure>
	-->
</fieldset>
<fieldset class="acciones" id="finan">
	 <h3>Finanzas</h3><br>
	 	<div id="egresos">
			<figure class="cent"><img src="../images/config-egresos.png"/>
				<figcaption><p style="color:#28C7E0;">Egresos</p></figcaption>
			</figure>
		</div>
			
</fieldset>
<fieldset class="acciones" id="egre">
	 <h3>Egresos</h3><br>
	 	<a href="finanzas/egresos/conceptos">
		<figure class="cent"><img src="../images/config-concepto.png"/>
			<figcaption><p>Conceptos </p></figcaption>
		</figure>
		</a>
		<a href="finanzas/egresos/clasificaciones">
		<figure class="cent"><img src="../images/config-clasfi.png"/>
			<figcaption><p>Clasificación </p></figcaption>
		</figure>
		</a>
		<a href="finanzas/egresos/status">
		<figure class="cent"><img src="../images/config-status.png"/>
			<figcaption><p>Status </p></figcaption>
		</figure>
		</a>
		<a href="finanzas/egresos/origenes">
		<figure class="cent"><img src="../images/config-origen.png"/>
			<figcaption><p>Origenes </p></figcaption>
		</figure>
		</a>
		<a href="finanzas/egresos/destinos">
		<figure class="cent"><img src="../images/config-destino.png"/>
			<figcaption><p>Destinos </p></figcaption>
		</figure>
		</a>
</fieldset>
</body>
</html>