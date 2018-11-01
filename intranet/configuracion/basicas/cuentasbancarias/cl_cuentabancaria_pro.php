<?php
	require'../../../class/dataBaseConn.php';
	class cuentasBancarias
	{	
		public function obtenerCuentasBancarias() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_cbancarias_p, num_cbancaria_p FROM cuentas_bancarias;');
			$sth -> execute();
			$datCueBancaria = $sth -> fetchAll();
			return $datCueBancaria;
		}

		public function registrarCuentaBancaria($numCuentaBan) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($numCuentaBan != "") {
				$numCuentaBan = trim(mb_strtoupper($numCuentaBan));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT num_cbancaria_p FROM cuentas_bancarias WHERE num_cbancaria_p = :numCueBan');
				$sth -> bindParam(':numCueBan', $numCuentaBan);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrado el no. de cuenta: <i>".$numCuentaBan."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('INSERT INTO cuentas_bancarias(num_cbancaria_p) VALUES(:numCueBan)');
				$sth -> bindParam(':numCueBan', $numCuentaBan);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function infoCuentaBancaria($idCuentaBan) {
			$Conexion = new dataBaseConn();
			if ($idCuentaBan != "") {
				$sth = $Conexion -> prepare('SELECT num_cbancaria_p FROM cuentas_bancarias WHERE id_cbancarias_p = :idCueBan');
				$sth -> bindParam(':idCueBan', $idCuentaBan);
				$sth -> execute();
				$resultado = $sth -> fetch();
				return $resultado;
			}
		}

		public function modificarCuentaBancaria($idCuentaBan, $numCuentaBan) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($idCuentaBan != "" && $numCuentaBan != "") {
				$numCuentaBan = trim(mb_strtoupper($numCuentaBan));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT num_cbancaria_p FROM cuentas_bancarias WHERE num_cbancaria_p = :numCueBan');
				$sth -> bindParam(':numCueBan', $numCuentaBan);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrado el no. de cuenta: <i>".$numCuentaBan."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('UPDATE cuentas_bancarias SET num_cbancaria_p = :numCueBan WHERE id_cbancarias_p = :idCueBan');
				$sth -> bindParam(':idCueBan', $idCuentaBan);
				$sth -> bindParam(':numCueBan', $numCuentaBan);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarCuentaBancaria($idCuentaBan) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($idCuentaBan != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT id_cbancarias_p FROM proveedores_datos_bancarios WHERE id_cbancarias_p = :idCueBan');
				$sth -> bindParam(':idCueBan', $idCuentaBan);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "El registro seleccionado no puede ser eliminado.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM cuentas_bancarias WHERE id_cbancarias_p = :idCueBan');
				$sth -> bindParam(':idCueBan', $idCuentaBan);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Cuenta bancaria eliminada exitosamente.";
					return $result;
				}
			}
		}
	}
?>