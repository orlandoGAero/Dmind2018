<?php
	require'../../../class/dataBaseConn.php';
	class Usuarios
	{	
		public function obtenerUsuarios() {
			$Conexion = new dataBaseConn();
			$sth = $Conexion -> prepare('SELECT id_usuario,usuario,email,tipo FROM usuarios');
			$sth -> execute();
			$usuarios = $sth -> fetchAll();
			return $usuarios;
		}

		public function registrarUsuario($NomUsuario,$PasswordUsuario,$ConfirmUsuario,$CorreoUsuario,$TipoUsuario) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($NomUsuario != "" && $PasswordUsuario != "" && $ConfirmUsuario != "" && $CorreoUsuario != "") {
				$NomUsuario = trim($NomUsuario);
				$PasswordUsuario = trim($PasswordUsuario);
				$ConfirmUsuario = trim($ConfirmUsuario);
				$CorreoUsuario = trim($CorreoUsuario);
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT usuario FROM usuarios WHERE usuario = :nomUser');
				$sth -> bindParam(':nomUser', $NomUsuario);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrado el usuario: <i>".$NomUsuario."</i>.";
					$band = 1;
				}
				if($PasswordUsuario != $ConfirmUsuario){
					$this -> msjErr = "Las contraseñas no coinciden.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT id_usuario FROM usuarios ORDER BY id_usuario DESC LIMIT 1;');
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$result = $sth -> fetch(PDO::FETCH_ASSOC);
					echo $IdUsuario = ($result['id_usuario'] + 1);
				}else {
					$IdUsuario = 1;
				}
				$sth = $Conexion -> prepare('INSERT INTO usuarios(id_usuario,usuario,contrasena,email,usuario_freg,tipo) VALUES(:idUser,:nomUser,:passUser,:emailUser,NOW(),:tipoUser)');
				$sth -> bindParam(':idUser', $IdUsuario);
				$sth -> bindParam(':nomUser', $NomUsuario);
				$sth -> bindParam(':passUser', $PasswordUsuario);
				$sth -> bindParam(':emailUser', $CorreoUsuario);
				$sth -> bindParam(':tipoUser', $TipoUsuario);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function obtenerDatoUsuario($IDusuario) {
			$Conexion = new dataBaseConn();
			if ($IDusuario != "") {
				$sth = $Conexion -> prepare('SELECT usuario,email FROM usuarios WHERE id_usuario = :idUser');
				$sth -> bindParam(':idUser', $IDusuario);
				$sth -> execute();
				$resultado = $sth -> fetch();
				return $resultado;
			}
		}

		public function modificarUsuario($IDusuario,$NomUsuario,$CorreoUsuario,$TipoUsuario) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($NomUsuario != "" && $CorreoUsuario != "") {
				$NomUsuario = trim($NomUsuario);
				$CorreoUsuario = trim($CorreoUsuario);
				$band = 0;
			}else{
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('SELECT usuario FROM usuarios WHERE usuario = :nomUser AND id_usuario != :idUser');
				$sth -> bindParam(':idUser', $IDusuario);
				$sth -> bindParam(':nomUser', $NomUsuario);
				$sth -> execute();
				$rows = $sth -> rowCount();
				if ($rows != 0) {
					$this -> msjErr = "Ya se encuentra registrado el usuario: <i>".$NomUsuario."</i>.";
					$band = 1;
				}
			}
			if ($band == 0) {
				$sth = $Conexion -> prepare('UPDATE usuarios SET usuario = :nomUser, email = :emailUser, tipo = :tipoUser WHERE id_usuario = :idUser');
				$sth -> bindParam(':idUser', $IDusuario);
				$sth -> bindParam(':nomUser', $NomUsuario);
				$sth -> bindParam(':emailUser', $CorreoUsuario);
				$sth -> bindParam(':tipoUser', $TipoUsuario);
				$result = $sth -> execute();
				if ($result) {
					return $result;
				}
			}
		}

		public function eliminarUsuario($IDusuario) {
			$band = 0;
			$Conexion = new dataBaseConn();
			if ($IDusuario != "") {
				$band = 0;
			}else{
				$band = 1;
			}
			// if ($band == 0) {
			// 	$sth = $Conexion -> prepare('SELECT id_status_venta FROM venta WHERE id_status_venta = :idStVenta');
			// 	$sth -> bindParam(':idStVenta', $IDusuario);
			// 	$sth -> execute();
			// 	$rows = $sth -> rowCount();
			// 	if ($rows != 0) {
			// 		$this -> msjErr = "El registro seleccionado no puede ser eliminado.";
			// 		$band = 1;
			// 	}
			// }
			if ($band == 0) {
				$sth = $Conexion -> prepare('DELETE FROM usuarios WHERE id_usuario = :idUser');
				$sth -> bindParam(':idUser', $IDusuario);
				$result = $sth -> execute();
				if ($result) {
					$this -> msjOk = "Usuario eliminado exitosamente.";
					return $result;
				}
			}
		}
	}
?>