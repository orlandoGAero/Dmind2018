<?php
	require'../../../class/dataBaseConn.php';
	class Divisiones
	{	
		public function obtenerDivisionesProducto() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_division,nombre_division FROM division');
			$sth -> execute();
			$divisionesProd = $sth -> fetchAll();
			return $divisionesProd;
		}

		public function registrarDivisionProducto($NomDivProduct) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($NomDivProduct != "") {
				$NomDivProduct = trim(mb_strtoupper($NomDivProduct));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_division FROM division WHERE nombre_division = :nomDivProd');
				$sth -> bindParam(':nomDivProd', $NomDivProduct);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la división: <i>".$NomDivProduct."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('INSERT INTO division(nombre_division) VALUES(:nomDivProd)');
				$sth -> bindParam(':nomDivProd', $NomDivProduct);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function obtenerDatoDivisionProducto($IDdivProduct) {
			$Conexion = new dataBaseConn();
			if ($IDdivProduct != "") {
				$sth = $Conexion -> prepare('SELECT nombre_division FROM division WHERE id_division = :idDivProd');
				$sth -> bindParam(':idDivProd', $IDdivProduct);
				$sth -> execute();
				$resultado = $sth -> fetch();
				return $resultado;
			}
		}

		public function modificarDivisionProducto($IDdivProduct,$NomDivProduct) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDdivProduct != "" && $NomDivProduct != "") {
				$NomDivProduct = trim(mb_strtoupper($NomDivProduct));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_division FROM division WHERE nombre_division = :nomDivProd AND id_division != :idDivProd');
				$sth -> bindParam(':idDivProd', $IDdivProduct);
				$sth -> bindParam(':nomDivProd', $NomDivProduct);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la división: <i>".$NomDivProduct."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('UPDATE division SET nombre_division = :nomDivProd WHERE id_division = :idDivProd');
				$sth -> bindParam(':idDivProd', $IDdivProduct);
				$sth -> bindParam(':nomDivProd', $NomDivProduct);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarDivisionProducto($IDdivProduct) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDdivProduct != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT id_division FROM productos WHERE id_division = :idDivProd');
				$sth -> bindParam(':idDivProd', $IDdivProduct);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "La división seleccionada no puede ser eliminada.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM division WHERE id_division = :idDivProd');
				$sth -> bindParam(':idDivProd', $IDdivProduct);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "División eliminada exitosamente.";
					return $result;
				}
			}
		}
	}
?>