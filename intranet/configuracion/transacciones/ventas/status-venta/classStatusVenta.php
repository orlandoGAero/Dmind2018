<?php
	require'../../../../class/dataBaseConn.php';
	class StatusVenta
	{	
		public function obtenerStatusVenta() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_status_venta,nombre_status_venta FROM status_venta');
			$sth -> execute();
			$statusVenta = $sth -> fetchAll();
			return $statusVenta;
		}

		public function registrarStatusVenta($NomStVenta) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($NomStVenta != "") {
				$NomStVenta = trim(mb_strtoupper($NomStVenta));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_status_venta FROM status_venta WHERE nombre_status_venta = :nomStVenta');
				$sth -> bindParam(':nomStVenta', $NomStVenta);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrado el status: <i>".$NomStVenta."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('INSERT INTO status_venta(nombre_status_venta) VALUES(:nomStVenta)');
				$sth -> bindParam(':nomStVenta', $NomStVenta);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function obtenerDatoStatusVenta($IDstVnt) {
			$Conexion = new dataBaseConn();
			if ($IDstVnt != "") {
				$sth = $Conexion -> prepare('SELECT nombre_status_venta FROM status_venta WHERE id_status_venta = :idStVenta');
				$sth -> bindParam(':idStVenta', $IDstVnt);
				$sth -> execute();
				$resultado = $sth -> fetch();
				return $resultado;
			}
		}

		public function modificarStatusVenta($IDstVnt,$NomStVenta) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDstVnt != "" && $NomStVenta != "") {
				$NomStVenta = trim(mb_strtoupper($NomStVenta));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_status_venta FROM status_venta WHERE nombre_status_venta = :nomStVenta AND id_status_venta != :idStVenta');
				$sth -> bindParam(':idStVenta', $IDstVnt);
				$sth -> bindParam(':nomStVenta', $NomStVenta);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrado el status: <i>".$NomStVenta."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('UPDATE status_venta SET nombre_status_venta = :nomStVenta WHERE id_status_venta = :idStVenta');
				$sth -> bindParam(':idStVenta', $IDstVnt);
				$sth -> bindParam(':nomStVenta', $NomStVenta);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarStatusVenta($IDstVnt) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDstVnt != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT id_status_venta FROM venta WHERE id_status_venta = :idStVenta');
				$sth -> bindParam(':idStVenta', $IDstVnt);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "El registro seleccionado no puede ser eliminado.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM status_venta WHERE id_status_venta = :idStVenta');
				$sth -> bindParam(':idStVenta', $IDstVnt);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Registro eliminado exitosamente.";
					return $result;
				}
			}
		}
	}
?>