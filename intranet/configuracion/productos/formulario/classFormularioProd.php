<?php
	require'../../../class/dataBaseConn.php';
	class FormularioProd{
		public function obtenerConfiguracionFormP(){
			$Conexion =  new dataBaseConn();
			$query = $Conexion -> prepare('SELECT categoria,
												subcategoria,
												division,
												nombre,
												tipo,
												marca,
												modelo,
												precio,
												moneda,
												unidad_medida,
												descripcion
											FROM productos_formulario;');
			$query -> execute();
			$result = $query -> fetch();
			return $result;
		}
		public function guardarConfigFormProd($Modelo,$Precio,$Descripcion){
			$Conexion = new dataBaseConn();
			$query = $Conexion -> prepare('UPDATE productos_formulario SET modelo = :mod, precio = :pre, descripcion = :des');
			$query -> bindParam(':mod',$Modelo);
			$query -> bindParam(':pre',$Precio);
			$query -> bindParam(':des',$Descripcion);
			$result = $query -> execute();
			if ($result) {
				$this -> msjOk = "Se guardaron los cambios correctamente.";
				return $result;
			}
		}
	}
?>