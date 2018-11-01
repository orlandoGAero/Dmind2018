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
	$IDtipoTransacion = $_REQUEST["idTipoTransaccion"];
	$fecha = $_REQUEST["fechaAlta"];
	$fechaTransacc = date_format(date_create($fecha),'Y-m-d H:i:s');
	$descripcion = $_REQUEST["descripcion"];
	$NumSerie = trim($_REQUEST["noSerie"]);
	$PedidoDeImportacion = trim($_REQUEST["pedidoImportacion"]);
	$NumFactura = trim($_REQUEST["noFactura"]);
	$IDestado = $_REQUEST["idEstado"];
	$IDstatus = $_REQUEST["idStatus"];
	$IDubicacion = $_REQUEST["idUbicacion"];
	$color = $_REQUEST["color"];
	$IDtransaccion = $_REQUEST["idTransaccion"];

	$flag = 0;

	if ($flag == 0) {
		$sql = "SELECT no_serie
				FROM inventario
				WHERE  no_serie = '".$NumSerie."' AND id_inventario !=" . $IDinventario;
		$ejecutar = mysql_query($sql) or die(mysql_error());
		$filas = mysql_num_rows($ejecutar);
	 	if($filas != 0) {
			echo "<div class='errorAddInv'><h3>No. de Serie:" . $NumSerie . " duplicado, por favor ingresa otro.</h3></div>";
			$flag = 1;
		}
	}

	if ($flag == 0) {
		$color = mb_strtoupper($color);
		$descripcion = mb_strtoupper($descripcion);
		$NumSerie = mb_strtoupper($NumSerie);
		$PedidoDeImportacion = mb_strtoupper($PedidoDeImportacion);
		$NumFactura = mb_strtoupper($NumFactura);

		$sql="INSERT INTO inventario VALUES (".$IDinventario.",".$IDproveedor.",".$IDproducto.",'".$NumSerie."','".$PedidoDeImportacion."','".$NumFactura."',".$IDestado.",".$IDstatus.",".$IDubicacion.",'".$color."');";
		$sql=mysql_query($sql);

		$ejecutar="INSERT INTO transacciones VALUES (".$IDtransaccion.",'".$fechaTransacc."',".$IDinventario.",".$IDtipoTransacion.",'".$descripcion."')";
		$ejecutar=mysql_query($ejecutar);

		$sql="SELECT exit_inventario FROM productos WHERE id_producto=$IDproducto";
		$result=mysql_query($sql);
		while($fila=mysql_fetch_array($result)){	
		 	$tot=$fila[0];
	 	}

		$total=$tot+1;

		$sent="UPDATE productos SET exit_inventario=$total WHERE id_producto=$IDproducto";
		$sent=mysql_query($sent);
		// Guardar mas de un registro.
		if (isset($_REQUEST['txtCantidad'])) {
			if ($_REQUEST['txtCantidad'] != "" || $_REQUEST['txtCantidad'] != 0) {
				require 'classInventario.php';
				$fnInventario = new Inventario();
				$cantProd = $_REQUEST['txtCantidad'];
				for ($i=1; $i <= $cantProd; $i++) { 
					$idInvent = $fnInventario -> incrementoInventario();
					$IDtransaccion = $fnInventario -> incrementoTransaccion();
					$numSerieInt = $NumSerie.$i;
					$fnInventario -> registrarInventario($idInvent,$IDproveedor,$IDproducto,$numSerieInt,$PedidoDeImportacion,$NumFactura,$IDestado,$IDstatus,$IDubicacion,$color,
														$IDtransaccion,$fechaTransacc,$IDtipoTransacion,$descripcion);
				}
			}
		}
	}

echo "
	<script type='text/javascript'>
		var inve = jQuery.noConflict();
		inve(function() {
			var band = ".$flag.";
			if (band == 0) {
				modInv.fancybox.close();
				inve('#tb_inv').load('tabla_inv.php');
			}
		});

		setTimeout(function(){
			inve('.errorAddInv').fadeOut(1000);
		},5000);

		inve('#serie').focus();
	</script>";
?>

