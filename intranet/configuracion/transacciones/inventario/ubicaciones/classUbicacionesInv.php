<?php
	require'../../../../class/dataBaseConn.php';
	class UbicacionesInv
	{	
		public function obtenerUbicacionesInventario() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_ubicacion,nombre_ubicacion FROM ubicaciones');
			$sth -> execute();
			$ubicacionesInv = $sth -> fetchAll();
			return $ubicacionesInv;
		}

		public function registrarUbicacionInventario($NameUbicacionInvent) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($NameUbicacionInvent != "") {
				$NameUbicacionInvent = trim(mb_strtoupper($NameUbicacionInvent));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_ubicacion FROM ubicaciones WHERE nombre_ubicacion = :nomUbInv');
				$sth -> bindParam(':nomUbInv', $NameUbicacionInvent);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la ubicación: <i>".$NameUbicacionInvent."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('INSERT INTO ubicaciones(nombre_ubicacion) VALUES(:nomUbInv)');
				$sth -> bindParam(':nomUbInv', $NameUbicacionInvent);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function obtenerDatoUbicacionInventario($IDubicacionInvent) {
			$Conexion = new dataBaseConn();
			if ($IDubicacionInvent != "") {
				$sth = $Conexion -> prepare('SELECT nombre_ubicacion FROM ubicaciones WHERE id_ubicacion = :idUbInv');
				$sth -> bindParam(':idUbInv', $IDubicacionInvent);
				$sth -> execute();
				$resultado = $sth -> fetch();
				return $resultado;
			}
		}

		public function modificarUbicacionInventario($IDubicacionInvent,$NameUbicacionInvent) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDubicacionInvent != "" && $NameUbicacionInvent != "") {
				$NameUbicacionInvent = trim(mb_strtoupper($NameUbicacionInvent));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_ubicacion FROM ubicaciones WHERE nombre_ubicacion = :nomUbInv AND id_ubicacion != :idUbInv');
				$sth -> bindParam(':idUbInv', $IDubicacionInvent);
				$sth -> bindParam(':nomUbInv', $NameUbicacionInvent);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la ubicación: <i>".$NameUbicacionInvent."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('UPDATE ubicaciones SET nombre_ubicacion = :nomUbInv WHERE id_ubicacion = :idUbInv');
				$sth -> bindParam(':idUbInv', $IDubicacionInvent);
				$sth -> bindParam(':nomUbInv', $NameUbicacionInvent);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarUbicacionInventario($IDubicacionInvent) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDubicacionInvent != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT id_ubicacion FROM inventario WHERE id_ubicacion = :idUbInv');
				$sth -> bindParam(':idUbInv', $IDubicacionInvent);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "La ubicación seleccionada no puede ser eliminada.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM ubicaciones WHERE id_ubicacion = :idUbInv');
				$sth -> bindParam(':idUbInv', $IDubicacionInvent);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Ubicación eliminada exitosamente.";
					return $result;
				}
			}
		}
	}
?>