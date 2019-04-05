<?php
	session_start();
	//manejamos en sesion el nombre del usuario que se ha logeado
	if (!isset($_SESSION["usuario"])){
	    header("location:../");  
	}
	$_SESSION["usuario"];
	//termina inicio de sesion
	require_once 'classProductos.php'; 
	$productos = new Productos;	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title>Productos</title>
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
	<link rel="stylesheet" href="../css/estilos.css" />
	<link rel="stylesheet" href="../css/menu.css" />
	<link rel="stylesheet" href="../css/tabla.css" />
	<link rel="stylesheet" href="../css/formularios.css" />
	<link rel="stylesheet" href="../css/mensajes.css" />
	<link rel="stylesheet" type="text/css" href="../css/busqueda.css" />
	<!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../libs/dataTables/css/datatables.css">

	<!-- desarollo -->
	<script language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<!-- produccion -->
	<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->

  
	<script type="text/javascript" charset="utf8" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
	<script src="js/index.js" type="module"></script>
</head>

<body>
	<?php include ("../menu.php"); ?>
	<h1 style="text-align:center;">
		<a href="../Home"><img class="atras" src="../images/atras.png" alt="Atras"></a> Productos
	</h1>
	<div style="margin-left: 12.5%">
		<form id="formBuscarP">
			<select name="catPro">
				<option selected value="">Selecciona una categoría</option>
				<?php 
					$categorias = $productos->getCategorias();
					foreach($categorias as $categoria) :
				?>
						<option value='<?=$categoria['nombre_categoria']?>'><?=$categoria['nombre_categoria']?></option>
				<?php endforeach; ?>
			</select>
			<select name="subPro">
				<option selected value="">Selecciona una subcategoría</option>
				<?php
					$subcategorias = $productos->getSubCategorias();
					foreach($subcategorias as $subcategoria) :
				?>
						<option value='<?=$subcategoria['nombre_subcategoria']?>'><?=$subcategoria['nombre_subcategoria']?></option>
				<?php endforeach; ?>
			</select>
			<select name="divPro">
				<option selected value="">Selecciona una división</option>
				<?php
					 $divisiones = $productos->getDivisiones();
					 foreach($divisiones as $division) :
				?>
						<option value='<?=$division['nombre_division']?>'><?=$division['nombre_division']?></option>		
				<?php endforeach;?>
			</select>
			<input name="nombrePro" type="text" placeholder="Nombre del producto" title="Ingresa nombre del producto"/>
			<input name="tipoProd" type="text" placeholder="Tipo del producto" title="Ingresa tipo del producto"/>
			<select name="marPro">
				<option selected value="">Selecciona una Marca</option>
				<?php
					 $marcas = $productos->getMarcas();
					 foreach($marcas as $marca) :
				?>
						<option value='<?=$marca['nombre_marca']?>'><?=$marca['nombre_marca']?></option>		
				<?php endforeach;?>
			</select>
			<input name="modeloPro" type="text" placeholder="Modelo del producto" title="Ingresa modelo del producto"/>
			<input name="precioProd" type="number" placeholder="Precio del producto" title="Ingresa precio del producto"/>
			<input type="submit" class="btnBuscar" value="Buscar"/>
			<input type="reset" value="Limpiar" class="btn">
		</form>
	</div>
		
	<section id="botones">
		<button type="button" class="btnMostrarAll" id="mostrarTodo">Mostrar Productos</button>
	    <a class="addProducto"><b class="nuevos">Nuevo</b></a>
	    <a href="../transacciones/inventario"><b class="btnInventory">Inventario</b></a>
	</section> 

	<div id="cargando-res"></div>
	<div id="tablaProductos" style="margin-top: 50px"></div>

	<!-- Div para agregar nuevos datos de egresos -->
    <div id="nuevoProd" class="modal-egresos"></div>
    <div id="fondoProd" class="overlay"></div>
</body>
</html>