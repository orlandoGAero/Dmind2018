<?php
	require_once 'classProductos.php';
	$productos = new Productos;
	
	$fila = $productos->getFila();
	
	if ($fila[0]=="NULL") {
		$id_producto = 1;
	} else{
		$id_producto = $fila[0]+1;
	}
	
	$id_categoria=$_REQUEST["id_categoria"];
	$id_subcategoria=$_REQUEST["id_subcategoria"];
	$id_division=$_REQUEST["id_division"];
	$id_nombre=$_REQUEST["id_nombre"];
	$id_tipo=$_REQUEST["id_tipo"];
	$id_marca=$_REQUEST["id_marca"];
	$modelo=$_REQUEST["modelo"];
	$precio=$_REQUEST["precio"];
	$moneda=$_REQUEST["moneda"];
	$id_unidad=$_REQUEST["id_unidad"];
	$descripcion=$_REQUEST["descripcion"];

	$modelo = trim(mb_strtoupper($modelo));
	$precio = trim($precio);

	$band = 0;

	if ($band == 0) {
		if ($id_categoria == 0) {
			echo "<div class='cat' style='display:none'>Agrega una Categoria</div>";
			$band = 1;
		} 

		if ($id_subcategoria == 0) {
			echo "<div class='sub' style='display:none'>Agrega una Subcategoria</div>";
			$band = 1;
		} 

		if ($id_division == 0) {
			echo "<div class='div' style='display:none'>Agrega una División</div>";
			$band = 1;
		} 

		if ($id_nombre == 0) {
			echo "<div class='nom' style='display:none'>Agrega un Nombre</div>";
			$band = 1;
		} 

		if ($id_tipo == 0) {
			echo "<div class='tip' style='display:none'>Agrega un tipo</div>";
			$band = 1;
		} 

		if ($id_marca == 0) {
			echo "<div class='mar' style='display:none'>Agrega una Marca</div>";
			$band = 1;
		} 

		if ($modelo == "") {
			echo "<div class='mod' style='display:none'>Agrega un Modelo</div>";
			$band = 1;
		} 

		if ($precio == "") {
			echo "<div class='pre' style='display:none'>Agrega un Precio</div>";
			$band = 1;
		} 

		if ($moneda == 0) {
			echo "<div class='mon' style='display:none'>Agrega una Moneda</div>";
			$band = 1;
		} 

		if ($id_unidad == 0) {
			echo "<div class='uni' style='display:none'>Agrega una Unidad</div>";
			$band = 1;
		}

		$rowsValProd = $productos->getFilaAfectada($modelo,$id_producto);
		if ($rowsValProd != 0) {
			echo"<div class='error'><h3>Modelo: ".$modelo." duplicado, ingresa un modelo diferente.</h3></div>";
			$band = 1;
		}
	}

	if ($band == 0) {
		$productos->saveProducto($id_producto,$id_categoria,$id_subcategoria, 
		$id_division,$id_nombre,$id_tipo,$id_marca,$modelo,$precio,$moneda,
		$id_unidad,$descripcion);
		echo"<div class='success'><h3>Producto guardado exitosamente</h3></div>";
		$band = 0;
	}
?>
