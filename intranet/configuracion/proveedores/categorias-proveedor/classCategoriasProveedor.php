<?php
	require'../../../class/dataBaseConn.php';
	class CategoriasProveedor
	{	
		public function obtenerCategoriasProveedor() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_cat_prov,nombre_cat_prov FROM categorias_proveedor');
			$sth -> execute();
			$catProveedor = $sth -> fetchAll();
			return $catProveedor;
		}

		public function registrarCategoriaProveedor($NomCatProve) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($NomCatProve != "") {
				$NomCatProve = trim(mb_strtoupper($NomCatProve));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_cat_prov FROM categorias_proveedor WHERE nombre_cat_prov = :nomCatProv');
				$sth -> bindParam(':nomCatProv', $NomCatProve);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la categoría: <i>".$NomCatProve."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				// 1
				$query = $Conexion -> prepare('SELECT id_cat_prov FROM categorias_proveedor ORDER BY id_cat_prov DESC LIMIT 1;');
				$query -> execute();
				$result = $query -> fetch(PDO::FETCH_ASSOC);
				$idCatProv = $result['id_cat_prov'];
				if ($query -> rowCount() != 0) {
					$idCatProv = ($idCatProv + 1);
				}else{
					$idCatProv = 1;
				}
				// 2
				$sth = $Conexion -> prepare('INSERT INTO categorias_proveedor(id_cat_prov,nombre_cat_prov) VALUES(:idCatProv,:nomCatProv)');
				$sth -> bindParam(':idCatProv', $idCatProv);
				$sth -> bindParam(':nomCatProv', $NomCatProve);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function obtenerDatoCategoriaProveedor($IDcatProv) {
			$Conexion = new dataBaseConn();
			if ($IDcatProv != "") {
				$sth = $Conexion -> prepare('SELECT nombre_cat_prov FROM categorias_proveedor WHERE id_cat_prov = :idCatProv');
				$sth -> bindParam(':idCatProv', $IDcatProv);
				$sth -> execute();
				$resultado = $sth -> fetch();
				return $resultado;
			}
		}

		public function modificarCategoriaProveedor($IDcatProv,$NomCatProve) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDcatProv != "" && $NomCatProve != "") {
				$NomCatProve = trim(mb_strtoupper($NomCatProve));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_cat_prov FROM categorias_proveedor WHERE nombre_cat_prov = :nomCatProv AND id_cat_prov != :idCatProv');
				$sth -> bindParam(':idCatProv', $IDcatProv);
				$sth -> bindParam(':nomCatProv', $NomCatProve);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la categoría: <i>".$NomCatProve."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('UPDATE categorias_proveedor SET nombre_cat_prov = :nomCatProv WHERE id_cat_prov = :idCatProv');
				$sth -> bindParam(':idCatProv', $IDcatProv);
				$sth -> bindParam(':nomCatProv', $NomCatProve);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarCategoriaProveedor($IDcatProv) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDcatProv != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT id_cat_prov FROM proveedores WHERE id_cat_prov = :idCatprov');
				$sth -> bindParam(':idCatprov', $IDcatProv);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "El registro seleccionado no puede ser eliminado.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM categorias_proveedor WHERE id_cat_prov = :idCatprov');
				$sth -> bindParam(':idCatprov', $IDcatProv);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Registro eliminado exitosamente.";
					return $result;
				}
			}
		}
	}
?>