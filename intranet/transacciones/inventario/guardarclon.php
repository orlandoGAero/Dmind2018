<?php
include ("../../conexion.php");

$query ="SELECT id_inventario FROM inventario ORDER BY id_inventario DESC LIMIT 1";
$result=mysql_query($query);
$fila=mysql_fetch_array($result);
 if($fila[0]=="NULL"){
 	$IDinventario=1;
 }else{
	$IDinventario=$fila[0]+1;
 }

$IDproveedor = $_REQUEST["idProveedor"];
$IDproducto = $_REQUEST["idProducto"];
$IDtransaccion = $_REQUEST["idTransaccion"];
$IDtipoTransaccion = $_REQUEST["idTipoTransaccion"];
$fecha = $_REQUEST["fecha"];
$fechaTransacc = date_format(date_create($fecha),'Y-m-d H:i:s');
$descripcion = $_REQUEST["descripcion"];
$NumSerie =  trim($_REQUEST["noSerie"]);
$PedidoDeImportacion = trim($_REQUEST["pedidoImportacion"]);
$NumFactura = trim($_REQUEST["noFactura"]);
$IDestado = $_REQUEST["idEstado"];
$IDstatus = $_REQUEST["idStatus"];
$IDubicacion = $_REQUEST["idUbicacion"];
$color = $_REQUEST["color"];

$band = 0;

if ($band == 0) {
	$sql = "SELECT no_serie
			FROM inventario
			WHERE  no_serie = '".$NumSerie."' AND id_inventario !=" . $IDinventario;
	$ejecutar = mysql_query($sql) or die(mysql_error());
	$filas = mysql_num_rows($ejecutar);
 	if($filas != 0) {
		echo "<div class='errorClonInv'><h3>No. de Serie:" . $NumSerie . " duplicado, por favor ingresa otro.</h3></div>";
		$band = 1;
	}
}

if ($band == 0) {
	$color = mb_strtoupper($color);
	$descripcion = mb_strtoupper($descripcion);
	$NumSerie = mb_strtoupper($NumSerie);
	$PedidoDeImportacion = mb_strtoupper($PedidoDeImportacion);
	$NumFactura = mb_strtoupper($NumFactura);

	$sql = "INSERT INTO inventario VALUES (".$IDinventario.",".$IDproveedor.",".$IDproducto.",'".$NumSerie."','".$PedidoDeImportacion."','".$NumFactura."',".$IDestado.",".$IDstatus.",".$IDubicacion.",'".$color."')";

	$ejecutar = mysql_query($sql);

	$query = "INSERT INTO transacciones VALUES (".$IDtransaccion.",'".$fechaTransacc."',".$IDinventario.",".$IDtipoTransaccion.",'".$descripcion."')";
	$ejecutar = mysql_query($query);

	$sql="SELECT exit_inventario from productos where id_producto=$IDproducto";
	$result=mysql_query($sql);
	 while($fila=mysql_fetch_array($result)){	
	 	$tot=$fila[0];
	 }
	$total=$tot+1;

	$sent="UPDATE productos SET exit_inventario=$total where id_producto=$IDproducto";
	mysql_query($sent);

	 echo "<script type='text/javascript'>
        $(window.location).attr('href','index.php');
      </script>";
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		setTimeout(function(){
			$('.errorClonInv').fadeOut(1000);
		},5000);

		$('#serie').focus();
	});
</script>