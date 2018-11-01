<?php
	require'../../../../class/dataBaseConn.php';
	class TiposVenta
	{	
		public function obtenerTiposVenta() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_tipo_venta,nom_tipo_venta FROM tipos_venta');
			$sth -> execute();
			$tiposVenta = $sth -> fetchAll();
			return $tiposVenta;
		}

		public function registrarTipoVenta($NomTipVenta) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($NomTipVenta != "") {
				$NomTipVenta = trim(mb_strtoupper($NomTipVenta));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nom_tipo_venta FROM tipos_venta WHERE nom_tipo_venta = :nomTipVenta');
				$sth -> bindParam(':nomTipVenta', $NomTipVenta);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrado el tipo: <i>".$NomTipVenta."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('INSERT INTO tipos_venta(nom_tipo_venta) VALUES(:nomTipVenta)');
				$sth -> bindParam(':nomTipVenta', $NomTipVenta);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function obtenerDatoTipoVenta($IDTipVnt) {
			$Conexion = new dataBaseConn();
			if ($IDTipVnt != "") {
				$sth = $Conexion -> prepare('SELECT nom_tipo_venta FROM tipos_venta WHERE id_tipo_venta = :idTipVenta');
				$sth -> bindParam(':idTipVenta', $IDTipVnt);
				$sth -> execute();
				$resultado = $sth -> fetch();
				return $resultado;
			}
		}

		public function modificarTipoVenta($IDTipVnt,$NomTipVenta) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDTipVnt != "" && $NomTipVenta != "") {
				$NomTipVenta = trim(mb_strtoupper($NomTipVenta));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nom_tipo_venta FROM tipos_venta WHERE nom_tipo_venta = :nomTipVenta AND id_tipo_venta != :idTipVenta');
				$sth -> bindParam(':idTipVenta', $IDTipVnt);
				$sth -> bindParam(':nomTipVenta', $NomTipVenta);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrado el tipo: <i>".$NomTipVenta."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('UPDATE tipos_venta SET nom_tipo_venta = :nomTipVenta WHERE id_tipo_venta = :idTipVenta');
				$sth -> bindParam(':idTipVenta', $IDTipVnt);
				$sth -> bindParam(':nomTipVenta', $NomTipVenta);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarTipoVenta($IDTipVnt) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDTipVnt != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT id_tipo_venta FROM venta WHERE id_tipo_venta = :idTipVenta');
				$sth -> bindParam(':idTipVenta', $IDTipVnt);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "El registro seleccionado no puede ser eliminado.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM tipos_venta WHERE id_tipo_venta = :idTipVenta');
				$sth -> bindParam(':idTipVenta', $IDTipVnt);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Registro eliminado exitosamente.";
					return $result;
				}
			}
		}
	}
?>