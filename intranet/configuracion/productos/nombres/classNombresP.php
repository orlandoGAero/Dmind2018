<?php
	require'../../../class/dataBaseConn.php';
	class NombresP
	{	
		public function obtenerNombresProducto() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_nombre,nombre FROM nombres');
			$sth -> execute();
			$nombresProd = $sth -> fetchAll();
			return $nombresProd;
		}

		public function registrarNombreProducto($NomProduct) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($NomProduct != "") {
				$NomProduct = trim(mb_strtoupper($NomProduct));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre FROM nombres WHERE nombre = :nomProd');
				$sth -> bindParam(':nomProd', $NomProduct);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrado el nombre: <i>".$NomProduct."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('INSERT INTO nombres(nombre) VALUES(:nomProd)');
				$sth -> bindParam(':nomProd', $NomProduct);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function obtenerDatoNombreProducto($IDnomProduct) {
			$Conexion = new dataBaseConn();
			if ($IDnomProduct != "") {
				$sth = $Conexion -> prepare('SELECT nombre FROM nombres WHERE id_nombre = :idNomProd');
				$sth -> bindParam(':idNomProd', $IDnomProduct);
				$sth -> execute();
				$resultado = $sth -> fetch();
				return $resultado;
			}
		}

		public function modificarNombreProducto($IDnomProduct,$NomProduct) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDnomProduct != "" && $NomProduct != "") {
				$NomProduct = trim(mb_strtoupper($NomProduct));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre FROM nombres WHERE nombre = :nomProd AND id_nombre != :idNomProd');
				$sth -> bindParam(':idNomProd', $IDnomProduct);
				$sth -> bindParam(':nomProd', $NomProduct);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrado el nombre: <i>".$NomProduct."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('UPDATE nombres SET nombre = :nomProd WHERE id_nombre = :idNomProd');
				$sth -> bindParam(':idNomProd', $IDnomProduct);
				$sth -> bindParam(':nomProd', $NomProduct);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarNombreProducto($IDnomProduct) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDnomProduct != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT id_nombre FROM productos WHERE id_nombre = :idNomProd');
				$sth -> bindParam(':idNomProd', $IDnomProduct);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "El nombre seleccionado no puede ser eliminado.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM nombres WHERE id_nombre = :idNomProd');
				$sth -> bindParam(':idNomProd', $IDnomProduct);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Nombre eliminado exitosamente.";
					return $result;
				}
			}
		}
	}
?>