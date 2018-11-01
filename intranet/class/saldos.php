<?php
	/**
	* FUNCIONES para SALDOS.
	*/
	require_once 'dataBaseConn.php';
	class saldos {
		// Obtener Cuentas Bancarias.
		public function cuentasBancarias() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_cbancarias_p, num_cbancaria_p
										 FROM cuentas_bancarias
										 ORDER BY num_cbancaria_p;');
			$sth -> execute();
			$datCuentaBancaria = $sth -> fetchAll();
			return $datCuentaBancaria;
		}
		// Obtener Cuentas Diferentes.
		public function cuentasBancariasDiff($cuentaBan) {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_cbancarias_p, num_cbancaria_p
										 FROM cuentas_bancarias
										 WHERE num_cbancaria_p != :numCue
										 ORDER BY num_cbancaria_p;');
			$sth -> bindParam(':numCue', $cuentaBan);
			$sth -> execute();
			$datCuentaBancaria = $sth -> fetchAll();
			return $datCuentaBancaria;
		}
		// Obtener la lista de los saldos registrados.
		public function obtenerDatosSaldos() {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT 
											id_saldo,
											fecha_s,
											descripcion_s,
											referencia_s,
											cargos_s,
											abonos_s,
											saldo,
											clasificacion_s,
											num_cbancaria,
											agregado,
											forma_pago
										   FROM saldos;');
			$query -> execute();
			$datSaldos = $query -> fetchAll(); 
			return $datSaldos;
		}
		// Obtener la lista de los saldos, donde el cargo sea igual al Total del Egreso.
		public function obtenerCargos($precioTotal) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT 
											id_saldo,
											fecha_s,
											descripcion_s,
											cargos_s,
											num_cbancaria
										   FROM saldos
										   WHERE (cargos_s >= 1 AND cargos_s = :totalCargos)
										    AND agregado = :valueA;');
			$saldoAgregado = 'No';
			$query -> bindParam(':valueA', $saldoAgregado);
			$query -> bindParam(':totalCargos', $precioTotal);
			$query -> execute();
			$cargosSaldos = $query -> fetchAll(); 
			return $cargosSaldos;
		}
		// Obtener la lista de los saldos, donde el cargo sea menor al Total del Egreso.
		public function obtenerCargosMenores($precioTotal) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT 
											id_saldo,
											fecha_s,
											descripcion_s,
											cargos_s,
											num_cbancaria
										   FROM saldos
										   WHERE (cargos_s >= 1 AND cargos_s < :totalCargos)
										    AND agregado = :valueA;');
			$saldoAgregado = 'No';
			$query -> bindParam(':valueA', $saldoAgregado);
			$query -> bindParam(':totalCargos', $precioTotal);
			$query -> execute();
			$cargosMenores = $query -> fetchAll(); 
			return $cargosMenores;
		}
		// Obtener todos los saldos
		public function obtenerOtrosCargos() {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT 
											id_saldo,
											fecha_s,
											descripcion_s,
											cargos_s,
											num_cbancaria
										   FROM saldos
										   WHERE cargos_s >= 1 
										    AND (agregado = :valorN)
										     OR (agregado = :valorS AND forma_pago = :pCompleto);');
			$saldoNoAgregado = 'No';
			$query -> bindParam(':valorN', $saldoNoAgregado);
			$saldoAgregado = 'Si';
			$query -> bindParam(':valorS', $saldoAgregado);
			$statusCargo = 'completo-parcial';
			$query -> bindParam(':pCompleto', $statusCargo);
			$query -> execute();
			$otrosCargos = $query -> fetchAll(); 
			return $otrosCargos;
		}
		// Obtener la lista de los Pagos de la relacion Egreso - Saldo.
		public function pagosParciales($idEgreso) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT epp.fecha_pago, s.cargos_s
											FROM egresos_pagos_parciales epp
											 INNER JOIN saldos s
											  ON s.id_saldo = epp.id_saldo
											WHERE epp.id_egresos = :IDegr;');
			$query -> bindParam(':IDegr', $idEgreso);
			$query -> execute();
			$pagosP = $query -> fetchAll(); 
			return $pagosP;
		}
		// Obtener el Id del Egreso según el Id de Saldo de los pagos parciales.
		public function obtenerIdEgreso($idSaldo) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT id_egresos FROM egresos_pagos_parciales WHERE id_saldo = :IDsaldo;');
			$query -> bindParam(':IDsaldo', $idSaldo);
			$query -> execute();
			$result = $query -> fetch(PDO::FETCH_ASSOC);
			$idEgreso = $result['id_egresos'];
			return $idEgreso;
		} // Función obtenerIdEgreso.
		// Obtener la lista de los Pagos Parciales en los saldos.
		public function saldoEgresoPagoParcial($idSaldo, $idEgreso) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT epp.fecha_pago,
												  s.cargos_s,
												  e.razon_social_emisor,
												  e.folio_fiscal
											FROM saldos s
											 INNER JOIN egresos_pagos_parciales epp ON s.id_saldo = epp.id_saldo
											 RIGHT JOIN egresos e ON e.idegresos = epp.id_egresos
											WHERE epp.id_saldo = :IDsaldo AND epp.id_egresos = :IDegreso;');
			$query -> bindParam(':IDsaldo', $idSaldo);
			$query -> bindParam(':IDegreso', $idEgreso);
			$query -> execute();
			$pagosC = $query -> fetchAll(); 
			return $pagosC;
		}
		// Obtener la lista de los Pagos de forma completa en los egresos.
		public function pagosCompletos($idSaldo) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT e.fecha_pago,
												  e.razon_social_emisor,
												  e.folio_fiscal,
												  epc.precio_acumulado
										   FROM saldos s
											   INNER JOIN egresos_pagos_completos epc ON s.id_saldo = epc.id_saldo
											   RIGHT JOIN egresos e ON e.idegresos = epc.id_egreso
										   WHERE epc.id_saldo = :IDsal;');
			$query -> bindParam(':IDsal', $idSaldo);
			$query -> execute();
			$pagosC = $query -> fetchAll(); 
			return $pagosC;
		}
		// Obtiene el total de pagos parciales agregados a los egresos.
		public function totalPagosParciales($idEgreso) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT SUM(s.cargos_s) total_cargos
										   FROM saldos s 
										    INNER JOIN egresos_pagos_parciales epp
										     ON s.id_saldo = epp.id_saldo
										   WHERE epp.id_egresos = :IDegr;');
			$query -> bindParam(':IDegr', $idEgreso);
			$query -> execute();
			$sumaTotal = $query -> fetch(PDO::FETCH_ASSOC);
			$sumaTotal = $sumaTotal['total_cargos'];
			return $sumaTotal;
		}
		// Obtiene el total de pagos completos agregados a los egresos.
		public function totalPagosCompletos($idSaldo) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT SUM(precio_acumulado) total_acumulado
										   FROM egresos_pagos_completos
										   WHERE id_saldo = :IDsal;');
			$query -> bindParam(':IDsal', $idSaldo);
			$query -> execute();
			$sumaTotalA = $query -> fetch(PDO::FETCH_ASSOC);
			$sumaTotalA = $sumaTotalA['total_acumulado'];
			return $sumaTotalA;			
		}
		// Registra los Pagos Parciales del Egreso.
		public function registrarPagosParcialesE($idEgreso, $idSaldo, $fechaPagoEgreso, $numCuentaEgreso, $totalFacturaEgreso, $precioCargoSaldo){
			$Conexion = new dataBaseConn();
			$band = 0;
			if ($idEgreso == "" && $idSaldo == "" && $fechaPagoEgreso == "" && $numCuentaEgreso == "") {
				$band = 1;
			} else {
				$fechaDePago = date_format(date_create($fechaPagoEgreso), 'Y-m-d');
			}
			if ($band == 0) {
				// Obtiene el total de los pagos abonados.
				$precioTotalPagos = $this -> totalPagosParciales($idEgreso);
				$totalCargosAb = $precioTotalPagos + $precioCargoSaldo;
				if ($totalCargosAb <= $totalFacturaEgreso) {
					// Buscar datos.
					$query = $Conexion -> prepare('SELECT id_egre_parcial FROM egresos_pagos_parciales WHERE id_egresos = :IDegr;');
					$query -> bindParam(':IDegr', $idEgreso);
					$query -> execute();
					$rows = $query -> rowCount();
					// Va actualizar si no encuentra registros.
					if ($rows == 0) {
						// Update. Actualiza la Fecha de Pago del Egreso.
						$queryU = $Conexion -> prepare('UPDATE egresos SET fecha_pago = :fPagoE, no_cuenta = :cBancaria WHERE idegresos = :IDegr;');
						$queryU -> bindParam(':fPagoE', $fechaDePago);
						$queryU -> bindParam(':cBancaria', $numCuentaEgreso);
						$queryU -> bindParam(':IDegr', $idEgreso);
						$queryU -> execute();
					}
					// Registra el pago parcial del Egreso.
					$queryI = $Conexion -> prepare('INSERT INTO egresos_pagos_parciales (id_egresos, id_saldo, fecha_pago) VALUES(:IDegr, :IDsal, :fPagoE);');
					$queryI -> bindParam(':IDegr', $idEgreso);
					$queryI -> bindParam(':IDsal', $idSaldo);
					$queryI -> bindParam(':fPagoE', $fechaDePago);
					$queryI -> execute();
				} else {
					echo "<script>alert('No se puede agregar el pago.')</script>";
					$band = 1;
				}
			}
			if ($band == 0) {
				// Update 1. Actualiza el valor de agregado a Si.
				$queryU1 = $Conexion -> prepare('UPDATE saldos SET agregado = :valueA, forma_pago = :formaPago WHERE id_saldo = :IDsaldo;');
				$saldoAgregado = 'Si';
				$queryU1 -> bindParam(':valueA', $saldoAgregado);
				$pagoParcial = "parcial";
				$queryU1 -> bindParam(':formaPago', $pagoParcial);
				$queryU1 -> bindParam(':IDsaldo', $idSaldo);
				$queryU1 -> execute();
				$precioTotalPagos = $this -> totalPagosParciales($idEgreso);
				if ($totalFacturaEgreso == $precioTotalPagos) {
					$statusEgreso = "PAGADO";
				} else {
					$statusEgreso = "PARCIALIDAD";
				}
				// Update 2. Actualiza el Status del Egreso.
				$queryU2 = $Conexion -> prepare('UPDATE egresos SET estado = :statusE WHERE idegresos = :IDegr;');
				$queryU2 -> bindParam(':statusE', $statusEgreso);
				$queryU2 -> bindParam(':IDegr', $idEgreso);
				$queryU2 -> execute();
			}
		}
		// Buscar si hay pagos parciales registrados.
		public function buscarPagosParcialesE($idEgreso) {
			$Conexion = new dataBaseConn();
			// Buscar datos.
			$query = $Conexion -> prepare('SELECT id_egre_parcial FROM egresos_pagos_parciales WHERE id_egresos = :IDegr;');
			$query -> bindParam(':IDegr', $idEgreso);
			$query -> execute();
			$rows = $query -> rowCount();
			if ($rows == 0) {
				// Sin datos.
				$resultBusqueda = 0;
			} else {
				// Datos encontrados
				$resultBusqueda = 1;
			}
			return $resultBusqueda;
		}
		// Registra los pagos completos del Egreso.
		public function registrarPagosCompletosE($idEgreso, $idSaldo, $fechaPagoEgreso, $numCuentaEgreso, $totalFacturaEgreso, $precioCargoSaldo, $pagoEgresoTerminado){
			$Conexion = new dataBaseConn();
			$band = 0;
			if ($idEgreso == "" && $idSaldo == "" && $fechaPagoEgreso == "" && $numCuentaEgreso == "") {
				$band = 1;
			} else {
				$fechaDePago = date_format(date_create($fechaPagoEgreso), 'Y-m-d');
			}
			if ($band == 0) {
				// Valida que el precio del cargo sea mayor al precio total de la factura.
				if ($precioCargoSaldo >= $totalFacturaEgreso) {
					// Registra el Pago Completo del Egreso.
					$queryI = $Conexion -> prepare('INSERT INTO egresos_pagos_completos (id_saldo, id_egreso, precio_acumulado) VALUES(:IDsal, :IDegr, :pAcumulado);');
					$queryI -> bindParam(':IDsal', $idSaldo);
					$queryI -> bindParam(':IDegr', $idEgreso);
					$queryI -> bindParam(':pAcumulado', $totalFacturaEgreso);
					$result = $queryI -> execute();
					if ($result == TRUE) {
						// Update. Actualiza los datos del Egreso.
						$queryU = $Conexion -> prepare('UPDATE egresos SET fecha_pago = :fPagoE, no_cuenta = :cBancaria, estado = :statusE WHERE idegresos = :IDegr;');
						$queryU -> bindParam(':fPagoE', $fechaDePago);
						$queryU -> bindParam(':cBancaria', $numCuentaEgreso);
						$statusEgreso = 'PAGADO';
						$queryU -> bindParam(':statusE', $statusEgreso);
						$queryU -> bindParam(':IDegr', $idEgreso);
						$queryU -> execute();
					}
				} else {
					// Si el precio total no coincide con el total de pagos abonados, el status se define como PARCIALIDAD.
					$this -> msjAlerta = 'No se puede agregar el cargo, por ser menor al total del egreso.';
					$band = 1;
				}
				if ($band == 0) {
					// Obtiene el total de los pagos acumulados.
					$precioTotalAcumulado = $this -> totalPagosCompletos($idSaldo);
					if ($precioCargoSaldo == $precioTotalAcumulado) {
						$statusCargo = "completo";
					} else {
						if ($pagoEgresoTerminado == 'Si') {
							$statusCargo = "completo";
						} else {
							$statusCargo = "completo-parcial";
						}
					}
					// Update 1. Actualiza el valor de agregado a Si.
					$queryU1 = $Conexion -> prepare('UPDATE saldos SET agregado = :valueA, forma_pago = :formaPago WHERE id_saldo = :IDsaldo;');
					$saldoAgregado = 'Si';
					$queryU1 -> bindParam(':valueA', $saldoAgregado);
					$queryU1 -> bindParam(':formaPago', $statusCargo);
					$queryU1 -> bindParam(':IDsaldo', $idSaldo);
					$queryU1 -> execute();
				}
			}
		}
		// Incrementar ID de Saldos.
		public function incrementoIdSaldo()
		{
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_saldo FROM saldos ORDER BY id_saldo DESC LIMIT 1;');
			$sth -> execute();
			$rows = $sth -> rowCount();
			if ($rows != 0)
			{
				$result = $sth -> fetch(PDO::FETCH_ASSOC);
				$isSaldo = ($result['id_saldo'] + 1);
			}
			else
			{
				$isSaldo = 1;
			}
			return $isSaldo;
		} // Función incrementoIdSaldo.
		public function saldosGuardados($cantidadGuardados) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT 
											id_saldo,
											fecha_s,
											descripcion_s,
											referencia_s,
											cargos_s,
											abonos_s,
											saldo,
											clasificacion_s,
											num_cbancaria
										   FROM saldos
										   ORDER BY fecha_registro DESC
										   LIMIT :salReg;');
			$query -> bindParam(':salReg', $cantidadGuardados, PDO::PARAM_INT);
			$query -> execute();
			$result = $query -> fetchAll(PDO::FETCH_ASSOC);
			$saldosReg = "<div align='left'>";
				$saldosReg .= "<label style='color: #fff;'>Número de Cuenta</label>&nbsp;";
				$saldosReg .= "<select id='numCuentaBanc'>";
					$saldosReg .= "<option value=''>Elige</option>";
					foreach ($this -> cuentasBancarias() as $numCuenta) {
						$saldosReg .= "<option value='".$numCuenta['num_cbancaria_p']."'>".$numCuenta['num_cbancaria_p']."</option>";
					}
				$saldosReg .= "</select>";
			$saldosReg .= "</div>";
			$saldosReg .= "<br>";
			$saldosReg .= "<form method='post' id='addNumCuenta'>";
				$saldosReg .= "<table cellspacing='0' cellpadding='2' class='display'>";
					$saldosReg .= "<thead>";
						$saldosReg .= "<tr>";
							$saldosReg .= "<th>Fecha</th>";
							$saldosReg .= "<th>Descripción</th>";
							$saldosReg .= "<th>Referencia</th>";
							$saldosReg .= "<th>Cargos</th>";
							$saldosReg .= "<th>Abonos</th>";
							$saldosReg .= "<th>Saldo</th>";
							$saldosReg .= "<th>Clasificación</th>";
							$saldosReg .= "<th>No. Cuenta</th>";
						$saldosReg .= "</tr>";
					$saldosReg .= "</thead>";
					$saldosReg .= "<tbody>";
				foreach ($result as $saldos) {
					$saldosReg .= "<tr>";
						$saldosReg .= "<td>".$saldos['fecha_s']."</td>";
						$saldosReg .= "<td>".$saldos['descripcion_s']."</td>";
						$saldosReg .= "<td>".$saldos['referencia_s']."</td>";
						$saldosReg .= "<td>$".number_format($saldos['cargos_s'], 2)."</td>";
						$saldosReg .= "<td>$".number_format($saldos['abonos_s'], 2)."</td>";
						$saldosReg .= "<td>$".number_format($saldos['saldo'], 2)."</td>";
						$saldosReg .= "<td>".$saldos['clasificacion_s']."</td>";
						$saldosReg .= "<td>";
							$saldosReg .= "<input type='hidden' name='txtIdSaldo[]' value='".$saldos['id_saldo']."'>";
							$saldosReg .= "<select name='numCuenta[]' class='cuentaB'>";
								$saldosReg .= "<option value=''>Elige</option>";
								foreach ($this -> cuentasBancarias() as $numCuenta) {
									$saldosReg .= "<option value='".$numCuenta['num_cbancaria_p']."'>".$numCuenta['num_cbancaria_p']."</option>";
								}
							$saldosReg .= "</select>";
						$saldosReg .= "</td>";
					$saldosReg .= "</tr>";
				}
					$saldosReg .= "</tbody>";
				$saldosReg .= "</table>";
			$saldosReg .= "</form>";
			$saldosReg .= "<div align='right'><button id='btnRegNumC' class='btn primary' disabled>Agregar Número Cuenta</button>&nbsp;</div>";
			$saldosReg .= "<div id='numCuentaRegistrada'></div>";
			return $saldosReg;
		}
		// Registrar saldos a tráves de un csv.
		public function registrarSaldos($nomarchivo, $nomtmparchivo, $tipoArchivo, $sizearchivo){
			define('DIR_BASE', dirname(__FILE__).'/');
			define('MAX_FILE_SIZE', 10000);
			$band = 0;
			$Conexion = new dataBaseConn();

			if (isset($nomarchivo) && is_uploaded_file($nomtmparchivo) && $sizearchivo <= MAX_FILE_SIZE && preg_match('/.[a-z0-9]+$/', $nomarchivo, $ext)) {
				// La extensión del archivo CSV la convierte en minúscula.
				$extension = strtolower($ext[0]);
				// Verifica que la extensión del archivo sea '.csv'.
				if ($extension == '.csv') {
					// Crea la ruta del archivo.
					$ruta = 'csv_saldos/'.$nomarchivo;
					// Mueve el archivo cargado a la ruta especificada.
					move_uploaded_file($nomtmparchivo, $ruta);
				} else {
					// Manda mensaje de archivo no valido.
					$this -> msjErr = "Tipo de archivo no valido.";
					$band = 1;
				}
			}
			if ($band == 0) {
				// Abrir archivo.
				if(($filecsv = fopen($ruta, 'r')) !== FALSE) {
					// Lee los nombres de los campos.
					$nombresCampos = fgetcsv($filecsv, 10000, ',');
					if (
						 in_array("fecha", $nombresCampos) &&
						 in_array("descripcion", $nombresCampos) &&
						 in_array("referencia", $nombresCampos) &&
						 in_array("cargos", $nombresCampos) &&
						 in_array("abonos", $nombresCampos) &&
						 in_array("saldo", $nombresCampos) &&
						 in_array("clasificacion", $nombresCampos)
						) 
					{
						$row = 0;
						$duplicados = 0;
						$guardados = 0;
						// Lee los registros.
						while (($datos = fgetcsv($filecsv, 10000, ',')) !== FALSE) {
							$row++;
							$fechaSaldo = trim($datos[0]);
							$descSaldo = trim($datos[1]);
							$referSaldo = trim($datos[2]);
							$cargosSaldo = trim($datos[3]);
							$abonosSaldo = trim($datos[4]);
							$saldoTotal = trim($datos[5]);
							$clasifiSaldo = trim($datos[6]);
							// Valida Fecha.
							if ($fechaSaldo != "") {
								// Valida el fomato de fecha 'yyyy-mm-dd'.
								if (!preg_match("/^[1-2]{1}[0-9]{1}[0-9]{1}[0-9]{1}[-][0-1]{1}[0-9]{1}[-][0-3]{1}[0-9]{1}$/", $fechaSaldo)) {
									$this -> msjErr = "La fecha ".$fechaSaldo." no es valida. Utiliza el formato: yyyy-mm-dd<br>";
									$band = 1;
								}
							}
							if ($band == 0) {
								// Signos de precio a remplazar.
								$signos = array("$", ",");
								// Valida Cargos.
								if ($cargosSaldo != "") {
									// Elimina el signo de pesos y la coma de cargos.
									$cargo = str_replace($signos, '', $cargosSaldo);
								} else {
									$cargo = 0;
								}
								// Valida Abonos.
								if ($abonosSaldo != "") {
									// Elimina el signo de pesos y la coma de abonos.
									$abonos = str_replace($signos, '', $abonosSaldo);
								} else {
									$abonos = 0;
								}
								// Valida Saldo.
								if ($saldoTotal != "") {
									// Elimina el signo de pesos y la coma de saldo.
									$saldo = str_replace($signos, '', $saldoTotal);
								}
								// Validar registros duplicados.
								$query = $Conexion -> prepare('SELECT id_saldo FROM saldos
																WHERE fecha_s = :fec
																 AND descripcion_s = :des
																 AND referencia_s = :ref
																 AND CAST(cargos_s AS DECIMAL) = CAST(:car AS DECIMAL)
																 AND CAST(abonos_s AS DECIMAL) = CAST(:abo AS DECIMAL);');
								$query -> bindParam(':fec', $fechaSaldo);
								$query -> bindParam(':des', $descSaldo);
								$query -> bindParam(':ref', $referSaldo);
								$query -> bindParam(':car', $cargo);
								$query -> bindParam(':abo', $abonos);
								$query -> execute();
								$rows = $query -> rowCount();
								if ($rows != 0) {
									$duplicados += 1;
								} else {
									$guardados += 1;
									// Convierte a mayúsculas.
									$descSaldo = mb_strtoupper($descSaldo);
									$clasifiSaldo = mb_strtoupper($clasifiSaldo);
									// Registrar saldo.
									$query = $Conexion -> prepare('INSERT INTO saldos (id_saldo,
																					   fecha_s,
																					   descripcion_s,
																					   referencia_s,
																					   cargos_s,
																					   abonos_s,
																					   saldo,
																					   clasificacion_s,
																					   fecha_registro)
																	VALUES(:IDsaldo,
																		   :fec,
																		   :des,
																		   :ref,
																		   :car,
																		   :abo,
																		   :sal,
																		   :clas,
																		   NOW());');
									$idSaldo = $this -> incrementoIdSaldo();
									$query -> bindParam(':IDsaldo', $idSaldo);
									$query -> bindParam(':fec', $fechaSaldo);
									$query -> bindParam(':des', $descSaldo);
									$query -> bindParam(':ref', $referSaldo);
									$query -> bindParam(':car', $cargo);
									$query -> bindParam(':abo', $abonos);
									$query -> bindParam(':sal', $saldo);
									$query -> bindParam(':clas', $clasifiSaldo);
									$query -> execute();
								}
							} // Band es igual a 0. 
						} // Fin de leer los registros.
						// Cerrar Fichero.
						fclose($filecsv);
						$this -> msjOK = "<p>".$guardados." registros guardados de ".$row;
						$this -> msjOK .= " / ".$duplicados." registros duplicados de ".$row."</p>";
						// Si se guardaron registros muestra la tabla de los saldos registrados.
						if ($guardados != 0) {
							echo $this -> saldosGuardados($guardados);
						}
					} else {
						$this -> msjErr = "Datos de campos no encontrados.";
					}
				} // fopen fichero.
			} // Band es igual a 0.
		} // Función registrarSaldos.
		// Función de agregar cuenta bancaria después de registrar saldos.
		public function agregarCuentaBancaria($numCuenta) {
			$Conexion = new dataBaseConn();
			foreach ($numCuenta as $key => $value) {
				$query = $Conexion -> prepare('UPDATE saldos SET num_cbancaria = :numCue WHERE id_saldo = :IDsaldo;');
				$query -> bindParam(':numCue', $value);
				$query -> bindParam(':IDsaldo', $key);
				$result = $query -> execute();
				if ($result == TRUE) {
					$this -> agregado = "correctamente";
				}
			}
		}
		// Desactivar Saldo.
		public function desactivarSaldo($idSaldo) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('UPDATE saldos SET agregado = :valorS WHERE id_saldo = :IDsaldo;');
			$saldoAgregado = 'Si';
			$query -> bindParam(':valorS', $saldoAgregado);
			$query -> bindParam(':IDsaldo', $idSaldo);
			$result = $query -> execute();
			if ($result == true) {
				$this -> msjDes = "Saldo Desactivado";
				return $result;
			}
		} // Función desactivarSaldo.
		// Activar Saldo.
		public function activarSaldo($idSaldo) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('UPDATE saldos SET agregado = :valorN WHERE id_saldo = :IDsaldo;');
			$saldoAgregado = 'No';
			$query -> bindParam(':valorN', $saldoAgregado);
			$query -> bindParam(':IDsaldo', $idSaldo);
			$result = $query -> execute();
			if ($result == true) {
				$this -> msjAct = "Saldo Activado";
				return $result;
			}
		} // Función activarSaldo.
		// Eliminar Saldo.
		public function eliminarSaldo($idSaldo) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('DELETE FROM saldos WHERE id_saldo = :IDsaldo;');
			$query -> bindParam(':IDsaldo', $idSaldo);
			$result = $query -> execute();
			if ($result == true) {
				$this -> msjOK = "eliminado";
				return $result;
			}
		} // Función eliminarSaldo.
		// Detalle de saldos registrados.
		public function detalleSaldo($idSaldo) {
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT 
											id_saldo,
											fecha_s,
											descripcion_s,
											referencia_s,
											cargos_s,
											abonos_s,
											saldo,
											clasificacion_s,
											num_cbancaria,
											forma_pago,
											fecha_registro
										   FROM saldos
										   WHERE id_saldo = :IDsaldo;');
			$query -> bindParam(':IDsaldo', $idSaldo);
			$query -> execute();
			$detSaldos = $query -> fetch(); 
			return $detSaldos;
		} // Función detalleSaldo.
	} // Class Saldos.
?>