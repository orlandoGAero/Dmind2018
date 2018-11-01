<?php
	set_time_limit(300);
	require '../../class/dataBaseConn.php';
	class Inventario{
		public function incrementoInventario(){
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT id_inventario FROM inventario ORDER BY id_inventario DESC LIMIT 1;');
			$query -> execute();
			$rows = $query -> rowCount();
			if ($rows != 0) {
				$result = $query -> fetch(PDO::FETCH_ASSOC);
				$IDinventario = ($result['id_inventario'] + 1);
			}else{
				$IDinventario = 1;
			}
			return $IDinventario;
		}

		public function incrementoTransaccion(){
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT id_transaccion FROM transacciones ORDER BY id_transaccion DESC LIMIT 1;');
			$query -> execute();
			$rows = $query -> rowCount();
			if ($rows != 0) {
				$result = $query -> fetch(PDO::FETCH_ASSOC);
				$IDtransscc = ($result['id_transaccion'] + 1);
			}else{
				$IDtransscc = 1;
			}
			return $IDtransscc;
		}

		public function registrarInventario($IDinventario,$IDproveedor,$IDproducto,$NumSerie,$PedidoDeImportacion,$NumFactura,$IDestado,$IDstatus,$IDubicacion,$color,
											$IDtransaccion,$fechaTransacc,$IDtipoTransacion,$descripcion){
			$Conexion = new dataBaseConn();
			$band = 0;
			if ($band == 0) {
				$query = $Conexion -> prepare('SELECT no_serie FROM inventario WHERE  no_serie = :numSerie AND id_inventario != :idInv;');
				$query -> bindParam(':numSerie', $NumSerie);
				$query -> bindParam(':idInv', $IDinventario);
				$query -> execute();
				$rows = $query -> rowCount();
				if ($rows != 0){
					echo "<div class='errorAddInv'><h3>No. de Serie:" . $NumSerie . " duplicado, por favor ingresa otro.</h3></div>";
					$band = 1;
				}
			}

			if ($band == 0) {
				$color = mb_strtoupper($color);
				$descripcion = mb_strtoupper($descripcion);
				$NumSerie = mb_strtoupper($NumSerie);
				$PedidoDeImportacion = mb_strtoupper($PedidoDeImportacion);
				$NumFactura = mb_strtoupper($NumFactura);
				// Registrar en Inventario.
				$queryInv = $Conexion -> prepare('INSERT INTO inventario VALUES(:idInv,:idProv,:idProd,:numSerie,:pedidoImport,:numFactura,:idEstad,:idStatus,:idUbic,:nameColor);');
				$queryInv -> bindParam(':idInv', $IDinventario);
				$queryInv -> bindParam(':idProv', $IDproveedor);
				$queryInv -> bindParam(':idProd', $IDproducto);
				$queryInv -> bindParam(':numSerie', $NumSerie);
				$queryInv -> bindParam(':pedidoImport', $PedidoDeImportacion);
				$queryInv -> bindParam(':numFactura', $NumFactura);
				$queryInv -> bindParam(':idEstad', $IDestado);
				$queryInv -> bindParam(':idStatus', $IDstatus);
				$queryInv -> bindParam(':idUbic', $IDubicacion);
				$queryInv -> bindParam(':nameColor', $color);
				$queryInv -> execute();
				// Registrar en Transacciones.
				$queryTrans = $Conexion -> prepare('INSERT INTO transacciones (id_transaccion,fecha_alta,id_inventario,id_tipo_transaccion,descripcion)
					VALUES(:idTrans,:fechaTrans,:idInv,:idTipTrans,:descrip);');
				$queryTrans -> bindParam(':idTrans', $IDtransaccion);
				$queryTrans -> bindParam(':fechaTrans', $fechaTransacc);
				$queryTrans -> bindParam(':idInv', $IDinventario);
				$queryTrans -> bindParam(':idTipTrans', $IDtipoTransacion);
				$queryTrans -> bindParam(':descrip', $descripcion);
				$queryTrans -> execute();
				// Seleccionar la existencia del producto.
				$queryExProd = $Conexion -> prepare('SELECT exit_inventario FROM productos WHERE id_producto = :idProd;');
				$queryExProd -> bindParam(':idProd', $IDproducto);
				$queryExProd -> execute();
				$result = $queryExProd -> fetch(PDO::FETCH_ASSOC);
				$existProd = $result['exit_inventario'];
				$nuevaExistInv = $existProd + 1;
				// Actualizar existencia del Producto.
				$queryUpdateExProd = $Conexion -> prepare('UPDATE productos SET exit_inventario = :existInv WHERE id_producto = :idProd;');
				$queryUpdateExProd -> bindParam(':existInv', $nuevaExistInv);
				$queryUpdateExProd -> bindParam(':idProd', $IDproducto);
				$queryUpdateExProd -> execute();
			}
		}

		public function obtenerDatosFiltrar($NomI, $ModI){
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('SELECT 
			  inv.id_inventario,
			  prov.nom_proveedor,
			  nomProd.nombre,
			  prod.modelo,
			  tiProd.nombre_tipo,
			  maProd.nombre_marca,
			  inv.no_serie,
			  inv.no_factura,
			  estProd.nombre_estado,
			  staInv.nombre_status,
			  ubicInv.nombre_ubicacion,
			  inv.id_producto
			FROM
			  inventario inv
			 LEFT JOIN proveedores prov 
			  ON inv.id_proveedor = prov.id_proveedor
			 LEFT JOIN productos prod
			  ON inv.id_producto = prod.id_producto
			 INNER JOIN nombres nomProd
			  ON nomProd.id_nombre = prod.id_nombre
			 INNER JOIN tipos tiProd
			  ON tiProd.id_tipo = prod.id_tipo
			 INNER JOIN marca_productos maProd
			  ON maProd.id_marca = prod.id_marca
			 LEFT JOIN estados estProd
			  ON inv.id_estado = estProd.id_estado
			 LEFT JOIN status_inventario staInv
			  ON inv.id_status = staInv.id_status
			 LEFT JOIN ubicaciones ubicInv
			  ON inv.id_ubicacion = ubicInv.id_ubicacion
			 WHERE nomProd.nombre = :nombreInv AND prod.modelo = :modeloInv AND (inv.id_status = :idStatusInv OR inv.id_status = :idStatusXVender)
			ORDER BY inv.id_producto ASC;');
			$query -> bindParam(':nombreInv', $NomI);
			$query -> bindParam(':modeloInv', $ModI);
			// id_status: 4 = INVENTARIADO
			$IDstatusInv = 4;
			$query -> bindParam(':idStatusInv', $IDstatusInv);
			// id_status: 7 = POR VENDERSE
			$IDstatusXVender = 7;
			$query -> bindParam(':idStatusXVender', $IDstatusXVender);
			$query -> execute();
			$inventario = $query -> fetchAll();
			return $inventario;
		}
	}

?>