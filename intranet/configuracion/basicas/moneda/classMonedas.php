<?php
	require'../../../class/dataBaseConn.php';
	class Monedas
	{	
		public function obtenerMonedas() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_moneda,nombre_moneda,valor FROM moneda');
			$sth -> execute();
			$monedas = $sth -> fetchAll();
			return $monedas;
		}

		public function registrarMoneda($NameMoneda,$ValorMoneda) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($NameMoneda != "" && $ValorMoneda != "") {
				$NameMoneda = trim(mb_strtoupper($NameMoneda));
				$ValorMoneda = trim($ValorMoneda);
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_moneda FROM moneda WHERE nombre_moneda = :nomMoneda');
				$sth -> bindParam(':nomMoneda', $NameMoneda);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la moneda: <i>".$NameMoneda."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('INSERT INTO moneda(nombre_moneda,valor) VALUES(:nomMoneda,:valMoneda)');
				$sth -> bindParam(':nomMoneda', $NameMoneda);
				$sth -> bindParam(':valMoneda', $ValorMoneda);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function obtenerDatoMoneda($IDmoneda) {
			$Conexion = new dataBaseConn();
			if ($IDmoneda != "") {
				$sth = $Conexion -> prepare('SELECT nombre_moneda,valor FROM moneda WHERE id_moneda = :idMoneda');
				$sth -> bindParam(':idMoneda', $IDmoneda);
				$sth -> execute();
				$resultado = $sth -> fetch();
				return $resultado;
			}
		}

		public function modificarMoneda($IDmoneda,$NameMoneda,$ValorMoneda) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDmoneda != "" && $NameMoneda != "" && $ValorMoneda != "") {
				$NameMoneda = trim(mb_strtoupper($NameMoneda));
				$ValorMoneda = trim($ValorMoneda);
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_moneda FROM moneda WHERE nombre_moneda = :nomMoneda AND id_moneda != :idMoneda');
				$sth -> bindParam(':idMoneda', $IDmoneda);
				$sth -> bindParam(':nomMoneda', $NameMoneda);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la moneda: <i>".$NameMoneda."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('UPDATE moneda SET nombre_moneda = :nomMoneda, valor = :valMoneda WHERE id_moneda = :idMoneda');
				$sth -> bindParam(':idMoneda', $IDmoneda);
				$sth -> bindParam(':nomMoneda', $NameMoneda);
				$sth -> bindParam(':valMoneda', $ValorMoneda);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarMoneda($IDmoneda) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDmoneda != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT id_moneda FROM productos WHERE id_moneda = :idMoneda');
				$sth -> bindParam(':idMoneda', $IDmoneda);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "La moneda seleccionada no puede ser eliminada.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM moneda WHERE id_moneda = :idMoneda');
				$sth -> bindParam(':idMoneda', $IDmoneda);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Moneda eliminada exitosamente.";
					return $result;
				}
			}
		}
	}
?>