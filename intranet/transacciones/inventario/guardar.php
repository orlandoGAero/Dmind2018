<?php
	require ('classInventario.php');
	$funInv = new Inventario();

	$fila = $funInv->getFilaInventario();

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
		$filas = $funInv->getNoSerieDuplicado($NumSerie, $IDinventario);
	 	if($filas != 0) {
			echo "<div class='errorAddInv'><h3>No. de Serie:" . $NumSerie . " duplicado, por favor ingresa otro.</h3></div>";
			$flag = 1;
		}

	}

	if ($flag == 0) {

		if ($_REQUEST['txtCantidad'] == "" || $_REQUEST['txtCantidad'] == 0) {

			$color = mb_strtoupper($color);
			$descripcion = mb_strtoupper($descripcion);
			$NumSerie = mb_strtoupper($NumSerie);
			$PedidoDeImportacion = mb_strtoupper($PedidoDeImportacion);
			$NumFactura = mb_strtoupper($NumFactura);
	
			$funInv->saveInventario($IDinventario,$IDproveedor,$IDproducto,$NumSerie,$PedidoDeImportacion,
									$NumFactura,$IDestado,$IDstatus,$IDubicacion,$color);
			
			$funInv->saveTransacciones($IDtransaccion,$fechaTransacc,$IDinventario,$IDtipoTransacion,$descripcion);
	
			$existencia = $funInv->getExistencias($IDproducto);
	
			$total = $existencia + 1;
	
			$funInv->setExistencia($total, $IDproducto);
		}

		if (isset($_REQUEST['txtCantidad'])) {
			if ($_REQUEST['txtCantidad'] != "" || $_REQUEST['txtCantidad'] != 0) {
				$cantProd = $_REQUEST['txtCantidad'];
				// Guardar mas de un registro.
				for ($i=1; $i <= $cantProd; $i++) { 
					$idInvent = $funInv -> incrementoInventario();
					$IDtransaccion = $funInv -> incrementoTransaccion();
					$numSerieInt = $NumSerie.$i;
					$funInv -> registrarInventario($idInvent,$IDproveedor,$IDproducto,$numSerieInt,$PedidoDeImportacion,$NumFactura,$IDestado,$IDstatus,$IDubicacion,$color,
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

