<?php
	require'../../../class/dataBaseConn.php';
	class Marcas
	{	
		public function obtenerMarcas() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_marca,nombre_marca FROM marca_productos');
			$sth -> execute();
			$marcas = $sth -> fetchAll();
			return $marcas;
		}

		public function registrarMarca($NomMarca) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($NomMarca != "") {
				$NomMarca = trim(mb_strtoupper($NomMarca));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_marca FROM marca_productos WHERE nombre_marca = :nomMarca');
				$sth -> bindParam(':nomMarca', $NomMarca);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la marca: <i>".$NomMarca."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('INSERT INTO marca_productos(nombre_marca) VALUES(:nomMarca)');
				$sth -> bindParam(':nomMarca', $NomMarca);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function obtenerDatoMarca($IDmarca) {
			$Conexion = new dataBaseConn();
			if ($IDmarca != "") {
				$sth = $Conexion -> prepare('SELECT nombre_marca FROM marca_productos WHERE id_marca = :idMarca');
				$sth -> bindParam(':idMarca', $IDmarca);
				$sth -> execute();
				$resultado = $sth -> fetch();
				return $resultado;
			}
		}

		public function modificarMarca($IDmarca,$NomMarca) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDmarca != "" && $NomMarca != "") {
				$NomMarca = trim(mb_strtoupper($NomMarca));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_marca FROM marca_productos WHERE nombre_marca = :nomMarca AND id_marca != :idMarca');
				$sth -> bindParam(':idMarca', $IDmarca);
				$sth -> bindParam(':nomMarca', $NomMarca);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la marca: <i>".$NomMarca."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('UPDATE marca_productos SET nombre_marca = :nomMarca WHERE id_marca = :idMarca');
				$sth -> bindParam(':idMarca', $IDmarca);
				$sth -> bindParam(':nomMarca', $NomMarca);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarMarca($IDmarca) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDmarca != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT id_marca FROM productos WHERE id_marca = :idMarca');
				$sth -> bindParam(':idMarca', $IDmarca);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "El registro seleccionado no puede ser eliminado.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM marca_productos WHERE id_marca = :idMarca');
				$sth -> bindParam(':idMarca', $IDmarca);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Registro eliminado exitosamente.";
					return $result;
				}
			}
		}
	}
?>