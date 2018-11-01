<?php
	/**
	* FUNCIÓN para conectar con la Base de Datos Codigos Postales.
	*/
	class condb_codpos extends PDO
	{
		public function __construct()
		{
			try{
				parent::__construct('mysql:host=localhost;dbname=codpos_mexico','desarrollo','entraradmin');
				parent::setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				parent::query('SET NAMES utf8');
			}catch(Exception $ex){
				die('La Base de Datos no existe!');
			}
		}
	}
?>