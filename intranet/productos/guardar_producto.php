<?php
	include ("../conexion.php");

  	$query = "SELECT id_producto FROM productos ORDER BY id_producto DESC LIMIT 1;";
  	$result=mysql_query($query);
  	$fila=mysql_fetch_array($result);
  	if($fila[0]=="NULL"){
	  	$id_producto=1;
  	}else{
	  	$id_producto=$fila[0]+1;
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
		$queryGuardar="INSERT INTO productos VALUES ('$id_producto','$id_categoria','$id_subcategoria','$id_division',
		 '$id_nombre','$id_tipo','$id_marca','$modelo','$precio','$moneda','$id_unidad','$descripcion','0','No')";
		mysql_query($queryGuardar)or die(mysql_errno());
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
