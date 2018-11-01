<?php
include ("../conexion.php");
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
	$queryValProd = "SELECT modelo
					FROM productos
					WHERE modelo = '".$modelo."' AND id_producto != ".$id_producto;
	$resultValProd = mysql_query($queryValProd) or die(mysql_errno());
	$rowsValProd = mysql_num_rows($resultValProd);
	if ($rowsValProd != 0) {
		echo"<div class='error'><h3>Modelo: ".$modelo." duplicado, ingresa un modelo diferente.</h3></div>";
		$band = 1;
	}
}

if ($band == 0) {
	$sql="UPDATE productos SET id_categoria='$id_categoria', id_subcategoria='$id_subcategoria', id_division='$id_division',
	 id_nombre='$id_nombre', id_tipo='$id_tipo', id_marca='$id_marca', modelo='$modelo', precio='$precio', id_moneda='$moneda',id_unidad='$id_unidad',
	  descripcion='$descripcion' WHERE id_producto=$id_producto";
	mysql_query($sql)or die(mysql_error());


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