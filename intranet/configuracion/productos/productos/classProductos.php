<?php
	require'../../../class/dataBaseConn.php';
	class Productos
	{	
		public function obtenerProductos() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT 
										  P.id_producto,
										  categorias.nombre_categoria,
										  subcategorias.nombre_subcategoria,
										  D.nombre_division,
										  nombre,
										  nombre_tipo,
										  M.nombre_marca,
										  P.modelo,
										  P.precio,
										  P.exit_inventario,
										  P.id_moneda,
										  P.descontinuado
										FROM
										  productos P 
										  LEFT JOIN categorias 
										    ON P.id_categoria = categorias.id_categoria 
										  LEFT JOIN subcategorias 
										    ON P.id_subcategoria = subcategorias.id_subcategoria 
										  LEFT JOIN division D
										    ON P.id_division = D.id_division
										  LEFT JOIN marca_productos M 
										    ON P.id_marca = M.id_marca 
										  LEFT JOIN nombres 
										    ON P.id_nombre = nombres.id_nombre 
										  LEFT JOIN tipos 
										    ON P.id_tipo = tipos.id_tipo 
										ORDER BY P.id_producto ASC;');
			$sth -> execute();
			$productos = $sth -> fetchAll();
			return $productos;
		}

		public function eliminarProducto($IDproduct) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDproduct != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT id_producto FROM inventario WHERE id_producto = :idProducto GROUP BY id_producto;');
				$sth -> bindParam(':idProducto', $IDproduct);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "El producto se encuentra inventariado, por lo tanto no podrá eliminarse.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$queryDel = $Conexion-> prepare('DELETE FROM conceptos_productos
						WHERE id_prod = :idProducto');
				$queryDel->bindParam(':idProducto', $IDproduct);
				$resDel = $queryDel->execute();

				$sth = $Conexion -> prepare('DELETE FROM productos WHERE id_producto = :idProducto');
				$sth -> bindParam(':idProducto', $IDproduct);
				$result = $sth -> execute();
				if ($resDel && $result) {
					$this -> msjOk = "Producto eliminado correctamente.";
					return $resDel & $result;
				}
			}
		}

		public function descontinuarProducto($IDproduct) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDproduct != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare("UPDATE productos SET descontinuado = 'Si' WHERE id_producto = :idProducto;");
				$sth -> bindParam(':idProducto', $IDproduct);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Producto descontinuado correctamente.";
					return $result;
				}
			}
		}

		public function habilitarProducto($IDproduct) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDproduct != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare("UPDATE productos SET descontinuado = 'No' WHERE id_producto = :idProducto");
				$sth -> bindParam(':idProducto', $IDproduct);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Producto habilitado correctamente.";
					return $result;
				}
			}
		}
	}
?>