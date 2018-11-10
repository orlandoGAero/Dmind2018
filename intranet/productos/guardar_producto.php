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
		$band = 0;
	}

	echo "
		<script type='text/javascript'>
			var prod = jQuery.noConflict();
			prod(function(){
				var flag = ".$band.";
				if (flag == 0) {
					iprod.fancybox.close();
					prod('#tablaProductos').load('lista_productos.php');
				}else{
					setTimeout(function(){
						prod('.error').fadeOut(1000);
					},5000);
				}
			});
		</script>
	";
?>
