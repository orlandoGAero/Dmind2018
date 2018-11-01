<?php
	/**
	*
	*
	*/
	require	'../../class/dataBaseConn.php';
	class funciones_ventas {
		public function numeroVenta(){
			$queryNV = "SELECT id_venta FROM venta ORDER BY id_venta DESC LIMIT 1";
			$resultNV = mysql_query($queryNV);
			$rowsNV = mysql_num_rows($resultNV);
			if ($rowsNV == 0) {
				$numVenta = 1;
			}else{
				$numVenta = mysql_result($resultNV,0,'id_venta');
				$numVenta = ($numVenta + 1);
			}

			return $numVenta;
		}

		public function obtenerStatusVenta(){
			$queryOSV = "SELECT id_status_venta,nombre_status_venta FROM status_venta;";
			$resultOSV = mysql_query($queryOSV) or die(mysql_errno());

			$statusventas = array();
			while ($rowsOSV = mysql_fetch_assoc($resultOSV)) {
				$statusventas[] = $rowsOSV;
			}
			return $statusventas;
		}

		public function obtnerNombreStatusVenta($idStatusVenta){
			$queryONSV = "SELECT nombre_status_venta FROM status_venta WHERE id_status_venta = ".$idStatusVenta.";";
			$resultONSV = mysql_query($queryONSV);
			$nombreStatusVenta = mysql_result($resultONSV,0,'nombre_status_venta');
			return $nombreStatusVenta;
		}

		public function obtenerClientes(){
			$queryOC = "SELECT id_cliente,nombre_cliente FROM clientes";
			$resultOC = mysql_query($queryOC);

			$clientes = array();
			while ($rowsOC = mysql_fetch_assoc($resultOC)) {
				$clientes[] = $rowsOC;
			}

			return $clientes;
		}

		public function obtenerNombreCliente($idCliente){
			$queryONC = "SELECT nombre_cliente FROM clientes WHERE id_cliente =".$idCliente.";";
			$resultONC = mysql_query($queryONC);
			$nombreCliente = mysql_result($resultONC,0,'nombre_cliente');
			return $nombreCliente;
		}

		public function datosCliente($idCliente){
			$queryDC = "SELECT   
						  F.rfc,
						  D.calle,
						  D.num_ext,
						  D.num_int,
						  D.colonia,
						  D.localidad,
						  D.municipio,
						  D.estado,
						  D.cod_postal,
						  D.pais
						FROM
						  clientes C
						  INNER JOIN direcciones D 
						    ON C.id_direccion = D.id_direccion 
						  INNER JOIN datos_fiscales F 
						    ON C.id_datfiscal = F.id_datfiscal 
						WHERE C.id_cliente = ".$idCliente;
			$resultDC = mysql_query($queryDC);

			$cliente = mysql_fetch_assoc($resultDC);

			return $cliente;
		}

		public function obtenerImpuestos(){
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare("SELECT id_impuesto,nombre_impuesto FROM impuestos;");
			$query -> execute();
			$result =  $query -> fetchAll();
			return $result;
		}

		public function obtenerTiposVenta(){
			$queryOTV = "SELECT id_tipo_venta,nom_tipo_venta FROM tipos_venta ORDER BY nom_tipo_venta;";
			$resultOTV = mysql_query($queryOTV);
			$tiposventas = array();
			while ($rowsOTV = mysql_fetch_assoc($resultOTV)) {
				$tiposventas[] = $rowsOTV;
			}
			return $tiposventas;
		}

		public function obtenerNombreTipoVenta($idTipoVenta){
			$queryONTV = "SELECT nom_tipo_venta FROM tipos_venta WHERE id_tipo_venta =".$idTipoVenta.";";
			$resultONTV = mysql_query($queryONTV);
			$nombreTipoVenta = mysql_result($resultONTV,0,'nom_tipo_venta');
			return $nombreTipoVenta;
		}

		public function obtenerFormasPago(){
			$queryOTP = "SELECT id_tipo_pago,nom_tipo_pago FROM tipos_pago ORDER BY nom_tipo_pago;";
			$resultOTP = mysql_query($queryOTP);
			$tipospago = array();
			while ($rowsOTP = mysql_fetch_assoc($resultOTP)) {
				$tipospago[] = $rowsOTP;
			}
			return $tipospago;
		}

		public function obtenerNombreFormaPago($idFormaPago){
			$queryONFP = "SELECT nom_tipo_pago FROM tipos_pago WHERE id_tipo_pago =".$idFormaPago.";";
			$resultONFP = mysql_query($queryONFP);
			$nombreFormaPago = mysql_result($resultONFP,0,'nom_tipo_pago');
			return $nombreFormaPago;
		}

		public function obtenerNombreImpuesto($idImpuesto){
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare("SELECT nombre_impuesto FROM impuestos WHERE id_impuesto = :IDimpuesto;");
			$query -> bindParam('IDimpuesto',$idImpuesto);
			$query -> execute();
			$result = $query -> fetch();
			return $result;
		}

		public function obtenerCategorias(){
			$queryOCA = "SELECT ca.id_categoria,ca.nombre_categoria
						 FROM categorias ca 
						  INNER JOIN productos pr ON ca.id_categoria = pr.id_categoria
						  INNER JOIN inventario inv ON pr.id_producto = inv.id_producto
						 WHERE inv.id_status = 4
						 GROUP BY ca.nombre_categoria;";
			$resultOCA = mysql_query($queryOCA);

			$categorias = array();
			while ($rowsOCA = mysql_fetch_assoc($resultOCA)) {
				$categorias[] = $rowsOCA;
			}

			return $categorias;
		}

		public function obtenerSubcategorias($idCategoria){
			$queryOSCA = "SELECT sca.id_subcategoria, sca.nombre_subcategoria
						  FROM subcategorias sca
						   INNER JOIN productos pr ON sca.id_subcategoria = pr.id_subcategoria
						   INNER JOIN inventario inv ON pr.id_producto = inv.id_producto
						  WHERE  pr.id_categoria = ".$idCategoria."
						   AND inv.id_status = 4
						  GROUP BY sca.nombre_subcategoria;";
			$resultOSCA = mysql_query($queryOSCA);

			$subcategorias = array();
			while ($rowsOSCA = mysql_fetch_assoc($resultOSCA)) {
				$subcategorias[] = $rowsOSCA;
			}

			return $subcategorias;
		}

		public function obtenerDivisiones($idCategoria,$idSubcategoria){
			$queryOD = "SELECT di.id_division, di.nombre_division
						FROM division di
						 INNER JOIN productos pr ON di.id_division = pr.id_division
						 INNER JOIN inventario inv ON pr.id_producto = inv.id_producto
						WHERE pr.id_categoria = ".$idCategoria."
						 AND pr.id_subcategoria = ".$idSubcategoria."
						 AND inv.id_status = 4
						GROUP BY di.nombre_division;";
			$resultOD = mysql_query($queryOD);

			$divisiones = array();
			while ($rowsOD = mysql_fetch_assoc($resultOD)) {
				$divisiones[] = $rowsOD;
			}

			return $divisiones;
		}

		public function obtenerNombres($idCategoria,$idSubcategoria,$idDivision){
			$queryON = "SELECT nom.id_nombre, nom.nombre
						FROM nombres nom
						 INNER JOIN productos pr ON nom.id_nombre = pr.id_nombre
						 INNER JOIN inventario inv ON pr.id_producto = inv.id_producto
						WHERE pr.id_categoria = ".$idCategoria."
						 AND pr.id_subcategoria = ".$idSubcategoria."
						 AND pr.id_division = ".$idDivision."
						 AND inv.id_status = 4
						GROUP BY nom.nombre;";
			$resultON = mysql_query($queryON);

			$nombres = array();
			while ($rowsON = mysql_fetch_assoc($resultON)) {
				$nombres[] = $rowsON;
			}

			return $nombres;
		}

		public function obtenerTipos($idCategoria,$idSubcategoria,$idDivision,$idNombre){
			$queryOT = "SELECT tp.id_tipo, tp.nombre_tipo
						FROM tipos tp
						 INNER JOIN productos pr ON tp.id_tipo = pr.id_tipo
						 INNER JOIN inventario inv ON pr.id_producto = inv.id_producto
						WHERE pr.id_categoria = ".$idCategoria."
						 AND pr.id_subcategoria = ".$idSubcategoria."
						 AND pr.id_division = ".$idDivision."
						 AND pr.id_nombre = ".$idNombre."
						 AND inv.id_status = 4
						GROUP BY tp.nombre_tipo;";
			$resultOT = mysql_query($queryOT);

			$tipos = array();
			while ($rowsOT = mysql_fetch_assoc($resultOT)) {
				$tipos[] = $rowsOT;
			}

			return $tipos;
		}

		public function obtenerMarcas($idCategoria,$idSubcategoria,$idDivision,$idNombre,$idTipo){
			$queryOM = "SELECT map.id_marca,map.nombre_marca
						FROM marca_productos map
						 INNER JOIN productos pr ON map.id_marca = pr.id_marca
						 INNER JOIN inventario inv ON pr.id_producto = inv.id_producto
						WHERE pr.id_categoria = ".$idCategoria."
						 AND pr.id_subcategoria = ".$idSubcategoria."
						 AND pr.id_division = ".$idDivision."
						 AND pr.id_nombre = ".$idNombre."
						 AND pr.id_tipo = ".$idTipo."
						 AND inv.id_status = 4
						GROUP BY map.nombre_marca;";
			$resultOM = mysql_query($queryOM);

			$marcas = array();
			while ($rowsOM = mysql_fetch_assoc($resultOM)) {
				$marcas[] = $rowsOM;
			}

			return $marcas;
		}

		public function obtenerModelos($idCategoria,$idSubcategoria,$idDivision,$idNombre,$idTipo,$idMarca){
			$queryOMo = "SELECT pr.id_producto,pr.modelo
						 FROM  productos pr
						  INNER JOIN inventario inv ON pr.id_producto = inv.id_producto
						 WHERE pr.id_categoria = ".$idCategoria."
						  AND pr.id_subcategoria = ".$idSubcategoria."
						  AND pr.id_division = ".$idDivision."
						  AND pr.id_nombre = ".$idNombre." 
						  AND pr.id_tipo = ".$idTipo."
						  AND pr.id_marca = ".$idMarca."
						  AND inv.id_status = 4
						 GROUP BY pr.modelo;";
			$resultOMo = mysql_query($queryOMo);

			$modelos = array();
			while ($rowsOMo = mysql_fetch_assoc($resultOMo)) {
				$modelos[] = $rowsOMo;
			}

			return $modelos;
		}

		public function obtenerNumSerie($idCategoria,$idSubcategoria,$idDivision,$idNombre,$idTipo,$idMarca,$idProducto){
			// La variable $idProducto hace referencia al modelo elegido.
			$queryONSe = "SELECT inv.id_inventario,inv.no_serie
						  FROM  productos pr
						   INNER JOIN inventario inv ON pr.id_producto = inv.id_producto
						  WHERE pr.id_categoria = ".$idCategoria."
						   AND pr.id_subcategoria = ".$idSubcategoria."
						   AND pr.id_division = ".$idDivision."
						   AND pr.id_nombre = ".$idNombre." 
						   AND pr.id_tipo = ".$idTipo."
						   AND pr.id_marca = ".$idMarca."
						   AND pr.id_producto = ".$idProducto."
						   AND inv.id_status = 4
						   ORDER BY inv.no_serie;";
			$resultONSe = mysql_query($queryONSe);

			$numSeries = array();
			while ($rowsONSe = mysql_fetch_assoc($resultONSe)) {
				$numSeries[] = $rowsONSe;
			}
			
			return $numSeries;
		}

		public function obtenerNumSerieJSON($idCategoria,$idSubcategoria,$idDivision,$idNombre,$idTipo,$idMarca,$idProducto){
			$queryONSe = "SELECT inv.id_inventario,inv.no_serie
						  FROM  productos pr
						   INNER JOIN inventario inv ON pr.id_producto = inv.id_producto
						  WHERE pr.id_categoria = ".$idCategoria."
						   AND pr.id_subcategoria = ".$idSubcategoria."
						   AND pr.id_division = ".$idDivision."
						   AND pr.id_nombre = ".$idNombre." 
						   AND pr.id_tipo = ".$idTipo."
						   AND pr.id_marca = ".$idMarca."
						   AND pr.id_producto = ".$idProducto."
						   AND inv.id_status = 4
						   ORDER BY inv.no_serie;";
			$resultONSe = mysql_query($queryONSe);
			$numSeries = array();
			$i=0;
			while ($rowsONSe = mysql_fetch_array($resultONSe)) {
				$numSeries[$i] = $rowsONSe;
				$i++;
			}
			return $numSeries;
		}

		public function dolares($idMoneda,$precio){
			// Convertir de peso mexicano a dolares americanos.
			if ($idMoneda == 2) {
				$queryCM = "SELECT valor FROM moneda WHERE id_moneda = 1;";
				$resultCM = mysql_query($queryCM);
				$valorMonedaPesos = mysql_result($resultCM,0,'valor');
				$pesosAdolares = $precio/$valorMonedaPesos;
				return number_format($pesosAdolares, 2, '.', ',');
			}elseif ($idMoneda == 1) {
				return number_format($precio, 2, '.', ',');
			}
		}

		public function pesosMexicanos($idMoneda,$precio){
			// Convertir de dolares americanos a peso mexicano.
			if($idMoneda == 1){
				$queryCM = "SELECT valor FROM moneda WHERE id_moneda = 1;";
				$resultCM = mysql_query($queryCM);
				$valorMonedaDolares = mysql_result($resultCM,0,'valor');
				$dolaresApesos =  $precio*$valorMonedaDolares;
				return number_format($dolaresApesos, 2, '.', '');
			}elseif ($idMoneda == 2) {
				return number_format($precio, 2, '.', '');
			}
		}
		// Convierte a dolares si el producto esta en pesos mexicanos.
		public function obtenerPrecioMoneda($idInventario){
			$queryOPM = "SELECT pr.precio,pr.id_moneda
						 FROM moneda mon
						  INNER JOIN productos pr ON mon.id_moneda = pr.id_moneda
						  INNER JOIN inventario inv ON pr.id_producto = inv.id_producto
						 WHERE inv.id_inventario = ".$idInventario.";";
			$resultOPM = mysql_query($queryOPM);

			$monedaProducto = mysql_result($resultOPM,0,'id_moneda');
			$precioProducto = mysql_result($resultOPM,0,'precio');

			$rowsOPM = $this -> dolares($monedaProducto,$precioProducto);

			return $rowsOPM;
		}
		// Obtiene el NOMBRE de la MONEDA PREDETERMINADA del TIPO de CAMBIO contra el PESO.
		public function monedaPredeterminada(){
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare("SELECT m.nombre_moneda FROM moneda m INNER JOIN configuracion_default confD ON m.id_moneda = confD.tipo_de_cambio");
			$query -> execute();
			$result = $query -> fetch();
			return $result;
		}
		// Obtiene el VALOR de la MONEDA PREDETERMINADA para el TIPO de CAMBIO contra el PESO.
		public function obtenerValorTipoCambio($NomMoneda){
			$queryOVTC = "SELECT valor FROM moneda WHERE nombre_moneda = '".$NomMoneda."';";
			$resultOVTC = mysql_query($queryOVTC);
			$tipoDeCambio = mysql_result($resultOVTC,0,'valor');
			return number_format($tipoDeCambio,2);
		}
		public function guardarProductosAgregadosVenta($idVenta,$idProducto,$idInventario,$Nota,$precioUnProd,$tipoMoneda){
			$band = 0;
			
			if ($idVenta == "" && $idProducto == "" && $idInventario == "" && $precioUnProd == "") {
				$this -> MsjError = "Faltan datos, para agregar el producto";
				$band = 1;
			}

			if ($band == 0) {
				$queryValPAV = "SELECT id_venta_tmp,id_inventario_tmp
								FROM venta_add_products_tmp
								WHERE id_inventario_tmp = ".$idInventario."
								 AND id_venta_tmp = ".$idVenta.";";
				$resultValPAV = mysql_query($queryValPAV) or die(mysql_error());
				$rowsValPAV = mysql_num_rows($resultValPAV);
				if ($rowsValPAV != 0) {
					$this -> MsjCaption = "El producto ya se encuentra agregado";
					$band = 1;
				}
			}

			if($band == 0){
				$queryEditStatus = "UPDATE inventario SET id_status = 7 WHERE id_inventario = ".$idInventario;
				$resultEditStatus = mysql_query($queryEditStatus);

				$queryInsert = "INSERT INTO venta_add_products_tmp(
								 id_venta_tmp,
								 id_producto_tmp,
								 id_inventario_tmp,
								 nota_tmp,
								 precio_unitario_tmp,
								 tipo_moneda_tmp
								)
								VALUES (
								 ".$idVenta.",
								 ".$idProducto.",
								 ".$idInventario.",
								 '".$Nota."',
								 ".$precioUnProd.",
								 ".$tipoMoneda."
								);";
				$resultInsert = mysql_query($queryInsert);

				return $resultEditStatus & $resultInsert;
			}
		}

		public function tmpObtenerDetalleVenta($idVenta){
			$queryTmpDatosDetVenta = "SELECT GROUP_CONCAT(vdp.id_vap_tmp) id_vent_det_tmp,
									    vdp.id_venta_tmp,
									    COUNT(vdp.id_producto_tmp) cantProd,
									    vdp.id_producto_tmp,
									    GROUP_CONCAT(vdp.id_inventario_tmp) id_inv_tmp,
									    np.nombre,
									    pr.modelo,
									    GROUP_CONCAT(inv.no_serie SEPARATOR ' ') noserie,
									    pr.descripcion,
									    mp.nombre_marca,
									    GROUP_CONCAT(vdp.nota_tmp SEPARATOR '[br]') notaDescr,
									    vdp.precio_unitario_tmp
									  FROM productos pr 
									  	LEFT JOIN nombres np ON pr.id_nombre = np.id_nombre
									   	LEFT JOIN marca_productos mp ON pr.id_marca = mp.id_marca
									  	LEFT JOIN inventario inv ON pr.id_producto = inv.id_producto
										LEFT JOIN venta_add_products_tmp vdp ON inv.id_inventario = vdp.id_inventario_tmp
									  WHERE vdp.id_venta_tmp = ".$idVenta."
									  GROUP BY vdp.id_producto_tmp;";
			$resultTmpDatosDetVenta = mysql_query($queryTmpDatosDetVenta);

			$detalleVenta = array();
			while ($rowsTmpDatosDetVenta = mysql_fetch_array($resultTmpDatosDetVenta)) {
				$detalleVenta[] = $rowsTmpDatosDetVenta;
			}
			
			return $detalleVenta;
		}

		public function tmpSubtotalVenta($idVenta){
			$queryTmpSubT = "SELECT SUM(precio_unitario_tmp) subtotal_tmp
							FROM venta_add_products_tmp
							WHERE id_venta_tmp = ".$idVenta;
			$resultTmpSubT = mysql_query($queryTmpSubT);

			$subtotalVenta = mysql_result($resultTmpSubT,0,'subtotal_tmp');

			return $subtotalVenta;
		}

		public function obtenerDatosVentas(){
			$queryDV = "SELECT ve.id_venta,ve.folio,ve.fecha_hora,cl.nombre_cliente
						FROM clientes cl
						 INNER JOIN venta ve ON cl.id_cliente = ve.id_cliente
						ORDER BY ve.id_venta";
			$resultDV = mysql_query($queryDV);

			$datosVentas = array();

			while ($rowsDV = mysql_fetch_assoc($resultDV)) {
				$datosVentas[] = $rowsDV;
			}

			return $datosVentas;
		}

		public function eliminarAllProductos($IDventa){
			$querySIDI = "SELECT id_inventario_tmp FROM venta_add_products_tmp WHERE id_venta_tmp = ".$IDventa;
			$resultSIDI = mysql_query($querySIDI) or die(mysql_errno());

			$IdsInventario = array();
			for ($inc=0; $inc < mysql_num_rows($resultSIDI); $inc++) { 
				$ClaveInventario = mysql_result($resultSIDI,$inc,'id_inventario_tmp');
				$IdsInventario[] = $ClaveInventario;
			}

			foreach ($IdsInventario as $IdsInv) {
				$queryUpStInv = "UPDATE inventario SET id_status = 4 WHERE id_inventario = ".$IdsInv.";";
				$resultUpStInv = mysql_query($queryUpStInv) or die(mysql_errno());	
			}

			$queryEAP = "DELETE FROM venta_add_products_tmp
						WHERE id_venta_tmp = ".$IDventa;
			$resultEAP = mysql_query($queryEAP) or die(mysql_errno());
			return $resultEAP;
		}

		public function obtenerTipoMonedaVenta($idVenta){
			$queryTMV = "SELECT tipo_moneda_tmp FROM venta_add_products_tmp WHERE id_venta_tmp = ".$idVenta;
			$resultTMV = mysql_query($queryTMV) or die(mysql_errno());
			$rowsTMV = mysql_num_rows($resultTMV);
			if ($rowsTMV == 0) {
				$tMoneda = 1;
			}else{
				$tMoneda = mysql_result($resultTMV,0,'tipo_moneda_tmp');
			}

			return $tMoneda;
		}

		public function cambiarVentaApesos($idVenta){
			$queryCVAP = "SELECT id_vap_tmp,precio_unitario_tmp,tipo_moneda_tmp
						 FROM venta_add_products_tmp
						 WHERE id_venta_tmp = ".$idVenta.";";
			$resultCVAP = mysql_query($queryCVAP);

			$cambiarApesos = array();
			while ($rowsCVAP = mysql_fetch_assoc($resultCVAP)) {
				$cambiarApesos[] = $rowsCVAP;
			}

			foreach ($cambiarApesos as $pesosM) {
				$precioProdPeso = $this -> pesosMexicanos($pesosM['tipo_moneda_tmp'],$pesosM['precio_unitario_tmp']);
				$queryUpdate = "UPDATE venta_add_products_tmp
			 					SET precio_unitario_tmp = ".$precioProdPeso.", tipo_moneda_tmp = 2
			 					WHERE id_vap_tmp = ".$pesosM['id_vap_tmp']." AND id_venta_tmp = ".$idVenta.";";
				$resultUpdate = mysql_query($queryUpdate) or die(mysql_errno());
			}			
		}

		public function cambiarVentaAdolares($idVenta){
			$queryCVAD = "SELECT id_vap_tmp,precio_unitario_tmp,tipo_moneda_tmp
						 FROM venta_add_products_tmp
						 WHERE id_venta_tmp = ".$idVenta.";";
			$resultCVAD = mysql_query($queryCVAD);

			$cambiarAdolares = array();
			while ($rowsCVAD = mysql_fetch_assoc($resultCVAD)) {
				$cambiarAdolares[] = $rowsCVAD;
			}

			foreach ($cambiarAdolares as $dolaresA) {
				$precioProdDolar = $this -> dolares($dolaresA['tipo_moneda_tmp'],$dolaresA['precio_unitario_tmp']);
				$queryUpdate = "UPDATE venta_add_products_tmp
			 					SET precio_unitario_tmp = ".$precioProdDolar.", tipo_moneda_tmp = 1
			 					WHERE id_vap_tmp = ".$dolaresA['id_vap_tmp']." AND id_venta_tmp = ".$idVenta.";";
				$resultUpdate = mysql_query($queryUpdate) or die(mysql_errno());
			}			
		}

		public function registrarVenta($IDventa,$IDcliente,$Moneda,$StatusVentas,$TipoVenta,$FormaPago,$IDinventario,$CantProd,$IDproducto,$Subtotal,$tipoImpuesto,$porcentImpuesto,$Total){
			$Subtotal = number_format($Subtotal,2,'.','');
			$Total = number_format($Total,2,'.','');
			$band = 0;
			if ($IDventa == "" && $IDcliente == "" && $Moneda == "" && $IDinventario == "" && $Subtotal == "" && $porcentImpuesto == "" && $Total == "") {
				// Se requieren los datos principales de la venta
				$band = 1;
			}

			if ($StatusVentas == 0) {
				// echo "<script>alert('Se requiere el Status de Venta para Continuar.')</script>";
				$band = 1;
			}
			if ($TipoVenta == 0) {
				// echo "<script>alert('Se requiere el Tipo de Venta para Continuar.')</script>";
				$band = 1;
			}
			if ($FormaPago == 0) {
				// echo "<script>alert('Se requiere la Forma de Pago para Continuar.')</script>";
				$band = 1;
			}
			if($tipoImpuesto == 0){
				$band = 1;
			}

			if ($band == 0) {
				#Registra la Información General de la Venta.
					$queryRV = "INSERT INTO venta (
								  id_venta,folio,id_cliente,id_vendedor,fecha_hora,id_moneda,id_tipo_venta,id_tipo_pago,id_status_venta,subtotal,id_impuesto,iva,total
								) 
								VALUES
								  (
								  	".$IDventa.",'V-".$IDventa."',".$IDcliente.",1,NOW(),".$Moneda.",".$TipoVenta.",".$FormaPago.",".$StatusVentas.",".$Subtotal.",".$tipoImpuesto.",".$porcentImpuesto.",".$Total."
								   );";
					$resultRV = mysql_query($queryRV) or die(mysql_errno());
				#Venta General.

				#Registra el Detalle de la Venta.
					$queryRDV = "INSERT INTO detalle_venta (id_venta,id_producto,id_inventario,nota,precio_unitario)
									SELECT id_venta_tmp,id_producto_tmp,id_inventario_tmp,nota_tmp,precio_unitario_tmp 
									FROM venta_add_products_tmp WHERE id_venta_tmp = ".$IDventa.";";
					$resultRDV = mysql_query($queryRDV) or die(mysql_errno());

					$obtenerIDsInventario = implode(",", $IDinventario);
					$IDsInventario = explode(",", $obtenerIDsInventario);
					foreach($IDsInventario as $idInv){
						// Actualiza el status a VENDIDO de cada Producto en Inventario.
						$queryUpInv = "UPDATE inventario SET id_status = 5 WHERE id_inventario = ".$idInv.";";
						$result = mysql_query($queryUpInv) or die(mysql_errno());						
						// Registra la Transacción de cada Producto con el Tipo de Transacción VENTA.
						$queryRegisTrans = "INSERT INTO transacciones (fecha_alta,id_inventario,id_tipo_transaccion)
											VALUES(NOW(),".$idInv.",3);";
						$resultRegisTrans = mysql_query($queryRegisTrans) or die(mysql_error());
					}
				#Registro Detalle Venta.

				#Actualiza Existencia del Producto.
					$productovendido = array_combine($IDproducto,$CantProd);

					foreach ($productovendido as $idProd => $cantidadProd) {
						$queryProd = "SELECT exit_inventario FROM productos WHERE id_producto = ".$idProd.";";
						$resultProd = mysql_query($queryProd) or die(mysql_error());

						$existenciaProducto = mysql_result($resultProd,0,'exit_inventario');
						$existenciaActualPr = $existenciaProducto - $cantidadProd;
						
						$queryExistProdUp = "UPDATE productos SET exit_inventario = ".$existenciaActualPr."
										 WHERE id_producto = ".$idProd.";";
						$resultExistProdUp = mysql_query($queryExistProdUp) or die(mysql_error());
					}
				#Actualización de Existencia del Producto.

				#Elimina Detalle de Venta en la Tabla Temporal.
					// Elimina los datos de la tabla que es utilizada temporalmente para guardar el Detalle de la Venta.
					$queryEDVTmp = "DELETE FROM venta_add_products_tmp WHERE id_venta_tmp = ".$IDventa.";";
					$resultEDVTmp = mysql_query($queryEDVTmp) or die(mysql_errno());
				#Eliminar Detalle Venta Temporal.

				if ($resultRV && $resultRDV && $resultEDVTmp) {
					return $resultRV & $resultRDV & $resultEDVTmp;
				}
			}
		}

		#
			public function obtdventa($id_venta){
				$queryv = "SELECT ve.id_venta,
								ve.folio,
								cl.id_cliente,
								cl.nombre_cliente,
								CONCAT(ven.nom_vendedor,' ',ven.apat_vendedor,' ',ven.amat_vendedor ) nom_vend,
								ve.fecha_hora,
								mon.id_moneda,
								sve.nombre_status_venta,
								tv.nom_tipo_venta,
								tp.nom_tipo_pago,
								ve.subtotal,
								im.id_impuesto,
								ve.iva,
								ve.total
							FROM venta ve INNER JOIN  clientes cl ON ve.id_cliente = cl.id_cliente
								 INNER JOIN vendedores ven ON ve.id_vendedor = ven.id_vendedor
								 INNER JOIN moneda mon ON ve.id_moneda = mon.id_moneda
								 INNER JOIN status_venta sve ON ve.id_status_venta = sve.id_status_venta
								 INNER JOIN tipos_venta tv ON ve.id_tipo_venta = tv.id_tipo_venta
								 INNER JOIN tipos_pago tp ON ve.id_tipo_pago = tp.id_tipo_pago
								 INNER JOIN impuestos im ON ve.id_impuesto = im.id_impuesto
							WHERE ve.id_venta =" . $id_venta;
				$ejecutar = mysql_query($queryv) or die(mysql_error());
				$filas = mysql_fetch_assoc($ejecutar);
					$detVenta = $filas;
				return $detVenta;
			}
		#
		#
			public function obtdetventa($id_ven){
				$querydv = "SELECT nom.nombre,pr.modelo,dve.precio_unitario,marp.nombre_marca,pr.descripcion,
								GROUP_CONCAT(inv.no_serie SEPARATOR ' ') noserie,
								COUNT(dve.id_producto) cantp,
								GROUP_CONCAT(dve.nota SEPARATOR '[br]') notaProd
							FROM productos pr 
							LEFT JOIN nombres nom ON pr.id_nombre = nom.id_nombre
							LEFT JOIN detalle_venta dve ON pr.id_producto = dve.id_producto
							LEFT JOIN inventario inv ON dve.id_inventario = inv.id_inventario
							LEFT JOIN marca_productos marp ON pr.id_marca = marp.id_marca
							WHERE dve.id_venta = " . $id_ven . "
							GROUP BY pr.id_producto";
				$ejecutar = mysql_query($querydv) or die(mysql_error());

				$arr_detv = array();

				while ($fila = mysql_fetch_assoc($ejecutar)) {
					$arr_detv[] = $fila;
				}
				return $arr_detv;
			}
		#
		#
			public function obtenerProsingle($idp_ven){
				$query = "SELECT vtmp.id_vap_tmp,inv.no_serie,nom.nombre,pro.modelo,marp.nombre_marca
							FROM productos pro 
							LEFT JOIN venta_add_products_tmp vtmp ON pro.id_producto = vtmp.id_producto_tmp
							LEFT JOIN nombres nom ON pro.id_nombre = nom.id_nombre
							LEFT JOIN inventario inv ON vtmp.id_inventario_tmp = inv.id_inventario
							LEFT JOIN marca_productos marp ON pro.id_marca = marp.id_marca
							WHERE vtmp.id_vap_tmp  =" . $idp_ven;
				$result = mysql_query($query);

				$arr_pro = array();

				while ($rows = mysql_fetch_assoc($result)) {
					$arr_pro[] = $rows;
				}
				return $arr_pro;
			}
			
			public function borrar_producto($id_prod){
				$querySIDI = "SELECT id_inventario_tmp FROM venta_add_products_tmp WHERE id_vap_tmp = ".$id_prod;
				$resultSIDI = mysql_query($querySIDI) or die(mysql_errno());

				$IdsInventario = array();
				for ($inc=0; $inc < mysql_num_rows($resultSIDI); $inc++) { 
					$ClaveInventario = mysql_result($resultSIDI,$inc,'id_inventario_tmp');
					$IdsInventario[] = $ClaveInventario;
				}

				foreach ($IdsInventario as $IdsInv) {
					$queryUpStInv = "UPDATE inventario SET id_status = 4 WHERE id_inventario = ".$IdsInv.";";
					$resultUpStInv = mysql_query($queryUpStInv) or die(mysql_errno());	
				}
				$querydel = "DELETE FROM venta_add_products_tmp
							 WHERE id_vap_tmp =" . $id_prod;
				$ejecucion = mysql_query($querydel);
				return $ejecucion;
			}
		#
	}
?>