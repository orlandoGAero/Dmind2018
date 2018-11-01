<?php
	/**
	* FUNCIÓN para Ingresos.
	*/
	require'dataBaseConn.php';
	class ingresos {
		// Obtener los ingresos registrados.
		public function listarIngresos() {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare("SELECT 
										  ingr.id_ingresos,
										  ingr.fecha,
										  ingr.rfc_emisor,
										  ingr.razon_social_emisor,
										  ingr.serie,
										  ingr.no_folio,
										  ingr.subtotal,
										  ingr.iva,
										  ingr.total,
										  ingr.metodo_pago,
										  ingr.fecha_hora_pago,
										  ingr.no_cuenta,
										  ingr.concepto,
										  ingr.clasificacion,
										  ingr.estado
										FROM ingresos ingr;");
			$query -> execute();
			$datIngresos = $query -> fetchAll(); 
			return $datIngresos;
		}
		// Extraer datos del archivo XML.
		public function obtenerDatosXML($nombreArchivo, $nombreArchivoTemporal, $tipo){
			define('DIR_BASE', dirname(__FILE__).'/');
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

				if(isset($nodos['cdi']) || isset($nodos['tfd'])){
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
																'claveConceptoI'=>'',
																'cantidadConceptoI'=>trim($concepto['cantidad']),
																'claveUnidadConceptoI'=>'',
																'unidadConceptoI'=>trim($concepto['unidad']),
																'descripcionConceptoI'=>trim($concepto['descripcion']),
																'valorUnitarioConceptoI'=>trim($concepto['valorUnitario']),
																'importeConceptoI'=>trim($concepto['importe'])
															);	
							$impuestosConceptosComprobante[] = array(
																		'baseConceptoI'=>'',
																		'impuestoConceptoI'=>'',
																		'tipoFactorConceptoI'=>'',
																		'tasaCuotaConceptoI'=>'',
																		'importeImpuestoConceptoI'=>''
																	);			
						}

						foreach ($xml -> xpath('//c:Comprobante//c:Impuestos') as $impuestos) {
							$totalDeImpuestos = trim($impuestos['totalImpuestosTrasladados']);
						}

						foreach ($xml -> xpath('//c:Comprobante//c:Impuestos//c:Traslados//c:Traslado') as $impuestosTranslados) {
							$tipoImpuesto = trim(mb_strtoupper($impuestosTranslados['impuesto']));
							$tipoFactorImpuesto = "";
							$tasaCuotaImpuesto = trim($impuestosTranslados['tasa']);
							$importeImpuesto = trim($impuestosTranslados['importe']);
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
																'claveConceptoI'=>trim($concepto['ClaveProdServ']),
																'cantidadConceptoI'=>trim($concepto['Cantidad']),
																'claveUnidadConceptoI'=>trim($concepto['ClaveUnidad']),
																'unidadConceptoI'=>trim($concepto['Unidad']),
																'descripcionConceptoI'=>trim($concepto['Descripcion']),
																'valorUnitarioConceptoI'=>trim($concepto['ValorUnitario']),
																'importeConceptoI'=>trim($concepto['Importe'])
															);				
						}

						foreach ($xml -> xpath('//c:Comprobante//c:Conceptos//c:Concepto//c:Impuestos//c:Traslados//c:Traslado') as $impuestosConceptos) {
							$impuestosConceptosComprobante[] = array(
																		'baseConceptoI'=>trim($impuestosConceptos['Base']),
																		'impuestoConceptoI'=>trim($impuestosConceptos['Impuesto']),
																		'tipoFactorConceptoI'=>trim($impuestosConceptos['TipoFactor']),
																		'tasaCuotaConceptoI'=>trim($impuestosConceptos['TasaOCuota']),
																		'importeImpuestoConceptoI'=>trim($impuestosConceptos['Importe'])
																	);
						}

						foreach ($xml -> xpath('//c:Comprobante//c:Impuestos') as $impuestos) {
							$totalDeImpuestos = trim($impuestos['TotalImpuestosTrasladados']);
						}

						foreach ($xml -> xpath('//c:Comprobante//c:Impuestos//c:Traslados//c:Traslado') as $impuestosTranslados) {
							$tipoImpuesto = trim(mb_strtoupper($impuestosTranslados['Impuesto']));
							$tipoFactorImpuesto = trim(mb_strtoupper($impuestosTranslados['TipoFactor']));
							$tasaCuotaImpuesto = trim($impuestosTranslados['TasaOCuota']);
							$importeImpuesto = trim($impuestosTranslados['Importe']);
						}

						foreach ($xml -> xpath('//t:TimbreFiscalDigital') as $timbreFiscal) {
							$FolioFiscal = trim($timbreFiscal['UUID']);
							$fechaTimbrado = trim($timbreFiscal['FechaTimbrado']);
							$fechaTimbr = date_format(date_create($fechaTimbrado),'d-m-Y');
							$horaTimbr = date_format(date_create($fechaTimbrado),'H:i:s');
							$RFCproveedor = trim(mb_strtoupper($timbreFiscal['RfcProvCertif']));
						}
					} // Termina VERSIÓN 3.3
				}else{
					$band = 1;
					$this -> msjErr = "El archivo '".$nombreArchivo."', no cumple con el formato requerido.";
					// Borrar el archivo cargado, si no cumple con el formato requerido
					unlink($ruta);
				}				
			}

			if ($band == 0) {
				$this -> datosIngresosXML = array(
								'versionI'=>$versionComprobante,
								'serieI'=>$NumSerie,
								'folioI'=>$NumFolio,
								'fechaI'=>$Fecha,
								'horaI'=>$Hora,
								'descuentoI'=>$descuentoComprobante,
								'subtotalI'=>$SubTotal,
								'condicionPagoI'=>$condicionPago,
								'formaPagoI'=>$formaDePago,
								'monedaI'=>$moneda,
								'totalI'=>$Total,
								'tipoComprobanteI'=>$tipoComprob,
								'metodoPagoI'=>$MetodoPago,
								'lugarExpI'=>$LugarExpedicion,
								'selloI'=>$selloComprobante,
								'rfcEmisorI'=>$rfcEmisor,
								'nombreEmisorI'=>$nombreEmisor,
								'regimenFiscalI'=>$regimenFiscal,
									'dirPaisI'=>$paisDFE,
									'dirEstadoI'=>$estadoDFE,
									'dirMunicipioI'=>$municipioDFE,
									'dirColoniaI'=>$coloniaDFE,
									'dirNExtI'=>$numExtDFE,
									'dirNIntI'=>$numIntDFE,
									'dirCalleI'=>$calleDFE,
									'dirCodPostI'=>$codPosDFE,
							  	'rfcReceptorI'=>$rfcReceptor,
							  	'nombreReceptorI'=>$nombreReceptor,
							  	'usoCfdiReceptorI'=>$usoCfdiReceptor,
							  	'conceptosComprobanteI'=>$conceptosComprobante,
							  	'impuestosConceptosComprobanteI'=>$impuestosConceptosComprobante,
							  	'tipoImpuestoI'=>$tipoImpuesto,
							  	'totalImpuestosI'=>$totalDeImpuestos,
							  	'tipoFactorImpuestoI'=>$tipoFactorImpuesto,
							  	'tasaCuotaImpuestoI'=>$tasaCuotaImpuesto,
							  	'importeImpuestoI'=>$importeImpuesto,
								'folioFiscalI'=>$FolioFiscal,
								'fechaTimbradoI'=>$fechaTimbr,
								'horaTimbradoI'=>$horaTimbr,
								'rfcProvI'=>$RFCproveedor
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
		}
		// Detalle de Ingresos.
		public function detalleIngresos($idIngreso) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare("SELECT 
											ingr.id_ingresos,
											ingr.efecto_comprobante,
											ingr.tipo_comprobante,
											ingr.version_comprobante,
											ingr.lugar_expedicion,
											ingr.fecha,
											ingr.rfc_emisor,
											ingr.razon_social_emisor,
											ingr.regimen_fiscal,
											ingr.rfc_receptor,
											ingr.razon_social_receptor,
											idir.ingr_pais,
											idir.ingr_estado,
											idir.ingr_municipio,
											idir.ingr_colonia,
											idir.ingr_no_ext,
											idir.ingr_no_int,
											idir.ingr_calle,
											idir.ingr_cod_post,
											ingr.uso_cfdi,
											ingr.serie,
											ingr.no_folio,
											ingr.descuento,
											ingr.subtotal,
											ingr.iva,
											ingr.total,
											ingr.moneda_comprobante,
											ingr.metodo_pago,
											ingr.condiciones_pago,
											ingr.forma_pago,
											ingr.fecha_hora_pago,
											ingr.nombre_impuesto,
											ingr.total_impuesto,
											ingr.tipo_factor_impuesto,
											ingr.tasa_cuota_impuesto,
											ingr.no_cuenta,
											ingr.concepto,
											ingr.clasificacion,
											ingr.estado,
											ingr.origen,
											ingr.destino,
											ingr.estado_comprobante,
											ingr.fecha_cancelacion,
											ingr.folio_fiscal,
											ingr.fecha_timbrado, 
											ingr.sello_comprobante,
											ingr.rfc_proveedor 
									FROM ingresos ingr
										LEFT JOIN ingresos_direcciones idir ON ingr.id_ingresos = idir.id_ingresos
									WHERE ingr.id_ingresos = :IDingreso;");
			$query -> bindParam(':IDingreso', $idIngreso);
			$query -> execute();
			$detIngr = $query -> fetch();
			return $detIngr;
		}
		//Conceptos Detalle Ingresos.
		public function conceptosDetalleIngresos($idIngreso) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare("SELECT 
											ingcon.id_ingresos_conceptos,
											ingcon.clave_concepto_i,
											ingcon.cantidad_concepto_i,
											ingcon.clave_unidad_concepto_i,
											ingcon.unidad_concepto_i,
											ingcon.descripcion_concepto_i,
											ingcon.valor_unitario_concepto_i,
											ingcon.importe_concepto_i,
											ingcon.base_impuesto_concepto_i,
											ingcon.impuesto_concepto_i,
											ingcon.tipofactor_impuesto_concepto_i,
											ingcon.tasacuota_impuesto_concepto_i,
											ingcon.importe_impuesto_concepto_i
										FROM
										 	ingresos_conceptos ingcon 
											 LEFT JOIN ingresos igr ON igr.id_ingresos = ingcon.id_ingresos
										WHERE ingcon.id_ingresos = :IDingreso;");
			$query -> bindParam(':IDingreso', $idIngreso);
			$query -> execute();
			$conceptosIngresos = $query -> fetchAll();
			return $conceptosIngresos;
		}
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
			#...datos diferentes al seleccionado(Se utilizan para la modificación de Ingresos).
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
			#...datos diferentes al seleccionado(Se utilizan para la modificación de Ingresos).

		// Registrar Ingresos.
		public function registrarIngresos($EfectoComprobante, $VersionComprobante, $TipoComprobante, $LugarExpedicionComprobante, $Fecha, $Hora, $rfcEmisor, $nombreEmisor, $paisEmisor, $estadoEmisor, $municipioEmisor, $coloniaEmisor, $numExtEmisor, $numIntEmisor, $calleEmisor, $cpEmisor, $rfcReceptor, $nombreReceptor, $usoCFDIComprobante, $NumSerie, $NumFolio, $ConceptosComprobante, $Descuento, $SubTotal, $IVA, $Total, $MonedaComprobante, $MetodoPago, $CondicionesPagoComprobante, $FormaPagoComprobante, $FechaHoraPago, $NombreImpuesto, $TotalImpuesto, $TipoFactorImpuesto, $TasaImpuesto, $NumCuenta, $Concepto, $Clasificacion, $Estado, $Origen, $Destino, $EstadoComprobante, $FechaHoraCancel, $RegimenFiscalEmisor, $FolioFiscal, $FechaTimbrado, $HoraTimbrado, $SelloComprobante, $rfcProveedor) {
			$Conexion = new dataBaseConn();
			$band = 0;
			if ($EfectoComprobante != "" && $VersionComprobante != "" && $TipoComprobante != "" && $LugarExpedicionComprobante != "" && $Fecha != "" && $EfectoComprobante != "" && $Hora != "" && $rfcEmisor != "" && $nombreEmisor != "" && $rfcReceptor != "" && $nombreReceptor != "" && $NumSerie != "" && $NumFolio != "" && $SubTotal != "" && $IVA != "" && $Total != "" && $MonedaComprobante != "" && $MetodoPago != "" && $FormaPagoComprobante != "" && $NombreImpuesto != "" && $TotalImpuesto != "" && $TasaImpuesto != "" && $FolioFiscal != "" && $FechaTimbrado != "" && $HoraTimbrado != "" && $SelloComprobante != "") {
					// Fecha del Comprobante.
					$Fecha = date_format(date_create($Fecha), 'Y-m-d');
					$FechaIngreso = $Fecha." ".$Hora;
					// Fecha Timbrado del Comprobante.
					$FechaTimbrado = date_format(date_create($FechaTimbrado), 'Y-m-d');
					$fechaTimbradoComprobante = $FechaTimbrado." ".$HoraTimbrado;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			
			if ($band == 0) {
				$query = $Conexion -> prepare('SELECT no_folio
											  FROM ingresos
											  WHERE no_folio = :nFolio;');
				$query -> bindParam(':nFolio', $NumFolio);
				$query -> execute();
				$rows = $query -> rowCount();;
				if($rows != 0){
					$this -> msjErr = "Ya se encuentra guardado el registro con el número de folio: ".$NumFolio.".";
					$band = 1;
				}
			}

			if($band == 0){
				$EfectoComprobante = trim(mb_strtoupper($EfectoComprobante));
				$VersionComprobante = trim(mb_strtoupper($VersionComprobante));
				$TipoComprobante = trim(mb_strtoupper($TipoComprobante));
				$LugarExpedicionComprobante = trim(mb_strtoupper($LugarExpedicionComprobante));
				$FechaIngreso = trim($FechaIngreso);
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
				$IVA = trim($IVA);
				$Total = trim($Total);
				$MonedaComprobante = trim(mb_strtoupper($MonedaComprobante));
				$MetodoPago = trim(mb_strtoupper($MetodoPago));
				$CondicionesPagoComprobante = trim(mb_strtoupper($CondicionesPagoComprobante));
				$FormaPagoComprobante = trim(mb_strtoupper($FormaPagoComprobante));
				$FechaHoraPago = trim($FechaHoraPago);
				$NombreImpuesto = trim(mb_strtoupper($NombreImpuesto));
				$TotalImpuesto = trim($TotalImpuesto);
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
				
				$queryIdIngre = $Conexion -> prepare("SELECT id_ingresos FROM ingresos ORDER BY id_ingresos DESC LIMIT 1;");
				$queryIdIngre -> execute();
				$rowsIdIngre = $queryIdIngre -> rowCount();
				if ($rowsIdIngre == 0) {
					$idIngreso = 1;
				}else{
					$resultIdIngre = $queryIdIngre -> fetch(PDO::FETCH_ASSOC);
					$idIngreso = ($resultIdIngre['id_ingresos'] + 1);
				}

				$queryRegIngre = $Conexion -> prepare('INSERT INTO ingresos (
							 								 			id_ingresos,
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
										 								fecha_hora_pago,
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
										 								rfc_proveedor
							 						  				)
							 								VALUES (
																	:IDingreso,
																	:efectoCompI,
																	:tipoCompI,
																	:versionComp,
																	:lugarExpedComp,
																	:fechaIngreso,
																	:rfcEmisorIngr,
																	:nomEmisorIngr,
																	:regFiscalI,
																	:rfcReceptorIngr,
																	:nomReceptorIngr,
																	:usoCFDI,
																	:nSerie,
																	:nFolio,
																	:descuentoComp,
																	:subtotalI,
																	:ivaI,
																	:totalI,
																	:monedaComp,
																	:mPagoI,
																	:condiPagoI,
																	:formaPagoI,
																	:fechaHpago,
																	:impuestoI,
																	:totalImpI,
																	:tFactorImpI,
																	:tasaImpI,
																	:nCuentaI,
																	:conceptoIngr,
																	:clasificacionIngr,
																	:estadoIngr,
																	:origenIngr,
																	:destinoIngr,
																	:estadoCompIngr,
																	:fechaCancelado,
																	:folFiscalI,
																	:fechaTimbI,
																	:selloComp,
																	:rfcProv
								 								);');
				$queryRegIngre -> bindParam(':IDingreso', $idIngreso);
				$queryRegIngre -> bindParam(':efectoCompI', $EfectoComprobante);
				$queryRegIngre -> bindParam(':tipoCompI', $TipoComprobante);
				$queryRegIngre -> bindParam(':versionComp', $VersionComprobante);
				$queryRegIngre -> bindParam(':lugarExpedComp', $LugarExpedicionComprobante);
				$queryRegIngre -> bindParam(':fechaIngreso', $FechaIngreso);
				$queryRegIngre -> bindParam(':rfcEmisorIngr', $rfcEmisor);
				$queryRegIngre -> bindParam(':nomEmisorIngr', $nombreEmisor);
				$queryRegIngre -> bindParam(':regFiscalI', $RegimenFiscalEmisor);
				$queryRegIngre -> bindParam(':rfcReceptorIngr', $rfcReceptor);
				$queryRegIngre -> bindParam(':nomReceptorIngr', $nombreReceptor);
				$queryRegIngre -> bindParam(':usoCFDI', $usoCFDIComprobante);
				$queryRegIngre -> bindParam(':nSerie', $NumSerie);
				$queryRegIngre -> bindParam(':nFolio', $NumFolio);
				$queryRegIngre -> bindParam(':descuentoComp', $Descuento);
				$queryRegIngre -> bindParam(':subtotalI', $SubTotal);
				$queryRegIngre -> bindParam(':ivaI', $IVA);
				$queryRegIngre -> bindParam(':totalI', $Total);
				$queryRegIngre -> bindParam(':monedaComp', $MonedaComprobante);
				$queryRegIngre -> bindParam(':mPagoI', $MetodoPago);
				$queryRegIngre -> bindParam(':condiPagoI', $CondicionesPagoComprobante);
				$queryRegIngre -> bindParam(':formaPagoI', $FormaPagoComprobante);
				$queryRegIngre -> bindParam(':fechaHpago', $fechaYhoraPago);
				$queryRegIngre -> bindParam(':impuestoI', $NombreImpuesto);
				$queryRegIngre -> bindParam(':totalImpI', $TotalImpuesto);
				$queryRegIngre -> bindParam(':tFactorImpI', $TipoFactorImpuesto);
				$queryRegIngre -> bindParam(':tasaImpI', $TasaImpuesto);
				$queryRegIngre -> bindParam(':nCuentaI', $NumCuenta);
				$queryRegIngre -> bindParam(':conceptoIngr', $Concepto);
				$queryRegIngre -> bindParam(':clasificacionIngr', $Clasificacion);
				$queryRegIngre -> bindParam(':estadoIngr', $Estado);
				$queryRegIngre -> bindParam(':origenIngr', $Origen);
				$queryRegIngre -> bindParam(':destinoIngr', $Destino);
				$queryRegIngre -> bindParam(':estadoCompIngr', $EstadoComprobante);
				$queryRegIngre -> bindParam(':fechaCancelado', $fechaYhoraCancel);
				$queryRegIngre -> bindParam(':folFiscalI', $FolioFiscal);
				$queryRegIngre -> bindParam(':fechaTimbI', $fechaTimbradoComprobante);
				$queryRegIngre -> bindParam(':selloComp', $SelloComprobante);
				$queryRegIngre -> bindParam(':rfcProv', $rfcProveedor);
				$resultRegIngre = $queryRegIngre -> execute();

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
					$query = $Conexion -> prepare("INSERT INTO ingresos_conceptos (
																clave_concepto_i,
																cantidad_concepto_i,
																clave_unidad_concepto_i,
																unidad_concepto_i,
																descripcion_concepto_i,
																valor_unitario_concepto_i,
																importe_concepto_i,
																base_impuesto_concepto_i,
																impuesto_concepto_i,
																tipofactor_impuesto_concepto_i,
																tasacuota_impuesto_concepto_i,
																importe_impuesto_concepto_i,
																id_ingresos
															)
													VALUES (
																:clavConcepto,
																:cantConcepto,
																:clavUnidConcepto,
																:unidConcepto,
																:descripConcepto,
																:valUnitConcepto,
																:importConcepto,
																:baseImpConcepto,
																:impConcepto,
																:tipFactImpConc,
																:tasaCuotaImpConc,
																:importImpConc,
																:IDingre
															);");
					$query -> bindParam(':clavConcepto', $conceptosComp['claveC']);
					$query -> bindParam(':cantConcepto', $conceptosComp['cantidadC']);
					$query -> bindParam(':clavUnidConcepto', $conceptosComp['claveUnidadC']);
					$query -> bindParam(':unidConcepto', $conceptosComp['unidadC']);
					$query -> bindParam(':descripConcepto', $conceptosComp['descripcionC']);
					$query -> bindParam(':valUnitConcepto', $conceptosComp['valorUnitarioC']);
					$query -> bindParam(':importConcepto', $conceptosComp['importeC']);
					$query -> bindParam(':baseImpConcepto', $conceptosComp['baseImpuestoC']);
					$query -> bindParam(':impConcepto', $conceptosComp['impuestoC']);
					$query -> bindParam(':tipFactImpConc', $conceptosComp['tipoFactorImpuestoC']);
					$query -> bindParam(':tasaCuotaImpConc', $conceptosComp['tasaCuotaImpuestoC']);
					$query -> bindParam(':importImpConc', $conceptosComp['importeImpuestoC']);
					$query -> bindParam(':IDingre', $idIngreso);
					$resultQuery = $query -> execute();
				}

				if ($paisEmisor != "" && $estadoEmisor != "" && $municipioEmisor != "" && $coloniaEmisor != "") {
					$queryIdDirI = $Conexion -> prepare("SELECT id_ingr_direccion FROM ingresos_direcciones ORDER BY id_ingr_direccion DESC LIMIT 1;");
					$queryIdDirI -> execute();
					$rowsIdDirI = $queryIdDirI -> rowCount();
					if ($rowsIdDirI == 0) {
						$idIngresoDir = 1;
					}else{
						$resultIdDirI = $queryIdDirI -> fetch(PDO::FETCH_ASSOC);
						$idIngresoDir = ($resultIdDirI['id_ingr_direccion'] + 1);
					}

					$queryDirI = $Conexion -> prepare("INSERT INTO ingresos_direcciones(
														id_ingr_direccion,
														ingr_pais,
														ingr_estado,
														ingr_municipio,
														ingr_colonia,
														ingr_no_ext,
														ingr_no_int,
														ingr_calle,
														ingr_cod_post,
														id_ingresos)
											            VALUES(
											            :IDingresoDir,
											            :paisEmis,
											            :estadoEmis,
											            :municipioEmis,
											            :coloniaEmis,
											            :numExtEmis,
											            :numIntEmis,
											            :calleEmis,
											            :codigoPostEmis,
											            :IDingreso);");
					$queryDirI -> bindParam(':IDingresoDir', $idIngresoDir);
					$queryDirI -> bindParam(':paisEmis', $paisEmisor);
					$queryDirI -> bindParam(':estadoEmis', $estadoEmisor);
					$queryDirI -> bindParam(':municipioEmis', $municipioEmisor);
					$queryDirI -> bindParam(':coloniaEmis', $coloniaEmisor);
					$queryDirI -> bindParam(':numExtEmis', $numExtEmisor);
					$queryDirI -> bindParam(':numIntEmis', $numIntEmisor);
					$queryDirI -> bindParam(':calleEmis', $calleEmisor);
					$queryDirI -> bindParam(':codigoPostEmis', $cpEmisor);
					$queryDirI -> bindParam(':IDingreso', $idIngreso);
					$resultDirI = $queryDirI -> execute();
				}
				if($resultRegIngre){
					return $resultRegIngre;
				}
			}
		}
		// Eliminar Ingreso.
		public function eliminarIngreso($idIngreso) {
			$Conexion = new dataBaseConn();
			$band = 0;

			if($band == 0){
				$queryDelIgrCon = $Conexion -> prepare("DELETE FROM ingresos_conceptos WHERE id_ingresos = :IDingre;");
				$queryDelIgrCon -> bindParam(':IDingre', $idIngreso);
				$resultDelIgrCon = $queryDelIgrCon -> execute();

				$queryDelDirI = $Conexion -> prepare("DELETE FROM ingresos_direcciones WHERE id_ingresos = :IDingre;");
				$queryDelDirI -> bindParam(':IDingre', $idIngreso);
				$resultDelDirI = $queryDelDirI -> execute();

				$query = $Conexion -> prepare("DELETE FROM ingresos
					WHERE id_ingresos = :IDingre;");
				$query -> bindParam(':IDingre', $idIngreso);
				$resultDelIngr = $query -> execute();

				if ($resultDelIgrCon && $resultDelDirI && $resultDelIngr) {
					$this -> msj = "Ingreso eliminado exitosamente.";
					return $resultDelIgrCon & $resultDelDirI & $resultDelIngr;
				}
			}
		}
		// Datos de Ingreso.
		public function datosEditarIngreso($idIngreso) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare("SELECT 
										  	ingr.id_ingresos,
											ingr.efecto_comprobante,
											ingr.tipo_comprobante,
											ingr.version_comprobante,
											ingr.lugar_expedicion,
											ingr.fecha,
											ingr.rfc_emisor,
											ingr.razon_social_emisor,
											ingr.regimen_fiscal,
											ingr.rfc_receptor,
											ingr.razon_social_receptor,
											idir.id_ingr_direccion,
											idir.ingr_pais,
											idir.ingr_estado,
											idir.ingr_municipio,
											idir.ingr_colonia,
											idir.ingr_no_ext,
											idir.ingr_no_int,
											idir.ingr_calle,
											idir.ingr_cod_post,
											ingr.uso_cfdi,
											ingr.serie,
											ingr.no_folio,
											ingr.descuento,
											ingr.subtotal,
											ingr.iva,
											ingr.total,
											ingr.moneda_comprobante,
											ingr.metodo_pago,
											ingr.condiciones_pago,
											ingr.forma_pago,
											ingr.fecha_hora_pago,
											ingr.nombre_impuesto,
											ingr.total_impuesto,
											ingr.tipo_factor_impuesto,
											ingr.tasa_cuota_impuesto,
											ingr.no_cuenta,
											ingr.concepto,
											ingr.clasificacion,
											ingr.estado,
											ingr.origen,
											ingr.destino,
											ingr.estado_comprobante,
											ingr.fecha_cancelacion,
											ingr.folio_fiscal,
											ingr.fecha_timbrado, 
											ingr.sello_comprobante,
											ingr.rfc_proveedor
										FROM
										  ingresos ingr
										   LEFT JOIN ingresos_direcciones idir ON ingr.id_ingresos = idir.id_ingresos
										WHERE ingr.id_ingresos = :IDingre;");
			$query -> bindParam(':IDingre', $idIngreso);
			$query -> execute();
			$datosIngreso = $query -> fetch();
			return $datosIngreso;
		}
		// Modificar Ingreso.
		public function modificarIngresos($idIngreso, $EfectoComprobante, $VersionComprobante, $TipoComprobante, $LugarExpedicionComprobante, $Fecha, $Hora, $rfcEmisor, $nombreEmisor, $idIngrDir, $paisEmisor, $estadoEmisor, $municipioEmisor, $coloniaEmisor, $numExtEmisor, $numIntEmisor, $calleEmisor, $cpEmisor, $rfcReceptor, $nombreReceptor, $usoCFDIComprobante, $NumSerie, $NumFolio, $ConceptosComprobante, $Descuento, $SubTotal, $IVA, $Total, $MonedaComprobante, $MetodoPago, $CondicionesPagoComprobante, $FormaPagoComprobante, $FechaHoraPago, $NombreImpuesto, $TotalImpuesto, $TipoFactorImpuesto, $TasaImpuesto, $NumCuenta, $Concepto, $Clasificacion, $Estado, $Origen, $Destino, $EstadoComprobante, $FechaHoraCancel, $RegimenFiscalEmisor, $FolioFiscal, $FechaTimbrado, $HoraTimbrado, $SelloComprobante, $rfcProveedor) {
			$Conexion = new dataBaseConn();
			$band = 0;
			if ($idIngreso != "" && $EfectoComprobante != "" && $VersionComprobante != "" && $TipoComprobante != "" && $LugarExpedicionComprobante != "" && $Fecha != "" && $EfectoComprobante != "" && $Hora != "" && $rfcEmisor != "" && $nombreEmisor != "" && $rfcReceptor != "" && $nombreReceptor != "" && $NumSerie != "" && $NumFolio != "" && $SubTotal != "" && $IVA != "" && $Total != "" && $MonedaComprobante != "" && $MetodoPago != "" && $FormaPagoComprobante != "" && $NombreImpuesto != "" && $TotalImpuesto != "" && $TasaImpuesto != "" && $FolioFiscal != "" && $FechaTimbrado != "" && $HoraTimbrado != "" && $SelloComprobante != "") {
					// Fecha del Comprobante.
					$Fecha = date_format(date_create($Fecha), 'Y-m-d');
					$FechaIngreso = $Fecha." ".$Hora;
					// Fecha Timbrado del Comprobante.
					$FechaTimbrado = date_format(date_create($FechaTimbrado), 'Y-m-d');
					$fechaTimbradoComprobante = $FechaTimbrado." ".$HoraTimbrado;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			
			if ($band == 0) {
				$query = $Conexion -> prepare('SELECT folio_fiscal
											  FROM ingresos
											  WHERE folio_fiscal = :folFiscal AND id_ingresos != :IDingre;');
				$query -> bindParam(':folFiscal', $FolioFiscal);
				$query -> bindParam(':IDingre', $idIngreso);
				$query -> execute();
				$rows = $query -> rowCount();;
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
				$FechaIngreso = trim($FechaIngreso);
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
				$IVA = trim($IVA);
				$Total = trim($Total);
				$MonedaComprobante = trim(mb_strtoupper($MonedaComprobante));
				$MetodoPago = trim(mb_strtoupper($MetodoPago));
				$CondicionesPagoComprobante = trim(mb_strtoupper($CondicionesPagoComprobante));
				$FormaPagoComprobante = trim(mb_strtoupper($FormaPagoComprobante));
				$FechaHoraPago = trim($FechaHoraPago);
				$NombreImpuesto = trim(mb_strtoupper($NombreImpuesto));
				$TotalImpuesto = trim($TotalImpuesto);
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
				// Modificar datos generales del ingreso.
				$queryModIngre = $Conexion -> prepare("UPDATE ingresos
														SET tipo_comprobante = :tipoCompI,
									 						version_comprobante = :versionComp,
									 						lugar_expedicion = :lugarExpedComp,
									 						fecha = :fechaIngreso,
									 						rfc_emisor = :rfcEmisorIngr,
									 						razon_social_emisor = :nomEmisorIngr,
									 						regimen_fiscal = :regFiscalI,
									 						rfc_receptor = :rfcReceptorIngr,
									 						razon_social_receptor = :nomReceptorIngr,
									 						uso_cfdi = :usoCFDI,
									 						serie = :nSerie,
									 						no_folio = :nFolio,
									 						descuento = :descuentoComp,
									 						subtotal = :subtotalI,
									 						iva = :ivaI,
									 						total = :totalI,
									 						moneda_comprobante = :monedaComp,
									 						metodo_pago = :mPagoI,
									 						condiciones_pago = :condiPagoI,
									 						forma_pago = :formaPagoI,
									 						fecha_hora_pago = :fechaHpago,
									 						nombre_impuesto = :impuestoI,
									 						total_impuesto = :totalImpI,
									 						tipo_factor_impuesto = :tFactorImpI,
									 						tasa_cuota_impuesto = :tasaImpI,
									 						no_cuenta = :nCuentaI,
									 						concepto = :conceptoIngr,
									 						clasificacion = :clasificacionIngr,
									 						estado = :estadoIngr,
									 						origen = :origenIngr,
									 						destino = :destinoIngr,
									 						estado_comprobante = :estadoCompIngr,
									 						fecha_cancelacion = :fechaCancelado,
									 						folio_fiscal = :folFiscalI,
									 						fecha_timbrado = :fechaTimbI,
									 						sello_comprobante = :selloComp,
									 						rfc_proveedor = :rfcProv
							 							WHERE id_ingresos = :IDingre;");
				$queryModIngre -> bindParam(':tipoCompI', $TipoComprobante);
				$queryModIngre -> bindParam(':versionComp', $VersionComprobante);
				$queryModIngre -> bindParam(':lugarExpedComp', $LugarExpedicionComprobante);
				$queryModIngre -> bindParam(':fechaIngreso', $FechaIngreso);
				$queryModIngre -> bindParam(':rfcEmisorIngr', $rfcEmisor);
				$queryModIngre -> bindParam(':nomEmisorIngr', $nombreEmisor);
				$queryModIngre -> bindParam(':regFiscalI', $RegimenFiscalEmisor);
				$queryModIngre -> bindParam(':rfcReceptorIngr', $rfcReceptor);
				$queryModIngre -> bindParam(':nomReceptorIngr', $nombreReceptor);
				$queryModIngre -> bindParam(':usoCFDI', $usoCFDIComprobante);
				$queryModIngre -> bindParam(':nSerie', $NumSerie);
				$queryModIngre -> bindParam(':nFolio', $NumFolio);
				$queryModIngre -> bindParam(':descuentoComp', $Descuento);
				$queryModIngre -> bindParam(':subtotalI', $SubTotal);
				$queryModIngre -> bindParam(':ivaI', $IVA);
				$queryModIngre -> bindParam(':totalI', $Total);
				$queryModIngre -> bindParam(':monedaComp', $MonedaComprobante);
				$queryModIngre -> bindParam(':mPagoI', $MetodoPago);
				$queryModIngre -> bindParam(':condiPagoI', $CondicionesPagoComprobante);
				$queryModIngre -> bindParam(':formaPagoI', $FormaPagoComprobante);
				$queryModIngre -> bindParam(':fechaHpago', $fechaYhoraPago);
				$queryModIngre -> bindParam(':impuestoI', $NombreImpuesto);
				$queryModIngre -> bindParam(':totalImpI', $TotalImpuesto);
				$queryModIngre -> bindParam(':tFactorImpI', $TipoFactorImpuesto);
				$queryModIngre -> bindParam(':tasaImpI', $TasaImpuesto);
				$queryModIngre -> bindParam(':nCuentaI', $NumCuenta);
				$queryModIngre -> bindParam(':conceptoIngr', $Concepto);
				$queryModIngre -> bindParam(':clasificacionIngr', $Clasificacion);
				$queryModIngre -> bindParam(':estadoIngr', $Estado);
				$queryModIngre -> bindParam(':origenIngr', $Origen);
				$queryModIngre -> bindParam(':destinoIngr', $Destino);
				$queryModIngre -> bindParam(':estadoCompIngr', $EstadoComprobante);
				$queryModIngre -> bindParam(':fechaCancelado', $fechaYhoraCancel);
				$queryModIngre -> bindParam(':folFiscalI', $FolioFiscal);
				$queryModIngre -> bindParam(':fechaTimbI', $fechaTimbradoComprobante);
				$queryModIngre -> bindParam(':selloComp', $SelloComprobante);
				$queryModIngre -> bindParam(':rfcProv', $rfcProveedor);
				$queryModIngre -> bindParam(':IDingre', $idIngreso);
				$resultModIngre = $queryModIngre -> execute();
				// Modificar Conceptos de los ingresos.
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
					$query = $Conexion -> prepare("UPDATE ingresos_conceptos
													SET clave_concepto_i = :clavConcepto,
														cantidad_concepto_i = :cantConcepto,
														clave_unidad_concepto_i = :clavUnidConcepto,
														unidad_concepto_i = :unidConcepto,
														descripcion_concepto_i = :descripConcepto,
														valor_unitario_concepto_i = :valUnitConcepto,
														importe_concepto_i = :importConcepto,
														base_impuesto_concepto_i = :baseImpConcepto,
														impuesto_concepto_i = :impConcepto,
														tipofactor_impuesto_concepto_i = :tipFactImpConc,
														tasacuota_impuesto_concepto_i = :tasaCuotaImpConc,
														importe_impuesto_concepto_i = :importImpConc
													WHERE id_ingresos_conceptos = :IDingrConcepto;");
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
					$query -> bindParam(':IDingrConcepto', trim($conceptosComp['idCoIng']));
					$resultQuery = $query -> execute();
				}
				// Verifica que esten definidos los datos de dirección del Emisor.
				if (isset($idIngrDir) && isset($paisEmisor) && isset($estadoEmisor) && isset($municipioEmisor) && isset($coloniaEmisor) && isset($numExtEmisor) && isset($numIntEmisor) && isset($calleEmisor) && isset($cpEmisor)) {
					// Modificar dirección del Emisor, en caso de que exista.
					if ($paisEmisor != "" && $estadoEmisor != "" && $municipioEmisor != "" && $coloniaEmisor != "") {
						// Modificar egresos direcciones.
						$queryDirIngr = $Conexion -> prepare("UPDATE ingresos_direcciones
															  SET ingr_pais = :paisEmis,
																  ingr_estado = :estadoEmis,
																  ingr_municipio = :municipioEmis,
																  ingr_colonia = :coloniaEmis,
																  ingr_no_ext = :numExtEmis,
																  ingr_no_int = :numIntEmis,
																  ingr_calle = :calleEmis,
																  ingr_cod_post = :codigoPostEmis
															  WHERE id_ingr_direccion = :IDingresoDir;");
						$queryDirIngr -> bindParam(':paisEmis', $paisEmisor);
						$queryDirIngr -> bindParam(':estadoEmis', $estadoEmisor);
						$queryDirIngr -> bindParam(':municipioEmis', $municipioEmisor);
						$queryDirIngr -> bindParam(':coloniaEmis', $coloniaEmisor);
						$queryDirIngr -> bindParam(':numExtEmis', $numExtEmisor);
						$queryDirIngr -> bindParam(':numIntEmis', $numIntEmisor);
						$queryDirIngr -> bindParam(':calleEmis', $calleEmisor);
						$queryDirIngr -> bindParam(':codigoPostEmis', $cpEmisor);
						$queryDirIngr -> bindParam(':IDingresoDir', $idIngrDir);
						$resultDirIngr = $queryDirIngr -> execute();
					}
				} // Fin de verificación de dirección del Emisor.
				if($resultModIngre == TRUE){
					header("Location: listar_ingresos.php");
					return $resultModIngre;
				}
			}
		}
	}
?>