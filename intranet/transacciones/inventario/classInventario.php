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
			 WHERE nomProd.nombre = :nombreInv AND prod.modelo = :modeloInv AND (staInv.nombre_status = :NomStatusInv OR staInv.nombre_status = :NomStatusXVender)
			ORDER BY inv.id_producto ASC;');
			$query -> bindParam(':nombreInv', $NomI);
			$query -> bindParam(':modeloInv', $ModI);
			// nombre_status: = INVENTARIADO
			$nomStatusInv = 'inventariado';
			$query -> bindParam(':NomStatusInv', $nomStatusInv);
			// nombre_status: = POR VENDERSE
			$nomstatusXVender = 'por venderse';
			$query -> bindParam(':NomStatusXVender', $nomstatusXVender);
			$query -> execute();
			$inventario = $query -> fetchAll();
			return $inventario;
		}

		public function obtenerInventario() {
			$Conexion = new dataBaseConn();
			$sql = "SELECT 
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
					 ORDER BY inv.id_producto ASC;";
			$query = $Conexion->prepare($sql);
			$query->execute();
			$Inventario = $query->fetchAll();
			return $Inventario;	
		}

		public function getProveedores(){
			$Conexion = new dataBaseConn();
			$query = $Conexion->prepare("SELECT * FROM proveedores");
			$query->execute();
			$proveedores = $query->fetchAll(PDO::FETCH_ASSOC);
			return $proveedores;
		}

		public function getStatus() {
			$Conexion = new dataBaseConn();
			$query = $Conexion->prepare("SELECT * FROM status_inventario WHERE nombre_status = :NOM_sta");
			$nom_status = 'inventariado';
			$query->bindParam(':NOM_sta', $nom_status);
			$query->execute();
			$status = $query->fetch(PDO::FETCH_ASSOC);
			return $status;
		}

		public function getCategoriasProd() {
			$Conexion = new dataBaseConn();
			$query = $Conexion->prepare("SELECT pro.id_categoria, cat.nombre_categoria 
										FROM categorias cat 
										INNER JOIN productos pro ON cat.id_categoria=pro.id_categoria
										WHERE pro.descontinuado = :Desco
										GROUP BY cat.nombre_categoria;");
			$descontinuado = 'No';
			$query->bindParam(':Desco', $descontinuado);
			$query->execute();
			$cats = $query->fetchAll(PDO::FETCH_ASSOC);
			return $cats;
		}

		public function getSubcategoriasProd($cat) {
			$Conexion = new dataBaseConn();
			$query = $Conexion->prepare("SELECT DISTINCT P.id_subcategoria, S.nombre_subcategoria 
										FROM productos P INNER JOIN subcategorias S ON P.id_subcategoria=S.id_subcategoria 
										WHERE P.id_categoria = :Cat  
										AND P.descontinuado = :Desco;");
			$descontinuado = 'No';
			$query->bindParam(':Cat', $cat);	
			$query->bindParam(':Desco', $descontinuado);
			$query->execute();
			$subcats = $query->fetchAll(PDO::FETCH_ASSOC);
			return $subcats;
		}

		public function getDivisionesProd($cat, $subCat) {
			$Conexion = new dataBaseConn();
			$query = $Conexion->prepare("SELECT DISTINCT P.id_division, D.nombre_division 
										FROM productos P 
										INNER JOIN division D ON P.id_division=D.id_division
										WHERE id_categoria = :Cat 
										AND P.id_subcategoria = :SubCat
										AND P.descontinuado = :Desco;");
			$descontinuado = 'No';
			$query->bindParam(':Cat', $cat);	
			$query->bindParam(':SubCat', $subCat);	
			$query->bindParam(':Desco', $descontinuado);
			$query->execute();
			$divs = $query->fetchAll(PDO::FETCH_ASSOC);
			return $divs;
		}

		public function getNombresProd($cat, $subCat, $div) {
			$Conexion = new dataBaseConn();
			$query = $Conexion->prepare("SELECT DISTINCT P.id_nombre, N.nombre 
										FROM productos P 
										INNER JOIN nombres N ON P.id_nombre=N.id_nombre 
										WHERE P.id_categoria = :Cat 
										AND id_subcategoria = :SubCat
										AND id_division = :Div 
										AND P.descontinuado = :Desco;");
			$descontinuado = 'No';
			$query->bindParam(':Cat', $cat);	
			$query->bindParam(':SubCat', $subCat);	
			$query->bindParam(':Div', $div);	
			$query->bindParam(':Desco', $descontinuado);
			$query->execute();
			$nombres = $query->fetchAll(PDO::FETCH_ASSOC);
			return $nombres;
		}

		public function getTiposProd($cat, $subCat, $div, $nom) {
			$Conexion = new dataBaseConn();
			$query = $Conexion->prepare("SELECT DISTINCT P.id_tipo, T.nombre_tipo 
										FROM productos P INNER JOIN tipos T ON P.id_tipo=T.id_tipo 
										WHERE P.id_categoria = :Cat
										AND P.id_subcategoria = :SubCat 
										AND P.id_division = :Div
										AND P.id_nombre = :Nom
										AND P.descontinuado = :Desco;");
			$descontinuado = 'No';
			$query->bindParam(':Cat', $cat);	
			$query->bindParam(':SubCat', $subCat);	
			$query->bindParam(':Div', $div);	
			$query->bindParam(':Nom', $nom);	
			$query->bindParam(':Desco', $descontinuado);
			$query->execute();
			$tipos = $query->fetchAll(PDO::FETCH_ASSOC);
			return $tipos;
		}

		public function getMarcasProd($cat, $subCat, $div, $nom, $tip) {
			$Conexion = new dataBaseConn();
			$query = $Conexion->prepare("SELECT DISTINCT P.id_marca, M.nombre_marca 
										FROM productos P 
										INNER JOIN marca_productos M ON P.id_marca=M.id_marca 
										WHERE id_categoria = :Cat   
										AND id_subcategoria = :SubCat 
										AND id_division = :Div 
										AND id_nombre = :Nom 
										AND id_tipo = :Tipo
										AND P.descontinuado = :Desco;");
			$descontinuado = 'No';
			$query->bindParam(':Cat', $cat);	
			$query->bindParam(':SubCat', $subCat);	
			$query->bindParam(':Div', $div);	
			$query->bindParam(':Nom', $nom);	
			$query->bindParam(':Tipo', $tip);	
			$query->bindParam(':Desco', $descontinuado);
			$query->execute();
			$marca = $query->fetchAll(PDO::FETCH_ASSOC);
			return $marca;
		}

		public function getModeloProd($cat, $subCat, $div, $nom, $tip, $marca) {
			$Conexion = new dataBaseConn();
			$query = $Conexion->prepare("SELECT id_producto,modelo FROM productos
										WHERE id_categoria = :Cat
										AND id_subcategoria = :SubCat
										AND id_division = :Div                   
										AND id_nombre = :Nom                
										AND id_tipo = :Tipo              
										AND id_marca = :Marca
										AND descontinuado = :Desco");
			$descontinuado = 'No';
			$query->bindParam(':Cat', $cat);	
			$query->bindParam(':SubCat', $subCat);	
			$query->bindParam(':Div', $div);	
			$query->bindParam(':Nom', $nom);	
			$query->bindParam(':Tipo', $tip);	
			$query->bindParam(':Marca', $marca);	
			$query->bindParam(':Desco', $descontinuado);
			$query->execute();
			$modelo = $query->fetchAll(PDO::FETCH_ASSOC);
			return $modelo;
		}

		public function getEstado(){
			$Conexion = new dataBaseConn();
			$query = $Conexion->prepare("SELECT id_estado,nombre_estado FROM estados ORDER BY nombre_estado");
			$query->execute();
			$estados = $query->fetchAll(PDO::FETCH_ASSOC);
			return $estados;
		}

		public function getUbicacion(){
			$Conexion = new dataBaseConn();
			$query = $Conexion->prepare("SELECT id_ubicacion,nombre_ubicacion FROM ubicaciones ORDER BY nombre_ubicacion");
			$query->execute();
			$ubicacion = $query->fetchAll(PDO::FETCH_ASSOC);
			return $ubicacion;
		}

		public function getFilaTransaccion() {
			$Conexion = new dataBaseConn();
			$query = $Conexion->query("SELECT id_transaccion FROM transacciones ORDER BY id_transaccion DESC LIMIT 1");
			$fila = $query->fetch(PDO::FETCH_NUM);
			return $fila;
		}

		public function getTipoTransaccion(){
			$Conexion = new dataBaseConn();
			$query = $Conexion->prepare("SELECT * FROM tipo_transaccion where id_tipo_transaccion=:IdTipoTra");
			$id_t_tran = 1;
			$query->bindParam(':IdTipoTra', $id_t_tran);
			$query->execute();
			$tipoT = $query->fetch(PDO::FETCH_NUM);
			return $tipoT;
		}

		public function getFilaInventario() {
			$Conexion = new dataBaseConn();
			$query = $Conexion->query("SELECT id_inventario FROM inventario ORDER BY id_inventario DESC LIMIT 1");
			$fila = $query->fetch(PDO::FETCH_NUM);
			return $fila;
		}

		public function getNoSerieDuplicado($noSerie, $idInv){
			$Conexion = new dataBaseConn();
			$query = $Conexion->prepare("SELECT no_serie
										FROM inventario
										WHERE  no_serie = :NoSerie 
										AND id_inventario != :IdInventario");
			$query->bindParam(':NoSerie', $noSerie);
			$query->bindParam(':IdInventario', $idInv);
			$query->execute();
			$filaAfectada = $query->rowCount();
			return $filaAfectada;
		}

		public function saveInventario($IDinventario,$IDproveedor,$IDproducto,$NumSerie,
										$PedidoDeImportacion,$NumFactura,$IDestado,
										$IDstatus,$IDubicacion,$color) {
			try {
				$Conexion = new dataBaseConn();
				$sql = "INSERT INTO inventario 
						VALUES (:IdInv,:IdProv,:IdProd,:NumSerie,:PedidoImp,:NumFac,
						:IdEst,:IdSta,:IdUbi,:Color);";
				$query = $Conexion->prepare($sql);
				$query->bindParam(':IdInv',$IDinventario);
				$query->bindParam(':IdProv',$IDproveedor);
				$query->bindParam(':IdProd',$IDproducto);
				$query->bindParam(':NumSerie',$NumSerie);
				$query->bindParam(':PedidoImp',$PedidoDeImportacion);
				$query->bindParam(':NumFac',$NumFactura);
				$query->bindParam(':IdEst',$IDestado);
				$query->bindParam(':IdSta',$IDstatus);
				$query->bindParam(':IdUbi',$IDubicacion);
				$query->bindParam(':Color',$color);
				$result = $query->execute();
				return $result;
			} catch(PDOException $e ) {
				print $e->getMessage();
			}							

		}

		public function saveTransacciones($IDtransaccion,$fechaTransacc,$IDinventario,$IDtipoTransacion,$descripcion) {
			// Registrar en Transacciones.
			try {
				$Conexion = new dataBaseConn();
				$query = $Conexion -> prepare('INSERT INTO transacciones (id_transaccion,fecha_alta,id_inventario,id_tipo_transaccion,descripcion)
												VALUES(:idTrans,:fechaTrans,:idInv,:idTipTrans,:descrip);');
				$query -> bindParam(':idTrans', $IDtransaccion);
				$query -> bindParam(':fechaTrans', $fechaTransacc);
				$query -> bindParam(':idInv', $IDinventario);
				$query -> bindParam(':idTipTrans', $IDtipoTransacion);
				$query -> bindParam(':descrip', $descripcion);
				$query -> execute();
			} catch(PDOException $e) {
				print $e->getMessage();
			}
		}

		public function getExistencias($IDproducto) {
			$Conexion = new dataBaseConn();
			$queryE = $Conexion -> prepare('SELECT exit_inventario FROM productos WHERE id_producto = :idProd;');
			$queryE -> bindParam(':idProd', $IDproducto);
			$queryE -> execute();
			$result = $queryE -> fetch(PDO::FETCH_ASSOC);
			$existProd = $result['exit_inventario'];
			return $existProd;
		}

		public function setExistencia($nuevaExistInv, $IDproducto) {
			// Actualizar existencia del Producto.
			$Conexion = new dataBaseConn();
			$queryUp = $Conexion -> prepare('UPDATE productos SET exit_inventario = :existInv WHERE id_producto = :idProd;');
			$queryUp -> bindParam(':existInv', $nuevaExistInv);
			$queryUp -> bindParam(':idProd', $IDproducto);
			$queryUp -> execute();
		}

		public function getEgInv() {
			$Conexion = new dataBaseConn();
			$query = $Conexion->prepare('SELECT idegresos,fecha,rfc_emisor,razon_social_emisor,serie,no_folio
										FROM egresos
										WHERE status_factura = :StatusInv
										AND inventariar = :Inventariar;');
			$status = 'Sin Capturar';
			$inventariar = 'Si';
			$query->bindParam(':StatusInv', $status);
			$query->bindParam(':Inventariar', $inventariar);
			$query->execute();
			$eg = $query->fetchAll(PDO::FETCH_ASSOC);
			return $eg;
		}
        
        public function getEgInvIncomp() {
			$Conexion = new dataBaseConn();
			$query = $Conexion->prepare('SELECT idegresos,fecha,rfc_emisor,razon_social_emisor,serie,no_folio
										FROM egresos
										WHERE status_factura = :StatusInv;');
			$status = 'Incompleto';
			$query->bindParam(':StatusInv', $status);
			$query->execute();
			$eg = $query->fetchAll(PDO::FETCH_ASSOC);
			return $eg;
		}
        
        public function getEgInvComp() {
			$Conexion = new dataBaseConn();
			$query = $Conexion->prepare('SELECT idegresos,fecha,rfc_emisor,razon_social_emisor,serie,no_folio
										FROM egresos
										WHERE status_factura = :StatusInv;');
			$status = 'Capturada';
			$query->bindParam(':StatusInv', $status);
			$query->execute();
			$eg = $query->fetchAll(PDO::FETCH_ASSOC);
			return $eg;
		}
		
		public function getConceptosEg($id_egreso) {
			$Conexion = new dataBaseConn();
			$query = $Conexion->prepare('SELECT econ.id_egresos_conceptos,econ.descripcion_concepto_e, econ.modelo_concepto_e, econ.cantidad_concepto_e 
										FROM egresos_conceptos econ
										INNER JOIN egresos eg ON eg.idegresos=econ.id_egresos
										WHERE eg.idegresos = :IdEgreso AND inventariado = :Inv;');
			$inventariado = 'No';
            $query->bindParam(':IdEgreso', $id_egreso);
            $query->bindParam(':Inv', $inventariado);
			$query->execute();
			$conceptos = $query->fetchAll(PDO::FETCH_ASSOC);
			return $conceptos;
			
		}
        
        public function getProductosEg($ideg) {
            $Conexion = new dataBaseConn();
            $sql = "SELECT econ.id_egresos_conceptos, pr.descripcion, pr.modelo, econ.cantidad_concepto_e
                    FROM conceptos_productos cp
                    INNER JOIN productos pr ON pr.id_producto = cp.id_prod
                    INNER JOIN egresos_conceptos econ ON econ.id_egresos_conceptos = cp.id_eg_con
                    WHERE econ.id_egresos = :IdEgreso 
                    AND econ.inventariado = :Inv
                    AND econ.agregar_inv = :addInv;";
            $query = $Conexion->prepare($sql);
            $query->bindParam(':IdEgreso', $ideg);
            $inventariado = 'No';
            $query->bindParam(':Inv', $inventariado);
            $agregarInv = 'Si';
            $query->bindParam(':addInv', $agregarInv);
            $query->execute();
			$conceptos = $query->fetchAll(PDO::FETCH_ASSOC);
			return $conceptos;
        }
        
        // modificar funcion 14 feb 2019
        public function getCantidadesConceptosEg($id_egreso) {
			$Conexion = new dataBaseConn();
			$query = $Conexion->prepare('SELECT econ.cantidad_concepto_e
										FROM egresos_conceptos econ
										INNER JOIN egresos eg ON eg.idegresos=econ.id_egresos
										WHERE eg.idegresos = :IdEgreso
										AND econ.agregar_inv = :AddInv;');
            $query->bindParam(':IdEgreso', $id_egreso);
            $addInv = 'Si';
            $query->bindParam(':AddInv', $addInv);
			$query->execute();
			$conceptos = $query->fetchAll(PDO::FETCH_ASSOC);
			return $conceptos;
			
		}
        
        public function getProductosInv($noFactura) {
            $Conexion = new dataBaseConn();
            $query = $Conexion->prepare('SELECT * 
                                        FROM inventario
                                        WHERE no_factura = :NoFact;');
            $query->bindParam(':NoFact', $noFactura);
			$query->execute();
			$prodInv = $query->fetchAll(PDO::FETCH_ASSOC);
			return $prodInv;
            
        }
        
        public function setInventariado($idEConcepto) {
			// Actualizar producto si esta inventariado.
			$Conexion = new dataBaseConn();
			$queryUp = $Conexion -> prepare("UPDATE egresos_conceptos
                                            SET inventariado = 'Si'
                                            WHERE id_egresos_conceptos = :IdConcepto;");
			$queryUp -> bindParam(':IdConcepto', $idEConcepto);
			$queryUp -> execute();
		}
        
        public function setStatusInvCap($idEgr) {
			// Actualizar status inventario Capturada.
			$Conexion = new dataBaseConn();
			$queryUp = $Conexion -> prepare("UPDATE egresos
                                            SET status_factura = 'Capturada'
                                            WHERE idegresos = :IdEg;");
			$queryUp -> bindParam(':IdEg', $idEgr);
			$queryUp -> execute();
		}
        
        public function setStatusInvIncom($idEgr) {
			// Actualizar status inventario Incompleto.
			$Conexion = new dataBaseConn();
			$queryUp = $Conexion -> prepare("UPDATE egresos
                                            SET status_factura = 'Incompleto'
                                            WHERE idegresos = :IdEg;");
			$queryUp -> bindParam(':IdEg', $idEgr);
			$queryUp -> execute();
		}

		public function getDatosProd($modelo) {
			$Conexion = new dataBaseConn();
			$sql = "SELECT pro.id_producto,cat.nombre_categoria, cat.id_categoria, 
						sub.nombre_subcategoria, sub.id_subcategoria,
						divi.nombre_division, divi.id_division,
						nom.nombre, nom.id_nombre,
						tip.nombre_tipo, tip.id_tipo,
						mar.nombre_marca, mar.id_marca
				FROM productos pro
				INNER JOIN categorias cat ON cat.id_categoria=pro.id_categoria
				INNER JOIN subcategorias sub ON sub.id_subcategoria=pro.id_subcategoria
				INNER JOIN division divi ON divi.id_division=pro.id_division
				INNER JOIN nombres nom ON nom.id_nombre=pro.id_nombre
				INNER JOIN tipos tip ON tip.id_tipo=pro.id_tipo
				INNER JOIN marca_productos mar ON mar.id_marca=pro.id_marca
				WHERE pro.modelo = :Modelo;";
			$query =  $Conexion->prepare($sql);
			$query->bindParam(':Modelo', $modelo);
			$query->execute();
			$datos = $query->fetchAll(PDO::FETCH_ASSOC);
			return $datos;

		}

		public function getNombreProv($rfc) {
			$Conexion = new dataBaseConn();
			$sql = "SELECT prov.id_proveedor, prov.nom_proveedor
					FROM proveedores prov
					INNER JOIN proveedores_datos_fiscales provdt ON prov.id_proveedor = provdt.id_proveedor
					WHERE provdt.rfc_prov = :Rfc";
			$query = $Conexion->prepare($sql);
			$query->bindParam(':Rfc', $rfc);
			$query->execute();
			$prov = $query->fetch(PDO::FETCH_ASSOC);
			return $prov;
		}

		public function buscarInv($prov, $prod, $tipo, $marca, $noserie, $factura, $estado, $status, $ubicacion) {
			$Conexion = new dataBaseConn();

			$criterio = "";

			if (empty($criterio) && !empty($prov)) {
				$criterio .= "prov.nom_proveedor LIKE :ProvInv";
			} elseif (!empty($criterio) && !empty($prov)) {
				$criterio .= " AND prov.nom_proveedor LIKE :ProvInv";
			}

			if (empty($criterio) && !empty($prod)) {
				$criterio .= "nomProd.nombre LIKE :ProdInv";
			} elseif (!empty($criterio) && !empty($prod)) {
				$criterio .= " AND nomProd.nombre LIKE :ProdInv";
			}

			if (empty($criterio) && !empty($tipo)) {
				$criterio .= "tiProd.nombre_tipo LIKE :TipoInv";
			} elseif (!empty($criterio) && !empty($tipo)) {
				$criterio .= " AND tiProd.nombre_tipo LIKE :TipoInv";
			}

			if (empty($criterio) && !empty($marca)) {
				$criterio .= "maProd.nombre_marca LIKE :MarInv";
			} elseif (!empty($criterio) && !empty($marca)) {
				$criterio .= " AND maProd.nombre_marca LIKE :MarInv";
			}

			if (empty($criterio) && !empty($noserie)) {
				$criterio .= "inv.no_serie LIKE :NoSerieInv";
			} elseif (!empty($criterio) && !empty($noserie)) {
				$criterio .= " AND inv.no_serie LIKE :NoSerieInv";
			}

			if (empty($criterio) && !empty($factura)) {
				$criterio .= "inv.no_factura LIKE :NoFacInv";
			} elseif (!empty($criterio) && !empty($factura)) {
				$criterio .= " AND inv.no_factura LIKE :NoFacInv";
			}

			if (empty($criterio) && !empty($estado)) {
				$criterio .= "estProd.nombre_estado LIKE :EstadoInv";
			} elseif (!empty($criterio) && !empty($estado)) {
				$criterio .= " AND estProd.nombre_estado LIKE :EstadoInv";
			}

			if (empty($criterio) && !empty($status)) {
				$criterio .= "staInv.nombre_status LIKE :StatusInv";
			} elseif (!empty($criterio) && !empty($status)) {
				$criterio .= " AND staInv.nombre_status LIKE :StatusInv";
			}

			if (empty($criterio) && !empty($ubicacion)) {
				$criterio .= "ubicInv.nombre_ubicacion LIKE :UbicacionInv";
			} elseif (!empty($criterio) && !empty($ubicacion)) {
				$criterio .= " AND ubicInv.nombre_ubicacion LIKE :UbicacionInv";
			}

			$query = $Conexion -> prepare("SELECT 
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
										 WHERE " . $criterio);

			if ($prov !== "") {
				$prov = "%".$prov."%";
				$query->bindParam(':ProvInv', $prov);
			}

			if ($prod !== "") {
				$prod = "%".$prod."%";
				$query->bindParam(':ProdInv', $prod);
			}

			if ($tipo !== "") {
				$tipo = "%".$tipo."%";
				$query->bindParam(':TipoInv', $tipo);
			}

			if ($marca !== "") {
				$marca = "%".$marca."%";
				$query->bindParam(':MarInv', $marca);
			}

			if ($noserie !== "") {
				$noserie = "%".$noserie."%";
				$query->bindParam(':NoSerieInv', $noserie);
			}

			if ($factura !== "") {
				$factura = "%".$factura."%";
				$query->bindParam(':NoFacInv', $factura);
			}

			if ($estado !== "") {
				$estado = "%".$estado."%";
				$query->bindParam(':EstadoInv', $estado);
			}

			if ($status !== "") {
				$status = "%".$status."%";
				$query->bindParam(':StatusInv', $status);
			}

			if ($ubicacion !== "") {
				$ubicacion = "%".$ubicacion."%";
				$query->bindParam(':UbicacionInv', $ubicacion);
			}

			$query->execute();
			$res = $query->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		// tal vez borrar
		// public function getNomProvEg($idEgreso) {
		// 	$Conexion = new dataBaseConn();
		// 	$sql = "SELECT rfc_emisor
		// 			FROM egresos
		// 			WHERE idegresos = :IdEgreso;";
		// 	$query = $Conexion->prepare($sql);
		// 	$query->bindParam(':IdEgreso', $idEgreso);
		// 	$query->execute();
		// 	$rfcE = $query->fetch(PDO::FETCH_ASSOC);
		// 	return $rfcE;
		// }

	}
?>