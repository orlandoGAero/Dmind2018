<?php
	require '../class/dataBaseConn.php';
	class Proveedores {
		public function listarProveedores(){
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT p.id_proveedor,
												p.nom_proveedor,
												p.tel_proveedor,
												p.email_proveedor,
												p.url_proveedor,
												p.fecha_registro,
												cap.nombre_cat_prov,
												pdt.rfc_prov,
												pd.calle_p,
												pd.num_ext_p,
												pd.num_int_p,
												pd.municipio_p,
												pd.estado_p
										 FROM proveedores p
										  LEFT JOIN detalle_categorias_proveedores dcatp
										   ON p.id_proveedor = dcatp.id_proveedor 
										  LEFT JOIN categorias_proveedor cap
										   ON cap.id_cat_prov = dcatp.id_cat_prov
										  LEFT JOIN detalle_proveedores_direcciones dpd
										  ON p.id_proveedor = dpd.id_proveedor
										 LEFT JOIN proveedores_direcciones pd
										  ON pd.idprov_direccion = dpd.idprov_direccion
										 INNER JOIN proveedores_datos_fiscales pdt
										  ON p.id_proveedor = pdt.id_proveedor
										 WHERE (dpd.tipo_direccion IS NULL)
										  OR (dpd.tipo_direccion IS NOT NULL
										  		AND dpd.tipo_direccion LIKE :tipDir)
										 ORDER BY p.id_proveedor;');
			$tipoDireccion = "%FISCAL%";
			$sth -> bindParam(':tipDir', $tipoDireccion);
			$sth -> execute();
			$datosProv = $sth -> fetchAll();
			return $datosProv;
		}
		public function detalleProveedor($idProveedor){
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT 
										  p.id_proveedor,
										  cp.nombre_cat_prov,
										  p.nom_proveedor,
										  p.tel_proveedor,
										  p.email_proveedor,
										  p.url_proveedor,
										  p.fecha_registro,
										  pdf.razon_social_prov,
										  pdf.rfc_prov,
										  pdf.tipo_razon_social_prov,
										  pdb.nombre_banco_p,
										  pdb.sucursal_banco_p,
										  pdb.titular_cuenta_p,
										  cba.num_cbancaria_p,
										  pdb.clabe_interbancaria_p,
										  pdb.tipo_cuenta_p
										FROM
										  proveedores p
										 LEFT JOIN detalle_categorias_proveedores dcp
										  ON p.id_proveedor = dcp.id_proveedor
										 LEFT JOIN categorias_proveedor cp
										  ON cp.id_cat_prov = dcp.id_cat_prov
										 INNER JOIN proveedores_datos_fiscales pdf
										  ON p.id_proveedor = pdf.id_proveedor
										 LEFT JOIN proveedores_datos_bancarios pdb
										  ON p.id_proveedor = pdb.id_proveedor
										 LEFT JOIN cuentas_bancarias cba
										  ON cba.id_cbancarias_p = pdb.id_cbancarias_p
										WHERE p.id_proveedor = :idProv;');
			$sth -> bindParam(':idProv', $idProveedor);
			$sth -> execute();
			$detProv = $sth -> fetch();
			return $detProv;
		}
		public function contactosProveedor($idProveedor){
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT 
										  c.nombre, 
										  ac.nombre_areacontacto,
										  c.tel_oficina
										 FROM 
										  areacontacto ac
										 INNER JOIN contactos c
										  ON ac.id_areacontacto = c.id_areacontacto
										 INNER JOIN proveedorxcontacto pc
										  ON c.id_contacto = pc.id_contacto
										 INNER JOIN proveedores p
										  ON p.id_proveedor = pc.id_proveedor
										 WHERE p.id_proveedor = :idProv;');
			$sth -> bindParam(':idProv', $idProveedor);
			$sth -> execute();
			$contactosP = $sth -> fetchAll();
			return $contactosP;
		}
		public function categoriasProveedor() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_cat_prov, nombre_cat_prov
										 FROM categorias_proveedor
										 ORDER BY nombre_cat_prov;');
			$sth -> execute();
			$datosCatProve = $sth -> fetchAll();
			return $datosCatProve;
		}
		public function cuentasBancariasProv() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_cbancarias_p, num_cbancaria_p
										 FROM cuentas_bancarias
										 ORDER BY num_cbancaria_p;');
			$sth -> execute();
			$datosCueBanProve = $sth -> fetchAll();
			return $datosCueBanProve;
		}
		public function direccionesProveedor($idProveedor){
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT 
										 d.idprov_direccion,
										 d.calle_p,
										 d.num_ext_p,
										 d.num_int_p,
										 d.colonia_p,
										 d.localidad_p,
										 d.municipio_p,
										 d.estado_p,
										 d.pais_p,
										 d.cod_postal_p,
										 d.referencia_direccion,
										 d.gps_ubicacion,
										 dpd.iddetalle_prov_dir,
										 dpd.tipo_direccion
										FROM proveedores_direcciones d
										 INNER JOIN detalle_proveedores_direcciones dpd
										  ON d.idprov_direccion = dpd.idprov_direccion
										WHERE dpd.id_proveedor = :IDprov;');
			$sth -> bindParam(':IDprov', $idProveedor);
			$sth -> execute();
			$rows = $sth -> rowCount();
			if ($rows != "") {
				$dirProv = $sth -> fetchAll();
			} else {
				$dirProv[] = array();;
			}
			return $dirProv;
		}
		public function incrementoIdProveedor() {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare("SELECT id_proveedor FROM proveedores ORDER BY id_proveedor DESC LIMIT 1;");
			$query -> execute();
			$rows = $query -> rowCount();
			if ($rows != 0) {
				$resultIdP = $query -> fetch(PDO::FETCH_ASSOC);
				$idProveedor = ($resultIdP['id_proveedor'] + 1);
			}else{
				$idProveedor = 1;
			}
			return $idProveedor;
		}
		public function incrementoIdProveedorDireccion() {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare("SELECT idprov_direccion FROM proveedores_direcciones ORDER BY idprov_direccion DESC LIMIT 1;");
			$query -> execute();
			$rows = $query -> rowCount();
			if ($rows != 0) {
				$resultIdProvDir = $query -> fetch(PDO::FETCH_ASSOC);
				$idProvDireccion = ($resultIdProvDir['idprov_direccion'] + 1);
			}else{
				$idProvDireccion = 1;
			}
			return $idProvDireccion;
		}
		public function registrarProveedor($nombreP, $telefonoP, $emailP, $direccionWebP, $categoriaP, $razoSocialP, $rfcP, $tipoRazonSocialP, $bancoP, $sucursalP, $titularP, $numCuentaP, $numClabeInterP, $tipoCuenta, $direccionesProveedor){
			$Conexion = new dataBaseConn();
			$band = 0;
			if ($nombreP != "" && $razoSocialP != "" && $rfcP != "") {
				if ($direccionWebP == "http://") {
					$direccionWebP = "";
				}
			} else {
				$this -> msjErr = "Completa todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$query = $Conexion -> prepare('SELECT nom_proveedor FROM proveedores WHERE nom_proveedor = :nomProv;');
				$query -> bindParam(':nomProv', $nombreP);
				$query -> execute();
				$rows = $query -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "El proveedor <b>".$nombreP."</b> ya fue registrado.";
					$band = 1;
				}
				$query2 = $Conexion -> prepare('SELECT rfc_prov FROM proveedores_datos_fiscales WHERE rfc_prov = :rfcProv;');
				$query2 -> bindParam(':rfcProv', $rfcP);
				$query2 -> execute();
				$rows2 = $query2 -> rowCount();
				if ($rows2 != 0) {
					$this -> msjErr = "El proveedor con el RFC <b>".$rfcP."</b> ya fue registrado.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$nombreP = trim(mb_strtoupper($nombreP));
				$categoriaP = trim(mb_strtoupper($categoriaP));
				$razoSocialP = trim(mb_strtoupper($razoSocialP));
				$rfcP = trim(mb_strtoupper($rfcP));
				$tipoRazonSocialP = trim(mb_strtoupper($tipoRazonSocialP));
				$bancoP = trim(mb_strtoupper($bancoP));
				$sucursalP = trim(mb_strtoupper($sucursalP));
				$titularP = trim(mb_strtoupper($titularP));
				$tipoCuenta = trim(mb_strtoupper($tipoCuenta));
				// Insertar Proveedor.
				$query = $Conexion -> prepare('INSERT INTO proveedores
												(id_proveedor, nom_proveedor, tel_proveedor, email_proveedor, url_proveedor, fecha_registro)
												VALUES (:IDprov, :nomProv, :telProv, :emailProv, :urlProv, NOW());');
				$idProveedor = $this -> incrementoIdProveedor();
				$query -> bindParam(':IDprov', $idProveedor);
				$query -> bindParam(':nomProv', $nombreP);
				$query -> bindParam(':telProv', $telefonoP);
				$query -> bindParam(':emailProv', $emailP);
				$query -> bindParam(':urlProv', $direccionWebP);
				$result = $query -> execute();
				// Insertar Datos Fiscales Proveedor.
				$query2 = $Conexion -> prepare('INSERT INTO proveedores_datos_fiscales
												 (razon_social_prov, rfc_prov, tipo_razon_social_prov, id_proveedor)
												VALUES (:rsProv, :rfcProv, :trsProv, :IDprov);');
				$query2 -> bindParam(':rsProv', $razoSocialP);
				$query2 -> bindParam(':rfcProv', $rfcP);
				$query2 -> bindParam(':trsProv', $tipoRazonSocialP);
				$query2 -> bindParam(':IDprov', $idProveedor);
				$result2 = $query2 -> execute();
				// Insertar Categoría Proveedor, si no está vacía.
				if ($categoriaP != "") {
					$query3 = $Conexion -> prepare('INSERT INTO detalle_categorias_proveedores
													 (id_proveedor, id_cat_prov)
													VALUES (:IDprov, :IDcatProv);');
					$query3 -> bindParam(':IDprov', $idProveedor);
					$query3 -> bindParam(':IDcatProv', $categoriaP);
					$query3 -> execute();
				}
				// Insertar Datos Bancarios Proveedor.
				if ($bancoP != "" && $sucursalP != "" && $titularP != "" && $numCuentaP != "") {
					$query4 = $Conexion -> prepare('INSERT INTO proveedores_datos_bancarios
													 (nombre_banco_p, sucursal_banco_p, titular_cuenta_p, id_cbancarias_p, clabe_interbancaria_p, tipo_cuenta_p,  id_proveedor)
													VALUES (:banP, :sucP, :titP, :nCueP, :claIntP, :tCueP, :IDprov);');
					$query4 -> bindParam(':banP', $bancoP);
					$query4 -> bindParam(':sucP', $sucursalP);
					$query4 -> bindParam(':titP', $titularP);
					$query4 -> bindParam(':nCueP', $numCuentaP);
					$query4 -> bindParam(':claIntP', $numClabeInterP);
					$query4 -> bindParam(':tCueP', $tipoCuenta);
					$query4 -> bindParam(':IDprov', $idProveedor);
					$query4 -> execute();
				}
				// Insertar Dirección Proveedor.
				foreach ($direccionesProveedor  as $dirProv) {
					$calleP = trim(mb_strtoupper($dirProv['txtCalle']));
					$numExtP = trim(mb_strtoupper($dirProv['txtNexterior']));
					if ($numExtP == "") {
						$numExtP = "S/N";
					}
					$numIntP = trim(mb_strtoupper($dirProv['txtNinterior']));
					$coloniaP = trim(mb_strtoupper($dirProv['txtColonia']));
					$localidadP = trim(mb_strtoupper($dirProv['txtLocalidad']));
					$municipioP = trim(mb_strtoupper($dirProv['txtMunicipio']));
					$estadoP = trim(mb_strtoupper($dirProv['txtEstado']));
					$paisP = trim(mb_strtoupper($dirProv['txtPais']));
					$codigoPostalP = trim($dirProv['txtCp']);
					$referenciaP = trim(mb_strtoupper($dirProv['txtRef']));
					$ubicacionGpsP = trim($dirProv['txtUbGps']);
					$tipoDir = trim(mb_strtoupper($dirProv['txtTipDir']));
					if ($calleP != "" || $coloniaP != "" || $municipioP != "" || $estadoP != "" || $paisP != "" || $codigoPostalP != "") {
						$query5 = $Conexion -> prepare('INSERT INTO proveedores_direcciones
														 (idprov_direccion, calle_p, num_ext_p, num_int_p, colonia_p, localidad_p, municipio_p, estado_p, pais_p, cod_postal_p, referencia_direccion, gps_ubicacion)
														VALUES (:IDprovDir, :calleD, :nExtD, :nIntD, :colD, :locD, :munD, :estD, :paisD, :cpD, :refD, :gpsD);');
						$idProvDireccion = $this -> incrementoIdProveedorDireccion();
						$query5 -> bindParam(':IDprovDir', $idProvDireccion);
						$query5 -> bindParam(':calleD', $calleP);
						$query5 -> bindParam(':nExtD', $numExtP);
						$query5 -> bindParam(':nIntD', $numIntP);
						$query5 -> bindParam(':colD', $coloniaP);
						$query5 -> bindParam(':locD', $localidadP);
						$query5 -> bindParam(':munD', $municipioP);
						$query5 -> bindParam(':estD', $estadoP);
						$query5 -> bindParam(':paisD', $paisP);
						$query5 -> bindParam(':cpD', $codigoPostalP);
						$query5 -> bindParam(':refD', $referenciaP);
						$query5 -> bindParam(':gpsD', $ubicacionGpsP);
						$resultProvDir = $query5 -> execute();
						if ($resultProvDir == TRUE) {
							$query6 = $Conexion -> prepare('INSERT INTO detalle_proveedores_direcciones
														 (id_proveedor, idprov_direccion, tipo_direccion)
														VALUES (:IDprov, :IDprovDir, :tDir);');
							$query6 -> bindParam(':IDprov', $idProveedor);
							$query6 -> bindParam(':IDprovDir', $idProvDireccion);
							$query6 -> bindParam(':tDir', $tipoDir);
							$query6 -> execute();
						}
					}
				}
				if ($result == TRUE && $result2 == TRUE) {
					$this -> msjOK = "registrado";
					return $result & $result2;
				}
			}
		}
		public function eliminarProveedor($idProveedor) {
			$band = 0;
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT id_proveedor FROM inventario WHERE id_proveedor = :IDprov;');
			$query -> bindParam(':IDprov', $idProveedor);
			$query -> execute();
			$rows = $query -> rowCount();
			if ($rows != 0) {
				$this -> msjErr = "EL proveedor no puede ser eliminado, porque esta ocupado en inventario.";
				$band = 1;
			}
			if ($band == 0) {
				// Eliminar Detalle Categorias Proveedor.
				$delete1 = $Conexion -> prepare('DELETE FROM detalle_categorias_proveedores WHERE id_proveedor = :IDprov;');
				$delete1 -> bindParam(':IDprov', $idProveedor);
				$result1 = $delete1 -> execute();
				// Eliminar Detalle Contactos Proveedor.
				$delete2 = $Conexion -> prepare('DELETE FROM proveedorxcontacto WHERE id_proveedor = :IDprov;');
				$delete2 -> bindParam(':IDprov', $idProveedor);
				$result2 = $delete2 -> execute();
				// Seleccionar Id proveedor dirección de Detalle Proveedores Direcciones.
				$queryDetProvDir = $Conexion -> prepare('SELECT idprov_direccion FROM detalle_proveedores_direcciones WHERE id_proveedor = :IDprov;');
				$queryDetProvDir -> bindParam(':IDprov', $idProveedor);
				$queryDetProvDir -> execute();
				$rows = $queryDetProvDir -> rowCount();
				if ($rows != 0) {
					$resultDetProvDir = $queryDetProvDir -> fetchAll();
					// Eliminar Detalle Dirección Proveedor.
					$delete3 = $Conexion -> prepare('DELETE FROM detalle_proveedores_direcciones WHERE id_proveedor = :IDprov;');
					$delete3 -> bindParam(':IDprov', $idProveedor);
					$result3 = $delete3 -> execute();
					// Eliminar Dirección Proveedor.
					foreach ($resultDetProvDir as $idPrDir) {
						$delete4 = $Conexion -> prepare('DELETE FROM proveedores_direcciones WHERE idprov_direccion = :IDprovDir;');
						$delete4 -> bindParam(':IDprovDir', $idPrDir['idprov_direccion']);
						$result4 = $delete4 -> execute();
					}
				}
				// Eliminar Datos Fiscales Proveedor.
				$delete5 = $Conexion -> prepare('DELETE FROM proveedores_datos_fiscales WHERE id_proveedor = :IDprov;');
				$delete5 -> bindParam(':IDprov', $idProveedor);
				$result5 = $delete5 -> execute();
				// Eliminar Datos Bancarios Proveedor.
				$delete6 = $Conexion -> prepare('DELETE FROM proveedores_datos_bancarios WHERE id_proveedor = :IDprov;');
				$delete6 -> bindParam(':IDprov', $idProveedor);
				$result6 = $delete6 -> execute();
				// Eliminar Proveedor.
				$delete7 = $Conexion -> prepare('DELETE FROM proveedores WHERE id_proveedor = :IDprov;');
				$delete7 -> bindParam(':IDprov', $idProveedor);
				$result7 = $delete7 -> execute();
				if ($result1 && $result2 && $result5 && $result6 && $result7) {
					$this -> msjOK = "Proveedor eliminado correctamente.";
					return $result1 & $result2 & $result5 & $result6 & $result7;
				}
			}
		}
		public function datosProveedorEditar($idProveedor){
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT 
										  p.id_proveedor,
										  dcp.id_detalle_prov,
										  cp.id_cat_prov,
										  cp.nombre_cat_prov,
										  p.nom_proveedor,
										  p.tel_proveedor,
										  p.email_proveedor,
										  p.url_proveedor,
										  pdf.idprov_datos_fiscales,
										  pdf.razon_social_prov,
										  pdf.rfc_prov,
										  pdf.tipo_razon_social_prov,
										  pdb.idprov_datos_bancarios,
										  pdb.nombre_banco_p,
										  pdb.sucursal_banco_p,
										  pdb.titular_cuenta_p,
										  cba.num_cbancaria_p,
										  pdb.id_cbancarias_p,
										  pdb.clabe_interbancaria_p,
										  pdb.tipo_cuenta_p
										FROM
										  proveedores p
										 LEFT JOIN detalle_categorias_proveedores dcp
										  ON p.id_proveedor = dcp.id_proveedor
										 LEFT JOIN categorias_proveedor cp
										  ON cp.id_cat_prov = dcp.id_cat_prov
										 INNER JOIN proveedores_datos_fiscales pdf
										  ON p.id_proveedor = pdf.id_proveedor
										 LEFT JOIN proveedores_datos_bancarios pdb
										  ON p.id_proveedor = pdb.id_proveedor
										 LEFT JOIN cuentas_bancarias cba
										  ON cba.id_cbancarias_p = pdb.id_cbancarias_p
										WHERE p.id_proveedor = :idProv;');
			$sth -> bindParam(':idProv', $idProveedor);
			$sth -> execute();
			$datProv = $sth -> fetch();
			return $datProv;
		}
		public function categoriasProveedorDiff($idCategoriaProv) {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_cat_prov, nombre_cat_prov
										 FROM categorias_proveedor
										 WHERE id_cat_prov != :IDcategP
										 ORDER BY nombre_cat_prov;');
			$sth -> bindParam(':IDcategP', $idCategoriaProv);
			$sth -> execute();
			$datosCatProve = $sth -> fetchAll();
			return $datosCatProve;
		}
		public function cuentasBancariasProvDiff($idCuentaBancaria) {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_cbancarias_p, num_cbancaria_p
										 FROM cuentas_bancarias
										 WHERE id_cbancarias_p != :idCueBan
										 ORDER BY num_cbancaria_p;');
			$sth -> bindParam(':idCueBan', $idCuentaBancaria);
			$sth -> execute();
			$datosCatProve = $sth -> fetchAll();
			return $datosCatProve;
		}
		public function modificarProveedor($idP, $nombreP, $telefonoP, $emailP, $direccionWebP, $idDetCategoriaP, $categoriaP, $idDatFiscales, $razoSocialP, $rfcP, $tipoRazonSocialP, $idDatBancarios, $bancoP, $sucursalP, $titularP, $numCuentaP, $numClabeInterP, $tipoCuenta, $direccionesProveedor){
			$Conexion = new dataBaseConn();
			$band = 0;
			if ($idP != "" && $nombreP != "" && $razoSocialP != "" && $rfcP != "") {
				if ($direccionWebP == "http://") {
					$direccionWebP = "";
				}
			} else {
				$this -> msjErr = "Completa todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$query = $Conexion -> prepare('SELECT nom_proveedor FROM proveedores WHERE nom_proveedor = :nomProv AND id_proveedor != :IDprov;');
				$query -> bindParam(':IDprov', $idP);
				$query -> bindParam(':nomProv', $nombreP);
				$query -> execute();
				$rows = $query -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "El proveedor <b>".$nombreP."</b> ya fue registrado.";
					$band = 1;
				}
				$query2 = $Conexion -> prepare('SELECT rfc_prov FROM proveedores_datos_fiscales WHERE rfc_prov = :rfcProv AND idprov_datos_fiscales != :IDprovDatF;');
				$query2 -> bindParam(':rfcProv', $rfcP);
				$query2 -> bindParam(':IDprovDatF', $idDatFiscales);
				$query2 -> execute();
				$rows2 = $query2 -> rowCount();
				if ($rows2 != 0) {
					$this -> msjErr = "El proveedor con el RFC <b>".$rfcP."</b> ya fue registrado.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$nombreP = trim(mb_strtoupper($nombreP));
				$categoriaP = trim(mb_strtoupper($categoriaP));
				$razoSocialP = trim(mb_strtoupper($razoSocialP));
				$rfcP = trim(mb_strtoupper($rfcP));
				$tipoRazonSocialP = trim(mb_strtoupper($tipoRazonSocialP));
				$bancoP = trim(mb_strtoupper($bancoP));
				$sucursalP = trim(mb_strtoupper($sucursalP));
				$titularP = trim(mb_strtoupper($titularP));
				$tipoCuenta = trim(mb_strtoupper($tipoCuenta));
				// Modificar Proveedor.
				$query = $Conexion -> prepare('UPDATE proveedores
												SET nom_proveedor = :nomProv,
													tel_proveedor = :telProv,
													email_proveedor = :emailProv,
													url_proveedor = :urlProv
												WHERE id_proveedor = :IDprov;');
				$query -> bindParam(':IDprov', $idP);
				$query -> bindParam(':nomProv', $nombreP);
				$query -> bindParam(':telProv', $telefonoP);
				$query -> bindParam(':emailProv', $emailP);
				$query -> bindParam(':urlProv', $direccionWebP);
				$result = $query -> execute();
				// Modificar Datos Fiscales Proveedor.
				$query2 = $Conexion -> prepare('UPDATE proveedores_datos_fiscales
												SET razon_social_prov = :rsProv,
													rfc_prov = :rfcProv,
													tipo_razon_social_prov = :trsProv
												WHERE idprov_datos_fiscales = :IDprovDatF;');
				$query2 -> bindParam(':rsProv', $razoSocialP);
				$query2 -> bindParam(':rfcProv', $rfcP);
				$query2 -> bindParam(':trsProv', $tipoRazonSocialP);
				$query2 -> bindParam(':IDprovDatF', $idDatFiscales);
				$result2 = $query2 -> execute();
				// Modificar Categoría Proveedor, si no está vacía.
				if ($idDetCategoriaP != NULL) {
					if ($categoriaP != "") {
						$query3 = $Conexion -> prepare('UPDATE detalle_categorias_proveedores
														SET id_cat_prov = :IDcatProv
														WHERE id_proveedor = :IDprov;');
						$query3 -> bindParam(':IDprov', $idP);
						$query3 -> bindParam(':IDcatProv', $categoriaP);
						$query3 -> execute();
					}
				} else {
					if ($categoriaP != "") {
						$insertDetCtPr = $Conexion -> prepare('INSERT INTO detalle_categorias_proveedores
													 (id_proveedor, id_cat_prov)
													VALUES (:IDprov, :IDcatProv)');
						$insertDetCtPr -> bindParam(':IDprov', $idP);
						$insertDetCtPr -> bindParam(':IDcatProv', $categoriaP);
						$insertDetCtPr -> execute();
					}
				}
				// Modificar Datos Bancarios Proveedor.
				if ($idDatBancarios != NULL) {
					if ($bancoP != "" && $sucursalP != "" && $titularP != "" && $numCuentaP != "")
					{
						$query4 = $Conexion -> prepare('UPDATE proveedores_datos_bancarios
														SET nombre_banco_p = :banP,
															sucursal_banco_p = :sucP,
															titular_cuenta_p = :titP,
															id_cbancarias_p = :nCueP,
															clabe_interbancaria_p = :claIntP,
															tipo_cuenta_p = :tCueP
														WHERE idprov_datos_bancarios = :IDprovDatB;');
						$query4 -> bindParam(':banP', $bancoP);
						$query4 -> bindParam(':sucP', $sucursalP);
						$query4 -> bindParam(':titP', $titularP);
						$query4 -> bindParam(':nCueP', $numCuentaP);
						$query4 -> bindParam(':claIntP', $numClabeInterP);
						$query4 -> bindParam(':tCueP', $tipoCuenta);
						$query4 -> bindParam(':IDprovDatB', $idDatBancarios);
						$query4 -> execute();
					}
				} else {
					if ($bancoP != "" && $sucursalP != "" && $titularP != "" && $numCuentaP != "")
					{
						$insertDatB = $Conexion -> prepare('INSERT INTO proveedores_datos_bancarios
														 (nombre_banco_p, sucursal_banco_p, titular_cuenta_p, id_cbancarias_p, clabe_interbancaria_p, tipo_cuenta_p,  id_proveedor)
														VALUES (:banP, :sucP, :titP, :nCueP, :claIntP, :tCueP, :IDprov)');
						$insertDatB -> bindParam(':banP', $bancoP);
						$insertDatB -> bindParam(':sucP', $sucursalP);
						$insertDatB -> bindParam(':titP', $titularP);
						$insertDatB -> bindParam(':nCueP', $numCuentaP);
						$insertDatB -> bindParam(':claIntP', $numClabeInterP);
						$insertDatB -> bindParam(':tCueP', $tipoCuenta);
						$insertDatB -> bindParam(':IDprov', $idP);
						$insertDatB -> execute();
					}
				}
				// Modificar Dirección Proveedor.
				foreach ($direccionesProveedor as $dirProv) {
					$calleP = trim(mb_strtoupper($dirProv['txtCalle']));
					$numExtP = trim(mb_strtoupper($dirProv['txtNexterior']));
					if ($numExtP == "") {
						$numExtP = "S/N";
					}
					$numIntP = trim(mb_strtoupper($dirProv['txtNinterior']));
					$coloniaP = trim(mb_strtoupper($dirProv['txtColonia']));
					$localidadP = trim(mb_strtoupper($dirProv['txtLocalidad']));
					$municipioP = trim(mb_strtoupper($dirProv['txtMunicipio']));
					$estadoP = trim(mb_strtoupper($dirProv['txtEstado']));
					$paisP = trim(mb_strtoupper($dirProv['txtPais']));
					$codigoPostalP = trim($dirProv['txtCp']);
					$referenciaP = trim(mb_strtoupper($dirProv['txtRef']));
					$ubicacionGpsP = trim($dirProv['txtUbGps']);
					$tipoDir = trim(mb_strtoupper($dirProv['txtTipDir']));
					if (isset($dirProv['txtIdProvDir']) && isset($dirProv['txtIdDetProDir'])) {
						$idModProvDir = trim($dirProv['txtIdProvDir']);
						$idModDetalleProvDir = trim($dirProv['txtIdDetProDir']);
						if ($idModProvDir != "" && ($calleP != "" || $coloniaP != "" || $municipioP != "" || $estadoP != "" || $paisP != "" || $codigoPostalP != ""))
						{
							$query5 = $Conexion -> prepare('UPDATE proveedores_direcciones
															SET calle_p = :calleD,
																num_ext_p = :nExtD,
																num_int_p = :nIntD,
																colonia_p = :colD,
																localidad_p = :locD,
																municipio_p = :munD,
																estado_p = :estD,
																pais_p = :paisD,
																cod_postal_p = :cpD,
																referencia_direccion = :refD,
																gps_ubicacion = :gpsD
															WHERE idprov_direccion = :IDprovDir;');
							$query5 -> bindParam(':IDprovDir', $idModProvDir);
							$query5 -> bindParam(':calleD', $calleP);
							$query5 -> bindParam(':nExtD', $numExtP);
							$query5 -> bindParam(':nIntD', $numIntP);
							$query5 -> bindParam(':colD', $coloniaP);
							$query5 -> bindParam(':locD', $localidadP);
							$query5 -> bindParam(':munD', $municipioP);
							$query5 -> bindParam(':estD', $estadoP);
							$query5 -> bindParam(':paisD', $paisP);
							$query5 -> bindParam(':cpD', $codigoPostalP);
							$query5 -> bindParam(':refD', $referenciaP);
							$query5 -> bindParam(':gpsD', $ubicacionGpsP);
							$resultProvDir = $query5 -> execute();
							if ($resultProvDir == TRUE) {
								$query6 = $Conexion -> prepare('UPDATE detalle_proveedores_direcciones
															 	SET tipo_direccion = :tDir
															 	WHERE iddetalle_prov_dir = :idDetPrDir;');
								$query6 -> bindParam(':tDir', $tipoDir);
								$query6 -> bindParam(':idDetPrDir', $idModDetalleProvDir);
								$query6 -> execute();
							}
						}
					} else {
						if ($calleP != "" || $coloniaP != "" || $municipioP != "" || $estadoP != "" || $paisP != "" || $codigoPostalP != "")
						{
							$query5 = $Conexion -> prepare('INSERT INTO proveedores_direcciones
															 (idprov_direccion, calle_p, num_ext_p, num_int_p, colonia_p, localidad_p, municipio_p, estado_p, pais_p, cod_postal_p, referencia_direccion, gps_ubicacion)
															VALUES (:IDprovDir, :calleD, :nExtD, :nIntD, :colD, :locD, :munD, :estD, :paisD, :cpD, :refD, :gpsD);');
							$idProvDireccion = $this -> incrementoIdProveedorDireccion();
							$query5 -> bindParam(':IDprovDir', $idProvDireccion);
							$query5 -> bindParam(':calleD', $calleP);
							$query5 -> bindParam(':nExtD', $numExtP);
							$query5 -> bindParam(':nIntD', $numIntP);
							$query5 -> bindParam(':colD', $coloniaP);
							$query5 -> bindParam(':locD', $localidadP);
							$query5 -> bindParam(':munD', $municipioP);
							$query5 -> bindParam(':estD', $estadoP);
							$query5 -> bindParam(':paisD', $paisP);
							$query5 -> bindParam(':cpD', $codigoPostalP);
							$query5 -> bindParam(':refD', $referenciaP);
							$query5 -> bindParam(':gpsD', $ubicacionGpsP);
							$resultProvDir = $query5 -> execute();
							if ($resultProvDir == TRUE) {
								$query6 = $Conexion -> prepare('INSERT INTO detalle_proveedores_direcciones
															 (id_proveedor, idprov_direccion, tipo_direccion)
															VALUES (:IDprov, :IDprovDir, :tDir);');
								$query6 -> bindParam(':IDprov', $idP);
								$query6 -> bindParam(':IDprovDir', $idProvDireccion);
								$query6 -> bindParam(':tDir', $tipoDir);
								$query6 -> execute();
							}
						}
					}
				}
				if ($result == TRUE && $result2 == TRUE) {
					$this -> msjOK = "modificado";
					return $result & $result2;
				}
			}
		}
		public function obtenerProvEgresos(){
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT idegresos, fecha, rfc_emisor, razon_social_emisor, serie, no_folio FROM egresos WHERE guardar_prov = :valGuardarProv');
			$valGuardarProv = 'Si';
			$sth -> bindParam(':valGuardarProv', $valGuardarProv);
			$sth -> execute();
			$provEgresos = $sth -> fetchAll();
			return $provEgresos;
		}
		public function obtenerDatoProvEgresos($IDegresos){
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT 
										  e.rfc_emisor,
										  e.razon_social_emisor,
										  eg.ed_pais,
										  eg.ed_estado,
										  eg.ed_municipio,
										  eg.ed_cod_post,
										  eg.ed_colonia,
										  eg.ed_calle,
										  eg.ed_no_ext,
										  eg.ed_no_int
										FROM
										  egresos e 
										  LEFT JOIN egresos_direcciones eg 
										    ON e.idegresos = eg.id_egresos 
										WHERE e.idegresos = :idEgresos');
			$sth -> bindParam(':idEgresos', $IDegresos);
			$sth -> execute();
			return $sth -> fetch();
		}
	}
?>