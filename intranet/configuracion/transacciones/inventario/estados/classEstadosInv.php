<?php
	require'../../../../class/dataBaseConn.php';
	class EstadosInv
	{	
		public function obtenerEstadosInventario() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_estado,nombre_estado FROM estados');
			$sth -> execute();
			$estadosInv = $sth -> fetchAll();
			return $estadosInv;
		}

		public function registrarEstadoInventario($NameEstadoInvent) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($NameEstadoInvent != "") {
				$NameEstadoInvent = trim(mb_strtoupper($NameEstadoInvent));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_estado FROM estados WHERE nombre_estado = :nomEstInv');
				$sth -> bindParam(':nomEstInv', $NameEstadoInvent);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrado el estado: <i>".$NameEstadoInvent."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('INSERT INTO estados(nombre_estado) VALUES(:nomEstInv)');
				$sth -> bindParam(':nomEstInv', $NameEstadoInvent);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function obtenerDatoEstadoInventario($IDEstadoInvent) {
			$Conexion = new dataBaseConn();
			if ($IDEstadoInvent != "") {
				$sth = $Conexion -> prepare('SELECT nombre_estado FROM estados WHERE id_estado = :idEstInv');
				$sth -> bindParam(':idEstInv', $IDEstadoInvent);
				$sth -> execute();
				$resultado = $sth -> fetch();
				return $resultado;
			}
		}

		public function modificarEstadoInventario($IDEstadoInvent,$NameEstadoInvent) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDEstadoInvent != "" && $NameEstadoInvent != "") {
				$NameEstadoInvent = trim(mb_strtoupper($NameEstadoInvent));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_estado FROM estados WHERE nombre_estado = :nomEstInv AND id_estado != :idEstInv');
				$sth -> bindParam(':idEstInv', $IDEstadoInvent);
				$sth -> bindParam(':nomEstInv', $NameEstadoInvent);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrado el estado: <i>".$NameEstadoInvent."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('UPDATE estados SET nombre_estado = :nomEstInv WHERE id_estado = :idEstInv');
				$sth -> bindParam(':idEstInv', $IDEstadoInvent);
				$sth -> bindParam(':nomEstInv', $NameEstadoInvent);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarEstadoInventario($IDEstadoInvent) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDEstadoInvent != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT id_estado FROM inventario WHERE id_estado = :idEstInv');
				$sth -> bindParam(':idEstInv', $IDEstadoInvent);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "El estado seleccionado no puede ser eliminado.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM estados WHERE id_estado = :idEstInv');
				$sth -> bindParam(':idEstInv', $IDEstadoInvent);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Estado eliminado exitosamente.";
					return $result;
				}
			}
		}
	}
?>