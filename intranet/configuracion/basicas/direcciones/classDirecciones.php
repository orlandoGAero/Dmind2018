<?php
	require'../../../class/dataBaseConn.php';
	class Direcciones
	{	
		public function obtenerDirecciones() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_direccion,calle,num_ext,num_int,colonia,localidad,referencia,municipio,estado,pais,cod_postal,sucursal,gps_ubicacion
			FROM direcciones');
			$sth -> execute();
			$dir = $sth -> fetchAll();
			return $dir;
		}

		public function registrarDireccion($calle,$numext,$numint,$col,$loc,$ref,$mun,$est,$pais,$cp,$suc,$gps_u) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($calle != "" && $numext != "" && $col != "" && $loc != "" && $mun != "" && $est != "" && $pais != "" && $cp != "") {
				$calle = trim(mb_strtoupper($calle));
				$numext = trim($numext);
				$col = trim(mb_strtoupper($col));
				$loc = trim(mb_strtoupper($loc));
				$mun = trim(mb_strtoupper($mun));
				$est = trim(mb_strtoupper($est));
				$pais = trim(mb_strtoupper($pais));
				$cp = trim($cp);
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			
			if ($band == 0) {
				$ref = trim(mb_strtoupper($ref));
				$suc = trim(mb_strtoupper($suc));
				$sth = $Conexion -> prepare('SELECT id_direccion FROM direcciones ORDER BY id_direccion DESC LIMIT 1;');
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$result = $sth -> fetch(PDO::FETCH_ASSOC);
					$id_dir = ($result['id_direccion'] + 1);
				}else {
					$id_dir = 1;
				}
				$sth = $Conexion -> prepare('INSERT INTO direcciones(id_direccion,calle,num_ext,num_int,colonia,localidad,referencia,municipio,estado,pais,cod_postal,sucursal,gps_ubicacion)
											 VALUES (:idDir,:calleDir,:nextDir,:nintDir,:colDir,:locDir,:refDir,:munDir,:estDir,:paisDir,:cpDir,:sucDir,:gpsDir)');
				$sth -> bindParam(':idDir', $id_dir);
				$sth -> bindParam(':calleDir', $calle);
				$sth -> bindParam(':nextDir', $numext);
				$sth -> bindParam(':nintDir', $numint);
				$sth -> bindParam(':colDir', $col);
				$sth -> bindParam(':locDir', $loc);
				$sth -> bindParam(':refDir', $ref);
				$sth -> bindParam(':munDir', $mun);
				$sth -> bindParam(':estDir', $est);
				$sth -> bindParam(':paisDir', $pais);
				$sth -> bindParam(':cpDir', $cp);
				$sth -> bindParam(':sucDir', $suc);
				$sth -> bindParam(':gpsDir', $gps_u);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function obtenerDatosDireccion($IDir) {
			$Conexion = new dataBaseConn();
			if ($IDir != "") {
				$sth = $Conexion -> prepare('SELECT id_direccion,calle,num_ext,num_int,colonia,localidad,referencia,municipio,estado,pais,cod_postal,sucursal,gps_ubicacion
			FROM direcciones WHERE id_direccion = :idDir');
				$sth -> bindParam(':idDir', $IDir);
				$sth -> execute();
				$resultado = $sth -> fetch();
				return $resultado;
			}
		}

		public function modificarDireccion($iddir,$calle,$numext,$numint,$col,$loc,$ref,$mun,$est,$pais,$cp,$suc,$gps_u) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($calle != "" && $numext != "" && $col != "" && $loc != "" && $mun != "" && $est != "" && $pais != "" && $cp != "") {
				$calle = trim(mb_strtoupper($calle));
				$numext = trim($numext);
				$col = trim(mb_strtoupper($col));
				$loc = trim(mb_strtoupper($loc));
				$mun = trim(mb_strtoupper($mun));
				$est = trim(mb_strtoupper($est));
				$pais = trim(mb_strtoupper($pais));
				$cp = trim($cp);
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$ref = trim(mb_strtoupper($ref));
				$suc = trim(mb_strtoupper($suc));
				$sth = $Conexion -> prepare('UPDATE direcciones SET calle = :calleDir,num_ext = :nextDir,num_int = :nintDir,colonia = :colDir,localidad = :locDir,referencia = :refDir,municipio = :munDir,estado = :estDir,pais = :paisDir,cod_postal = :cpDir,sucursal = :sucDir,gps_ubicacion = :gpsDir WHERE id_direccion = :idDir');
				$sth -> bindParam(':idDir', $iddir);
				$sth -> bindParam(':calleDir', $calle);
				$sth -> bindParam(':nextDir', $numext);
				$sth -> bindParam(':nintDir', $numint);
				$sth -> bindParam(':colDir', $col);
				$sth -> bindParam(':locDir', $loc);
				$sth -> bindParam(':refDir', $ref);
				$sth -> bindParam(':munDir', $mun);
				$sth -> bindParam(':estDir', $est);
				$sth -> bindParam(':paisDir', $pais);
				$sth -> bindParam(':cpDir', $cp);
				$sth -> bindParam(':sucDir', $suc);
				$sth -> bindParam(':gpsDir', $gps_u);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarDireccion($IDir) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDir != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sqlCl = $Conexion -> prepare('SELECT id_direccion FROM clientes WHERE id_direccion = :idDirCl');
				$sqlCo = $Conexion -> prepare('SELECT id_direccion FROM contactos WHERE id_direccion = :idDirCo');
				$sqlDf = $Conexion -> prepare('SELECT id_direccion FROM datos_fiscales WHERE id_direccion = :idDirDf');
				$sqlPr = $Conexion -> prepare('SELECT id_direccion FROM proveedores WHERE id_direccion = :idDirP');
				$sqlCl -> bindParam(':idDirCl', $IDir);
				$sqlCo -> bindParam(':idDirCo', $IDir);
				$sqlDf -> bindParam(':idDirDf', $IDir);
				$sqlPr -> bindParam(':idDirP', $IDir);
				$sqlCl -> execute();
				$sqlCo -> execute();
				$sqlDf -> execute();
				$sqlPr -> execute();
				$rows1 = $sqlCl -> rowCount();
				$rows2 = $sqlCo -> rowCount();
				$rows3 = $sqlDf -> rowCount();
				$rows4 = $sqlPr -> rowCount();
				if ($rows1 != 0 || $rows2 != 0 || $rows3 != 0 || $rows4 != 0) {
					$this -> msjErr = "El registro seleccionado no puede ser eliminado.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM direcciones WHERE id_direccion = :idDir');
				$sth -> bindParam(':idDir', $IDir);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Direccion eliminada exitosamente.";
					return $result;
				}
			}
		}
	}
?>