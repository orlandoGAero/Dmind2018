<?php 
include("../../conexion.php");

$IDinventario = $_REQUEST["idInventario"];
$IDtransaccion = $_REQUEST["idTransaccion"];;
$descripcion = $_REQUEST["descripcion"];
$PedidoDeImportacion = trim($_REQUEST["pedidoImportacion"]);
$NumFactura = trim($_REQUEST["noFactura"]);
$IDestado = $_REQUEST["idEstado"];
$IDubicacion = $_REQUEST["idUbicacion"];

$band = 0;

if ($band == 0) {
	$descripcion = mb_strtoupper($descripcion);
	$PedidoDeImportacion = mb_strtoupper($PedidoDeImportacion);
	$NumFactura = mb_strtoupper($NumFactura);

	$query="UPDATE inventario SET pedido_de_importacion='".$PedidoDeImportacion."',no_factura='".$NumFactura."',id_estado=".$IDestado.",id_ubicacion=".$IDubicacion." WHERE id_inventario=".$IDinventario.";";
	mysql_query($query);

	$sql="UPDATE transacciones SET descripcion='".$descripcion."' WHERE id_transaccion=$IDtransaccion";
	mysql_query($sql);

	 echo "<script type='text/javascript'>
        window.location.href = 'index.php';
      </script>";
}
?>