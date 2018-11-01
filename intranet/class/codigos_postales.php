<?php
	/**
	* FUNCIÓN para Códigos Postales.
	*/
	require'condb_codpos.php';
	class codigos_postales {
		public function obtenerDireccion($codPostal) {
			$Conexion = new condb_codpos();
			$query = $Conexion -> prepare('SELECT cp.codigo_pos, UPPER(cp.localidad) localidad, UPPER(cp.municipio) municipio, UPPER(e.estado) estado
										  FROM codigos_postales cp
										   INNER JOIN estados_mexico e ON e.id_estado = cp.id_estado
										  WHERE cp.codigo_pos = :codP;');
			$query -> bindParam(':codP', $codPostal);
			$query -> execute();
			$datDireccion =  $query -> fetchAll();
			return $datDireccion;
		}
	}
?>