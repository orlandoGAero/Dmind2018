<?php

    require ('classInventario.php');
    $funInv = new Inventario();
    
    $idEg = $_REQUEST['txt_idEg'];
    $IDproveedor = $_REQUEST["idProvee"];
    $IDstatus = $_REQUEST["txt_idStatus"];
    $NumFactura = trim($_REQUEST["txt_noFactura"]);
    $DatosInventario = $_REQUEST['datosInv'];
    $IDtipoTransacion = $_REQUEST["txt_idTipoTransaccion"];
    $fecha = $_REQUEST["txt_fechaAlta"];
    $fechaTransacc = date_format(date_create($fecha),'Y-m-d H:i:s');
    $descripcion = $_REQUEST["descrip"];

    $flag = 0;

    if($flag === 0) {

        foreach ($DatosInventario as $key => $datos) {
            if (isset($datos['txt_Cantidad'])) {
                // No tiene no Serie y se genera segun la cantidad
                if ($datos['txt_Cantidad'] != 0) {

                    $cantProd = $datos['txt_Cantidad'];
                    $noSerie = $datos['noSerie'];
                    
                    for ($j=1; $j <= $cantProd; $j++) { 
                        $idInvent = $funInv -> incrementoInventario();
                        $IDtransaccion = $funInv -> incrementoTransaccion();
    
                        $numSerieInt = $noSerie.$j;
                        $funInv -> registrarInventario($idInvent,
                                                    $IDproveedor,
                                                    $datos['idProducto'],
                                                    $numSerieInt,
                                                    $datos['pedidoImportacion'],
                                                    $NumFactura,
                                                    $datos['idEstado'],
                                                    $IDstatus,
                                                    $datos['idUbicacion'],
                                                    $datos['color'],
                                                    $IDtransaccion,
                                                    $fechaTransacc,
                                                    $IDtipoTransacion,
                                                    $descripcion);
                        $funInv -> setInventariado($datos['txtIdCon']);
                        
                    }
                } else if ($datos['txt_Cantidad'] == 0) {
                    //crear array
                    
                    $cantidadSerie =  count($datos['noSerie']);
                    for ($i = 1; $i <= $cantidadSerie; $i++) {
                        $idInvent = $funInv -> incrementoInventario();
                        $IDtransaccion = $funInv -> incrementoTransaccion();

                        $nuevoArray = array( 
                            "idConcepto" => $datos['txtIdCon'],
                            "idProd" => $datos['idProducto'],
                            "serie" => $datos['noSerie'][$i],
                            "importacion" => $datos['pedidoImportacion'],
                            "color" => $datos['color'],
                            "estado" => $datos['idEstado'],
                            "ubicacion" => $datos['idUbicacion'],
                        );
                        $funInv -> registrarInventario($idInvent,
                                                    $IDproveedor,
                                                    $nuevoArray['idProd'],
                                                    $nuevoArray['serie'],
                                                    $nuevoArray['importacion'],
                                                    $NumFactura,
                                                    $nuevoArray['estado'],
                                                    $IDstatus,
                                                    $nuevoArray['ubicacion'],
                                                    $nuevoArray['color'],
                                                    $IDtransaccion,
                                                    $fechaTransacc,
                                                    $IDtipoTransacion,
                                                    $descripcion);
                        $funInv -> setInventariado($nuevoArray['idConcepto']);
                        
                    }
                }
            }
        }
        
        $cantidades = $funInv->getCantidadesConceptosEg($idEg);
        $productosInv = $funInv->getProductosInv($NumFactura);

        $sumaCant = 0;
        
        foreach($cantidades as $cantidad) {
            $cant = $cantidad['cantidad_concepto_e'];
            $sumaCant += $cant;
        }
        
        $NumProdInv = count($productosInv);
        
        if($sumaCant === $NumProdInv) {
            $funInv->setStatusInvCap($idEg);
        } else {
            $funInv->setStatusInvIncom($idEg);
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