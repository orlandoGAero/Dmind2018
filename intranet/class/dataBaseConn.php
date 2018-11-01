<?php
	/**
	* FUNCIÓN para conectar con la Base de Datos.
	*/
	class dataBaseConn extends PDO
	{
		public function __construct()
		{
			try{
				//conexion servidor
				// parent::__construct('mysql:host=localhost;dbname=digitalm','desarrollo','entraradmin');
				//conexion local
				parent::__construct('mysql:host=localhost;dbname=dmind','root','');
				parent::setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				parent::query('SET NAMES utf8');
			}catch(Exception $ex){
				die('La Base de Datos no existe!');
			}
		}
	}
?>