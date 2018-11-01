<?php
	require'../../../class/dataBaseConn.php';
	class UnidadesP
	{	
		public function obtenerUnidadesProducto() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_unidad,nombre_unidad FROM unidades');
			$sth -> execute();
			$unidadesProd = $sth -> fetchAll();
			return $unidadesProd;
		}

		public function registrarUnidadProducto($NameUnidadProduct) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($NameUnidadProduct != "") {
				$NameUnidadProduct = trim(mb_strtoupper($NameUnidadProduct));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_unidad FROM unidades WHERE nombre_unidad = :nomUnidProd');
				$sth -> bindParam(':nomUnidProd', $NameUnidadProduct);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la unidad: <i>".$NameUnidadProduct."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('INSERT INTO unidades(nombre_unidad) VALUES(:nomUnidProd)');
				$sth -> bindParam(':nomUnidProd', $NameUnidadProduct);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function obtenerDatoUnidadProducto($IDUniProduct) {
			$Conexion = new dataBaseConn();
			if ($IDUniProduct != "") {
				$sth = $Conexion -> prepare('SELECT nombre_unidad FROM unidades WHERE id_unidad = :idUniProd');
				$sth -> bindParam(':idUniProd', $IDUniProduct);
				$sth -> execute();
				$resultado = $sth -> fetch();
				return $resultado;
			}
		}

		public function modificarUnidadProducto($IDUniProduct,$NameUnidadProduct) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDUniProduct != "" && $NameUnidadProduct != "") {
				$NameUnidadProduct = trim(mb_strtoupper($NameUnidadProduct));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_unidad FROM unidades WHERE nombre_unidad = :nomUnidProd AND id_unidad != :idUniProd');
				$sth -> bindParam(':idUniProd', $IDUniProduct);
				$sth -> bindParam(':nomUnidProd', $NameUnidadProduct);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la unidad: <i>".$NameUnidadProduct."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('UPDATE unidades SET nombre_unidad = :nomUnidProd WHERE id_unidad = :idUniProd');
				$sth -> bindParam(':idUniProd', $IDUniProduct);
				$sth -> bindParam(':nomUnidProd', $NameUnidadProduct);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarUnidadProducto($IDUniProduct) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDUniProduct != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT id_unidad FROM productos WHERE id_unidad = :idUniProd');
				$sth -> bindParam(':idUniProd', $IDUniProduct);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "La unidad seleccionada no puede ser eliminada.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM unidades WHERE id_unidad = :idUniProd');
				$sth -> bindParam(':idUniProd', $IDUniProduct);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Unidad eliminada exitosamente.";
					return $result;
				}
			}
		}
	}
?>