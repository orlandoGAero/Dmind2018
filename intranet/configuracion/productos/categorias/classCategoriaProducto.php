<?php
	require'../../../class/dataBaseConn.php';
	class CategoriaProducto
	{	
		public function obtenerCategoriasProducto() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_categoria,nombre_categoria FROM categorias');
			$sth -> execute();
			$categoriasProd = $sth -> fetchAll();
			return $categoriasProd;
		}

		public function registrarCategoriaProducto($NomCatProduct) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($NomCatProduct != "") {
				$NomCatProduct = trim(mb_strtoupper($NomCatProduct));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_categoria FROM categorias WHERE nombre_categoria = :nomCatProd');
				$sth -> bindParam(':nomCatProd', $NomCatProduct);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la categoría: <i>".$NomCatProduct."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('INSERT INTO categorias(nombre_categoria) VALUES(:nomCatProd)');
				$sth -> bindParam(':nomCatProd', $NomCatProduct);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function obtenerDatoCategoriaProducto($IDcatProduct) {
			$Conexion = new dataBaseConn();
			if ($IDcatProduct != "") {
				$sth = $Conexion -> prepare('SELECT nombre_categoria FROM categorias WHERE id_categoria = :idCatProd');
				$sth -> bindParam(':idCatProd', $IDcatProduct);
				$sth -> execute();
				$resultado = $sth -> fetch();
				return $resultado;
			}
		}

		public function modificarCategoriaProducto($IDcatProduct,$NomCatProduct) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDcatProduct != "" && $NomCatProduct != "") {
				$NomCatProduct = trim(mb_strtoupper($NomCatProduct));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_categoria FROM categorias WHERE nombre_categoria = :nomCatProd AND id_categoria != :idCatProd');
				$sth -> bindParam(':idCatProd', $IDcatProduct);
				$sth -> bindParam(':nomCatProd', $NomCatProduct);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la categoría: <i>".$NomCatProduct."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('UPDATE categorias SET nombre_categoria = :nomCatProd WHERE id_categoria = :idCatProd');
				$sth -> bindParam(':idCatProd', $IDcatProduct);
				$sth -> bindParam(':nomCatProd', $NomCatProduct);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarCategoriaProducto($IDcatProduct) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDcatProduct != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT id_categoria FROM productos WHERE id_categoria = :idCatProd');
				$sth -> bindParam(':idCatProd', $IDcatProduct);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "La categoría seleccionada no puede ser eliminada.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM categorias WHERE id_categoria = :idCatProd');
				$sth -> bindParam(':idCatProd', $IDcatProduct);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Categoría eliminada exitosamente.";
					return $result;
				}
			}
		}
	}
?>