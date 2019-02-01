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
											  mon.nombre_moneda 
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
					    					  LEFT JOIN moneda mon
												ON mon.id_moneda = P.id_moneda 
											WHERE P.descontinuado = :valDescontinuado
											ORDER BY P.id_producto ASC;');
			$prodDescontinuado = 'No';
			$query -> bindParam(':valDescontinuado', $prodDescontinuado);
			$query -> execute();
			$Productos = $query -> fetchAll(PDO::FETCH_ASSOC);
			return $Productos;
		}

		public function getProductoDet($idpro) {
			$Conexion = new dataBaseConn();
			$sql = $Conexion->prepare('SELECT 
																	distinct M.nombre_marca,
																	P.id_marca,
																	P.id_producto,
																	P.id_categoria,
																	C.nombre_categoria,
																	P.id_subcategoria,
																	S.nombre_subcategoria,
																	P.id_division,
																	D.nombre_division,
																	P.id_nombre,
																	N.nombre,
																	P.id_tipo,
																	T.nombre_tipo,
																	P.modelo,
																	P.precio,
																	P.exit_inventario,
																	P.id_moneda,
																	Mo.nombre_moneda,
																	P.id_unidad,
																	U.nombre_unidad,
																	P.descripcion
																FROM
																	productos P 
																	INNER JOIN categorias C 
																		ON P.id_categoria = C.id_categoria 
																	INNER JOIN subcategorias S 
																		ON P.id_subcategoria = S.id_subcategoria 
																	INNER JOIN division D
																		ON P.id_division = D.id_division
																	INNER JOIN nombres N 
																		ON P.id_nombre = N.id_nombre
																	INNER JOIN tipos T 
																		ON P.id_tipo=T.id_tipo
																	INNER JOIN marca_productos M 
																		ON P.id_marca=M.id_marca
																	INNER JOIN unidades U 
																		ON P.id_unidad=U.id_unidad
																	INNER JOIN moneda Mo
																		ON P.id_moneda=Mo.id_moneda
																WHERE P.id_producto = :IDproducto');
			$sql->bindParam(':IDproducto', $idpro);
			$sql->execute();
			$detProducto = $sql->fetch();

			return $detProducto;
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

		//obtener ultima fila en la tabla productos
		public function getFila() {
			$Conexion = new dataBaseConn();
			$query = $Conexion->query('SELECT id_producto FROM productos ORDER BY id_producto DESC LIMIT 1;');
			$fila = $query->fetch(PDO::FETCH_NUM);
			return $fila;
		}
		
		public function getFilaAfectada($modelo, $id_producto) {
			$Conexion = new dataBaseConn();
			$query = $Conexion->prepare('SELECT modelo
																		FROM productos
																		WHERE modelo = :model AND id_producto != :IDproducto');
			$query->bindParam(':model', $modelo);
			$query->bindParam(':IDproducto', $id_producto);
			$query->execute();
			$filaAfectada = $query->rowCount();
			return $filaAfectada;

		}

		public function saveProducto(
			$id_producto, 
			$id_categoria, 
			$id_subcategoria, 
			$id_division,
			$id_nombre, 
			$id_tipo, 
			$id_marca,
			$modelo,
			$precio,
			$moneda,
			$id_unidad,
			$descripcion
		) {
			try {
				$Conexion = new dataBaseConn();
				$query = "INSERT INTO productos 
								VALUES (:IDproducto,:IDcategoria,:IDsubcategoria,:IDdivision,:IDnombre,:IDtipo,
												:IDmarca,:Modelo,:Precio,:Moneda,:IDunidad,:Descripcion,:Exist,:Descon)";
				$sql = $Conexion->prepare($query);
				$existencias = '0';
				$descontinuado = 'No';
				$sql->bindParam(':IDproducto',$id_producto);
				$sql->bindParam(':IDcategoria',$id_categoria);
				$sql->bindParam(':IDsubcategoria',$id_subcategoria);
				$sql->bindParam(':IDdivision',$id_division);
				$sql->bindParam(':IDnombre',$id_nombre);
				$sql->bindParam(':IDtipo',$id_tipo);
				$sql->bindParam(':IDmarca',$id_marca);
				$sql->bindParam(':Modelo',$modelo);
				$sql->bindParam(':Precio',$precio);
				$sql->bindParam(':Moneda',$moneda);
				$sql->bindParam(':IDunidad',$id_unidad);
				$sql->bindParam(':Descripcion',$descripcion);
				$sql->bindParam(':Exist',$existencias);
				$sql->bindParam(':Descon',$descontinuado);
				$result = $sql->execute();
				
				return $result;
			} catch(PDOException $e) {
				print $e->getMessage();
			}
		}

		public function modifyProducto(
			$id_producto, 
			$id_categoria, 
			$id_subcategoria, 
			$id_division,
			$id_nombre, 
			$id_tipo, 
			$id_marca,
			$modelo,
			$precio,
			$moneda,
			$id_unidad,
			$descripcion
		) {
			try {
				$Conexion = new dataBaseConn();
				$query = "UPDATE productos SET id_categoria=:IDcategoria, id_subcategoria=:IDsubcategoria, id_division=:IDdivision,
				id_nombre=:IDnombre, id_tipo=:IDtipo, id_marca=:IDmarca, modelo=:Modelo, precio=:Precio, id_moneda=:Moneda,id_unidad=:IDunidad,
				 descripcion=:Descripcion WHERE id_producto=:IDproducto";
				$sql = $Conexion->prepare($query);
				$sql->bindParam(':IDproducto',$id_producto);
				$sql->bindParam(':IDcategoria',$id_categoria);
				$sql->bindParam(':IDsubcategoria',$id_subcategoria);
				$sql->bindParam(':IDdivision',$id_division);
				$sql->bindParam(':IDnombre',$id_nombre);
				$sql->bindParam(':IDtipo',$id_tipo);
				$sql->bindParam(':IDmarca',$id_marca);
				$sql->bindParam(':Modelo',$modelo);
				$sql->bindParam(':Precio',$precio);
				$sql->bindParam(':Moneda',$moneda);
				$sql->bindParam(':IDunidad',$id_unidad);
				$sql->bindParam(':Descripcion',$descripcion);
				$result = $sql->execute();
				
				return $result;
			} catch(PDOException $e) {
				print $e->getMessage();
			}
		}
		
	}
?>