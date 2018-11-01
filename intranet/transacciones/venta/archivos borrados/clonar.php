<!DOCTYPE html>
<html lang="es">
<head>
    <title>Clonar Cotización</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../../css/formularios.css" />
    <link rel="stylesheet" href="../../css/menu.css" />
    <script type="text/javascript" src="../../js/jquery-2.1.4.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
    	$("#todo").css("display","block");
    });
    </script>
<style>
	body{
	}
	.alert{
		width: 260px;
		height: 120px;
		padding: 10px;
		letter-spacing: 1.3px;
		text-align: center;
		border-radius: 10px;
		background: rgba(255,255,255,.7);
		position: absolute;
		top:40%;
		left:40%;
	}
	.alert h3{
		color: #000;
	}
	.alert .si{
		float: left;
		width: 100px;
	}
	.alert .no{
		background: rgba(223,0,0,.9);
		margin-left: -20px;
		position: absolute;
		border: 1px solid #000;
		color:#fff;
		
	}
</style>
</head>
    <body>
<body background="../imagenes/bg.jpg">
  <header>
    <img src="../../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
  </header>
  <nav>
    <ul>
      <li><a href="../../Home" alt="Inicio" title="Inicio"><img src="../../images/home.png"/></a></li>
      <li></li><li></li><li></li><li></li>
      <li><a href="../../salir.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../../images/lock.png"/></a></li>
    </ul>
  </nav>
	<h1 style="text-align:center; color:rgba(0,191,255,.9);">
	Cotizaciones</h1>
<?php
include ('../../conexion.php');


$id_cot=$_GET["id_cot"];

$query = "SELECT * FROM detalle_cotizacion where id_cotizacion=$id_cot";
$result = mysql_query($query);
$cuantos=mysql_num_rows($result);
?>
<div id="todo">
<form action="clonarproductos.php" class="">
<input type="hidden" value="<?php echo $_GET["id_cot"]; ?>" name="id_cot">
<input type="hidden" value="<?php echo $_GET["id_clie"]; ?>" name="id_clie">
<input type="hidden" value="<?php echo $cuantos ?>" name="cuantos">
<?php
$conta=1;
  while ($fila = mysql_fetch_array($result))
  {
	echo "<input type='hidden' name='p",$conta++,"' value='",$fila["id_producto"],"' />";
  }
?>
<aside class="alert">
<h3>¿Deseas clonar productos y cliente de esta cotizacion?</h3>
<br><br>
<button class="btn primary si">Aceptar</button>
<a href="javascript:window.history.back();" class="btn eliminar no">
	Cancelar
</a>
</aside>
</form>
</div>
    </body>
</html>