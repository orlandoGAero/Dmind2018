<?php
	require	'../class/dataBaseConn.php';
	class Productos {
		// Convierte el PRECIO del PRODUCTO que está en DÓLARES AMERICANOS a PESOS MEXICANOS.
		public function pesosMexicanos($precioProdEnDolaresAm){
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare("SELECT valor FROM moneda WHERE nombre_moneda = :nomMoneda;");
			$NameMoneda = "DOLAR";
			$query -> bindParam(':nomMoneda',$NameMoneda);
			$query -> execute();
			$result = $query -> fetch(PDO::FETCH_ASSOC);
			$valorMonedaDolares = $result['valor'];
			$dolaresApesos = $precioProdEnDolaresAm*$valorMonedaDolares;
			return number_format($dolaresApesos,2,'.',',');
		}
		// Convierte el PRECIO del PRODUCTO que está en PESOS MEXICANOS a DÓLARES AMERICANOS.
		public function dolaresAmericanos($precioProdEnPesosMex){
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare("SELECT valor FROM moneda WHERE nombre_moneda = :nomMoneda;");
			$NameMoneda = "DOLAR";
			$query -> bindParam(':nomMoneda',$NameMoneda);
			$query -> execute();
			$result = $query -> fetch(PDO::FETCH_ASSOC);
			$valorMonedaDolares = $result['valor'];
			$pesosAdolares = $precioProdEnPesosMex/$valorMonedaDolares;
			return number_format($pesosAdolares,2,'.',',');
		}
		// Obtiene la MONEDA predeterminada del precio del PRODUCTO.
		public function monedaPredeterminada(){
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare("SELECT m.nombre_moneda FROM moneda m INNER JOIN configuracion_default confD ON m.id_moneda = confD.moneda_productos");
			$query -> execute();
			$result = $query -> fetch();
			return $result;
		}

		public function obtenerProductos(){
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT 
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
											  P.id_moneda 
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
											WHERE P.descontinuado = :valDescontinuado
											ORDER BY P.id_producto ASC;');
			$prodDescontinuado = 'No';
			$query -> bindParam(':valDescontinuado', $prodDescontinuado);
			$query -> execute();
			$Productos = $query -> fetchAll();
			return $Productos;
		}

		public function buscarProductosNombre($NombreProducto){
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT 
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
											  P.id_moneda 
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
											WHERE nombre LIKE :namePro
											  AND P.descontinuado = :valDescontinuado
											ORDER BY P.id_producto ASC;');
			$prodDescontinuado = 'No';
			$NombreProducto = "%".$NombreProducto."%";
			$query -> bindParam(':namePro', $NombreProducto);
			$query -> bindParam(':valDescontinuado', $prodDescontinuado);
			$query -> execute();
			$Productos = $query -> fetchAll();
			return $Productos;
		}
	}
?>