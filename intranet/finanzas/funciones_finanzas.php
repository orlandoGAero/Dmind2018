<?php
	/**
	* 
	*/
	class funciones_finanzas {
		public function cargarXML($nombreArchivo,$nombreArchivoTemporal,$tipo){
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
																'claveConceptoE'=>'',
																'cantidadConceptoE'=>trim($concepto['cantidad']),
																'claveUnidadConceptoE'=>'',
																'unidadConceptoE'=>trim($concepto['unidad']),
																'descripcionConceptoE'=>trim($concepto['descripcion']),
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
																'claveConceptoE'=>trim($concepto['ClaveProdServ']),
																'cantidadConceptoE'=>trim($concepto['Cantidad']),
																'claveUnidadConceptoE'=>trim($concepto['ClaveUnidad']),
																'unidadConceptoE'=>trim($concepto['Unidad']),
																'descripcionConceptoE'=>trim($concepto['Descripcion']),
																'valorUnitarioConceptoE'=>trim($concepto['ValorUnitario']),
																'importeConceptoE'=>trim($concepto['Importe'])
															);				
						}

						foreach ($xml -> xpath('//c:Comprobante//c:Conceptos//c:Concepto//c:Impuestos//c:Traslados//c:Traslado') as $impuestosConceptos) {
							$impuestosConceptosComprobante[] = array(
																		'baseConceptoE'=>trim($impuestosConceptos['Base']),
																		'impuestoConceptoE'=>trim($impuestosConceptos['Impuesto']),
																		'tipoFactorConceptoE'=>trim($impuestosConceptos['TipoFactor']),
																		'tasaCuotaConceptoE'=>trim($impuestosConceptos['TasaOCuota']),
																		'importeImpuestoConceptoE'=>trim($impuestosConceptos['Importe'])
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
					$query = "SELECT id_dfiscales_e FROM datos_fiscales_empresa WHERE razon_social_e = '".$nombreEmisor."' AND rfc_e = '".$rfcEmisor."';";
					$result = mysql_query($query) or die(mysql_error());
					$rows = mysql_num_rows($result);
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
		}

		public function obtenerRFCProveedores($rfcEmisor){
			$queryRFCPr = "SELECT rfc_prov FROM proveedores_datos_fiscales WHERE rfc_prov = '".$rfcEmisor."';";
			$resultRFCPr = mysql_query($queryRFCPr);
			$rowsRFCPr = mysql_num_rows($resultRFCPr);
			if ($rowsRFCPr != 0) {
				$this -> msjErr = "Proveedor con el RFC: ".$rfcEmisor." guardado anteriormente.";
			}
		}

		public function registrarEgresos($EfectoComprobante,
										$VersionComprobante,
										$TipoComprobante,
										$LugarExpedicionComprobante,
										$Fecha,
										$Hora,
										$rfcEmisor,
										$nombreEmisor,
										$guardarProv,
										$paisEmisor,
										$estadoEmisor,
										$municipioEmisor,
										$coloniaEmisor,
										$numExtEmisor,
										$numIntEmisor,
										$calleEmisor,
										$cpEmisor,
										$rfcReceptor,
										$nombreReceptor,
										$usoCFDIComprobante,
										$NumSerie,
										$NumFolio,
										$ConceptosComprobante,
										$Descuento,
										$SubTotal,
										$IVA,
										$Total,
										$MonedaComprobante,
										$MetodoPago,
										$CondicionesPagoComprobante,
										$FormaPagoComprobante,
										$FechaHoraPago,
										$NombreImpuesto,
										$TotalImpuesto,
										$TipoFactorImpuesto,
										$TasaImpuesto,
										$NumCuenta,
										$Concepto,
										$Clasificacion,
										$Estado,
										$Origen,
										$Destino,
										$EstadoComprobante,
										$FechaHoraCancel,
										$RegimenFiscalEmisor,
										$FolioFiscal,
										$FechaTimbrado,
										$HoraTimbrado,
										$SelloComprobante,
										$rfcProveedor){
			$band = 0;

			if ($EfectoComprobante != "" && $VersionComprobante != "" && $TipoComprobante != "" && $LugarExpedicionComprobante != "" && $Fecha != "" && $EfectoComprobante != "" && $Hora != "" && $rfcEmisor != "" && $nombreEmisor != "" && $rfcReceptor != "" && $nombreReceptor != "" && $NumSerie != "" && $NumFolio != "" && $SubTotal != "" && $IVA != "" && $Total != "" && $MonedaComprobante != "" && $MetodoPago != "" && $FormaPagoComprobante != "" && $NombreImpuesto != "" && $TotalImpuesto != "" && $TasaImpuesto != "" && $FolioFiscal != "" && $FechaTimbrado != "" && $HoraTimbrado != "" && $SelloComprobante != "") {
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
					$queryRFCPr = "SELECT rfc_prov FROM proveedores_datos_fiscales WHERE rfc_prov = '".$rfcEmisor."';";
					$resultRFCPr = mysql_query($queryRFCPr);
					$rowsRFCPr = mysql_num_rows($resultRFCPr);
					if ($rowsRFCPr != 0) {
						$this -> msjErr = "Proveedor con el RFC: ".$rfcEmisor." guardado anteriormente.";
						$band = 1;
					}
				}
				$query = "SELECT folio_fiscal
						  FROM egresos
						  WHERE folio_fiscal = '".$FolioFiscal."'";
				$result = mysql_query($query) or die(mysql_error());
				$rows = mysql_num_rows($result);
				if($rows != 0){
					$this -> msjErr = "Ya se encuentra guardado el registro con el folio fiscal: ".$FolioFiscal.".";
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
					$fechaYhoraPago = "NULL";
					$fechaYhoraCancel = "NULL";
				}elseif($FechaHoraPago != "" && $FechaHoraCancel == "") {
					$fechaYhoraPago = date_format(date_create($FechaHoraPago),'Y-m-d');
					$fechaYhoraPago = "'".$fechaYhoraPago."'";
					$fechaYhoraCancel = "NULL";
				}elseif($FechaHoraPago == "" && $FechaHoraCancel != ""){
					$fechaYhoraPago = "NULL";
					$fechaYhoraCancel = date_format(date_create($FechaHoraCancel),'Y-m-d');
					$fechaYhoraCancel = "'".$fechaYhoraCancel."'";
				}else{
					$fechaYhoraPago = date_format(date_create($FechaHoraPago),'Y-m-d');
					$fechaYhoraPago = "'".$fechaYhoraPago."'";
					$fechaYhoraCancel = date_format(date_create($FechaHoraCancel),'Y-m-d');
					$fechaYhoraCancel = "'".$fechaYhoraCancel."'";
				}

				$queryIdEgre = "SELECT idegresos FROM egresos ORDER BY idegresos DESC LIMIT 1;";
				$resultIdEgre = mysql_query($queryIdEgre);
				$rowsIdEgre = mysql_num_rows($resultIdEgre);
				if ($rowsIdEgre == 0) {
					$idEgreso = 1;
				}else{
					$idEgreso = (mysql_result($resultIdEgre,0,'idegresos') + 1);
				}

				$consultaEgr = "INSERT INTO egresos (
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
				 								rfc_proveedor,
				 								guardar_prov
			 						 		)
			 						VALUES (
						 						".$idEgreso.",
			 								  	'".$EfectoComprobante."',
				 								'".$TipoComprobante."',
				 								'".$VersionComprobante."',
				 								'".$LugarExpedicionComprobante."',
				 								'".$FechaEgreso."',
				 								'".$rfcEmisor."',
				 								'".$nombreEmisor."',
				 								'".$RegimenFiscalEmisor."',
				 								'".$rfcReceptor."',
				 								'".$nombreReceptor."',
				 								'".$usoCFDIComprobante."',
				 								'".$NumSerie."',
				 								".$NumFolio.",
				 								".$Descuento.",
				 								".$SubTotal.",
				 								".$IVA.",
				 								".$Total.",
				 								'".$MonedaComprobante."',
				 								'".$MetodoPago."',
				 								'".$CondicionesPagoComprobante."',
				 								'".$FormaPagoComprobante."',
				 								".$fechaYhoraPago.",
				 								'".$NombreImpuesto."',
				 								".$TotalImpuesto.",
				 								'".$TipoFactorImpuesto."',
				 								".$TasaImpuesto.",
				 								'".$NumCuenta."',
				 								'".$Concepto."',
				 								'".$Clasificacion."',
				 								'".$Estado."',
				 								'".$Origen."',
				 								'".$Destino."',
				 								'".$EstadoComprobante."',
				 								".$fechaYhoraCancel.",
				 								'".$FolioFiscal."',
				 								'".$fechaTimbradoComprobante."',
				 								'".$SelloComprobante."',
				 								'".$rfcProveedor."',
				 								'".$guardarProv."'
				 							);";
				$ejecutarConsultaEgr = mysql_query($consultaEgr) or die(mysql_error());

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
					$query = "INSERT INTO egresos_conceptos (
																clave_concepto_e,
																cantidad_concepto_e,
																clave_unidad_concepto_e,
																unidad_concepto_e,
																descripcion_concepto_e,
																valor_unitario_concepto_e,
																importe_concepto_e,
																base_impuesto_concepto_e,
																impuesto_concepto_e,
																tipofactor_impuesto_concepto_e,
																tasacuota_impuesto_concepto_e,
																importe_impuesto_concepto_e,
																id_egresos
															)
													VALUES (
																'".$conceptosComp['claveC']."',
																".$conceptosComp['cantidadC'].",
																'".$conceptosComp['claveUnidadC']."',
																'".$conceptosComp['unidadC']."',
																'".$conceptosComp['descripcionC']."',
																".$conceptosComp['valorUnitarioC'].",
																".$conceptosComp['importeC'].",
																".$conceptosComp['baseImpuestoC'].",
																'".$conceptosComp['impuestoC']."',
																'".$conceptosComp['tipoFactorImpuestoC']."',
																".$conceptosComp['tasaCuotaImpuestoC'].",
																".$conceptosComp['importeImpuestoC'].",
																".$idEgreso."
															);";
					$resultQuery = mysql_query($query) or die(mysql_error()." ConceptosEgresos");
				}

				if ($paisEmisor != "" && $estadoEmisor != "" && $municipioEmisor != "" && $coloniaEmisor != "") {
					$queryIdDir = "SELECT id_e_direccion FROM egresos_direcciones ORDER BY id_e_direccion DESC LIMIT 1;";
					$resultIdDir = mysql_query($queryIdDir);
					$rowsIdDir = mysql_num_rows($resultIdDir);
					if ($rowsIdDir == 0) {
						$idEgrDir = 1;
					}else{
						$idEgrDir = (mysql_result($resultIdDir,0,'id_e_direccion') + 1);
					}

					$queryDir = "INSERT INTO egresos_direcciones (id_e_direccion,ed_pais,ed_estado,ed_municipio,ed_colonia,ed_no_ext,ed_no_int,ed_calle,ed_cod_post,id_egresos)
					             VALUES (".$idEgrDir.",'".$paisEmisor."','".$estadoEmisor."','".$municipioEmisor."','".$coloniaEmisor."','".$numExtEmisor."','".$numIntEmisor."','".$calleEmisor."','".$cpEmisor."',".$idEgreso.");";
					$resultDir = mysql_query($queryDir);
				}

				if ($guardarProv == 'Si') {
					// Incremento de id proveedor.
					$queryIdProv = "SELECT id_proveedor FROM proveedores ORDER BY id_proveedor DESC LIMIT 1;";
					$resultIdProv = mysql_query($queryIdProv);
					$rowsIdProv = mysql_num_rows($resultIdProv);
					if ($rowsIdProv == 0) {
						$idProveedor = 1;
					}else{
						$idProveedor = (mysql_result($resultIdProv, 0, 'id_proveedor') + 1);
					}
					// Insertar proveedor.
					$queryProv = "INSERT INTO proveedores
								  (
								  	id_proveedor,
								  	fecha_registro
								  )
								  VALUES
								  (
								  	".$idProveedor.",
								  	NOW()
								  );";
					$resultProv = mysql_query($queryProv);
					// Insertar Datos Fiscales Proveedor.
					if ($resultProv) {
						$queryDatFisProv = "INSERT INTO proveedores_datos_fiscales 
											(
												razon_social_prov,
												rfc_prov,
												id_proveedor
											)
								  			VALUES
								  			(
								  				'".$nombreEmisor."',
								  				'".$rfcEmisor."',
								  				".$idProveedor."
								  			);";
						$resultDatFisProv = mysql_query($queryDatFisProv);
					}
					// Incremento de id direccion.
					$queryIdProvDir = "SELECT idprov_direccion FROM proveedores_direcciones ORDER BY idprov_direccion DESC LIMIT 1;";
					$resultIdProvDir = mysql_query($queryIdProvDir);
					$rowsIdProvDir = mysql_num_rows($resultIdProvDir);
					if ($rowsIdProvDir == 0) {
						$idDireccionProv = 1;
					}else{
						$idDireccionProv = (mysql_result($resultIdProvDir, 0, 'idprov_direccion') + 1);
					}
					// Insertar Dirección Proveedor.
					if ($paisEmisor != "" && $estadoEmisor != "" && $municipioEmisor != "" && $coloniaEmisor != "" && $numExtEmisor != "" && $calleEmisor != "" && $cpEmisor != "") {
						$queryDirProv = "INSERT INTO proveedores_direcciones
										 (
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
								  		 VALUES
								  		 (
								  		 	".$idDireccionProv.",
											'".$calleEmisor."',
											'".$numExtEmisor."',
											'".$numIntEmisor."',
											'".$coloniaEmisor."',
											'".$municipioEmisor."',
											'".$estadoEmisor."',
											'".$paisEmisor."',
											'".$cpEmisor."'
								  		 );";
						$resultDirProv = mysql_query($queryDirProv);
						if ($resultDirProv) {
							$queryDetProvDir = "INSERT INTO detalle_proveedores_direcciones
												(
													id_proveedor,
													idprov_direccion,
													tipo_direccion
												)
												VALUES
												(
													".$idProveedor.",
													".$idDireccionProv.",
													'FISICA Y FISCAL'
												);";
							$resultDetProvDir = mysql_query($queryDetProvDir);
						}
					}
				}

				if($ejecutarConsultaEgr){
					return $ejecutarConsultaEgr;
				}
			}
		}

		// Tabla de Egresos
		public function obtenerDatosEgresos(){
			$consulta = "SELECT 
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
						  eg.fecha_hora_pago,
						  eg.no_cuenta,
						  eg.concepto,
						  eg.clasificacion,
						  eg.estado
						FROM egresos eg;";
			$ejecutarConsulta = mysql_query($consulta);

			$datosEgresos = array();
			while($filas = mysql_fetch_assoc($ejecutarConsulta)){
				$datosEgresos[] = $filas;
			} 
			return $datosEgresos;
		}

		// Detalle de Egresos.
		public function obtenerDetEg($id_eg) {
			$sql = "SELECT 
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
					  eg.fecha_hora_pago,
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
					WHERE eg.idegresos = " . $id_eg;
			$ejecutar = mysql_query($sql) or die(mysql_error());

			$filas = mysql_fetch_assoc($ejecutar);
				$DetEgresos = $filas;
			
			return $DetEgresos;
		}

		//Conceptos Detalle Egresos.
		public function conceptosDetalleEgresos($idEgreso) {
			$sql = "SELECT 
						egcon.clave_concepto_e,
						egcon.cantidad_concepto_e,
						egcon.clave_unidad_concepto_e,
						egcon.unidad_concepto_e,
						egcon.descripcion_concepto_e,
						egcon.valor_unitario_concepto_e,
						egcon.importe_concepto_e,
						egcon.base_impuesto_concepto_e,
						egcon.impuesto_concepto_e,
						egcon.tipofactor_impuesto_concepto_e,
						egcon.tasacuota_impuesto_concepto_e,
						egcon.importe_impuesto_concepto_e
					FROM
					 	egresos_conceptos egcon 
						 LEFT JOIN egresos eg ON eg.idegresos = egcon.id_egresos
					WHERE egcon.id_egresos = " . $idEgreso;
			$ejecutar = mysql_query($sql) or die(mysql_error());

			$conceptosEgresos = array();
			while($filas = mysql_fetch_assoc($ejecutar)){
				$conceptosEgresos[] = $filas;
			}			
			return $conceptosEgresos;
		}

		// Obtener datos para la modificación de Egresos.
		public function obtenerDatModificarEg($idE){
			$query = "SELECT 
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
					  eg.fecha_hora_pago,
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
					  eg.rfc_proveedor,
					  eg.guardar_prov
					FROM egresos eg
					 LEFT JOIN egresos_direcciones edir ON eg.idegresos = edir.id_egresos
					WHERE eg.idegresos = " . $idE;
			$ejecutar = mysql_query($query) or die(mysql_error());

			$fila = mysql_fetch_assoc($ejecutar);
			$datosEgreso = $fila;
			
			return $datosEgreso;
		}

		// Modificación de Egresos.
		public function modificarEgresos($idEgr,$NumSerie,$NumFolio,$Fecha,$Hora,$SubTotal,$Total,$MetodoPago,$EfectoComprobante,$FolioFiscal,
									$rfcEmisor,$nombreEmisor,
									$rfcReceptor,$nombreReceptor,
									$IVA,$tipoImpuesto,
									$NumCuenta,$Concepto,$Clasificacion,$Estado,$Origen,$Destino,$estadoComprobante,
									$FechaHoraPago,$FechaHoraCancel,
									$guardarProv) {
			$band = 0;

			if ($NumSerie != "" && $NumFolio != "" && $Fecha != "" && $Hora != "" && $SubTotal != "" && $Total != "" && $MetodoPago != "" && $EfectoComprobante != "" && $FolioFiscal != "" &&
			 	$rfcEmisor != "" && $nombreEmisor != "" &&
			 	$rfcReceptor != "" && $nombreReceptor != "" &&
			 	$IVA != "" && $tipoImpuesto != "") {
					$Fecha = date_format(date_create($Fecha),'Y-m-d');
					$FechaEgreso = $Fecha." ".$Hora;
			}else {
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}

			if ($band == 0) {
				if ($guardarProv == 'Si') {
					$queryRFCPr = "SELECT rfc FROM datos_fiscales WHERE rfc = '".$rfcEmisor."';";
					$resultRFCPr = mysql_query($queryRFCPr);
					$rowsRFCPr = mysql_num_rows($resultRFCPr);
					if ($rowsRFCPr != 0) {
						$this -> msjErr = "Proveedor con el RFC: ".$rfcEmisor." guardado anteriormente.";
						$band = 1;
					}
				}
				$query = "SELECT idegresos, folio_fiscal
						  FROM egresos
						  WHERE folio_fiscal = '".$FolioFiscal."' AND idegresos != ".$idEgr;
				$result = mysql_query($query) or die(mysql_error());
				$rows = mysql_num_rows($result);
				if($rows != 0){
					$this -> msjErr = "Ya se encuentra guardado el registro con el folio fiscal: ".$FolioFiscal.".";
					$band = 1;
				}
			}

			if ($band == 0) {
				$NumSerie = trim(mb_strtoupper($NumSerie));
				$NumFolio = trim($NumFolio);
				$FechaEgreso = trim($FechaEgreso);
				$SubTotal = trim($SubTotal);
				$Total = trim($Total);
				$MetodoPago = trim(mb_strtoupper($MetodoPago));
				$EfectoComprobante = trim(mb_strtoupper($EfectoComprobante));
				$FolioFiscal = trim($FolioFiscal);
				$rfcEmisor = trim(mb_strtoupper($rfcEmisor));
				$nombreEmisor = trim(mb_strtoupper($nombreEmisor));
				$rfcReceptor = trim(mb_strtoupper($rfcReceptor));
				$nombreReceptor = trim(mb_strtoupper($nombreReceptor));
				$IVA = trim($IVA);
				$tipoImpuesto = trim(mb_strtoupper($tipoImpuesto));
				$NumCuenta = trim($NumCuenta);
				$Concepto = trim($Concepto);
				$Clasificacion = trim($Clasificacion);
				$Estado = trim($Estado);
				$Origen = trim($Origen);
				$Destino = trim($Destino);
				$estadoComprobante = trim(mb_strtoupper($estadoComprobante));
				$FechaHoraPago = trim($FechaHoraPago);
				$FechaHoraCancel = trim($FechaHoraCancel);

				if($FechaHoraPago == "" && $FechaHoraCancel == ""){
					$complementoQuery = "fecha_hora_pago = NULL, fecha_cancelacion = NULL";
				}elseif($FechaHoraPago != "" && $FechaHoraCancel == "") {
					$FechaHoraPago = date_format(date_create($FechaHoraPago),'Y-m-d H:i:s');
					$complementoQuery = "fecha_hora_pago = '".$FechaHoraPago."', fecha_cancelacion = NULL";
				}elseif($FechaHoraPago == "" && $FechaHoraCancel != ""){
					$FechaHoraCancel = date_format(date_create($FechaHoraCancel),'Y-m-d H:i:s');
					$complementoQuery = "fecha_hora_pago = NULL, fecha_cancelacion = '".$FechaHoraCancel."'";
				}else{
					$FechaHoraPago = date_format(date_create($FechaHoraPago),'Y-m-d H:i:s');
					$FechaHoraCancel = date_format(date_create($FechaHoraCancel),'Y-m-d H:i:s');
					$complementoQuery = "fecha_hora_pago = '".$FechaHoraPago."', fecha_cancelacion = '".$FechaHoraCancel."'";
				}

				$sql = "UPDATE egresos
						SET serie = '".$NumSerie."', no_folio = ".$NumFolio.", fecha = '".$FechaEgreso."', subtotal = ".$SubTotal.", total = ".$Total.", metodo_pago = '".$MetodoPago."', efecto_comprobante = '".$EfectoComprobante."',
						  	folio_fiscal = '".$FolioFiscal."', rfc_emisor = '".$rfcEmisor."', razon_social_emisor = '".$nombreEmisor."',
						  	rfc_receptor = '".$rfcReceptor."', razon_social_receptor = '".$nombreReceptor."',
								iva = ".$IVA.", nombre_impuesto = '".$tipoImpuesto."', no_cuenta = '".$NumCuenta."', concepto = '".$Concepto."', clasificacion = '".$Clasificacion."', 
								estado = '".$Estado."', origen = '".$Origen."', destino = '".$Destino."', estado_comprobante = '".$estadoComprobante."',
								".$complementoQuery.", guardar_prov = '".$guardarProv."'
						WHERE idegresos =" . $idEgr;
				$execute = mysql_query($sql) or die("Error Update: ".mysql_error());

				if ($guardarProv == 'Si') {
					// Incremento de id proveedor.
					$queryIdProv = "SELECT id_proveedor FROM proveedores ORDER BY id_proveedor DESC LIMIT 1;";
					$resultIdProv = mysql_query($queryIdProv);
					$rowsIdProv = mysql_num_rows($resultIdProv);
					if ($rowsIdProv == 0) {
						$idProveedor = 1;
					}else{
						$idProveedor = (mysql_result($resultIdProv, 0, 'id_proveedor') + 1);
					}
					// Insertar proveedor.
					$queryProv = "INSERT INTO proveedores
								  (
								  	id_proveedor,
								  	fecha_registro
								  )
								  VALUES
								  (
								  	".$idProveedor.",
								  	NOW()
								  );";
					$resultProv = mysql_query($queryProv);
					// Insertar Datos Fiscales Proveedor.
					if ($resultProv) {
						$queryDatFisProv = "INSERT INTO proveedores_datos_fiscales 
											(
												razon_social_prov,
												rfc_prov,
												id_proveedor
											)
								  			VALUES
								  			(
								  				'".$nombreEmisor."',
								  				'".$rfcEmisor."',
								  				".$idProveedor."
								  			);";
						$resultDatFisProv = mysql_query($queryDatFisProv);
					}
					// Incremento de id direccion.
					$queryIdProvDir = "SELECT idprov_direccion FROM proveedores_direcciones ORDER BY idprov_direccion DESC LIMIT 1;";
					$resultIdProvDir = mysql_query($queryIdProvDir);
					$rowsIdProvDir = mysql_num_rows($resultIdProvDir);
					if ($rowsIdProvDir == 0) {
						$idDireccionProv = 1;
					}else{
						$idDireccionProv = (mysql_result($resultIdProvDir, 0, 'idprov_direccion') + 1);
					}
					// Insertar Dirección Proveedor.
					if ($paisEmisor != "" && $estadoEmisor != "" && $municipioEmisor != "" && $coloniaEmisor != "" && $numExtEmisor != "" && $calleEmisor != "" && $cpEmisor != "") {
						$queryDirProv = "INSERT INTO proveedores_direcciones
										 (
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
								  		 VALUES
								  		 (
								  		 	".$idDireccionProv.",
											'".$calleEmisor."',
											'".$numExtEmisor."',
											'".$numIntEmisor."',
											'".$coloniaEmisor."',
											'".$municipioEmisor."',
											'".$estadoEmisor."',
											'".$paisEmisor."',
											'".$cpEmisor."'
								  		 );";
						$resultDirProv = mysql_query($queryDirProv);
						if ($resultDirProv) {
							$queryDetProvDir = "INSERT INTO detalle_proveedores_direcciones
												(
													id_proveedor,
													idprov_direccion,
													tipo_direccion
												)
												VALUES
												(
													".$idProveedor.",
													".$idDireccionProv.",
													'FISICA Y FISCAL'
												);";
							$resultDetProvDir = mysql_query($queryDetProvDir);
						}
					}
				}
				
				if($execute == true){
					header("Location: listar_egresos.php");
				}
			}
		}

		// Eliminar Egresos.
		public function DeleteEgre($idEgre)	{
			$band = 0;

			if($band == 0){
				$queryDelEgCon = "DELETE FROM egresos_conceptos WHERE id_egresos = ".$idEgre.";";
				$resultDelEgCon = mysql_query($queryDelEgCon);

				$queryDelDirE = "DELETE FROM egresos_direcciones WHERE id_egresos = ".$idEgre.";";
				$resultDelDirE = mysql_query($queryDelDirE);

				$sql = "DELETE FROM egresos
					WHERE idegresos =" . $idEgre;
				$result = mysql_query($sql);

				if ($resultDelEgCon && $resultDelDirE && $result) {
					$this -> msj = "Egreso eliminado exitosamente.";
					return $resultDelEgCon & $resultDelDirE & $result;
				}
			}
		}

		#INICIO de Funciones para Obtener de la BD Información que llena las Listas Desplegables.
			// Conceptos
			public function listaConceptos() {
				$queryConcp = "SELECT nom_concepto
							   FROM conceptos_comprobantes
							   ORDER BY nom_concepto;";
				$resultConcp = mysql_query($queryConcp);

				$conceptos = array();
				while ($rowsConcp = mysql_fetch_assoc($resultConcp)) {
					$conceptos [] = $rowsConcp;
				}
				return $conceptos;
			}

			// Clasificaciones
			public function listaClasificaciones() {
				$queryClasif = "SELECT nom_clasifi
							    FROM clasificacion_comprobantes
							    ORDER BY nom_clasifi;";
				$resultClasif = mysql_query($queryClasif);
				
				$clasificaciones = array();
				while ($rowsClasif = mysql_fetch_assoc($resultClasif)) {
					$clasificaciones [] = $rowsClasif;
				}
				return $clasificaciones;
			}

			// Status
			public function listaStatus() {
				$queryStat = "SELECT nom_status
							  FROM status_comprobantes
							  ORDER BY nom_status;";
				$resultStat = mysql_query($queryStat);
				
				$status = array();
				while ($rowsStat = mysql_fetch_assoc($resultStat)) {
					$status [] = $rowsStat;
				}
				return $status;
			}

			// Origenes
			public function listaOrigenes() {
				$queryOrig = "SELECT nom_origen
							  FROM origenes_comprobantes
							  ORDER BY nom_origen;";
				$resultOrig = mysql_query($queryOrig);
				
				$origenes = array();
				while ($rowsOrig = mysql_fetch_assoc($resultOrig)) {
					$origenes [] = $rowsOrig;
				}
				return $origenes;
			}

			// Destinos
			public function listaDestinos() {
				$queryDest = "SELECT nom_destino
							  FROM destinos_comprobantes
							  ORDER BY nom_destino;";
				$resultDest = mysql_query($queryDest);
				
				$destinos = array();
				while ($rowsDest = mysql_fetch_assoc($resultDest)) {
					$destinos [] = $rowsDest;
				}
				return $destinos;
			}
		#FIN de Funciones para Obtener de la BD Información que llena las Listas Desplegables.

		#INICIO de Funciones para Obtener de la BD Información que llena las Listas Desplegables...
			#...datos diferentes al seleccionado(Se utilizan para la modificación de Egresos).
			
			// Conceptos Diferentes
			public function listaConceptosDiff($nomConcepto) {
				$queryConcp = "SELECT nom_concepto
							   FROM conceptos_comprobantes
							   WHERE nom_concepto != '".$nomConcepto."'
							   ORDER BY nom_concepto;";
				$resultConcp = mysql_query($queryConcp);

				$DiffConceptos = array();
				while ($rowsConcp = mysql_fetch_assoc($resultConcp)) {
					$DiffConceptos [] = $rowsConcp;
				}
				return $DiffConceptos;
			}

			// Clasificaciones Diferentes
			public function listaClasificacionesDiff($nomClasificacion) {
				$queryClasif = "SELECT nom_clasifi
							    FROM clasificacion_comprobantes
							    WHERE nom_clasifi != '".$nomClasificacion."'
							    ORDER BY nom_clasifi;";
				$resultClasif = mysql_query($queryClasif);
				
				$DiffClasificaciones = array();
				while ($rowsClasif = mysql_fetch_assoc($resultClasif)) {
					$DiffClasificaciones [] = $rowsClasif;
				}
				return $DiffClasificaciones;
			}

			// Status Diferentes
			public function listaStatusDiff($nomStatus) {
				$queryStat = "SELECT nom_status
							  FROM status_comprobantes
							  WHERE nom_status != '".$nomStatus."'
							  ORDER BY nom_status;";
				$resultStat = mysql_query($queryStat);
				
				$Diffstatus = array();
				while ($rowsStat = mysql_fetch_assoc($resultStat)) {
					$Diffstatus [] = $rowsStat;
				}
				return $Diffstatus;
			}

			// Origenes Diferentes
			public function listaOrigenesDiff($nomOrigen) {
				$queryOrig = "SELECT nom_origen
							  FROM origenes_comprobantes
							  WHERE nom_origen != '".$nomOrigen."'
							  ORDER BY nom_origen;";
				$resultOrig = mysql_query($queryOrig);
				
				$Difforigenes = array();
				while ($rowsOrig = mysql_fetch_assoc($resultOrig)) {
					$Difforigenes [] = $rowsOrig;
				}
				return $Difforigenes;
			}

			// Destinos Diferentes
			public function listaDestinosDiff($nomDestino) {
				$queryDest = "SELECT nom_destino
							  FROM destinos_comprobantes
							  WHERE nom_destino != '".$nomDestino."'
							  ORDER BY nom_destino;";
				$resultDest = mysql_query($queryDest);
				
				$Diffdestinos = array();
				while ($rowsDest = mysql_fetch_assoc($resultDest)) {
					$Diffdestinos [] = $rowsDest;
				}
				return $Diffdestinos;
			}
		#FIN de Funciones para Obtener de la BD Información que llena las Listas Desplegables...
			#...datos diferentes al seleccionado(Se utilizan para la modificación de Egresos).

		// Buscar Egresos
		// public function filtrarEgresos($fechaE,$nombreEmisorE,$totalE,$metodoPagoE,$fechaHoraPagoE,$numCuentaE,$conceptoE,$clasificacionE,$statusE){
		// 	$filtroE = "";

		// 	if (empty($filtroE) && !empty($fechaE)) {
		// 		$filtroE .= " fecha LIKE '".$fechaE."%' ";
		// 	}

		// 	if (empty($filtroE) && !empty($nombreEmisorE)) {
		// 		$filtroE .= " razon_social_emisor LIKE '".$nombreEmisorE."%' ";
		// 	}else{
		// 		$filtroE .= " AND razon_social_emisor LIKE '".$nombreEmisorE."%' ";
		// 	}

		// 	if ($filtroE != "") {
		// 		echo $consulta = "SELECT * FROM egresos WHERE ".$filtroE." ORDER BY fecha ASC";
		// 		$ejecutarQuery = mysql_query($consulta);	

		// 		$resultadoFiltro = array();
		// 		while ($rows = mysql_fetch_assoc($ejecutarQuery)) {
		// 			$resultadoFiltro[] = $rows;
		// 		}
		// 		return $resultadoFiltro;
		// 	}
		// }

	}
?>