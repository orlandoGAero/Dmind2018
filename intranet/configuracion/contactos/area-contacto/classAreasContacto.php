<?php
	require'../../../class/dataBaseConn.php';
	class AreasContacto
	{	
		public function obtenerAreasContacto() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_areacontacto,nombre_areacontacto FROM areacontacto');
			$sth -> execute();
			$areasContacto = $sth -> fetchAll();
			return $areasContacto;
		}

		public function registrarAreaContacto($NomAreaContact) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($NomAreaContact != "") {
				$NomAreaContact = trim(mb_strtoupper($NomAreaContact));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_areacontacto FROM areacontacto WHERE nombre_areacontacto = :nomAreaCont');
				$sth -> bindParam(':nomAreaCont', $NomAreaContact);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada el área: <i>".$NomAreaContact."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('INSERT INTO areacontacto(nombre_areacontacto) VALUES(:nomAreaCont)');
				$sth -> bindParam(':nomAreaCont', $NomAreaContact);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function obtenerDatoAreaContacto($IDareaContact) {
			$Conexion = new dataBaseConn();
			if ($IDareaContact != "") {
				$sth = $Conexion -> prepare('SELECT nombre_areacontacto FROM areacontacto WHERE id_areacontacto = :idAreaContacto');
				$sth -> bindParam(':idAreaContacto', $IDareaContact);
				$sth -> execute();
				$resultado = $sth -> fetch();
				return $resultado;
			}
		}

		public function modificarAreaContacto($IDareaContact,$NomAreaContact) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDareaContact != "" && $NomAreaContact != "") {
				$NomAreaContact = trim(mb_strtoupper($NomAreaContact));
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT nombre_areacontacto FROM areacontacto WHERE nombre_areacontacto = :nomAreaCont AND id_areacontacto != :idAreaContacto');
				$sth -> bindParam(':idAreaContacto', $IDareaContact);
				$sth -> bindParam(':nomAreaCont', $NomAreaContact);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrada el área: <i>".$NomAreaContact."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('UPDATE areacontacto SET nombre_areacontacto = :nomAreaCont WHERE id_areacontacto = :idAreaContacto');
				$sth -> bindParam(':idAreaContacto', $IDareaContact);
				$sth -> bindParam(':nomAreaCont', $NomAreaContact);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarAreaContacto($IDareaContact) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDareaContact != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT id_areacontacto FROM contactos WHERE id_areacontacto = :idAreaContacto');
				$sth -> bindParam(':idAreaContacto', $IDareaContact);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "El área contacto seleccionada no puede ser eliminada.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM areacontacto WHERE id_areacontacto = :idAreaContacto');
				$sth -> bindParam(':idAreaContacto', $IDareaContact);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Área contacto eliminada exitosamente.";
					return $result;
				}
			}
		}
	}
?>