<?php
	require'../class/dataBaseConn.php';
	class clientes {
		public function cargarClientes(){
			$Conexion = new dataBaseConn;
			$query = $Conexion -> prepare('SELECT nombre, razonSocial, rfc, d_calle, d_noExterior, d_noInterior, d_colonia, d_localidad, d_referencia, d_municipio, d_estado, d_pais, d_codigoPostal, tipoRazonSocial 
											FROM digitalm_eere78.clientes');
			$query -> execute();
			$Clientes = $query -> fetchAll();
			return $Clientes;
		}

		public function incrementoDireccionCliente(){
			$Conexion = new dataBaseConn;
			$query = $Conexion -> prepare('SELECT id_direccion FROM direcciones ORDER BY id_direccion DESC LIMIT 1;');
			$query -> execute();
			$rows = $query -> rowCount();
			if ($rows != 0) {
				$result = $query -> fetch(PDO::FETCH_ASSOC);
				$IDdireccion = ($result['id_direccion'] + 1);
			}else{
				$IDdireccion = 1;
			}
			return $IDdireccion;
		}

		public function incrementoDatosFiscalesCliente(){
			$Conexion = new dataBaseConn;
			$query = $Conexion -> prepare('SELECT id_datfiscal FROM datos_fiscales ORDER BY id_datfiscal DESC LIMIT 1;');
			$query -> execute();
			$rows = $query -> rowCount();
			if ($rows != 0) {
				$result = $query -> fetch(PDO::FETCH_ASSOC);
				$IDdatosFiscales = ($result['id_datfiscal'] + 1);
			}else{
				$IDdatosFiscales = 1;
			}
			return $IDdatosFiscales;
		}

		public function registrarClientes($idDir,$dCalle,$dNumExt,$dNumInt,$dColonia,$dLocalidad,$dReferencia,$dMunicipio,$dEstado,$dPais,$dCodPostal,
										 $idDatFiscales,$razonSocial,$rfcCliente,$tipoRazonSocial,
										 $nomCliente){
			$Conexion = new dataBaseConn;
			$band = 0;
			if ($band == 0) {
				$query = $Conexion -> prepare('SELECT rfc FROM datos_fiscales WHERE rfc = :RFC;');
				$query -> bindParam(':RFC', $rfcCliente);
				$query -> execute();
				$rows = $query -> rowCount();
				if($rows != 0){
					// $this -> msjErr = "El RFC <i>".$rfcCliente."</i> ya se encuentra registrado.";
					$band = 1;
				}
			}
			if ($band == 0) {
				// Insertar Dirección Fiscal.
				$queryDFiscal = $Conexion -> prepare('INSERT INTO direcciones(id_direccion,calle,num_ext,num_int,colonia,localidad,referencia,municipio,estado,pais,cod_postal)
												VALUES (:IDdir,:calleC,:numExtC,:numIntC,:coloniaC,:localidadC,:referenciaC,:municipioC,:estadoC,:paisC,:codPostC);');				
				$queryDFiscal -> bindParam(":IDdir", trim($idDir));
				$queryDFiscal -> bindParam(":calleC", trim(mb_strtoupper($dCalle)));
				$queryDFiscal -> bindParam(":numExtC", trim(mb_strtoupper($dNumExt)));
				$queryDFiscal -> bindParam(":numIntC", trim(mb_strtoupper($dNumInt)));
				$queryDFiscal -> bindParam(":coloniaC", trim(mb_strtoupper($dColonia)));
				$queryDFiscal -> bindParam(":localidadC", trim(mb_strtoupper($dLocalidad)));
				$queryDFiscal -> bindParam(":referenciaC", trim(mb_strtoupper($dReferencia)));
				$queryDFiscal -> bindParam(":municipioC", trim(mb_strtoupper($dMunicipio)));
				$queryDFiscal -> bindParam(":estadoC", trim(mb_strtoupper($dEstado)));
				$queryDFiscal -> bindParam(":paisC", trim(mb_strtoupper($dPais)));
				$queryDFiscal -> bindParam(":codPostC", trim($dCodPostal));
				$queryDFiscal -> execute();
				// Insertar Dirección Fisica Cliente.
				$idDirFisicaC = $idDir + 1;
				$queryDFisicaC = $Conexion -> prepare('INSERT INTO direcciones(id_direccion,calle,num_ext,num_int,colonia,localidad,referencia,municipio,estado,pais,cod_postal)
												VALUES (:IDdir,:calleC,:numExtC,:numIntC,:coloniaC,:localidadC,:referenciaC,:municipioC,:estadoC,:paisC,:codPostC);');				
				$queryDFisicaC -> bindParam(":IDdir", trim($idDirFisicaC));
				$queryDFisicaC -> bindParam(":calleC", trim(mb_strtoupper($dCalle)));
				$queryDFisicaC -> bindParam(":numExtC", trim(mb_strtoupper($dNumExt)));
				$queryDFisicaC -> bindParam(":numIntC", trim(mb_strtoupper($dNumInt)));
				$queryDFisicaC -> bindParam(":coloniaC", trim(mb_strtoupper($dColonia)));
				$queryDFisicaC -> bindParam(":localidadC", trim(mb_strtoupper($dLocalidad)));
				$queryDFisicaC -> bindParam(":referenciaC", trim(mb_strtoupper($dReferencia)));
				$queryDFisicaC -> bindParam(":municipioC", trim(mb_strtoupper($dMunicipio)));
				$queryDFisicaC -> bindParam(":estadoC", trim(mb_strtoupper($dEstado)));
				$queryDFisicaC -> bindParam(":paisC", trim(mb_strtoupper($dPais)));
				$queryDFisicaC -> bindParam(":codPostC", trim($dCodPostal));
				$queryDFisicaC -> execute();
				// Insertar Datos Fiscales.
				$queryDatFisc = $Conexion -> prepare('INSERT INTO datos_fiscales (id_datfiscal,razon_social,rfc,tipo_razon_social,id_direccion)
												VALUES (:IDdatFis,:razonSocialC,:rfcC,:tipoRazonSocialC,:idDireccionDFiscalC);');
				$queryDatFisc -> bindParam(":IDdatFis", $idDatFiscales);
				$queryDatFisc -> bindParam(":razonSocialC", trim(mb_strtoupper($razonSocial)));
				$queryDatFisc -> bindParam(":rfcC", trim(mb_strtoupper($rfcCliente)));
				$queryDatFisc -> bindParam(":tipoRazonSocialC", trim(mb_strtoupper($tipoRazonSocial)));
				$queryDatFisc -> bindParam(":idDireccionDFiscalC", $idDirFisicaC);
				$queryDatFisc -> execute();
				// Insertar Cliente.
					// 4 = Categoría de Servicios.
				$queryCliente = $Conexion -> prepare('INSERT INTO clientes (nombre_cliente,razonSocial,fecha_alta,id_datfiscal,id_direccion,id_categoria_cliente)
												VALUES (:nombreC,:razonSocialC,NOW(),:IDdatosFiscales,:IDdirFisicaC,4);');
				$queryCliente -> bindParam(":nombreC", trim(mb_strtoupper($nomCliente)));
				$queryCliente -> bindParam(":razonSocialC", trim(mb_strtoupper($razonSocial)));
				$queryCliente -> bindParam(":IDdatosFiscales", $idDatFiscales);
				$queryCliente -> bindParam(":IDdirFisicaC", $idDir);
				$queryCliente -> execute();
				$this -> msjOk = "Se actualizó la lista de clientes.";
			}

		}
	}
?>