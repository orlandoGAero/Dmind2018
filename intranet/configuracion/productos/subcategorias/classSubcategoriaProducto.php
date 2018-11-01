<?php
	require'../../../class/dataBaseConn.php';
	class SubcategoriaProducto
	{	
		public function obtenerSubcategoriasProducto() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_subcategoria,nombre_subcategoria FROM subcategorias');
			$sth -> execute();
			$subcategoriasProd = $sth -> fetchAll();
			return $subcategoriasProd;
		}

		public function registrarSubcategoriaProducto($NomSubcatProduct) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($NomSubcatProduct != "") {
				$NomSubcatProduct = trim(mb_strtoupper($NomSubcatProduct));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_subcategoria FROM subcategorias WHERE nombre_subcategoria = :nomSubcatProd');
				$sth -> bindParam(':nomSubcatProd', $NomSubcatProduct);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la subcategoría: <i>".$NomSubcatProduct."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('INSERT INTO subcategorias(nombre_subcategoria) VALUES(:nomSubcatProd)');
				$sth -> bindParam(':nomSubcatProd', $NomSubcatProduct);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function obtenerDatoSubcategoriaProducto($IDsubcatProduct) {
			$Conexion = new dataBaseConn();
			if ($IDsubcatProduct != "") {
				$sth = $Conexion -> prepare('SELECT nombre_subcategoria FROM subcategorias WHERE id_subcategoria = :idSubcatProd');
				$sth -> bindParam(':idSubcatProd', $IDsubcatProduct);
				$sth -> execute();
				$resultado = $sth -> fetch();
				return $resultado;
			}
		}

		public function modificarSubcategoriaProducto($IDsubcatProduct,$NomSubcatProduct) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDsubcatProduct != "" && $NomSubcatProduct != "") {
				$NomSubcatProduct = trim(mb_strtoupper($NomSubcatProduct));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_subcategoria FROM subcategorias WHERE nombre_subcategoria = :nomSubcatProd AND id_subcategoria != :idSubcatProd');
				$sth -> bindParam(':idSubcatProd', $IDsubcatProduct);
				$sth -> bindParam(':nomSubcatProd', $NomSubcatProduct);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la subcategoría: <i>".$NomSubcatProduct."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('UPDATE subcategorias SET nombre_subcategoria = :nomSubcatProd WHERE id_subcategoria = :idSubcatProd');
				$sth -> bindParam(':idSubcatProd', $IDsubcatProduct);
				$sth -> bindParam(':nomSubcatProd', $NomSubcatProduct);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarSubcategoriaProducto($IDsubcatProduct) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDsubcatProduct != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT id_subcategoria FROM productos WHERE id_subcategoria = :idSubcatProd');
				$sth -> bindParam(':idSubcatProd', $IDsubcatProduct);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "La subcategoría seleccionada no puede ser eliminada.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM subcategorias WHERE id_subcategoria = :idSubcatProd');
				$sth -> bindParam(':idSubcatProd', $IDsubcatProduct);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Subcategoría eliminada exitosamente.";
					return $result;
				}
			}
		}
	}
?>