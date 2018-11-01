<?php
	class conn{
		public function conectar(){
			$server = "localhost";
			$user = "desarrollo";
			$password = "entraradmin";
			$database = "digitalm";

			$connect = mysql_connect($server,$user,$password) or die("No se ha encontrado el servidor");
			mysql_select_db($database, $connect) or die("Base de Datos no encontrada");
			mysql_set_charset("utf8");

			// return $connect;
		}
	}
?>