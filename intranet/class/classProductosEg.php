<?php
	require	'dataBaseConn.php';
	
	class Productos {
		
		public function getCategorias() {
			$Conexion = new dataBaseConn();
			$sql = $Conexion->prepare("SELECT * FROM categorias");
			$sql->execute();
			$result = $sql->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}

		public function getSubCategorias() {
			$Conexion = new dataBaseConn();
			$sql = $Conexion->prepare("SELECT id_subcategoria, nombre_subcategoria FROM subcategorias");
			$sql->execute();
			$result = $sql->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}

		public function getDivisiones() {
			$Conexion = new dataBaseConn();
			$sql = $Conexion -> prepare('SELECT id_division,nombre_division FROM division');
			$sql -> execute();
			$divisiones = $sql -> fetchAll(PDO::FETCH_ASSOC);
			return $divisiones;
		}

		public function getNombres() {
			$Conexion = new dataBaseConn();
			$sql = $Conexion -> prepare('SELECT id_nombre,nombre FROM nombres');
			$sql -> execute();
			$nombres = $sql -> fetchAll(PDO::FETCH_ASSOC);
			return $nombres;
		}

		public function getTipos() {
			$Conexion = new dataBaseConn();
			$sql = $Conexion -> prepare('SELECT id_tipo,nombre_tipo FROM tipos');
			$sql -> execute();
			$tipos = $sql -> fetchAll(PDO::FETCH_ASSOC);
			return $tipos;
		}

		public function getMarcas() {
			$Conexion = new dataBaseConn();
			$sql = $Conexion -> prepare('SELECT id_marca,nombre_marca FROM marca_productos');
			$sql -> execute();
			$marcas = $sql -> fetchAll(PDO::FETCH_ASSOC);
			return $marcas;
		}

		public function getUnidades() {
			$Conexion = new dataBaseConn();
			$sql = $Conexion -> prepare('SELECT DISTINCT id_unidad,nombre_unidad FROM unidades');
			$sql -> execute();
			$unidades = $sql -> fetchAll(PDO::FETCH_ASSOC);
			return $unidades;
		}

		public function getMonedas() {
			$Conexion = new dataBaseConn();
			$sql = $Conexion -> prepare('SELECT id_moneda,nombre_moneda FROM moneda');
			$sql -> execute();
			$monedas = $sql -> fetchAll(PDO::FETCH_ASSOC);
			return $monedas;
		}
	}
?>