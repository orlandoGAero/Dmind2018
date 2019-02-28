<?php
	/**
	* FUNCIÓN para Egresos.
	*/
	require'dataBaseConn.php';
	class egresos {
		// Obtener los egresos registrados.
        public function getIdCon($modelo) {
			$Conexion = new dataBaseConn();
			$sql = "SELECT id_egresos_conceptos
                    FROM egresos_conceptos
                    WHERE modelo_concepto_e = :Modelo;";
            $query =  $Conexion->prepare($sql);
			$query->bindParam(':Modelo', $modelo);
			$query->execute();
			$datos = $query->fetch(PDO::FETCH_ASSOC);
			return $datos;
		}
        
        public function getFilaProd() {
			$Conexion = new dataBaseConn();
			$query = $Conexion->query('SELECT id_producto FROM productos ORDER BY id_producto DESC LIMIT 1;');
			$fila = $query->fetch(PDO::FETCH_NUM);
			return $fila;
		}
        
        public function guardarRelEgProd($idegcon,$idproducto) {
            
            try {
                    $Conexion = new dataBaseConn();
                    $sql = "INSERT INTO conceptos_productos(id_eg_con,id_prod)
                            VALUES (:IdEgCon,:IdProd);";
                    $query = $Conexion->prepare($sql);
                    $query->bindParam(':IdEgCon',$idegcon);
                    $query->bindParam(':IdProd',$idproducto);
                    $resultlt = $query->execute();
            } catch(PDOException $e) {
                $code = $e->getCode();
                $mensaje = $e->getMessage();
                print $mensaje;
                print $code;
            }
        }
        
        public function obtenerEgProd($idEgr,$idEgCon) {
            $Conexion = new dataBaseConn();
            $sql = "SELECT econ.id_egresos_conceptos, cp.id_prod, pr.descripcion, pr.modelo
                    FROM conceptos_productos cp
                    INNER JOIN productos pr ON pr.id_producto = cp.id_prod
                    INNER JOIN egresos_conceptos econ ON econ.id_egresos_conceptos = cp.id_eg_con
                    WHERE econ.id_egresos = :IdEg AND cp.id_eg_con = :IdEgCon;";
            $query = $Conexion->prepare($sql);
            $query->bindParam(':IdEg', $idEgr);
            $query->bindParam('IdEgCon', $idEgCon);
            $query->execute();
            $fila = $query->rowCount();
            return $fila;
        }
        
		public function listarEgresos() {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare("SELECT
											eg.idegresos,
											eg.fecha,
											eg.rfc_emisor,
											eg.razon_social_emisor,
											eg.serie,
											eg.no_folio,
											eg.subtotal,
											eg.iva,
											eg.total,
											eg.metodo_pago,
											eg.fecha_pago,
											eg.no_cuenta,
											eg.concepto,
											eg.clasificacion,
											eg.estado
										   FROM egresos eg;");
			$query -> execute();
			$datEgresos = $query -> fetchAll();
			return $datEgresos;
		} // Fin obtener los egresos registrados.
		// Extraer datos del archivo XML.
		public function obtenerDatosXML($nombreArchivo, $nombreArchivoTemporal, $tipo){
			dirname(__FILE__).'/';
			
			// define('DIR_BASE', dirname(__FILE__).'/');
			$band = 0;

			if (isset($nombreArchivo)) {
				if($tipo == "text/xml"){
					if (is_uploaded_file($nombreArchivoTemporal)) {
						$ruta = "../archivos_xml/".$nombreArchivo;
						move_uploaded_file($nombreArchivoTemporal, $ruta);
					}else{
						$this -> msjErr = "Error al intentar cargar el archivo '".$nombreArchivo."'.";
						$band = 1;
					}
				}else{
					$this -> msjCap = "Se requiere un archivo XML.";
					$band = 1;
				}
			}else {
				$this -> msjErr = "El archivo: ".$nombreArchivo." no existe.";
				$band = 1;
			}

			if($band == 0){
				// Leer el archivo XML.
				$xml = simplexml_load_file($ruta);
				$nodos =  $xml -> getNamespaces(true);
				if ($xml['version']) {
					$version = $xml['version'];
				} else if ($xml['Version']) {
					$version = $xml['Version'];
				}

				if(isset($nodos['cfdi']) || isset($nodos['tfd'])){
					// c es una abreviación de: cfdi
					$xml -> registerXPathNamespace('c',$nodos['cfdi']);

					if(isset($nodos['tfd'])){
						// t es una abreviación de: tfd
						$xml -> registerXPathNamespace('t',$nodos['tfd']);
					}

					if ($version == "3.2") { // Factura VERSIÓN 3.2
						foreach ($xml -> xpath('//c:Comprobante') as $comprobante) {
							$versionComprobante = trim($comprobante['version']);
							$NumSerie = trim(mb_strtoupper($comprobante['serie']));
							$NumFolio = trim($comprobante['folio']);
							$FechaComprobante = trim($comprobante['fecha']);
							$Fecha = date_format(date_create($FechaComprobante),'d-m-Y');
							$Hora = date_format(date_create($FechaComprobante),'H:i:s');
							$descuentoComprobante = trim($comprobante['descuento']);
							$SubTotal = trim($comprobante['subTotal']);
							$condicionPago = trim($comprobante['condicionesDePago']);
							$formaDePago = trim(mb_strtoupper($comprobante['formaDePago']));
							$moneda = trim(mb_strtoupper($comprobante['Moneda']));
							$Total = trim($comprobante['total']);
							$tipoComprob = trim(mb_strtoupper($comprobante['tipoDeComprobante']));
							$MetodoPago = trim(mb_strtoupper($comprobante['metodoDePago']));
							$LugarExpedicion = trim(mb_strtoupper($comprobante['LugarExpedicion']));
							$selloComprobante = trim($comprobante['sello']);
						}

						foreach ($xml -> xpath('//c:Comprobante//c:Emisor') as $emisor) {
							$rfcEmisor = trim(mb_strtoupper($emisor['rfc']));
							$nombreEmisor = trim(mb_strtoupper($emisor['nombre']));
							$regimenFiscal = "";
						}

						foreach ($xml -> xpath('//c:Comprobante//c:Emisor//c:DomicilioFiscal') as $dirFisEmisor) {
							// DFE = Domicilio Fiscal Emisor
							$paisDFE = trim($dirFisEmisor['pais']);
							$estadoDFE = trim($dirFisEmisor['estado']);
							$municipioDFE = trim($dirFisEmisor['municipio']);
							$coloniaDFE = trim($dirFisEmisor['colonia']);
							$numExtDFE = trim($dirFisEmisor['noExterior']);
							$numIntDFE = trim($dirFisEmisor['noInterior']);
							$calleDFE = trim($dirFisEmisor['calle']);
							$codPosDFE = trim($dirFisEmisor['codigoPostal']);
						}

						foreach ($xml -> xpath('//c:Comprobante//c:Receptor') as $receptor) {
							$rfcReceptor = trim(mb_strtoupper($receptor['rfc']));
							$nombreReceptor = trim(mb_strtoupper($receptor['nombre']));
							$usoCfdiReceptor = "";
						}

						foreach ($xml -> xpath('//c:Comprobante//c:Conceptos//c:Concepto') as $concepto) {
							$conceptosComprobante[] = array(
																'claveConceptoE'=>'',
																'cantidadConceptoE'=>trim($concepto['cantidad']),
																'claveUnidadConceptoE'=>'',
																'unidadConceptoE'=>trim($concepto['unidad']),
																'descripcionConceptoE'=>trim($concepto['descripcion']),
																'modeloConceptoE'=>trim($concepto['noIdentificacion']),
																'valorUnitarioConceptoE'=>trim($concepto['valorUnitario']),
																'importeConceptoE'=>trim($concepto['importe'])
															);
							$impuestosConceptosComprobante[] = array(
																		'baseConceptoE'=>'',
																		'impuestoConceptoE'=>'',
																		'tipoFactorConceptoE'=>'',
																		'tasaCuotaConceptoE'=>'',
																		'importeImpuestoConceptoE'=>''
																	);
							$infoAduanera[] = array('numeroPedimento' => '');
						}

						if ($xml -> xpath('//c:Comprobante//c:Impuestos')) {
							foreach ($xml -> xpath('//c:Comprobante//c:Impuestos') as $impuestos) {
								$totalDeImpuestos = trim($impuestos['totalImpuestosTrasladados']);
							}
						} else {
							$totalDeImpuestos = '';
						}

						if ($xml -> xpath('//c:Comprobante//c:Impuestos//c:Traslados//c:Traslado')) {
							
							foreach ($xml -> xpath('//c:Comprobante//c:Impuestos//c:Traslados//c:Traslado') as $impuestosTranslados) {
								$tipoImpuesto = trim(mb_strtoupper($impuestosTranslados['impuesto']));
								$tipoFactorImpuesto = "";
								$tasaCuotaImpuesto = trim($impuestosTranslados['tasa']);
								$importeImpuesto = trim($impuestosTranslados['importe']);
							}

						} else { 
							$tipoImpuesto = '';
							$tipoFactorImpuesto = '';
							$tasaCuotaImpuesto = '';
							$importeImpuesto  = '';
						}

						foreach ($xml -> xpath('//t:TimbreFiscalDigital') as $timbreFiscal) {
							$FolioFiscal = trim($timbreFiscal['UUID']);
							$fechaTimbrado = trim($timbreFiscal['FechaTimbrado']);
							$fechaTimbr = date_format(date_create($fechaTimbrado),'d-m-Y');
							$horaTimbr = date_format(date_create($fechaTimbrado),'H:i:s');
							$RFCproveedor = "";
						}
					} // Termina VERSIÓN 3.2
					else if($version == "3.3") { // Factura VERSIÓN 3.3
						foreach ($xml -> xpath('//c:Comprobante') as $comprobante) {
							$versionComprobante = trim($comprobante['Version']);
							$NumSerie = trim(mb_strtoupper($comprobante['Serie']));
							$NumFolio = trim($comprobante['Folio']);
							$FechaComprobante = trim($comprobante['Fecha']);
							$Fecha = date_format(date_create($FechaComprobante),'d-m-Y');
							$Hora = date_format(date_create($FechaComprobante),'H:i:s');
							$descuentoComprobante = "";
							$SubTotal = trim($comprobante['SubTotal']);
							$condicionPago = "";
							$formaDePago = trim(mb_strtoupper($comprobante['FormaPago']));
							$moneda = trim(mb_strtoupper($comprobante['Moneda']));
							$Total = trim($comprobante['Total']);
							$tipoComprob = trim(mb_strtoupper($comprobante['TipoDeComprobante']));
							$MetodoPago = trim(mb_strtoupper($comprobante['MetodoPago']));
							$LugarExpedicion = trim(mb_strtoupper($comprobante['LugarExpedicion']));
							$selloComprobante = trim($comprobante['Sello']);
						}

						foreach ($xml -> xpath('//c:Comprobante//c:Emisor') as $emisor) {
							$rfcEmisor = trim(mb_strtoupper($emisor['Rfc']));
							$nombreEmisor = trim(mb_strtoupper($emisor['Nombre']));
							$regimenFiscal = trim($emisor['RegimenFiscal']);
						}

						if ($xml -> xpath('//c:Comprobante//c:Emisor//c:DomicilioFiscal')) {
							foreach ($xml -> xpath('//c:Comprobante//c:Emisor//c:DomicilioFiscal') as $dirFisEmisor) {
								// DFE = Domicilio Fiscal Emisor
								$paisDFE = trim($dirFisEmisor['pais']);
								$estadoDFE = trim($dirFisEmisor['estado']);
								$municipioDFE = trim($dirFisEmisor['municipio']);
								$coloniaDFE = trim($dirFisEmisor['colonia']);
								$numExtDFE = trim($dirFisEmisor['noExterior']);
								$numIntDFE = trim($dirFisEmisor['noInterior']);
								$calleDFE = trim($dirFisEmisor['calle']);
								$codPosDFE = trim($dirFisEmisor['codigoPostal']);
							}
						} else {
							// DFE = Domicilio Fiscal Emisor
							$paisDFE = "";
							$estadoDFE =  "";
							$municipioDFE = "";
							$coloniaDFE = "";
							$numExtDFE = "";
							$numIntDFE = "";
							$calleDFE = "";
							$codPosDFE = "";
						}

						foreach ($xml -> xpath('//c:Comprobante//c:Receptor') as $receptor) {
							$rfcReceptor = trim(mb_strtoupper($receptor['Rfc']));
							$nombreReceptor = trim(mb_strtoupper($receptor['Nombre']));
							$usoCfdiReceptor = trim(mb_strtoupper($receptor['UsoCFDI']));
						}

						foreach ($xml -> xpath('//c:Comprobante//c:Conceptos//c:Concepto') as $concepto) {
							$conceptosComprobante[] = array(
																'claveConceptoE'=>trim($concepto['ClaveProdServ']),
																'cantidadConceptoE'=>trim($concepto['Cantidad']),
																'claveUnidadConceptoE'=>trim($concepto['ClaveUnidad']),
																'unidadConceptoE'=>trim($concepto['Unidad']),
																'descripcionConceptoE'=>trim($concepto['Descripcion']),
																'modeloConceptoE'=>trim($concepto['NoIdentificacion']),
																'valorUnitarioConceptoE'=>trim($concepto['ValorUnitario']),
																'importeConceptoE'=>trim($concepto['Importe'])

															);

						}

						if ($xml -> xpath('//c:Comprobante//c:Conceptos//c:Concepto//c:Impuestos')) {

							foreach ($xml -> xpath('//c:Comprobante//c:Conceptos//c:Concepto//c:Impuestos//c:Traslados//c:Traslado') as $impuestosConceptos) {
								$impuestosConceptosComprobante[] = array(
																			'baseConceptoE'=>trim($impuestosConceptos['Base']),
																			'impuestoConceptoE'=>trim($impuestosConceptos['Impuesto']),
																			'tipoFactorConceptoE'=>trim($impuestosConceptos['TipoFactor']),
																			'tasaCuotaConceptoE'=>trim($impuestosConceptos['TasaOCuota']),
																			'importeImpuestoConceptoE'=>trim($impuestosConceptos['Importe'])
																		);
							}
						} else {
							$impuestosConceptosComprobante = array ();
						}

						if ($xml -> xpath('//c:Comprobante//c:Impuestos')) {
							foreach ($xml -> xpath('//c:Comprobante//c:Impuestos') as $impuestos) {
								$totalDeImpuestos = trim($impuestos['TotalImpuestosTrasladados']);
							}
						} else {
							$totalDeImpuestos = '';
						}

						if ($xml -> xpath('//c:Comprobante//c:Impuestos//c:Traslados//c:Traslado')) {
						
							foreach ($xml -> xpath('//c:Comprobante//c:Impuestos//c:Traslados//c:Traslado') as $impuestosTranslados) {
								$tipoImpuesto = trim(mb_strtoupper($impuestosTranslados['Impuesto']));
								$tipoFactorImpuesto = trim(mb_strtoupper($impuestosTranslados['TipoFactor']));
								$tasaCuotaImpuesto = trim($impuestosTranslados['TasaOCuota']);
								$importeImpuesto = trim($impuestosTranslados['Importe']);
							}
						} else { 
							$tipoImpuesto = '';
							$tipoFactorImpuesto = '';
							$tasaCuotaImpuesto = '';
							$importeImpuesto  = '';
						}


						foreach ($xml -> xpath('//t:TimbreFiscalDigital') as $timbreFiscal) {
							$FolioFiscal = trim($timbreFiscal['UUID']);
							$fechaTimbrado = trim($timbreFiscal['FechaTimbrado']);
							$fechaTimbr = date_format(date_create($fechaTimbrado),'d-m-Y');
							$horaTimbr = date_format(date_create($fechaTimbrado),'H:i:s');
							$RFCproveedor = trim(mb_strtoupper($timbreFiscal['RfcProvCertif']));
						}
					} // Termina VERSIÓN 3.3
					// Comprueba que los Datos Fiscales (Razón Social y Rfc del Emisor) no sean iguales a los registrados en la intranet como empresa por default.
					$Conexion = new dataBaseConn();
					$query = $Conexion -> prepare("SELECT id_dfiscales_e FROM datos_fiscales_empresa WHERE razon_social_e = :nomEpresa AND rfc_e = :rfcEmpresa;");
					$query -> bindParam(':nomEpresa', $nombreEmisor);
					$query -> bindParam(':rfcEmpresa', $rfcEmisor);
					$query -> execute();
					$rows = $query -> rowCount();
					if ($rows != 0) {
						$this -> msjErr = "Razón Social y Rfc Emisor igual a datos fiscales de la empresa.";
						$band = 1;
					}
				}else{
					$band = 1;
					$this -> msjErr = "El archivo '".$nombreArchivo."', no cumple con el formato requerido.";
					// Borrar el archivo cargado, si no cumple con el formato requerido
					unlink($ruta);
				}
			}

			if ($band == 0) {
				$this -> datosEgresosXML = array(
								'versionE'=>$versionComprobante,
								'serieE'=>$NumSerie,
								'folioE'=>$NumFolio,
								'fechaE'=>$Fecha,
								'horaE'=>$Hora,
								'descuentoE'=>$descuentoComprobante,
								'subtotalE'=>$SubTotal,
								'condicionPagoE'=>$condicionPago,
								'formaPagoE'=>$formaDePago,
								'monedaE'=>$moneda,
								'totalE'=>$Total,
								'tipoComprobanteE'=>$tipoComprob,
								'metodoPagoE'=>$MetodoPago,
								'lugarExpE'=>$LugarExpedicion,
								'selloE'=>$selloComprobante,
								'rfcEmisorE'=>$rfcEmisor,
								'nombreEmisorE'=>$nombreEmisor,
								'regimenFiscalE'=>$regimenFiscal,
									'dirPaisE'=>$paisDFE,
									'dirEstadoE'=>$estadoDFE,
									'dirMunicipioE'=>$municipioDFE,
									'dirColoniaE'=>$coloniaDFE,
									'dirNExtE'=>$numExtDFE,
									'dirNIntE'=>$numIntDFE,
									'dirCalleE'=>$calleDFE,
									'dirCodPostE'=>$codPosDFE,
							  	'rfcReceptorE'=>$rfcReceptor,
							  	'nombreReceptorE'=>$nombreReceptor,
							  	'usoCfdiReceptorE'=>$usoCfdiReceptor,
								'conceptosComprobanteE'=>$conceptosComprobante,
								'impuestosConceptosComprobanteE'=>$impuestosConceptosComprobante,
							  	'tipoImpuestoE'=>$tipoImpuesto,
							  	'totalImpuestosE'=>$totalDeImpuestos,
							  	'tipoFactorImpuestoE'=>$tipoFactorImpuesto,
							  	'tasaCuotaImpuestoE'=>$tasaCuotaImpuesto,
							  	'importeImpuestoE'=>$importeImpuesto,
								'folioFiscalE'=>$FolioFiscal,
								'fechaTimbradoE'=>$fechaTimbr,
								'horaTimbradoE'=>$horaTimbr,
								'rfcProvE'=>$RFCproveedor
								);
				$this -> msjOk = "Los datos se cargaron exitosamente en el formulario de registro.";
			}

			// Si se ejecuta la consulta, se obtiene un nuevo nombre y se guardan los datos.

			// 	if($ejecutarConsulta){
			// 		// $dir = explode("/", $ruta);
			// 		// $dir1 = $dir[0]."/";
			// 		// $nuevoNombreArchivo = $dir1.$NumSerie."_".$NumFolio."_".$rfcEmisor.".xml";
			// 		// $nuevoNombre = $NumSerie."_".$NumFolio."_".$rfcEmisor.".xml";
			// 		// rename($ruta, $nuevoNombreArchivo);
			// 		$this -> msjOk = "Los datos del archivo: ".$nombreArchivo." se han guardado correctamente.";
			// 	}
		} // Fin extraer datos del archivo XML.
		// Obtener RFC Proveedores.
		public function obtenerRFCProveedores($rfcEmisor) {
			$Conexion = new dataBaseConn();
			$queryRFCPr = $Conexion -> prepare("SELECT rfc_prov FROM proveedores_datos_fiscales WHERE rfc_prov = :emisorRFC;");
			$queryRFCPr -> bindParam(':emisorRFC', $rfcEmisor);
			$queryRFCPr -> execute();
			$rowsRFCPr = $queryRFCPr -> rowCount();
			if ($rowsRFCPr != 0) {
				$this -> msjErr = "Proveedor con el RFC: ".$rfcEmisor." guardado anteriormente.";
			}
		} // Fin obtener RFC Proveedores.

		// Obtener Modelo
		public function obtenerModelo($modelo) {
			$Conexion = new dataBaseConn();
			$sql = $Conexion -> prepare("SELECT modelo FROM productos WHERE modelo = :modeloConcepto;");
			$sql -> bindParam(':modeloConcepto', $modelo);
			$sql -> execute();
			$rows = $sql -> rowCount();
			if ($rows != 0) {
				$this -> msjErr = "Modelo: ".$modelo." ya ha sido guardado anteriormente.";
			}
		} // Fin obtener Modelo


		// Buscar Rfc de Proveedor.
		public function buscarRfcProveedor($rfcEmisor) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare("SELECT rfc_prov FROM proveedores_datos_fiscales WHERE rfc_prov = :proveedorRFC;");
			$query -> bindParam(':proveedorRFC', $rfcEmisor);
			$query -> execute();
			$rows = $query -> rowCount();
			if ($rows != 0) {
				$existencia = "existe";
			} else {
				$existencia = "no existe";
			}
			return $existencia;
		} // Fin Buscar Rfc de Proveedor.
		// Detalle de Egresos.
		public function detalleEgresos($idEgreso) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare("SELECT
											eg.idegresos,
											eg.efecto_comprobante,
											eg.tipo_comprobante,
											eg.version_comprobante,
											eg.lugar_expedicion,
											eg.fecha,
											eg.rfc_emisor,
											eg.razon_social_emisor,
											eg.regimen_fiscal,
											eg.rfc_receptor,
											eg.razon_social_receptor,
											edir.ed_pais,
											edir.ed_estado,
											edir.ed_municipio,
											edir.ed_colonia,
											edir.ed_no_ext,
											edir.ed_no_int,
											edir.ed_calle,
											edir.ed_cod_post,
											eg.uso_cfdi,
											eg.serie,
											eg.no_folio,
											eg.descuento,
											eg.subtotal,
											eg.iva,
											eg.total,
											eg.moneda_comprobante,
											eg.metodo_pago,
											eg.condiciones_pago,
											eg.forma_pago,
											eg.fecha_pago,
											eg.nombre_impuesto,
											eg.total_impuesto,
											eg.tipo_factor_impuesto,
											eg.tasa_cuota_impuesto,
											eg.no_cuenta,
											eg.concepto,
											eg.clasificacion,
											eg.estado,
											eg.origen,
											eg.destino,
											eg.estado_comprobante,
											eg.fecha_cancelacion,
											eg.folio_fiscal,
											eg.fecha_timbrado,
											eg.sello_comprobante,
											eg.rfc_proveedor
										   FROM
											 egresos eg
											 LEFT JOIN egresos_direcciones edir ON eg.idegresos = edir.id_egresos
										   WHERE eg.idegresos = :IDegreso;");
			$query -> bindParam(':IDegreso', $idEgreso);
			$query -> execute();
			$detEgr = $query -> fetch();
			return $detEgr;
		} // Fin detalle de Egresos.
		//Conceptos Detalle Egresos.
		public function conceptosDetalleEgresos($idEgreso) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare("SELECT
											egcon.id_egresos_conceptos,
											egcon.clave_concepto_e,
											egcon.cantidad_concepto_e,
											egcon.clave_unidad_concepto_e,
											egcon.unidad_concepto_e,
											egcon.descripcion_concepto_e,
                                            egcon.modelo_concepto_e,
											egcon.valor_unitario_concepto_e,
											egcon.importe_concepto_e,
											egcon.base_impuesto_concepto_e,
											egcon.impuesto_concepto_e,
											egcon.tipofactor_impuesto_concepto_e,
											egcon.tasacuota_impuesto_concepto_e,
											egcon.importe_impuesto_concepto_e,
											egcon.agregar_inv
										   FROM
										 	   egresos_conceptos egcon
											    LEFT JOIN egresos eg ON eg.idegresos = egcon.id_egresos
										   WHERE egcon.id_egresos = :IDegreso;");
			$query -> bindParam(':IDegreso', $idEgreso);
			$query -> execute();
			$conceptosEgresos = $query -> fetchAll(PDO::FETCH_ASSOC);
			return $conceptosEgresos;
		} // Fin conceptos detalle egresos.
		// Busca la forma de pago del egreso.
		public function statusPagoEgreso($idEgreso) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT id_egresos FROM egresos_pagos_parciales WHERE id_egresos = :IDegr GROUP BY id_egresos;');
			$query -> bindParam(':IDegr', $idEgreso);
			$query -> execute();
			$rows = $query -> rowCount();
			if ($rows != 0) {
				$statusPe = 'parcial';
			} else {
				$query2 = $Conexion -> prepare('SELECT id_egreso FROM egresos_pagos_completos WHERE id_egreso = :IDegr;');
				$query2 -> bindParam(':IDegr', $idEgreso);
				$query2 -> execute();
				$rows = $query2 -> rowCount();
				if ($rows != 0) {
					$statusPe = 'completo';
				} else {
					$statusPe = 'sin pago';
				}
			}
			return $statusPe;
		} // Fin función statusPagoEgreso.
		// Pagos parcial del egreso.
		public function pagosParciales($idEgreso) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT epp.fecha_pago,
												  s.descripcion_s,
												  s.cargos_s
											FROM egresos_pagos_parciales epp
											 INNER JOIN saldos s
											  ON s.id_saldo = epp.id_saldo
											WHERE epp.id_egresos = :IDegr;');
			$query -> bindParam(':IDegr', $idEgreso);
			$query -> execute();
			$pagosPar = $query -> fetchAll();
			return $pagosPar;
		} // Fin función pagosParciales.
		// Obtiene el Id del Saldo en los pagos completos del egreso.
		public function obtenerIdSaldo($idEgreso) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT epc.id_saldo FROM egresos_pagos_completos epc WHERE epc.id_egreso = :IDegr;');
			$query -> bindParam(':IDegr', $idEgreso);
			$query -> execute();
			$idSaldo = $query -> fetch(PDO::FETCH_ASSOC);
			$idSaldo = $idSaldo['id_saldo'];
			return $idSaldo;
		} // Fin función obtenerIdSaldo.
		// Otiene el precio total del cargo en Saldos.
		public function precioCargoSaldo($idSaldo) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT cargos_s FROM saldos WHERE id_saldo = :IDsal;');
			$query -> bindParam(':IDsal', $idSaldo);
			$query -> execute();
			$pCargoSa = $query -> fetch(PDO::FETCH_ASSOC);
			$pCargoSa = $pCargoSa['cargos_s'];
			return $pCargoSa;
		} // Fin función precioCargoSaldo.
		// Pagos completos del egreso.
		public function pagosCompletos($idEgreso) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT s.fecha_s,
												  s.descripcion_s,
												  epc.precio_acumulado
										   FROM saldos s
											   INNER JOIN egresos_pagos_completos epc ON s.id_saldo = epc.id_saldo
										   WHERE epc.id_egreso = :IDegr;');
			$query -> bindParam(':IDegr', $idEgreso);
			$query -> execute();
			$pagosCom = $query -> fetchAll();
			return $pagosCom;
		} // Fin función pagosCompletos.
		#INICIO de Funciones para Obtener de la BD Información que llena las Listas Desplegables.
			// Conceptos
			public function listaConceptos() {
				$Conexion = new dataBaseConn();
				$queryConcp = $Conexion -> prepare("SELECT nom_concepto
												   FROM conceptos_comprobantes
												   ORDER BY nom_concepto;");
				$queryConcp -> execute();
				$conceptos = $queryConcp -> fetchAll();
				return $conceptos;
			}
			// Clasificaciones
			public function listaClasificaciones() {
				$Conexion = new dataBaseConn();
				$queryClasif = $Conexion -> prepare("SELECT nom_clasifi
												    FROM clasificacion_comprobantes
												    ORDER BY nom_clasifi;");
				$queryClasif -> execute();
				$clasificaciones = $queryClasif -> fetchAll();
				return $clasificaciones;
			}
			// Status
			public function listaStatus() {
				$Conexion = new dataBaseConn();
				$queryStat = $Conexion -> prepare("SELECT nom_status
												  FROM status_comprobantes
												  ORDER BY nom_status;");
				$queryStat -> execute();
				$status = $queryStat -> fetchAll();
				return $status;
			}
			// Origenes
			public function listaOrigenes() {
				$Conexion = new dataBaseConn();
				$queryOrig = $Conexion -> prepare("SELECT nom_origen
												  FROM origenes_comprobantes
												  ORDER BY nom_origen;");
				$queryOrig -> execute();
				$origenes = $queryOrig -> fetchAll();
				return $origenes;
			}
			// Destinos
			public function listaDestinos() {
				$Conexion = new dataBaseConn();
				$queryDest = $Conexion -> prepare("SELECT nom_destino
												  FROM destinos_comprobantes
												  ORDER BY nom_destino;");
				$queryDest -> execute();
				$destinos = $queryDest -> fetchAll();
				return $destinos;
			}
		#FIN de Funciones para Obtener de la BD Información que llena las Listas Desplegables.

		#INICIO de Funciones para Obtener de la BD Información que llena las Listas Desplegables...
			#...datos diferentes al seleccionado(Se utilizan para la modificación de Egresos).
			// Conceptos Diferentes
			public function listaConceptosDiff($nomConcepto) {
				$Conexion = new dataBaseConn();
				$queryConcp = $Conexion -> prepare("SELECT nom_concepto
												   FROM conceptos_comprobantes
												   WHERE nom_concepto != :NOMconcept
												   ORDER BY nom_concepto;");
				$queryConcp -> bindParam(':NOMconcept', $nomConcepto);
				$queryConcp -> execute();
				$conceptos = $queryConcp -> fetchAll();
				return $conceptos;
			}
			// Clasificaciones Diferentes
			public function listaClasificacionesDiff($nomClasificacion) {
				$Conexion = new dataBaseConn();
				$queryClasif = $Conexion -> prepare("SELECT nom_clasifi
												    FROM clasificacion_comprobantes
												    WHERE nom_clasifi != :NOMclasifica
												    ORDER BY nom_clasifi;");
				$queryClasif -> bindParam(':NOMclasifica', $nomClasificacion);
				$queryClasif -> execute();
				$clasificaciones = $queryClasif -> fetchAll();
				return $clasificaciones;
			}
			// Status Diferentes
			public function listaStatusDiff($nomStatus) {
				$Conexion = new dataBaseConn();
				$queryStat = $Conexion -> prepare("SELECT nom_status
												  FROM status_comprobantes
												  WHERE nom_status != :NOMstat
												  ORDER BY nom_status;");
				$queryStat -> bindParam(':NOMstat', $nomStatus);
				$queryStat -> execute();
				$status = $queryStat -> fetchAll();
				return $status;
			}
			// Origenes Diferentes
			public function listaOrigenesDiff($nomOrigen) {
				$Conexion = new dataBaseConn();
				$queryOrig = $Conexion -> prepare("SELECT nom_origen
												  FROM origenes_comprobantes
												  WHERE nom_origen != :NOMorig
												  ORDER BY nom_origen;");
				$queryOrig -> bindParam(':NOMorig', $nomOrigen);
				$queryOrig -> execute();
				$origenes = $queryOrig -> fetchAll();
				return $origenes;
			}
			// Destinos Diferentes
			public function listaDestinosDiff($nomDestino) {
				$Conexion = new dataBaseConn();
				$queryDest = $Conexion -> prepare("SELECT nom_destino
												  FROM destinos_comprobantes
												  WHERE nom_destino != :NOMdest
												  ORDER BY nom_destino;");
				$queryDest -> bindParam(':NOMdest', $nomDestino);
				$queryDest -> execute();
				$destinos = $queryDest -> fetchAll();
				return $destinos;
			}
		#FIN de Funciones para Obtener de la BD Información que llena las Listas Desplegables...
			#...datos diferentes al seleccionado(Se utilizan para la modificación de Egresos).

		// -*-*-*Registrar Egresos.-*-*-*
		public function registrarEgresos($EfectoComprobante, $VersionComprobante, $TipoComprobante, $LugarExpedicionComprobante, $Fecha, $Hora, $rfcEmisor, $nombreEmisor, $nomProv, $guardarProv, $paisEmisor, $estadoEmisor, $municipioEmisor, $coloniaEmisor, $numExtEmisor, $numIntEmisor, $calleEmisor, $cpEmisor, $rfcReceptor, $nombreReceptor, $usoCFDIComprobante, $NumSerie, $NumFolio, $ConceptosComprobante, $DatosProducto, $Descuento, $SubTotal, $IVA, $Total, $MonedaComprobante, $MetodoPago, $CondicionesPagoComprobante, $FormaPagoComprobante, $FechaHoraPago, $NombreImpuesto, $TotalImpuesto, $TipoFactorImpuesto, $TasaImpuesto, $NumCuenta, $Concepto, $Clasificacion, $Estado, $Origen, $Destino, $EstadoComprobante, $FechaHoraCancel, $RegimenFiscalEmisor, $FolioFiscal, $FechaTimbrado, $HoraTimbrado, $SelloComprobante, $rfcProveedor) {
			$Conexion = new dataBaseConn();
			$band = 0;
			if ($EfectoComprobante != "" && $VersionComprobante != "" && $TipoComprobante != "" && $LugarExpedicionComprobante != "" && $Fecha != "" && $EfectoComprobante != "" && $Hora != "" && $rfcEmisor != "" && $nombreEmisor != "" && $rfcReceptor != "" && $nombreReceptor != "" && $NumSerie !== "" && $NumFolio !== "" && $SubTotal != "" && $IVA !== "" && $Total != "" && $MonedaComprobante != "" && $MetodoPago !== "" && $FormaPagoComprobante !== "" && $NombreImpuesto !== "" && $TotalImpuesto !== "" && $TasaImpuesto !== "" && $FolioFiscal != "" && $FechaTimbrado != "" && $HoraTimbrado != "" && $SelloComprobante != "") {
					// Fecha del Comprobante.
					$Fecha = date_format(date_create($Fecha), 'Y-m-d');
					$FechaEgreso = $Fecha." ".$Hora;
					// Fecha Timbrado del Comprobante.
					$FechaTimbrado = date_format(date_create($FechaTimbrado), 'Y-m-d');
					$fechaTimbradoComprobante = $FechaTimbrado." ".$HoraTimbrado;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}

			if ($band == 0) {
				if ($guardarProv == 'Si') {
					$queryRFCPr = $Conexion -> prepare("SELECT rfc_prov FROM proveedores_datos_fiscales WHERE rfc_prov = :rfcE;");
					$queryRFCPr -> bindParam(':rfcE', $rfcEmisor);
					$queryRFCPr -> execute();
					$rowsRFCPr = $queryRFCPr -> rowCount();
					if ($rowsRFCPr != 0) {
						$this -> msjErr = "Proveedor con el RFC: ".$rfcEmisor." guardado anteriormente.";
						$band = 1;
					}
				}
				$query = $Conexion -> prepare("SELECT folio_fiscal
											  FROM egresos
											  WHERE folio_fiscal = :folFiscal;");
				$query -> bindParam(':folFiscal', $FolioFiscal);
				$query -> execute();
				$rows = $query -> rowCount();
				if($rows != 0){
					$this -> msjErr = "Ya se encuentra guardado el registro con el folio fiscal: <br>".$FolioFiscal.".";
					$band = 1;
				}
			}

			if($band == 0){
				$EfectoComprobante = trim(mb_strtoupper($EfectoComprobante));
				$VersionComprobante = trim(mb_strtoupper($VersionComprobante));
				$TipoComprobante = trim(mb_strtoupper($TipoComprobante));
				$LugarExpedicionComprobante = trim(mb_strtoupper($LugarExpedicionComprobante));
				$FechaEgreso = trim($FechaEgreso);
				$rfcEmisor = trim(mb_strtoupper($rfcEmisor));
				$nombreEmisor = trim(mb_strtoupper($nombreEmisor));
				$paisEmisor = trim(mb_strtoupper($paisEmisor));
				$estadoEmisor = trim(mb_strtoupper($estadoEmisor));
				$municipioEmisor = trim(mb_strtoupper($municipioEmisor));
				$coloniaEmisor = trim(mb_strtoupper($coloniaEmisor));
				$numExtEmisor = trim($numExtEmisor);
				$numIntEmisor = trim($numIntEmisor);
				$calleEmisor = trim(mb_strtoupper($calleEmisor));
				$cpEmisor = trim($cpEmisor);
				$rfcReceptor = trim(mb_strtoupper($rfcReceptor));
				$nombreReceptor = trim(mb_strtoupper($nombreReceptor));
				$usoCFDIComprobante = trim(mb_strtoupper($usoCFDIComprobante));
				$NumSerie = trim(mb_strtoupper($NumSerie));
				$NumFolio = trim($NumFolio);
				$Descuento = trim($Descuento);
				$SubTotal = trim($SubTotal);
				$SubTotal = str_replace(',', '', $SubTotal);
				$IVA = trim($IVA);
				$IVA = str_replace(',', '', $IVA);
				$Total = trim($Total);
				$Total = str_replace(',', '', $Total);
				$MonedaComprobante = trim(mb_strtoupper($MonedaComprobante));
				$MetodoPago = trim(mb_strtoupper($MetodoPago));
				$CondicionesPagoComprobante = trim(mb_strtoupper($CondicionesPagoComprobante));
				$FormaPagoComprobante = trim(mb_strtoupper($FormaPagoComprobante));
				$FechaHoraPago = trim($FechaHoraPago);
				$NombreImpuesto = trim(mb_strtoupper($NombreImpuesto));
				$TotalImpuesto = trim($TotalImpuesto);
				$TotalImpuesto = str_replace(',', '', $TotalImpuesto);
				$TipoFactorImpuesto = trim(mb_strtoupper($TipoFactorImpuesto));
				$TasaImpuesto = trim($TasaImpuesto);
				$NumCuenta = trim($NumCuenta);
				$Concepto = trim($Concepto);
				$Clasificacion = trim($Clasificacion);
				$Estado = trim($Estado);
				$Origen = trim($Origen);
				$Destino = trim($Destino);
				$EstadoComprobante = trim(mb_strtoupper($EstadoComprobante));
				$FechaHoraCancel = trim($FechaHoraCancel);
				$RegimenFiscalEmisor = trim($RegimenFiscalEmisor);
				$FolioFiscal = trim($FolioFiscal);
				$fechaTimbradoComprobante = trim($fechaTimbradoComprobante);
				$SelloComprobante = trim($SelloComprobante);
				$rfcProveedor = trim(mb_strtoupper($rfcProveedor));

				if ($numExtEmisor == "") {
					$numExtEmisor = 'SN';
				}

				if ($cpEmisor == "") {
					$cpEmisor = '00000';
				}

				if ($Descuento == "") {
					$Descuento = 0;
				}

				if($FechaHoraPago == "" && $FechaHoraCancel == ""){
					$fechaYhoraPago = NULL;
					$fechaYhoraCancel = NULL;
				}elseif($FechaHoraPago != "" && $FechaHoraCancel == "") {
					$fechaYhoraPago = date_format(date_create($FechaHoraPago),'Y-m-d');
					$fechaYhoraCancel = NULL;
				}elseif($FechaHoraPago == "" && $FechaHoraCancel != ""){
					$fechaYhoraPago = NULL;
					$fechaYhoraCancel = date_format(date_create($FechaHoraCancel),'Y-m-d');
				}else{
					$fechaYhoraPago = date_format(date_create($FechaHoraPago),'Y-m-d');
					$fechaYhoraCancel = date_format(date_create($FechaHoraCancel),'Y-m-d');
				}
				// Incremento del Id egresos.
				$queryIdEgre = $Conexion -> prepare("SELECT idegresos FROM egresos ORDER BY idegresos DESC LIMIT 1;");
				$queryIdEgre -> execute();
				$rowsIdEgre = $queryIdEgre -> rowCount();
				if ($rowsIdEgre == 0) {
					$idEgreso = 1;
				}else{
					$resultIdEgre = $queryIdEgre -> fetch(PDO::FETCH_ASSOC);
					$idEgreso = ($resultIdEgre['idegresos'] + 1);
				}
				// Registrar datos generales del egreso.
				$consultaRegEgr = $Conexion -> prepare('INSERT INTO egresos (
								 								  	idegresos,
								 								  	efecto_comprobante,
									 								tipo_comprobante,
									 								version_comprobante,
									 								lugar_expedicion,
									 								fecha,
									 								rfc_emisor,
									 								razon_social_emisor,
									 								regimen_fiscal,
									 								rfc_receptor,
									 								razon_social_receptor,
									 								uso_cfdi,
									 								serie,
									 								no_folio,
									 								descuento,
									 								subtotal,
									 								iva,
									 								total,
									 								moneda_comprobante,
									 								metodo_pago,
									 								condiciones_pago,
									 								forma_pago,
									 								fecha_pago,
									 								nombre_impuesto,
									 								total_impuesto,
									 								tipo_factor_impuesto,
									 								tasa_cuota_impuesto,
									 								no_cuenta,
									 								concepto,
									 								clasificacion,
									 								estado,
									 								origen,
									 								destino,
									 								estado_comprobante,
									 								fecha_cancelacion,
									 								folio_fiscal,
									 								fecha_timbrado,
									 								sello_comprobante,
									 								rfc_proveedor,
									 								guardar_prov,
																	status_factura,
																	inventariar
								 						 		)
						 								VALUES (
																:IDegreso,
																:efectoCompE,
																:tipoCompE,
																:versionComp,
																:lugarExpedComp,
																:fechaEgreso,
																:rfcEmisorEgr,
																:nomEmisorEgr,
																:regFiscalE,
																:rfcReceptorEgr,
																:nomReceptorEgr,
																:usoCFDI,
																:nSerie,
																:nFolio,
																:descuentoComp,
																:subtotalE,
																:ivaE,
																:totalE,
																:monedaComp,
																:mPagoE,
																:condiPagoE,
																:formaPagoE,
																:fechaHpago,
																:impuestoE,
																:totalImpE,
																:tFactorImpE,
																:tasaImpE,
																:nCuentaE,
																:conceptoEgr,
																:clasificacionEgr,
																:estadoEgr,
																:origenEgr,
																:destinoEgr,
																:estadoCompEgr,
																:fechaCancelado,
																:folFiscalE,
																:fechaTimbE,
																:selloComp,
																:rfcProv,
																:regProv,
																:statusFac,
																:inventariarE
							 								);');
				$consultaRegEgr -> bindParam(':IDegreso', $idEgreso);
				$consultaRegEgr -> bindParam(':efectoCompE', $EfectoComprobante);
				$consultaRegEgr -> bindParam(':tipoCompE', $TipoComprobante);
				$consultaRegEgr -> bindParam(':versionComp', $VersionComprobante);
				$consultaRegEgr -> bindParam(':lugarExpedComp', $LugarExpedicionComprobante);
				$consultaRegEgr -> bindParam(':fechaEgreso', $FechaEgreso);
				$consultaRegEgr -> bindParam(':rfcEmisorEgr', $rfcEmisor);
				$consultaRegEgr -> bindParam(':nomEmisorEgr', $nombreEmisor);
				$consultaRegEgr -> bindParam(':regFiscalE', $RegimenFiscalEmisor);
				$consultaRegEgr -> bindParam(':rfcReceptorEgr', $rfcReceptor);
				$consultaRegEgr -> bindParam(':nomReceptorEgr', $nombreReceptor);
				$consultaRegEgr -> bindParam(':usoCFDI', $usoCFDIComprobante);
				$consultaRegEgr -> bindParam(':nSerie', $NumSerie);
				$consultaRegEgr -> bindParam(':nFolio', $NumFolio);
				$consultaRegEgr -> bindParam(':descuentoComp', $Descuento);
				$consultaRegEgr -> bindParam(':subtotalE', $SubTotal);
				$consultaRegEgr -> bindParam(':ivaE', $IVA);
				$consultaRegEgr -> bindParam(':totalE', $Total);
				$consultaRegEgr -> bindParam(':monedaComp', $MonedaComprobante);
				$consultaRegEgr -> bindParam(':mPagoE', $MetodoPago);
				$consultaRegEgr -> bindParam(':condiPagoE', $CondicionesPagoComprobante);
				$consultaRegEgr -> bindParam(':formaPagoE', $FormaPagoComprobante);
				$consultaRegEgr -> bindParam(':fechaHpago', $fechaYhoraPago);
				$consultaRegEgr -> bindParam(':impuestoE', $NombreImpuesto);
				$consultaRegEgr -> bindParam(':totalImpE', $TotalImpuesto);
				$consultaRegEgr -> bindParam(':tFactorImpE', $TipoFactorImpuesto);
				$consultaRegEgr -> bindParam(':tasaImpE', $TasaImpuesto);
				$consultaRegEgr -> bindParam(':nCuentaE', $NumCuenta);
				$consultaRegEgr -> bindParam(':conceptoEgr', $Concepto);
				$consultaRegEgr -> bindParam(':clasificacionEgr', $Clasificacion);
				$consultaRegEgr -> bindParam(':estadoEgr', $Estado);
				$consultaRegEgr -> bindParam(':origenEgr', $Origen);
				$consultaRegEgr -> bindParam(':destinoEgr', $Destino);
				$consultaRegEgr -> bindParam(':estadoCompEgr', $EstadoComprobante);
				$consultaRegEgr -> bindParam(':fechaCancelado', $fechaYhoraCancel);
				$consultaRegEgr -> bindParam(':folFiscalE', $FolioFiscal);
				$consultaRegEgr -> bindParam(':fechaTimbE', $fechaTimbradoComprobante);
				$consultaRegEgr -> bindParam(':selloComp', $SelloComprobante);
				$consultaRegEgr -> bindParam(':rfcProv', $rfcProveedor);
				$consultaRegEgr -> bindParam(':regProv', $guardarProv);
				$facturaStatus = 'Sin capturar';
				$consultaRegEgr -> bindParam(':statusFac', $facturaStatus);
				$inventariaEg = 'No';
				$consultaRegEgr -> bindParam(':inventariarE', $inventariaEg);
				$resultRegEgre = $consultaRegEgr -> execute();
				// Registrar Conceptos de los egresos.
				foreach ($ConceptosComprobante as $conceptosComp) {
					if ($conceptosComp['baseImpuestoC'] == "") {
						$conceptosComp['baseImpuestoC'] = 0;
					}
					if ($conceptosComp['tasaCuotaImpuestoC'] == "") {
						$conceptosComp['tasaCuotaImpuestoC'] = 0;
					}
					if ($conceptosComp['importeImpuestoC'] == "") {
						$conceptosComp['importeImpuestoC'] = 0;
					}
					$query = $Conexion -> prepare("INSERT INTO egresos_conceptos (
																clave_concepto_e,
																cantidad_concepto_e,
																clave_unidad_concepto_e,
																unidad_concepto_e,
																descripcion_concepto_e,
																modelo_concepto_e,
																valor_unitario_concepto_e,
																importe_concepto_e,
																base_impuesto_concepto_e,
																impuesto_concepto_e,
																tipofactor_impuesto_concepto_e,
																tasacuota_impuesto_concepto_e,
																importe_impuesto_concepto_e,
																id_egresos,
																inventariado,
																agregar_inv
															)
													VALUES (
																:clavConcepto,
																:cantConcepto,
																:clavUnidConcepto,
																:unidConcepto,
																:descripConcepto,
																:modeloConcepto,
																:valUnitConcepto,
																:importConcepto,
																:baseImpConcepto,
																:impConcepto,
																:tipFactImpConc,
																:tasaCuotaImpConc,
																:importImpConc,
																:IDegr,
																:Inventariado,
																:AddConInv
															);");
					$query -> bindParam(':clavConcepto', trim($conceptosComp['claveC']));
					$query -> bindParam(':cantConcepto', trim($conceptosComp['cantidadC']));
					$query -> bindParam(':clavUnidConcepto', trim($conceptosComp['claveUnidadC']));
					$query -> bindParam(':unidConcepto', trim($conceptosComp['unidadC']));
					$query -> bindParam(':descripConcepto', trim(mb_strtoupper($conceptosComp['descripcionC'])));
					$query -> bindParam(':modeloConcepto', trim($conceptosComp['modeloC']));
					$query -> bindParam(':valUnitConcepto', trim($conceptosComp['valorUnitarioC']));
					$query -> bindParam(':importConcepto', trim($conceptosComp['importeC']));
					$query -> bindParam(':baseImpConcepto', trim($conceptosComp['baseImpuestoC']));
					$query -> bindParam(':impConcepto', trim($conceptosComp['impuestoC']));
					$query -> bindParam(':tipFactImpConc', trim($conceptosComp['tipoFactorImpuestoC']));
					$query -> bindParam(':tasaCuotaImpConc', trim($conceptosComp['tasaCuotaImpuestoC']));
					$query -> bindParam(':importImpConc', trim($conceptosComp['importeImpuestoC']));
					$query -> bindParam(':IDegr', $idEgreso);
					$inventariado = 'No';
					$query -> bindParam(':Inventariado', $inventariado);

					$addConInv = $conceptosComp['agregarInve'];
					$query -> bindParam(':AddConInv', $addConInv);
					$resultQuery = $query -> execute();
                    
				}

				if($DatosProducto) {
					foreach($DatosProducto as $datoProd) {
						$query = "INSERT INTO productos (id_categoria,
														id_subcategoria,
														id_division,
														id_nombre,
														id_tipo,
														id_marca,
														modelo,
														precio,
														id_moneda,
														id_unidad,
														descripcion,
														exit_inventario,
														descontinuado)
								VALUES (:IDcategoria,:IDsubcategoria,:IDdivision,:IDnombre,:IDtipo,
														:IDmarca,:Modelo,:Precio,:Moneda,:IDunidad,:Descripcion,:Exist,:Descon)";
						$sql = $Conexion->prepare($query);
						$existencias = '0';
						$descontinuado = 'No';
						$borrar = 1;
						$sql->bindParam(':IDcategoria',$datoProd['cat']);
						$sql->bindParam(':IDsubcategoria',$datoProd['sub']);
						$sql->bindParam(':IDdivision',$datoProd['div']);
						$sql->bindParam(':IDnombre',$datoProd['nom']);
						$sql->bindParam(':IDtipo',$datoProd['tip']);
						$sql->bindParam(':IDmarca',$datoProd['mar']);
						$sql->bindParam(':Modelo',$datoProd['mod']);
						$sql->bindParam(':Precio',$datoProd['pre']);
						$sql->bindParam(':Moneda',$datoProd['mon']);
						$sql->bindParam(':IDunidad',$borrar);
						$sql->bindParam(':Descripcion',$datoProd['des']);
						$sql->bindParam(':Exist',$existencias);
						$sql->bindParam(':Descon',$descontinuado);
						$result = $sql->execute();
                        
                        // Insertar en tabla que relaciona conceptos con productos
                        $fila = $this->getFilaProd();
                        $id_producto = $fila[0];

                        $idEgCon = $this->getIdCon($datoProd['mod']);
                        $id_eg_con = $idEgCon['id_egresos_conceptos'];

                        //print "prod: ".$id_producto."\n";
                        //print "eg: ".$id_eg_con."\n";

                        $this->guardarRelEgProd($id_eg_con,$id_producto);
					}
                    
				}

				// Registrar dirección del Emisor, en caso de que exista.
				if ($paisEmisor != "" && $estadoEmisor != "" && $municipioEmisor != "" && $coloniaEmisor != "") {
					// Incremento de id egresos direcciones.
					$queryIdDirEgr = $Conexion -> prepare("SELECT id_e_direccion FROM egresos_direcciones ORDER BY id_e_direccion DESC LIMIT 1;");
					$queryIdDirEgr -> execute();
					$rowsIdDirEgr = $queryIdDirEgr -> rowCount();
					if ($rowsIdDirEgr == 0) {
						$idEgrDir = 1;
					}else{
						$resultIdDirEgr = $queryIdDirEgr -> fetch(PDO::FETCH_ASSOC);
						$idEgrDir = ($resultIdDirEgr['id_e_direccion'] + 1);
					}
					// Registrar egresos direcciones.
					$queryDirEgr = $Conexion -> prepare("INSERT INTO egresos_direcciones(
														  id_e_direccion,
														  ed_pais,
														  ed_estado,
														  ed_municipio,
														  ed_colonia,
														  ed_no_ext,
														  ed_no_int,
														  ed_calle,
														  ed_cod_post,
														  id_egresos)
											             VALUES(
											              :IDegresoDir,
											              :paisEmis,
											              :estadoEmis,
											              :municipioEmis,
											              :coloniaEmis,
											              :numExtEmis,
											              :numIntEmis,
											              :calleEmis,
											              :codigoPostEmis,
											              :IDegreso);");
					$queryDirEgr -> bindParam(':IDegresoDir', $idEgrDir);
					$queryDirEgr -> bindParam(':paisEmis', $paisEmisor);
					$queryDirEgr -> bindParam(':estadoEmis', $estadoEmisor);
					$queryDirEgr -> bindParam(':municipioEmis', $municipioEmisor);
					$queryDirEgr -> bindParam(':coloniaEmis', $coloniaEmisor);
					$queryDirEgr -> bindParam(':numExtEmis', $numExtEmisor);
					$queryDirEgr -> bindParam(':numIntEmis', $numIntEmisor);
					$queryDirEgr -> bindParam(':calleEmis', $calleEmisor);
					$queryDirEgr -> bindParam(':codigoPostEmis', $cpEmisor);
					$queryDirEgr -> bindParam(':IDegreso', $idEgreso);
					$resultDirEgr = $queryDirEgr -> execute();
				}
				// Guardar como proveedor.
				if ($guardarProv == 'Si') {
					// Incremento del Id proveedor.
					$queryIdProv = $Conexion -> prepare("SELECT id_proveedor FROM proveedores ORDER BY id_proveedor DESC LIMIT 1;");
					$queryIdProv -> execute();
					$rowsIdProv = $queryIdProv -> rowCount();
					if ($rowsIdProv == 0) {
						$idProveedor = 1;
					}else{
						$resultIdProv = $queryIdProv -> fetch(PDO::FETCH_ASSOC);
						$idProveedor = ($resultIdProv['id_proveedor'] + 1);
					}
					// Insertar proveedor.
					$queryProv = $Conexion -> prepare("INSERT INTO proveedores (
													  	id_proveedor,
													  	nom_proveedor,
													  	fecha_registro
													   )
													   VALUES (
													  	:IDprove,
													  	:NOMprove,
													  	NOW()
													   );");
					$queryProv -> bindParam(':IDprove', $idProveedor);
					$queryProv -> bindParam(':NOMprove', $nomProv);
					$resultProv = $queryProv -> execute();
					// Insertar Datos Fiscales Proveedor.
					if ($resultProv == TRUE) {
						$queryDatFisProv = $Conexion -> prepare("INSERT INTO proveedores_datos_fiscales (
																  razon_social_prov,
																  rfc_prov,
																  id_proveedor
																 )
													  			 VALUES (
													  			  :nomEmis,
													  			  :rfcEmis,
													  			  :IDprove
													  			 );");
						$queryDatFisProv -> bindParam(':nomEmis', $nombreEmisor);
						$queryDatFisProv -> bindParam(':rfcEmis', $rfcEmisor);
						$queryDatFisProv -> bindParam(':IDprove', $idProveedor);
						$queryDatFisProv -> execute();
					}
					// Incremento de Id direccion.
					$queryIdProvDir = $Conexion -> prepare("SELECT idprov_direccion FROM proveedores_direcciones ORDER BY idprov_direccion DESC LIMIT 1;");
					$queryIdProvDir -> execute();
					$rowsIdProvDir = $queryIdProvDir -> rowCount();
					if ($rowsIdProvDir == 0) {
						$idDireccionProv = 1;
					}else{
						$resultIdProvDir = $queryIdProvDir -> fetch(PDO::FETCH_ASSOC);
						$idDireccionProv = ($resultIdProvDir['idprov_direccion'] + 1);
					}
					// Insertar Dirección Proveedor.
					if ($paisEmisor != "" && $estadoEmisor != "" && $municipioEmisor != "" && $coloniaEmisor != "" && $numExtEmisor != "" && $calleEmisor != "" && $cpEmisor != "") {
						$queryDirProv = $Conexion -> prepare("INSERT INTO proveedores_direcciones (
															   idprov_direccion,
															   calle_p,
															   num_ext_p,
															   num_int_p,
															   colonia_p,
															   municipio_p,
															   estado_p,
															   pais_p,
															   cod_postal_p
														      )
												  		      VALUES (
												  		 	   :IDdirProv,
															   :calleEm,
															   :neEm,
															   :niEm,
															   :colEm,
															   :munEm,
															   :estEm,
															   :paisEm,
															   :cpEm
								  							  );");
						$queryDirProv -> bindParam(':IDdirProv', $idDireccionProv);
						$queryDirProv -> bindParam(':calleEm', $calleEmisor);
						$queryDirProv -> bindParam(':neEm', $numExtEmisor);
						$queryDirProv -> bindParam(':niEm', $numIntEmisor);
						$queryDirProv -> bindParam(':colEm', $coloniaEmisor);
						$queryDirProv -> bindParam(':munEm', $municipioEmisor);
						$queryDirProv -> bindParam(':estEm', $estadoEmisor);
						$queryDirProv -> bindParam(':paisEm', $paisEmisor);
						$queryDirProv -> bindParam(':cpEm', $cpEmisor);
						$resultDirProv = $queryDirProv -> execute();
						if ($resultDirProv == TRUE) {
							$queryDetProvDir = $Conexion -> prepare("INSERT INTO detalle_proveedores_direcciones (
																	  id_proveedor,
																	  idprov_direccion,
																	  tipo_direccion
																	 )
																	 VALUES (
																	  :IDprove,
																	  :IDdirProv,
																	  :tDireccion
																	 );");
							$tipoDireccion = "FISCAL Y FISICA";
							$queryDetProvDir -> bindParam(':IDprove', $idProveedor);
							$queryDetProvDir -> bindParam(':IDdirProv', $idDireccionProv);
							$queryDetProvDir -> bindParam(':tDireccion', $tipoDireccion);
							$queryDetProvDir -> execute();
						}
					} // Guardar como proveedor.
				}
				if($resultRegEgre == TRUE){
					return $resultRegEgre;
				}
			}
		} // -*-*-*Fin registrar egresos.-*-*-*

		// Eliminar Egreso.
		public function eliminarEgreso($idEgreso) {
			$Conexion = new dataBaseConn();
			$band = 0;

			if ($band === 0) {
				$query = $Conexion-> prepare("SELECT cpr.id_eg_con
											FROM egresos eg
											INNER JOIN egresos_conceptos econ ON eg.idegresos = econ.id_egresos
											INNER JOIN conceptos_productos cpr ON econ.id_egresos_conceptos = cpr.id_eg_con
											WHERE eg.idegresos = :egresoId");
				$query->bindParam(':egresoId', $idEgreso);
				$query->execute();
				$fila = $query->rowCount();
				
				if ($fila !== 0) {
					$this -> msjErr = "El egreso tiene productos guardados, por lo tanto no podrá eliminarse.";
					$band = 1;
				}
			}

			if($band == 0){
				$queryDelEgrCon = $Conexion -> prepare("DELETE FROM egresos_conceptos WHERE id_egresos = :egresoId;");
				$queryDelEgrCon -> bindParam(':egresoId', $idEgreso);
				$resultDelEgrCon = $queryDelEgrCon -> execute();

				$queryDelDirE = $Conexion -> prepare("DELETE FROM egresos_direcciones WHERE id_egresos = :egresoId;");
				$queryDelDirE -> bindParam(':egresoId', $idEgreso);
				$resultDelDirE = $queryDelDirE -> execute();

				$query = $Conexion -> prepare("DELETE FROM egresos
												WHERE idegresos = :egresoId;");
				$query -> bindParam(':egresoId', $idEgreso);
				$resultDelEgr = $query -> execute();

				if ($resultDelEgrCon && $resultDelDirE && $resultDelEgr) {
					$this -> msj = "Egreso eliminado exitosamente.";
					return $resultDelEgrCon & $resultDelDirE & $resultDelEgr;
				}
			}

		} // Fin eliminar egreso.
		// Datos de Egreso.
		public function datosEditarEgreso($idEgreso) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare("SELECT
										  	eg.idegresos,
											eg.efecto_comprobante,
											eg.tipo_comprobante,
											eg.version_comprobante,
											eg.lugar_expedicion,
											eg.fecha,
											eg.rfc_emisor,
											eg.razon_social_emisor,
											eg.guardar_prov,
											eg.regimen_fiscal,
											eg.rfc_receptor,
											eg.razon_social_receptor,
											edir.id_e_direccion,
											edir.ed_pais,
											edir.ed_estado,
											edir.ed_municipio,
											edir.ed_colonia,
											edir.ed_no_ext,
											edir.ed_no_int,
											edir.ed_calle,
											edir.ed_cod_post,
											eg.uso_cfdi,
											eg.serie,
											eg.no_folio,
											eg.descuento,
											eg.subtotal,
											eg.iva,
											eg.total,
											eg.moneda_comprobante,
											eg.metodo_pago,
											eg.condiciones_pago,
											eg.forma_pago,
											eg.fecha_pago,
											eg.nombre_impuesto,
											eg.total_impuesto,
											eg.tipo_factor_impuesto,
											eg.tasa_cuota_impuesto,
											eg.no_cuenta,
											eg.concepto,
											eg.clasificacion,
											eg.estado,
											eg.origen,
											eg.destino,
											eg.estado_comprobante,
											eg.fecha_cancelacion,
											eg.folio_fiscal,
											eg.fecha_timbrado,
											eg.sello_comprobante,
											eg.rfc_proveedor
										   FROM
											 egresos eg
											 LEFT JOIN egresos_direcciones edir ON eg.idegresos = edir.id_egresos
										   WHERE eg.idegresos = :IDegreso;");
			$query -> bindParam(':IDegreso', $idEgreso);
			$query -> execute();
			$datosEgreso = $query -> fetch();
			return $datosEgreso;
		} // Fin datos de egreso.
		// Modificar Egresos.
		public function modificarEgresos($idEgreso, $EfectoComprobante, $VersionComprobante, $TipoComprobante, $LugarExpedicionComprobante, $Fecha, $Hora, $rfcEmisor, $nombreEmisor, $nomProv, $guardarProv, $provGuardado, $idEgrDir, $paisEmisor, $estadoEmisor, $municipioEmisor, $coloniaEmisor, $numExtEmisor, $numIntEmisor, $calleEmisor, $cpEmisor, $rfcReceptor, $nombreReceptor, $usoCFDIComprobante, $NumSerie, $NumFolio, $ConceptosComprobante, $Descuento, $SubTotal, $IVA, $Total, $MonedaComprobante, $MetodoPago, $CondicionesPagoComprobante, $FormaPagoComprobante, $FechaHoraPago, $NombreImpuesto, $TotalImpuesto, $TipoFactorImpuesto, $TasaImpuesto, $NumCuenta, $Concepto, $Clasificacion, $Estado, $Origen, $Destino, $EstadoComprobante, $FechaHoraCancel, $RegimenFiscalEmisor, $FolioFiscal, $FechaTimbrado, $HoraTimbrado, $SelloComprobante, $rfcProveedor, $DatosProducto) {
			$Conexion = new dataBaseConn();
			$band = 0;
			if ($idEgreso != "" && $EfectoComprobante != "" && $VersionComprobante != "" && $TipoComprobante != "" && $LugarExpedicionComprobante != "" && $Fecha != "" && $EfectoComprobante != "" && $Hora != "" && $rfcEmisor != "" && $nombreEmisor != "" && $rfcReceptor != "" && $nombreReceptor != "" && $NumSerie != "" && $NumFolio != "" && $SubTotal != "" && $IVA != "" && $Total != "" && $MonedaComprobante != "" && $MetodoPago != "" && $FormaPagoComprobante != "" && $NombreImpuesto != "" && $TotalImpuesto != "" && $TasaImpuesto != "" && $FolioFiscal != "" && $FechaTimbrado != "" && $HoraTimbrado != "" && $SelloComprobante != "") {
					// Fecha del Comprobante.
					$Fecha = date_format(date_create($Fecha), 'Y-m-d');
					$FechaEgreso = $Fecha." ".$Hora;
					// Fecha Timbrado del Comprobante.
					$FechaTimbrado = date_format(date_create($FechaTimbrado), 'Y-m-d');
					$fechaTimbradoComprobante = $FechaTimbrado." ".$HoraTimbrado;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}

			if ($band == 0) {
				if ($guardarProv == 'Si' && $provGuardado != 'guardado') {
					$queryRFCPr = $Conexion -> prepare("SELECT rfc_prov FROM proveedores_datos_fiscales WHERE rfc_prov = :rfcE;");
					$queryRFCPr -> bindParam(':rfcE', $rfcEmisor);
					$queryRFCPr -> execute();
					$rowsRFCPr = $queryRFCPr -> rowCount();
					if ($rowsRFCPr != 0) {
						$this -> msjErr = "Proveedor con el RFC: ".$rfcEmisor." guardado anteriormente.";
						$band = 1;
					}
				}
				$query = $Conexion -> prepare("SELECT folio_fiscal
											  FROM egresos
											  WHERE folio_fiscal = :folFiscal AND idegresos != :IDegreso;");
				$query -> bindParam(':folFiscal', $FolioFiscal);
				$query -> bindParam(':IDegreso', $idEgreso);
				$query -> execute();
				$rows = $query -> rowCount();
				if($rows != 0){
					$this -> msjErr = "Ya se encuentra guardado el registro con el folio fiscal: ".$FolioFiscal.".";
					$band = 1;
				}
			}

			if($band == 0){
				// Efecto del Comprobante no se modifica.
				$VersionComprobante = trim(mb_strtoupper($VersionComprobante));
				$TipoComprobante = trim(mb_strtoupper($TipoComprobante));
				$LugarExpedicionComprobante = trim(mb_strtoupper($LugarExpedicionComprobante));
				$FechaEgreso = trim($FechaEgreso);
				$rfcEmisor = trim(mb_strtoupper($rfcEmisor));
				$nombreEmisor = trim(mb_strtoupper($nombreEmisor));
				$paisEmisor = trim(mb_strtoupper($paisEmisor));
				$estadoEmisor = trim(mb_strtoupper($estadoEmisor));
				$municipioEmisor = trim(mb_strtoupper($municipioEmisor));
				$coloniaEmisor = trim(mb_strtoupper($coloniaEmisor));
				$numExtEmisor = trim($numExtEmisor);
				$numIntEmisor = trim($numIntEmisor);
				$calleEmisor = trim(mb_strtoupper($calleEmisor));
				$cpEmisor = trim($cpEmisor);
				$rfcReceptor = trim(mb_strtoupper($rfcReceptor));
				$nombreReceptor = trim(mb_strtoupper($nombreReceptor));
				$usoCFDIComprobante = trim(mb_strtoupper($usoCFDIComprobante));
				$NumSerie = trim(mb_strtoupper($NumSerie));
				$NumFolio = trim($NumFolio);
				$Descuento = trim($Descuento);
				$SubTotal = trim($SubTotal);
				$SubTotal = str_replace(',', '', $SubTotal);
				$IVA = trim($IVA);
				$IVA = str_replace(',', '', $IVA);
				$Total = trim($Total);
				$Total = str_replace(',', '', $Total);
				$MonedaComprobante = trim(mb_strtoupper($MonedaComprobante));
				$MetodoPago = trim(mb_strtoupper($MetodoPago));
				$CondicionesPagoComprobante = trim(mb_strtoupper($CondicionesPagoComprobante));
				$FormaPagoComprobante = trim(mb_strtoupper($FormaPagoComprobante));
				$FechaHoraPago = trim($FechaHoraPago);
				$NombreImpuesto = trim(mb_strtoupper($NombreImpuesto));
				$TotalImpuesto = trim($TotalImpuesto);
				$TotalImpuesto = str_replace(',', '', $TotalImpuesto);
				$TipoFactorImpuesto = trim(mb_strtoupper($TipoFactorImpuesto));
				$TasaImpuesto = trim($TasaImpuesto);
				$NumCuenta = trim($NumCuenta);
				$Concepto = trim($Concepto);
				$Clasificacion = trim($Clasificacion);
				$Estado = trim($Estado);
				$Origen = trim($Origen);
				$Destino = trim($Destino);
				$EstadoComprobante = trim(mb_strtoupper($EstadoComprobante));
				$FechaHoraCancel = trim($FechaHoraCancel);
				$RegimenFiscalEmisor = trim($RegimenFiscalEmisor);
				$FolioFiscal = trim($FolioFiscal);
				$fechaTimbradoComprobante = trim($fechaTimbradoComprobante);
				$SelloComprobante = trim($SelloComprobante);
				$rfcProveedor = trim(mb_strtoupper($rfcProveedor));

				if ($numExtEmisor == "") {
					$numExtEmisor = 'SN';
				}

				if ($cpEmisor == "") {
					$cpEmisor = '00000';
				}

				if ($Descuento == "") {
					$Descuento = 0;
				}

				if($FechaHoraPago == "" && $FechaHoraCancel == ""){
					$fechaYhoraPago = NULL;
					$fechaYhoraCancel = NULL;
				}elseif($FechaHoraPago != "" && $FechaHoraCancel == "") {
					$fechaYhoraPago = date_format(date_create($FechaHoraPago),'Y-m-d');
					$fechaYhoraCancel = NULL;
				}elseif($FechaHoraPago == "" && $FechaHoraCancel != ""){
					$fechaYhoraPago = NULL;
					$fechaYhoraCancel = date_format(date_create($FechaHoraCancel),'Y-m-d');
				}else{
					$fechaYhoraPago = date_format(date_create($FechaHoraPago),'Y-m-d');
					$fechaYhoraCancel = date_format(date_create($FechaHoraCancel),'Y-m-d');
				}
				// Modificar datos generales del egreso.
				$consultaModEgr = $Conexion -> prepare('UPDATE egresos
														 SET tipo_comprobante = :tipoCompE,
									 						 version_comprobante = :versionComp,
									 						 lugar_expedicion = :lugarExpedComp,
									 						 fecha = :fechaEgreso,
									 						 rfc_emisor = :rfcEmisorEgr,
									 						 razon_social_emisor = :nomEmisorEgr,
									 						 regimen_fiscal = :regFiscalE,
									 						 rfc_receptor = :rfcReceptorEgr,
									 						 razon_social_receptor = :nomReceptorEgr,
									 						 uso_cfdi = :usoCFDI,
									 						 serie = :nSerie,
									 						 no_folio = :nFolio,
									 						 descuento = :descuentoComp,
									 						 subtotal = :subtotalE,
									 						 iva = :ivaE,
									 						 total = :totalE,
									 						 moneda_comprobante = :monedaComp,
									 						 metodo_pago = :mPagoE,
									 						 condiciones_pago = :condiPagoE,
									 						 forma_pago = :formaPagoE,
									 						 fecha_pago = :fechaHpago,
									 						 nombre_impuesto = :impuestoE,
									 						 total_impuesto = :totalImpE,
									 						 tipo_factor_impuesto = :tFactorImpE,
									 						 tasa_cuota_impuesto = :tasaImpE,
									 						 no_cuenta = :nCuentaE,
									 						 concepto = :conceptoEgr,
									 						 clasificacion = :clasificacionEgr,
									 						 estado = :estadoEgr,
									 						 origen = :origenEgr,
									 						 destino = :destinoEgr,
									 						 estado_comprobante = :estadoCompEgr,
									 						 fecha_cancelacion = :fechaCancelado,
									 						 folio_fiscal = :folFiscalE,
									 						 fecha_timbrado = :fechaTimbE,
									 						 sello_comprobante = :selloComp,
									 						 rfc_proveedor = :rfcProv,
									 						 guardar_prov = :regProv
									 						WHERE idegresos = :IDegreso;');
				$consultaModEgr -> bindParam(':tipoCompE', $TipoComprobante);
				$consultaModEgr -> bindParam(':versionComp', $VersionComprobante);
				$consultaModEgr -> bindParam(':lugarExpedComp', $LugarExpedicionComprobante);
				$consultaModEgr -> bindParam(':fechaEgreso', $FechaEgreso);
				$consultaModEgr -> bindParam(':rfcEmisorEgr', $rfcEmisor);
				$consultaModEgr -> bindParam(':nomEmisorEgr', $nombreEmisor);
				$consultaModEgr -> bindParam(':regFiscalE', $RegimenFiscalEmisor);
				$consultaModEgr -> bindParam(':rfcReceptorEgr', $rfcReceptor);
				$consultaModEgr -> bindParam(':nomReceptorEgr', $nombreReceptor);
				$consultaModEgr -> bindParam(':usoCFDI', $usoCFDIComprobante);
				$consultaModEgr -> bindParam(':nSerie', $NumSerie);
				$consultaModEgr -> bindParam(':nFolio', $NumFolio);
				$consultaModEgr -> bindParam(':descuentoComp', $Descuento);
				$consultaModEgr -> bindParam(':subtotalE', $SubTotal);
				$consultaModEgr -> bindParam(':ivaE', $IVA);
				$consultaModEgr -> bindParam(':totalE', $Total);
				$consultaModEgr -> bindParam(':monedaComp', $MonedaComprobante);
				$consultaModEgr -> bindParam(':mPagoE', $MetodoPago);
				$consultaModEgr -> bindParam(':condiPagoE', $CondicionesPagoComprobante);
				$consultaModEgr -> bindParam(':formaPagoE', $FormaPagoComprobante);
				$consultaModEgr -> bindParam(':fechaHpago', $fechaYhoraPago);
				$consultaModEgr -> bindParam(':impuestoE', $NombreImpuesto);
				$consultaModEgr -> bindParam(':totalImpE', $TotalImpuesto);
				$consultaModEgr -> bindParam(':tFactorImpE', $TipoFactorImpuesto);
				$consultaModEgr -> bindParam(':tasaImpE', $TasaImpuesto);
				$consultaModEgr -> bindParam(':nCuentaE', $NumCuenta);
				$consultaModEgr -> bindParam(':conceptoEgr', $Concepto);
				$consultaModEgr -> bindParam(':clasificacionEgr', $Clasificacion);
				$consultaModEgr -> bindParam(':estadoEgr', $Estado);
				$consultaModEgr -> bindParam(':origenEgr', $Origen);
				$consultaModEgr -> bindParam(':destinoEgr', $Destino);
				$consultaModEgr -> bindParam(':estadoCompEgr', $EstadoComprobante);
				$consultaModEgr -> bindParam(':fechaCancelado', $fechaYhoraCancel);
				$consultaModEgr -> bindParam(':folFiscalE', $FolioFiscal);
				$consultaModEgr -> bindParam(':fechaTimbE', $fechaTimbradoComprobante);
				$consultaModEgr -> bindParam(':selloComp', $SelloComprobante);
				$consultaModEgr -> bindParam(':rfcProv', $rfcProveedor);
				$consultaModEgr -> bindParam(':regProv', $guardarProv);
				$consultaModEgr -> bindParam(':IDegreso', $idEgreso);
				$resultRegEgre = $consultaModEgr -> execute();
				// Modificar Conceptos de los egresos.
				foreach ($ConceptosComprobante as $conceptosComp) {
					if ($conceptosComp['baseImpuestoC'] == "") {
						$conceptosComp['baseImpuestoC'] = 0;
					}
					if ($conceptosComp['tasaCuotaImpuestoC'] == "") {
						$conceptosComp['tasaCuotaImpuestoC'] = 0;
					}
					if ($conceptosComp['importeImpuestoC'] == "") {
						$conceptosComp['importeImpuestoC'] = 0;
					}
					$query = $Conexion -> prepare("UPDATE egresos_conceptos
													SET clave_concepto_e = :clavConcepto,
														cantidad_concepto_e = :cantConcepto,
														clave_unidad_concepto_e = :clavUnidConcepto,
														unidad_concepto_e = :unidConcepto,
														descripcion_concepto_e = :descripConcepto,
														valor_unitario_concepto_e = :valUnitConcepto,
														importe_concepto_e = :importConcepto,
														base_impuesto_concepto_e = :baseImpConcepto,
														impuesto_concepto_e = :impConcepto,
														tipofactor_impuesto_concepto_e = :tipFactImpConc,
														tasacuota_impuesto_concepto_e = :tasaCuotaImpConc,
														importe_impuesto_concepto_e = :importImpConc
													WHERE id_egresos_conceptos = :IDegrConcepto;");
					$query -> bindParam(':clavConcepto', trim($conceptosComp['claveC']));
					$query -> bindParam(':cantConcepto', trim($conceptosComp['cantidadC']));
					$query -> bindParam(':clavUnidConcepto', trim($conceptosComp['claveUnidadC']));
					$query -> bindParam(':unidConcepto', trim($conceptosComp['unidadC']));
					$query -> bindParam(':descripConcepto', trim(mb_strtoupper($conceptosComp['descripcionC'])));
					$query -> bindParam(':valUnitConcepto', trim($conceptosComp['valorUnitarioC']));
					$query -> bindParam(':importConcepto', trim($conceptosComp['importeC']));
					$query -> bindParam(':baseImpConcepto', trim($conceptosComp['baseImpuestoC']));
					$query -> bindParam(':impConcepto', trim($conceptosComp['impuestoC']));
					$query -> bindParam(':tipFactImpConc', trim($conceptosComp['tipoFactorImpuestoC']));
					$query -> bindParam(':tasaCuotaImpConc', trim($conceptosComp['tasaCuotaImpuestoC']));
					$query -> bindParam(':importImpConc', trim($conceptosComp['importeImpuestoC']));
					$query -> bindParam(':IDegrConcepto', trim($conceptosComp['idCoEg']));
					$resultQuery = $query -> execute();
				}
				// Verifica que esten definidos los datos de dirección del Emisor.
				if (isset($idEgrDir) && isset($paisEmisor) && isset($estadoEmisor) && isset($municipioEmisor) && isset($coloniaEmisor) && isset($numExtEmisor) && isset($numIntEmisor) && isset($calleEmisor) && isset($cpEmisor)) {
					// Modificar dirección del Emisor, en caso de que exista.
					if ($paisEmisor != "" && $estadoEmisor != "" && $municipioEmisor != "" && $coloniaEmisor != "") {
						// Modificar egresos direcciones.
						$queryDirEgr = $Conexion -> prepare("UPDATE egresos_direcciones
															  SET ed_pais = :paisEmis,
																  ed_estado = :estadoEmis,
																  ed_municipio = :municipioEmis,
																  ed_colonia = :coloniaEmis,
																  ed_no_ext = :numExtEmis,
																  ed_no_int = :numIntEmis,
																  ed_calle = :calleEmis,
																  ed_cod_post = :codigoPostEmis
															  WHERE id_e_direccion = :IDegresoDir;");
						$queryDirEgr -> bindParam(':paisEmis', $paisEmisor);
						$queryDirEgr -> bindParam(':estadoEmis', $estadoEmisor);
						$queryDirEgr -> bindParam(':municipioEmis', $municipioEmisor);
						$queryDirEgr -> bindParam(':coloniaEmis', $coloniaEmisor);
						$queryDirEgr -> bindParam(':numExtEmis', $numExtEmisor);
						$queryDirEgr -> bindParam(':numIntEmis', $numIntEmisor);
						$queryDirEgr -> bindParam(':calleEmis', $calleEmisor);
						$queryDirEgr -> bindParam(':codigoPostEmis', $cpEmisor);
						$queryDirEgr -> bindParam(':IDegresoDir', $idEgrDir);
						$resultDirEgr = $queryDirEgr -> execute();
					}
				} // Fin de verificación de dirección del Emisor.
				// Guardar como proveedor.
				if ($guardarProv == 'Si' && $provGuardado != 'guardado') {
					// Incremento del Id proveedor.
					$queryIdProv = $Conexion -> prepare("SELECT id_proveedor FROM proveedores ORDER BY id_proveedor DESC LIMIT 1;");
					$queryIdProv -> execute();
					$rowsIdProv = $queryIdProv -> rowCount();
					if ($rowsIdProv == 0) {
						$idProveedor = 1;
					}else{
						$resultIdProv = $queryIdProv -> fetch(PDO::FETCH_ASSOC);
						$idProveedor = ($resultIdProv['id_proveedor'] + 1);
					}
					// Insertar proveedor.
					$queryProv = $Conexion -> prepare("INSERT INTO proveedores (
													  	id_proveedor,
													  	nom_proveedor,
													  	fecha_registro
													   )
													   VALUES (
													  	:IDprove,
													  	:NOMprove,
													  	NOW()
													   );");
					$queryProv -> bindParam(':IDprove', $idProveedor);
					$queryProv -> bindParam(':NOMprove', $nomProv);
					$resultProv = $queryProv -> execute();
					// Insertar Datos Fiscales Proveedor.
					if ($resultProv == TRUE) {
						$queryDatFisProv = $Conexion -> prepare("INSERT INTO proveedores_datos_fiscales (
																  razon_social_prov,
																  rfc_prov,
																  id_proveedor
																 )
													  			 VALUES (
													  			  :nomEmis,
													  			  :rfcEmis,
													  			  :IDprove
													  			 );");
						$queryDatFisProv -> bindParam(':nomEmis', $nombreEmisor);
						$queryDatFisProv -> bindParam(':rfcEmis', $rfcEmisor);
						$queryDatFisProv -> bindParam(':IDprove', $idProveedor);
						$queryDatFisProv -> execute();
					}
					// Incremento de Id direccion.
					$queryIdProvDir = $Conexion -> prepare("SELECT idprov_direccion FROM proveedores_direcciones ORDER BY idprov_direccion DESC LIMIT 1;");
					$queryIdProvDir -> execute();
					$rowsIdProvDir = $queryIdProvDir -> rowCount();
					if ($rowsIdProvDir == 0) {
						$idDireccionProv = 1;
					}else{
						$resultIdProvDir = $queryIdProvDir -> fetch(PDO::FETCH_ASSOC);
						$idDireccionProv = ($resultIdProvDir['idprov_direccion'] + 1);
					}
					// Insertar Dirección Proveedor.
					if ($paisEmisor != "" && $estadoEmisor != "" && $municipioEmisor != "" && $coloniaEmisor != "" && $numExtEmisor != "" && $calleEmisor != "" && $cpEmisor != "") {
						$queryDirProv = $Conexion -> prepare("INSERT INTO proveedores_direcciones (
															   idprov_direccion,
															   calle_p,
															   num_ext_p,
															   num_int_p,
															   colonia_p,
															   municipio_p,
															   estado_p,
															   pais_p,
															   cod_postal_p
														      )
												  		      VALUES (
												  		 	   :IDdirProv,
															   :calleEm,
															   :neEm,
															   :niEm,
															   :colEm,
															   :munEm,
															   :estEm,
															   :paisEm,
															   :cpEm
								  							  );");
						$queryDirProv -> bindParam(':IDdirProv', $idDireccionProv);
						$queryDirProv -> bindParam(':calleEm', $calleEmisor);
						$queryDirProv -> bindParam(':neEm', $numExtEmisor);
						$queryDirProv -> bindParam(':niEm', $numIntEmisor);
						$queryDirProv -> bindParam(':colEm', $coloniaEmisor);
						$queryDirProv -> bindParam(':munEm', $municipioEmisor);
						$queryDirProv -> bindParam(':estEm', $estadoEmisor);
						$queryDirProv -> bindParam(':paisEm', $paisEmisor);
						$queryDirProv -> bindParam(':cpEm', $cpEmisor);
						$resultDirProv = $queryDirProv -> execute();
						if ($resultDirProv == TRUE) {
							$queryDetProvDir = $Conexion -> prepare("INSERT INTO detalle_proveedores_direcciones (
																	  id_proveedor,
																	  idprov_direccion,
																	  tipo_direccion
																	 )
																	 VALUES (
																	  :IDprove,
																	  :IDdirProv,
																	  :tDireccion
																	 );");
							$tipoDireccion = "FISCAL Y FISICA";
							$queryDetProvDir -> bindParam(':IDprove', $idProveedor);
							$queryDetProvDir -> bindParam(':IDdirProv', $idDireccionProv);
							$queryDetProvDir -> bindParam(':tDireccion', $tipoDireccion);
							$queryDetProvDir -> execute();
						}
					} // Guardar como proveedor.
				}
                
                if($DatosProducto) {
					foreach($DatosProducto as $datoProd) {
						$query = "INSERT INTO productos (id_categoria,
														id_subcategoria,
														id_division,
														id_nombre,
														id_tipo,
														id_marca,
														modelo,
														precio,
														id_moneda,
														id_unidad,
														descripcion,
														exit_inventario,
														descontinuado)
								VALUES (:IDcategoria,:IDsubcategoria,:IDdivision,:IDnombre,:IDtipo,
														:IDmarca,:Modelo,:Precio,:Moneda,:IDunidad,:Descripcion,:Exist,:Descon)";
						$sql = $Conexion->prepare($query);
						$existencias = '0';
						$descontinuado = 'No';
						$borrar = 1;
						$sql->bindParam(':IDcategoria',$datoProd['cat']);
						$sql->bindParam(':IDsubcategoria',$datoProd['sub']);
						$sql->bindParam(':IDdivision',$datoProd['div']);
						$sql->bindParam(':IDnombre',$datoProd['nom']);
						$sql->bindParam(':IDtipo',$datoProd['tip']);
						$sql->bindParam(':IDmarca',$datoProd['mar']);
						$sql->bindParam(':Modelo',$datoProd['mod']);
						$sql->bindParam(':Precio',$datoProd['pre']);
						$sql->bindParam(':Moneda',$datoProd['mon']);
						$sql->bindParam(':IDunidad',$borrar);
						$sql->bindParam(':Descripcion',$datoProd['des']);
						$sql->bindParam(':Exist',$existencias);
						$sql->bindParam(':Descon',$descontinuado);
						$result = $sql->execute();
                        
                        // Insertar en tabla que relaciona conceptos con productos
                        $fila = $this->getFilaProd();
                        $id_producto = $fila[0];

                        $idEgCon = $this->getIdCon($datoProd['mod']);
                        $id_eg_con = $idEgCon['id_egresos_conceptos'];

                        //print "prod: ".$id_producto."\n";
                        //print "eg: ".$id_eg_con."\n";

                        $this->guardarRelEgProd($id_eg_con,$id_producto);
					}
                    
				}
				if($resultRegEgre == TRUE){
					header("Location: index.php");
					return $resultRegEgre;
				}
			}
		} // Fin modificar egresos.

		// Obtener si se inventaria egresos o no
		public function getInventariar($idEg) {
			$Conexion = new dataBaseConn();
			$query = $Conexion->prepare('SELECT inventariar
										FROM egresos
										WHERE idegresos = :IdEg;');
			$query->bindParam(':IdEg', $idEg);
			$query->execute();
			$inv = $query->fetch(PDO::FETCH_ASSOC);
			return $inv;
		}

		public function setInvSi($idEg) {
			// Actualizar existencia del Producto.
			$Conexion = new dataBaseConn();
			$queryUp = $Conexion -> prepare("UPDATE egresos SET inventariar = 'Si'
											WHERE idegresos = :IdEg;");
			$queryUp -> bindParam(':IdEg', $idEg);
			$queryUp -> execute();
		}

		public function setInvNo($idEg) {
			// Actualizar existencia del Producto.
			$Conexion = new dataBaseConn();
			$queryUp = $Conexion -> prepare("UPDATE egresos SET inventariar = 'No'
											WHERE idegresos = :IdEg;");
			$queryUp -> bindParam(':IdEg', $idEg);
			$queryUp -> execute();
		}

		public function setNoEgConAddInv($idEcon) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare("UPDATE egresos_conceptos
											SET agregar_inv = 'No'
											WHERE id_egresos_conceptos = :IdECon");
			$query->bindParam(':IdECon',$idEcon);
			$query->execute();
		}

		public function setSiEgConAddInv($idEcon) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare("UPDATE egresos_conceptos
											SET agregar_inv = 'Si'
											WHERE id_egresos_conceptos = :IdECon");
			$query->bindParam(':IdECon',$idEcon);
			$query->execute();
		}

		public function getInvCon($idEcon) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare("SELECT agregar_inv
											FROM egresos_conceptos
											WHERE id_egresos_conceptos = :IdEcon");
			$query->bindParam(':IdEcon', $idEcon);
			$query->execute();
			$InvCon = $query->fetch(PDO::FETCH_ASSOC);
			return $InvCon;
		}

		public function buscarEg($fecha, $rfc, $razon, $serie, $folio, $subtotal, $iva, $total, $metodoPago, $fechaPago, $cuenta, $concepto, $clasificacion, $status) {
			$Conexion = new dataBaseConn();
			$criterio = "";

			if(empty($criterio) && !empty($fecha)) {
				$criterio .= "eg.fecha LIKE :FechaEg";
			} elseif (!empty($criterio) && !empty($fecha)) {
				$criterio .= "AND eg.fecha LIKE :FechaEg";
			}

			if (empty($criterio) && !empty($rfc)) {
				$criterio .= "eg.rfc_emisor LIKE :RfcEg";
			} elseif (!empty($criterio) && !empty($rfc)) {
				$criterio .= " AND eg.rfc_emisor LIKE :RfcEg";
			}

			if (empty($criterio) && !empty($razon)) {
				$criterio .= "eg.razon_social_emisor LIKE :RazonEg";
			} elseif (!empty($criterio) && !empty($razon)) {
				$criterio .= " AND eg.razon_social_emisor LIKE :RazonEg";
			}

			if (empty($criterio) && !empty($serie)) {
				$criterio .= "eg.serie LIKE :SerieEg";
			} elseif (!empty($criterio) && !empty($serie)) {
				$criterio .= " AND eg.serie LIKE :SerieEg";
			}

			if (empty($criterio) && !empty($folio)) {
				$criterio .= "eg.no_folio LIKE :FolioEg";
			} elseif (!empty($criterio) && !empty($folio)) {
				$criterio .= " AND eg.no_folio LIKE :FolioEg";
			}

			if (empty($criterio) && !empty($subtotal)) {
				$criterio .= "eg.subtotal LIKE :SubTEg";
			} elseif (!empty($criterio) && !empty($subtotal)) {
				$criterio .= " AND eg.subtotal LIKE :SubTEg";
			}

			if (empty($criterio) && !empty($iva)) {
				$criterio .= "eg.iva LIKE :IvaEg";
			} elseif (!empty($criterio) && !empty($iva)) {
				$criterio .= " AND eg.iva LIKE :IvaEg";
			}

			if (empty($criterio) && !empty($total)) {
				$criterio .= "eg.total LIKE :TotalEg";
			} elseif (!empty($criterio) && !empty($total)) {
				$criterio .= " AND eg.total LIKE :TotalEg";
			}

			if (empty($criterio) && !empty($metodoPago)) {
				$criterio .= "eg.metodo_pago LIKE :MetodoP";
			} elseif (!empty($criterio) && !empty($metodoPago)) {
				$criterio .= " AND eg.metodo_pago LIKE :MetodoP";
			}

			if (empty($criterio) && !empty($fechaPago)) {
				$criterio .= "eg.fecha_pago LIKE :FechaP";
			} elseif (!empty($criterio) && !empty($fechaPago)) {
				$criterio .= " AND eg.fecha_pago LIKE :FechaP";
			}

			if (empty($criterio) && !empty($cuenta)) {
				$criterio .= "eg.no_cuenta LIKE :CuentaEg";
			} elseif (!empty($criterio) && !empty($cuenta)) {
				$criterio .= " AND eg.no_cuenta LIKE :CuentaEg";
			}

			if (empty($criterio) && !empty($concepto)) {
				$criterio .= "eg.concepto LIKE :ConceptoEg";
			} elseif (!empty($criterio) && !empty($concepto)) {
				$criterio .= " AND eg.concepto LIKE :ConceptoEg";
			}

			if (empty($criterio) && !empty($clasificacion)) {
				$criterio .= "eg.clasificacion LIKE :ClasifEg";
			} elseif (!empty($criterio) && !empty($clasificacion)) {
				$criterio .= " AND eg.clasificacion LIKE :ClasifEg";
			}

			if (empty($criterio) && !empty($status)) {
				$criterio .= "eg.estado LIKE :EstadoEg";
			} elseif (!empty($criterio) && !empty($status)) {
				$criterio .= " AND eg.estado LIKE :EstadoEg";
			}
			
			$query = $Conexion -> prepare("SELECT
									eg.idegresos,
									eg.fecha,
									eg.rfc_emisor,
									eg.razon_social_emisor,
									eg.serie,
									eg.no_folio,
									eg.subtotal,
									eg.iva,
									eg.total,
									eg.metodo_pago,
									eg.fecha_pago,
									eg.no_cuenta,
									eg.concepto,
									eg.clasificacion,
									eg.estado
								   FROM egresos eg
								   WHERE " . $criterio);
			
			if ($fecha !== "") {
				$fecha = "%".$fecha."%";
				$query->bindParam(':FechaEg', $fecha);
			}

			if ($rfc !== "") {
				$rfc = "%".$rfc."%";
				$query->bindParam(':RfcEg', $rfc);
			}

			if ($razon !== "") {
				$razon = "%".$razon."%";
				$query->bindParam(':RazonEg', $razon);
			}
			
			if ($serie !== "") {
				$serie = "%".$serie."%";
				$query->bindParam(':SerieEg', $serie);
			}

			if ($folio !== "") {
				$folio = "%".$folio."%";
				$query->bindParam(':FolioEg', $folio);
			}

			if ($subtotal !== "") {
				$subtotal = "%".$subtotal."%";
				$query->bindParam(':SubTEg', $subtotal);
			}

			if ($iva !== "") {
				$iva = "%".$iva."%";
				$query->bindParam(':IvaEg', $iva);
			}

			if ($total !== "") {
				$total = "%".$total."%";
				$query->bindParam(':TotalEg', $total);
			}

			if ($metodoPago !== "") {
				$metodoPago = "%".$metodoPago."%";
				$query->bindParam(':MetodoP', $metodoPago);
			}

			if ($fechaPago !== "") {
				$fechaPago = "%".$fechaPago."%";
				$query->bindParam(':FechaP', $fechaPago);
			}

			if ($cuenta !== "") {
				$cuenta = "%".$cuenta."%";
				$query->bindParam(':CuentaEg', $cuenta);
			}

			if ($concepto !== "") {
				$concepto = "%".$concepto."%";
				$query->bindParam(':ConceptoEg', $concepto);
			}

			if ($clasificacion !== "") {
				$clasificacion = "%".$clasificacion."%";
				$query->bindParam(':ClasifEg', $clasificacion);
			}

			if ($status !== "") {
				$status = "%".$status."%";
				$query->bindParam(':EstadoEg', $status);
			}

			$query->execute();
			// print_r( $query);
			$res = $query->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}

		public function encontrarEgxFolio($folioFi) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare("SELECT folio_fiscal
											FROM egresos
											WHERE folio_fiscal = :FolioEg");
			$query->bindParam(':FolioEg', $folioFi);
			$query->execute();
			$fila = $query->rowCount();
			return $fila;
		}
	} // Fin clase Egresos.
?>