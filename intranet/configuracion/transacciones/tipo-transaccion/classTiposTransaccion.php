<?php
	require'../../../class/dataBaseConn.php';
	class TiposTransaccion
	{	
		public function obtenerTiposTransaccion() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_tipo_transaccion,nombre_tipo_transaccion FROM tipo_transaccion');
			$sth -> execute();
			$tipo_transaccions = $sth -> fetchAll();
			return $tipo_transaccions;
		}

		public function registrarTipoTransaccion($NameTipoTrans) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($NameTipoTrans != "") {
				$NameTipoTrans = trim(mb_strtoupper($NameTipoTrans));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_tipo_transaccion FROM tipo_transaccion WHERE nombre_tipo_transaccion = :nomTipoTrans');
				$sth -> bindParam(':nomTipoTrans', $NameTipoTrans);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrado el tipo: <i>".$NameTipoTrans."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('INSERT INTO tipo_transaccion(nombre_tipo_transaccion) VALUES(:nomTipoTrans)');
				$sth -> bindParam(':nomTipoTrans', $NameTipoTrans);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function obtenerDatoTipoTransaccion($IDtipo_transaccion) {
			$Conexion = new dataBaseConn();
			if ($IDtipo_transaccion != "") {
				$sth = $Conexion -> prepare('SELECT nombre_tipo_transaccion FROM tipo_transaccion WHERE id_tipo_transaccion = :idTipoTrans');
				$sth -> bindParam(':idTipoTrans', $IDtipo_transaccion);
				$sth -> execute();
				$resultado = $sth -> fetch();
				return $resultado;
			}
		}

		public function modificarTipoTransaccion($IDtipo_transaccion,$NameTipoTrans) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDtipo_transaccion != "" && $NameTipoTrans != "") {
				$NameTipoTrans = trim(mb_strtoupper($NameTipoTrans));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_tipo_transaccion FROM tipo_transaccion WHERE nombre_tipo_transaccion = :nomTipoTrans AND id_tipo_transaccion != :idTipoTrans');
				$sth -> bindParam(':idTipoTrans', $IDtipo_transaccion);
				$sth -> bindParam(':nomTipoTrans', $NameTipoTrans);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrado el tipo: <i>".$NameTipoTrans."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('UPDATE tipo_transaccion SET nombre_tipo_transaccion = :nomTipoTrans WHERE id_tipo_transaccion = :idTipoTrans');
				$sth -> bindParam(':idTipoTrans', $IDtipo_transaccion);
				$sth -> bindParam(':nomTipoTrans', $NameTipoTrans);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarTipoTransaccion($IDtipo_transaccion) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDtipo_transaccion != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT id_tipo_transaccion FROM transacciones WHERE id_tipo_transaccion = :idTipoTrans');
				$sth -> bindParam(':idTipoTrans', $IDtipo_transaccion);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "El tipo seleccionado no puede ser eliminado.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM tipo_transaccion WHERE id_tipo_transaccion = :idTipoTrans');
				$sth -> bindParam(':idTipoTrans', $IDtipo_transaccion);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Tipo eliminado exitosamente.";
					return $result;
				}
			}
		}
	}
?>