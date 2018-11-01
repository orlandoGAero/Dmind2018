<?php
	require'../../../class/dataBaseConn.php';
	class TiposP
	{	
		public function obtenerTiposProducto() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_tipo,nombre_tipo FROM tipos');
			$sth -> execute();
			$tiposProd = $sth -> fetchAll();
			return $tiposProd;
		}

		public function registrarTipoProducto($NameTipoProduct) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($NameTipoProduct != "") {
				$NameTipoProduct = trim(mb_strtoupper($NameTipoProduct));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_tipo FROM tipos WHERE nombre_tipo = :nomTipProd');
				$sth -> bindParam(':nomTipProd', $NameTipoProduct);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrado el tipo: <i>".$NameTipoProduct."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('INSERT INTO tipos(nombre_tipo) VALUES(:nomTipProd)');
				$sth -> bindParam(':nomTipProd', $NameTipoProduct);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function obtenerDatoTipoProducto($IDTipProduct) {
			$Conexion = new dataBaseConn();
			if ($IDTipProduct != "") {
				$sth = $Conexion -> prepare('SELECT nombre_tipo FROM tipos WHERE id_tipo = :idTipProd');
				$sth -> bindParam(':idTipProd', $IDTipProduct);
				$sth -> execute();
				$resultado = $sth -> fetch();
				return $resultado;
			}
		}

		public function modificarTipoProducto($IDTipProduct,$NameTipoProduct) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDTipProduct != "" && $NameTipoProduct != "") {
				$NameTipoProduct = trim(mb_strtoupper($NameTipoProduct));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_tipo FROM tipos WHERE nombre_tipo = :nomTipProd AND id_tipo != :idTipProd');
				$sth -> bindParam(':idTipProd', $IDTipProduct);
				$sth -> bindParam(':nomTipProd', $NameTipoProduct);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrado el tipo: <i>".$NameTipoProduct."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('UPDATE tipos SET nombre_tipo = :nomTipProd WHERE id_tipo = :idTipProd');
				$sth -> bindParam(':idTipProd', $IDTipProduct);
				$sth -> bindParam(':nomTipProd', $NameTipoProduct);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarTipoProducto($IDTipProduct) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDTipProduct != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT id_tipo FROM productos WHERE id_tipo = :idTipProd');
				$sth -> bindParam(':idTipProd', $IDTipProduct);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "El tipo seleccionado no puede ser eliminado.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM tipos WHERE id_tipo = :idTipProd');
				$sth -> bindParam(':idTipProd', $IDTipProduct);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Tipo eliminado exitosamente.";
					return $result;
				}
			}
		}
	}
?>