<?php
	require'../../../../class/dataBaseConn.php';
	class TiposPago
	{	
		public function obtenerTiposPago() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_tipo_pago,nom_tipo_pago FROM tipos_pago');
			$sth -> execute();
			$tiposPago = $sth -> fetchAll();
			return $tiposPago;
		}

		public function registrarTipoPago($NomTipoPago) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($NomTipoPago != "") {
				$NomTipoPago = trim(mb_strtoupper($NomTipoPago));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nom_tipo_pago FROM tipos_pago WHERE nom_tipo_pago = :nomTipoPago');
				$sth -> bindParam(':nomTipoPago', $NomTipoPago);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la forma de pago: <i>".$NomTipoPago."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('INSERT INTO tipos_pago(nom_tipo_pago) VALUES(:nomTipoPago)');
				$sth -> bindParam(':nomTipoPago', $NomTipoPago);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function obtenerDatoTipoPago($IDtipoPago) {
			$Conexion = new dataBaseConn();
			if ($IDtipoPago != "") {
				$sth = $Conexion -> prepare('SELECT nom_tipo_pago FROM tipos_pago WHERE id_tipo_pago = :idTipoPago');
				$sth -> bindParam(':idTipoPago', $IDtipoPago);
				$sth -> execute();
				$resultado = $sth -> fetch();
				return $resultado;
			}
		}

		public function modificarTipoPago($IDtipoPago,$NomTipoPago) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDtipoPago != "" && $NomTipoPago != "") {
				$NomTipoPago = trim(mb_strtoupper($NomTipoPago));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nom_tipo_pago FROM tipos_pago WHERE nom_tipo_pago = :nomTipoPago AND id_tipo_pago != :idTipoPago');
				$sth -> bindParam(':idTipoPago', $IDtipoPago);
				$sth -> bindParam(':nomTipoPago', $NomTipoPago);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la forma de pago: <i>".$NomTipoPago."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('UPDATE tipos_pago SET nom_tipo_pago = :nomTipoPago WHERE id_tipo_pago = :idTipoPago');
				$sth -> bindParam(':idTipoPago', $IDtipoPago);
				$sth -> bindParam(':nomTipoPago', $NomTipoPago);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarTipoPago($IDtipoPago) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDtipoPago != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT id_tipo_pago FROM venta WHERE id_tipo_pago = :idTipoPago');
				$sth -> bindParam(':idTipoPago', $IDtipoPago);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "El registro seleccionado no puede ser eliminado.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM tipos_pago WHERE id_tipo_pago = :idTipoPago');
				$sth -> bindParam(':idTipoPago', $IDtipoPago);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Registro eliminado exitosamente.";
					return $result;
				}
			}
		}
	}
?>