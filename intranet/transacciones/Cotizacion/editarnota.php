<?php
session_start();
//manejamos en sesion el nombre del usuario que se ha logeado
if (!isset($_SESSION["usuario"])){
    header("location:../../");  
}
$_SESSION["usuario"];
//termina inicio de sesion
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title>Productos</title>
	<link rel="shortcut icon" type="image/x-icon" href="../favicon.ico" />
	<link rel="stylesheet" href="../../css/menu.css" />
	<script type="text/javascript" src="../../js/jquery-2.1.4.js"></script>
<script type="text/javascript">
$(document).ready(function(){
		$("#todedta").css("display","block");
		setTimeout(function() {
		$(".cargand").css("display","none");
		}, 500);
		setTimeout(function() {
		$("#formagregar").slideDown("low");
	}, 1000);
});
</script>
</head>

<body>
	<header>
		<img src="../../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
	</header>
<div id="todedt">
<?php //este se utiliza para llenar datos
$id_cotizacion=$_GET["id_cotizacion"];
$id_producto=$_GET["id_producto"];
?>
<img src="../../images/loadingAnimation.gif" class="cargand" style="left:50%; top:100px;">
	<form action='guardarnota.php' id='formagregar'>
	<h4>Editando Nota</h4><br><br>
<input type="hidden" name="id_cotizacion" value="<?php echo $_GET["id_cotizacion"] ?>">
<input type="hidden" name="id_producto" value="<?php echo $_GET["id_producto"] ?>">



<?php
include ('../../conexion.php');
 $sql = "SELECT * FROM detalle_cotizacion where id_cotizacion=$id_cotizacion and id_producto=$id_producto";
$result = mysql_query($sql);
  while ($fila = mysql_fetch_array($result))
  {
     echo '<b>'.$fila["descripcion"].'</b><hr>';
     echo '<br><textarea name="nota" cols="30" rows="7">'.$fila["nota"].'</textarea><br>';
     echo '<b>Cantidad :'.$fila["cantidad"].' Piezas</b>';
     echo '<br><br><b>Precio : $'.$fila["precio"].'</b>';
     echo '<br><br><b>Importe : $'.$fila["importe"].'</b>';
  }?>
  <br><br>

	<button id="guard">Guardar producto</button>
	<a href="./?id_cotizacion=<?php echo $_GET["id_cotizacion"] ?>">
  <img class="cerrar" src="../../images/eliminar.png">
  <spam class="cerrar">Cancelar</spam></a>
	</form>
</div>
</body>
</html>