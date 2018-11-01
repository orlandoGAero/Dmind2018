<?php
	require'../../../class/dataBaseConn.php';
	class CategoriasCliente
	{	
		public function obtenerCategoriasCliente() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_categoria_cliente,nombre_categoria_cliente FROM categoria_cliente');
			$sth -> execute();
			$catCliente = $sth -> fetchAll();
			return $catCliente;
		}

		public function registrarCategoriaCliente($NomCatClient) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($NomCatClient != "") {
				$NomCatClient = trim(mb_strtoupper($NomCatClient));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_categoria_cliente FROM categoria_cliente WHERE nombre_categoria_cliente = :nomCatClie');
				$sth -> bindParam(':nomCatClie', $NomCatClient);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la categoría: <i>".$NomCatClient."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				// 1
				$query = $Conexion -> prepare('SELECT id_categoria_cliente FROM categoria_cliente ORDER BY id_categoria_cliente DESC LIMIT 1;');
				$query -> execute();
				$result = $query -> fetch(PDO::FETCH_ASSOC);
				$idCatClie = $result['id_categoria_cliente'];
				if ($query -> rowCount() != 0) {
					$idCatClie = ($idCatClie + 1);
				}else{
					$idCatClie = 1;
				}
				// 2
				$sth = $Conexion -> prepare('INSERT INTO categoria_cliente(id_categoria_cliente,nombre_categoria_cliente) VALUES(:idCatClie,:nomCatClie)');
				$sth -> bindParam(':idCatClie', $idCatClie);
				$sth -> bindParam(':nomCatClie', $NomCatClient);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function obtenerDatoCategoriaCliente($IDcatClie) {
			$Conexion = new dataBaseConn();
			if ($IDcatClie != "") {
				$sth = $Conexion -> prepare('SELECT nombre_categoria_cliente FROM categoria_cliente WHERE id_categoria_cliente = :idCatClie');
				$sth -> bindParam(':idCatClie', $IDcatClie);
				$sth -> execute();
				$resultado = $sth -> fetch();
				return $resultado;
			}
		}

		public function modificarCategoriaCliente($IDcatClie,$NomCatClient) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDcatClie != "" && $NomCatClient != "") {
				$NomCatClient = trim(mb_strtoupper($NomCatClient));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_categoria_cliente FROM categoria_cliente WHERE nombre_categoria_cliente = :nomCatClie AND id_categoria_cliente != :idCatClie');
				$sth -> bindParam(':idCatClie', $IDcatClie);
				$sth -> bindParam(':nomCatClie', $NomCatClient);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la categoría: <i>".$NomCatClient."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('UPDATE categoria_cliente SET nombre_categoria_cliente = :nomCatClie WHERE id_categoria_cliente = :idCatClie');
				$sth -> bindParam(':idCatClie', $IDcatClie);
				$sth -> bindParam(':nomCatClie', $NomCatClient);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarCategoriaCliente($IDcatClie) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDcatClie != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT id_categoria_cliente FROM clientes WHERE id_categoria_cliente = :idCatClie');
				$sth -> bindParam(':idCatClie', $IDcatClie);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "La categoría seleccionada no puede ser eliminada.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM categoria_cliente WHERE id_categoria_cliente = :idCatClie');
				$sth -> bindParam(':idCatClie', $IDcatClie);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Categoría eliminada exitosamente.";
					return $result;
				}
			}
		}
	}
?>