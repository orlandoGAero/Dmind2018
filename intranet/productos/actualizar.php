<?php
	require_once 'classProductos.php';
	$productos = new Productos;
	require_once("../libs/encrypt_decrypt_strings_urls.php");

	$id_producto=$_REQUEST["id_producto"];
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

	$modelo = mb_strtoupper($modelo);

	$band = 0;

	if ($band == 0) {
		$rowsValProd = $productos->getFilaAfectada($modelo,$id_producto);
		if ($rowsValProd != 0) {
			echo"<div class='error'><h3>Modelo: ".$modelo." duplicado, ingresa un modelo diferente.</h3></div>";
			$band = 1;
		}
	}

	if ($band == 0) {
		$productos->modifyProducto($id_producto,$id_categoria,$id_subcategoria, 
			$id_division,$id_nombre,$id_tipo,$id_marca,$modelo,$precio,$moneda,
			$id_unidad,$descripcion);


		$idProducto = encrypt($id_producto,"productosDM");
		echo "<script type='text/javascript'>
				window.location.href = 'detalle.php?productdetail=".$idProducto."';
			</script>";
	}
?>
<script type="text/javascript">
	var actProd = jQuery.noConflict();
	actProd(document).ready(function() {
		setTimeout(function(){
			actProd('.error').fadeOut(1000);
		},5000);
	});
</script>