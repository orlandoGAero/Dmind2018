<?php
	require'../../../class/dataBaseConn.php';
	class datosFiscales
	{	
		public function obtenerDatosFiscales() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_dfiscales_e, razon_social_e, rfc_e FROM datos_fiscales_empresa;');
			$sth -> execute();
			$datFis = $sth -> fetchAll();
			return $datFis;
		}

		public function registrarDatosFiscales($razonSocialDatF, $rfcDatF) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($razonSocialDatF != "" && $rfcDatF != "") {
				$razonSocialDatF = trim(mb_strtoupper($razonSocialDatF));
				$rfcDatF = trim(mb_strtoupper($rfcDatF));
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT razon_social_e FROM datos_fiscales_empresa WHERE razon_social_e = :nomRazSoc');
				$sth -> bindParam(':nomRazSoc', $razonSocialDatF);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la razón social: <i>".$razonSocialDatF."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('INSERT INTO datos_fiscales_empresa(razon_social_e, rfc_e) VALUES(:nomRazSoc,:rfcE)');
				$sth -> bindParam(':nomRazSoc', $razonSocialDatF);
				$sth -> bindParam(':rfcE', $rfcDatF);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function infoDatoFiscal($idDatF) {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_dfiscales_e, razon_social_e, rfc_e FROM datos_fiscales_empresa WHERE id_dfiscales_e = :idDFiscal;');
			$sth -> bindParam(':idDFiscal', $idDatF);
			$sth -> execute();
			$infoDatFis = $sth -> fetch();
			return $infoDatFis;
		}

		public function modificarDatosFiscales($idDatF, $razonSocialDatF, $rfcDatF) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($idDatF != "" && $razonSocialDatF != "" && $rfcDatF != "") {
				$razonSocialDatF = trim(mb_strtoupper($razonSocialDatF));
				$rfcDatF = trim(mb_strtoupper($rfcDatF));
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT razon_social_e FROM datos_fiscales_empresa WHERE razon_social_e = :nomRazSoc AND id_dfiscales_e != :idDFiscal');
				$sth -> bindParam(':idDFiscal', $idDatF);
				$sth -> bindParam(':nomRazSoc', $razonSocialDatF);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada la razón social: <i>".$razonSocialDatF."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('UPDATE datos_fiscales_empresa SET razon_social_e = :nomRazSoc, rfc_e = :rfcE WHERE id_dfiscales_e = :idDFiscal');
				$sth -> bindParam(':idDFiscal', $idDatF);
				$sth -> bindParam(':nomRazSoc', $razonSocialDatF);
				$sth -> bindParam(':rfcE', $rfcDatF);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarDatosFiscales($idDatF) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($idDatF != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM datos_fiscales_empresa WHERE id_dfiscales_e = :idDFiscal');
				$sth -> bindParam(':idDFiscal', $idDatF);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Dato Fiscal eliminado exitosamente.";
					return $result;
				}
			}
		}
	}
?>