<?php
	class config_egresos {
		/*
			Clasificacion
		*/
		public function obtener_cla(){
			$query = "SELECT id_clasifi,nom_clasifi
					  FROM clasificacion_comprobantes";
			$ejecutar = mysql_query($query) or die(mysql_error());
			$datos_clas = array();
			while ($filas = mysql_fetch_assoc($ejecutar)) {
				$datos_clas[] = $filas;
			}
			return $datos_clas;
		}

		public function registrar_clasificacion($nomCl) {
			$band = 0;

			if ($nomCl != "") {
			} else {
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}

			if ($band == 0) {
				$query = "SELECT nom_clasifi
							FROM clasificacion_comprobantes
							WHERE nom_clasifi = '".$nomCl."' ";
				$result = mysql_query($query) or die("CONSU" . mysql_error());
				$filas = mysql_num_rows($result);
				if($filas != 0){
					$this -> msjErr = "Ya se encuentra registrada la clasificación: <i>".$nomCl."</i>.";
					$band = 1;
				}
			}

			if ($band == 0) {

				$nomCl = trim(mb_strtoupper($nomCl));

				$sql = "INSERT INTO clasificacion_comprobantes(nom_clasifi)
						VALUES ('".$nomCl."')";
				$ejecutar = mysql_query($sql) or die(mysql_error());
				
				if($ejecutar){
					return $ejecutar;
				}
			}

		}

		public function obtDatEditcla($id_cla){
			$query = "SELECT id_clasifi,nom_clasifi
					  FROM clasificacion_comprobantes
					  WHERE id_clasifi =" . $id_cla;
			$ejecutar = mysql_query($query) or die(mysql_error());
			$filas = mysql_fetch_assoc($ejecutar);
			
			return $filas;
		}

		public function editar_clasificacion($idcl,$nomCl) {
			$band = 0;

			if ($nomCl != "") {
			} else {
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}

			if ($band == 0) {
				$query = "SELECT nom_clasifi
							FROM clasificacion_comprobantes
							WHERE nom_clasifi = '".$nomCl."' ";
				$result = mysql_query($query) or die(mysql_error());
				$filas = mysql_num_rows($result);
				if($filas != 0){
					$this -> msjErr = "Ya se encuentra registrada la clasificación: ".$nomCl." ";
					$band = 1;
				}
			}

			if ($band == 0) {

				$nomCl = trim(mb_strtoupper($nomCl));

				$sql = "UPDATE clasificacion_comprobantes
						SET nom_clasifi = '".$nomCl."'
						WHERE id_clasifi =".$idcl;
				$ejecutar = mysql_query($sql) or die(mysql_error());
				
				if($ejecutar){
					return $ejecutar;
				}
			}

		}

		public function eliminar_clasifi($idCl)	{
			$band = 0;

			if ($band == 0) {
				$query = "SELECT clasificacion
							FROM egresos
							WHERE clasificacion =" . $idCl;
				$ejecutar = mysql_query($query) or die(mysql_error());
				$filas = mysql_num_rows($ejecutar);
				if ($filas != 0) {
					$this -> msjErr = "El registro no puede ser eliminado";
					$band = 1;
				}
			}

			if($band == 0){
				$sql = "DELETE FROM clasificacion_comprobantes
						WHERE id_clasifi =" . $idCl;
				$result = mysql_query($sql);
				$this -> msjOk = "Registro eliminado exitosamente.";
				return $result;
			}
		}

		/*
			Concepto
		*/
		public function obtener_concept(){
			$query = "SELECT id_concepto,nom_concepto
					  FROM conceptos_comprobantes";
			$ejecutar = mysql_query($query) or die(mysql_error());
			$datos_con = array();
			while ($filas = mysql_fetch_assoc($ejecutar)) {
				$datos_con[] = $filas;
			}
			return $datos_con;
		}

		public function registrar_concepto($nomCo) {
			$band = 0;

			if ($nomCo != "") {
			} else {
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}

			if ($band == 0) {
				$query = "SELECT nom_concepto
							FROM conceptos_comprobantes
							WHERE nom_concepto = '".$nomCo."' ";
				$result = mysql_query($query) or die(mysql_error());
				$filas = mysql_num_rows($result);
				if($filas != 0){
					$this -> msjErr = "Ya se encuentra registrado el concepto: ".$nomCo." ";
					$band = 1;
				}
			}

			if ($band == 0) {

				$nomCo = trim(mb_strtoupper($nomCo));

				$sql = "INSERT INTO conceptos_comprobantes(nom_concepto)
						VALUES ('".$nomCo."')";
				$ejecutar = mysql_query($sql) or die(mysql_error());
				
				if($ejecutar){
					return $ejecutar;
				}
			}
		}

		public function obtDatEditcon($id_co){
			$query = "SELECT id_concepto,nom_concepto
					  FROM conceptos_comprobantes
					  WHERE id_concepto =" . $id_co;
			$ejecutar = mysql_query($query) or die(mysql_error());
			$filas = mysql_fetch_assoc($ejecutar);
			
			return $filas;
		}

		public function editar_concepto($idco,$nomCo) {
			$band = 0;

			if ($nomCo != "") {
			} else {
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}

			if ($band == 0) {
				$query = "SELECT nom_concepto
							FROM conceptos_comprobantes
							WHERE nom_concepto = '".$nomCo."' ";
				$result = mysql_query($query) or die(mysql_error());
				$filas = mysql_num_rows($result);
				if($filas != 0){
					$this -> msjErr = "Ya se encuentra registrado el concepto: ".$nomCo." ";
					$band = 1;
				}
			}

			if ($band == 0) {

				$nomCo = trim(mb_strtoupper($nomCo));

				$sql = "UPDATE conceptos_comprobantes
						SET nom_concepto = '".$nomCo."'
						WHERE id_concepto =".$idco;
				$ejecutar = mysql_query($sql) or die(mysql_error());
				
				if($ejecutar){
					return $ejecutar;
				}
			}
		}

		public function eliminar_concepto($idCo)	{
			$band = 0;

			if ($band == 0) {
				$query = "SELECT concepto
							FROM egresos
							WHERE concepto =" . $idCo;
				$ejecutar = mysql_query($query) or die(mysql_error());
				$filas = mysql_num_rows($ejecutar);
				if ($filas != 0) {
					$this -> msjErr = "El registro no puede ser eliminado";
					$band = 1;
				}
			}

			if($band == 0){
				$sql = "DELETE FROM conceptos_comprobantes
						WHERE id_concepto =" . $idCo;
				$result = mysql_query($sql);
				$this -> msjOk = "Registro eliminado exitosamente.";
				return $result;
			}
		}

		/*
			Destino
		*/
		public function obtener_destino(){
			$query = "SELECT id_destino,nom_destino
					  FROM destinos_comprobantes";
			$ejecutar = mysql_query($query) or die(mysql_error());
			$datos_des = array();
			while ($filas = mysql_fetch_assoc($ejecutar)) {
				$datos_des[] = $filas;
			}
			return $datos_des;
		}

		public function registrar_destino($nomDes) {
			$band = 0;

			if ($nomDes != "") {
			} else {
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}

			if ($band == 0) {
				$query = "SELECT nom_destino
							FROM destinos_comprobantes
							WHERE nom_destino = '".$nomDes."' ";
				$result = mysql_query($query) or die(mysql_error());
				$filas = mysql_num_rows($result);
				if($filas != 0){
					$this -> msjErr = "Ya se encuentra registrado el destino: ".$nomDes." ";
					$band = 1;
				}
			}

			if ($band == 0) {

				$nomDes = trim(mb_strtoupper($nomDes));

				$sql = "INSERT INTO destinos_comprobantes(nom_destino)
						VALUES ('".$nomDes."')";
				$ejecutar = mysql_query($sql) or die(mysql_error());
				
				if($ejecutar){
					return $ejecutar;
				}
			}
		}

		public function obtDatEditdes($id_de){
			$query = "SELECT id_destino,nom_destino
					  FROM destinos_comprobantes
					  WHERE id_destino =" . $id_de;
			$ejecutar = mysql_query($query) or die(mysql_error());
			$filas = mysql_fetch_assoc($ejecutar);
			
			return $filas;
		}

		public function editar_destino($iddes,$nomDes) {
			$band = 0;

			if ($nomDes != "") {
			} else {
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}

			if ($band == 0) {
				$query = "SELECT nom_destino
							FROM destinos_comprobantes
							WHERE nom_destino = '".$nomDes."' ";
				$result = mysql_query($query) or die(mysql_error());
				$filas = mysql_num_rows($result);
				if($filas != 0){
					$this -> msjErr = "Ya se encuentra registrado el concepto: ".$nomDes." ";
					$band = 1;
				}
			}

			if ($band == 0) {

				$nomDes = trim(mb_strtoupper($nomDes));

				$sql = "UPDATE destinos_comprobantes
						SET nom_destino = '".$nomDes."'
						WHERE id_destino =".$iddes;
				$ejecutar = mysql_query($sql) or die(mysql_error());
				
				if($ejecutar){
					return $ejecutar;
				}
			}
		}

		public function eliminar_destino($idDes)	{
			$band = 0;

			if ($band == 0) {
				$query = "SELECT destino
							FROM egresos
							WHERE destino =" . $idDes;
				$ejecutar = mysql_query($query) or die(mysql_error());
				$filas = mysql_num_rows($ejecutar);
				if ($filas != 0) {
					$this -> msjErr = "El registro no puede ser eliminado";
					$band = 1;
				}
			}

			if($band == 0){
				$sql = "DELETE FROM destinos_comprobantes
						WHERE id_destino =" . $idDes;
				$result = mysql_query($sql);
				$this -> msjOk = "Registro eliminado exitosamente.";
				return $result;
			}
		}

		/*
			Origen
		*/
		public function obtener_origen(){
			$query = "SELECT id_origen,nom_origen
					  FROM origenes_comprobantes";
			$ejecutar = mysql_query($query) or die(mysql_error());
			$datos_or = array();
			while ($filas = mysql_fetch_assoc($ejecutar)) {
				$datos_or[] = $filas;
			}
			return $datos_or;
		}

		public function registrar_origen($nomOri) {
			$band = 0;

			if ($nomOri != "") {
			} else {
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}

			if ($band == 0) {
				$query = "SELECT nom_origen
							FROM origenes_comprobantes
							WHERE nom_origen = '".$nomOri."' ";
				$result = mysql_query($query) or die(mysql_error());
				$filas = mysql_num_rows($result);
				if($filas != 0){
					$this -> msjErr = "Ya se encuentra registrado el origen: ".$nomOri." ";
					$band = 1;
				}
			}

			if ($band == 0) {

				$nomOri = trim(mb_strtoupper($nomOri));

				$sql = "INSERT INTO origenes_comprobantes(nom_origen)
						VALUES ('".$nomOri."')";
				$ejecutar = mysql_query($sql) or die(mysql_error());
				
				if($ejecutar){
					return $ejecutar;
				}
			}
		}

		public function obtDatEditdori($id_or){
			$query = "SELECT id_origen,nom_origen
					  FROM origenes_comprobantes
					  WHERE id_origen =" . $id_or;
			$ejecutar = mysql_query($query) or die(mysql_error());
			$filas = mysql_fetch_assoc($ejecutar);
			
			return $filas;
		}

		public function editar_origen($idori,$nomOr) {
			$band = 0;

			if ($nomOr != "") {
			} else {
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}

			if ($band == 0) {
				$query = "SELECT nom_origen
							FROM origenes_comprobantes
							WHERE nom_origen = '".$nomOr."' ";
				$result = mysql_query($query) or die(mysql_error());
				$filas = mysql_num_rows($result);
				if($filas != 0){
					$this -> msjErr = "Ya se encuentra registrado el origen: ".$nomOr." ";
					$band = 1;
				}
			}

			if ($band == 0) {

				$nomOr = trim(mb_strtoupper($nomOr));

				$sql = "UPDATE origenes_comprobantes
						SET nom_origen = '".$nomOr."'
						WHERE id_origen =".$idori;
				$ejecutar = mysql_query($sql) or die(mysql_error());
				
				if($ejecutar){
					return $ejecutar;
				}
			}
		}

		public function eliminar_origen($idOrig)	{
			$band = 0;

			if ($band == 0) {
				$query = "SELECT origen
							FROM egresos
							WHERE origen =" . $idOrig;
				$ejecutar = mysql_query($query) or die(mysql_error());
				$filas = mysql_num_rows($ejecutar);
				if ($filas != 0) {
					$this -> msjErr = "El registro no puede ser eliminado";
					$band = 1;
				}
			}

			if($band == 0){
				$sql = "DELETE FROM origenes_comprobantes
						WHERE id_origen =" . $idOrig;
				$result = mysql_query($sql);
				$this -> msjOk = "Registro eliminado exitosamente.";
				return $result;
			}
		}

		/*
			Status
		*/
		public function obtener_status(){
			$query = "SELECT id_status,nom_status
					  FROM status_comprobantes";
			$ejecutar = mysql_query($query) or die(mysql_error());
			$datos_sta = array();
			while ($filas = mysql_fetch_assoc($ejecutar)) {
				$datos_sta[] = $filas;
			}
			return $datos_sta;
		}

		public function registrar_status($nomSta) {
			$band = 0;

			if ($nomSta != "") {
			} else {
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}

			if ($band == 0) {
				$query = "SELECT nom_status
							FROM status_comprobantes
							WHERE nom_status = '".$nomSta."' ";
				$result = mysql_query($query) or die(mysql_error());
				$filas = mysql_num_rows($result);
				if($filas != 0){
					$this -> msjErr = "Ya se encuentra registrado el status: ".$nomSta." ";
					$band = 1;
				}
			}

			if ($band == 0) {

				$nomSta = trim(mb_strtoupper($nomSta));

				$sql = "INSERT INTO status_comprobantes(nom_status)
						VALUES ('".$nomSta."')";
				$ejecutar = mysql_query($sql) or die(mysql_error());
				
				if($ejecutar){
					return $ejecutar;
				}
			}
		}

		public function obtDatEditdsta($id_sta){
			$query = "SELECT id_status,nom_status
					  FROM status_comprobantes
					  WHERE id_status =" . $id_sta;
			$ejecutar = mysql_query($query) or die(mysql_error());
			$filas = mysql_fetch_assoc($ejecutar);
			
			return $filas;
		}

		public function editar_status($idsta,$nomSt) {
			$band = 0;

			if ($nomSt != "") {
			} else {
				$this -> msjCap = "Complete todos los datos requeridos.";
				$band = 1;
			}

			if ($band == 0) {
				$query = "SELECT nom_status
							FROM status_comprobantes
							WHERE nom_status = '".$nomSt."' ";
				$result = mysql_query($query) or die(mysql_error());
				$filas = mysql_num_rows($result);
				if($filas != 0){
					$this -> msjErr = "Ya se encuentra registrado el status: ".$nomSt." ";
					$band = 1;
				}
			}

			if ($band == 0) {

				$nomSt = trim(mb_strtoupper($nomSt));

				$sql = "UPDATE status_comprobantes
						SET nom_status = '".$nomSt."'
						WHERE id_status =".$idsta;
				$ejecutar = mysql_query($sql) or die(mysql_error());
				
				if($ejecutar){
					return $ejecutar;
				}
			}
		}

		public function eliminar_status($idStatus)	{
			$band = 0;

			if ($band == 0) {
				$query = "SELECT estado
							FROM egresos
							WHERE estado =" . $idStatus;
				$ejecutar = mysql_query($query) or die(mysql_error());
				$filas = mysql_num_rows($ejecutar);
				if ($filas != 0) {
					$this -> msjErr = "El registro no puede ser eliminado";
					$band = 1;
				}
			}

			if($band == 0){
				$sql = "DELETE FROM status_comprobantes
						WHERE id_status =" . $idStatus;
				$result = mysql_query($sql);
				$this -> msjOk = "Registro eliminado exitosamente.";
				return $result;
			}
		}
	}
?>