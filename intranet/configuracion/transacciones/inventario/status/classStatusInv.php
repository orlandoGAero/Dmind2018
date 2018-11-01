<?php
	require'../../../../class/dataBaseConn.php';
	class StatusInv
	{	
		public function obtenerStatusInventario() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_status,nombre_status FROM status_inventario');
			$sth -> execute();
			$statusInv = $sth -> fetchAll();
			return $statusInv;
		}

		public function registrarStatusInventario($NameStatusInvent) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($NameStatusInvent != "") {
				$NameStatusInvent = trim(mb_strtoupper($NameStatusInvent));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_status FROM status_inventario WHERE nombre_status = :nomStInv');
				$sth -> bindParam(':nomStInv', $NameStatusInvent);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrado el status: <i>".$NameStatusInvent."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('INSERT INTO status_inventario(nombre_status) VALUES(:nomStInv)');
				$sth -> bindParam(':nomStInv', $NameStatusInvent);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function obtenerDatoStatusInventario($IDStatusInvent) {
			$Conexion = new dataBaseConn();
			if ($IDStatusInvent != "") {
				$sth = $Conexion -> prepare('SELECT nombre_status FROM status_inventario WHERE id_status = :idStInv');
				$sth -> bindParam(':idStInv', $IDStatusInvent);
				$sth -> execute();
				$resultado = $sth -> fetch();
				return $resultado;
			}
		}

		public function modificarStatusInventario($IDStatusInvent,$NameStatusInvent) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDStatusInvent != "" && $NameStatusInvent != "") {
				$NameStatusInvent = trim(mb_strtoupper($NameStatusInvent));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_status FROM status_inventario WHERE nombre_status = :nomStInv AND id_status != :idStInv');
				$sth -> bindParam(':idStInv', $IDStatusInvent);
				$sth -> bindParam(':nomStInv', $NameStatusInvent);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrado el status: <i>".$NameStatusInvent."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('UPDATE status_inventario SET nombre_status = :nomStInv WHERE id_status = :idStInv');
				$sth -> bindParam(':idStInv', $IDStatusInvent);
				$sth -> bindParam(':nomStInv', $NameStatusInvent);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarStatusInventario($IDStatusInvent) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDStatusInvent != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT id_status FROM inventario WHERE id_status = :idStInv');
				$sth -> bindParam(':idStInv', $IDStatusInvent);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "El status seleccionado no puede ser eliminado.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM status_inventario WHERE id_status = :idStInv');
				$sth -> bindParam(':idStInv', $IDStatusInvent);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Status eliminado exitosamente.";
					return $result;
				}
			}
		}
	}
?>