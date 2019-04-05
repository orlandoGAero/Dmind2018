<?php
	session_start();
	//manejamos en sesion el nombre del usuario que se ha logeado
	if(!isset($_SESSION["usuario"])){
   	 header("location:../");  
	}
	$_SESSION["usuario"];
	//termina inicio de sesion
?>
<?php
	require_once("../libs/encrypt_decrypt_strings_urls.php");
	require('classProductos.php');
	$fnProductos = new Productos();
	// Obtiene la moneda predeterminada, para mostrar el precio del producto.
	$nameMoneda = $fnProductos -> monedaPredeterminada();

	if (isset($_REQUEST['catPro'])
		|| isset($_REQUEST['subPro'])
		|| isset($_REQUEST['divPro'])
		|| isset($_REQUEST['nombrePro'])
		|| isset($_REQUEST['tipoProd'])
		|| isset($_REQUEST['marPro'])
		|| isset($_REQUEST['modeloPro'])
		|| isset($_REQUEST['precioProd'])
	) {
		$catProd = $_REQUEST['catPro'];
		$subProd = $_REQUEST['subPro'];
		$divProd = $_REQUEST['divPro'];
		$nameProd = $_REQUEST['nombrePro'];
		$tipoProd = $_REQUEST['tipoProd'];
		$marcProd = $_REQUEST['marPro'];
		$modProd = $_REQUEST['modeloPro'];
		$precioProd = $_REQUEST['precioProd'];
	}

	if ( !empty($catProd) || !empty($subProd) || !empty($divProd) 
		|| !empty($nameProd) || !empty($tipoProd) || !empty($marcProd) 
		|| !empty($modProd) || !empty($precioProd) ) :
		$DatProd = $fnProductos -> buscarProd($catProd, $subProd, $divProd, $nameProd, $tipoProd, $marcProd, $modProd, $precioProd);
		// print_r($DatProd);
?>
<?php if(count($DatProd) >= 1) : ?>
	<div id="eliminacion"></div>
	<table class="display" id="products">
		<thead>
			<tr>
				<th>ID</th>
				<th>CATEGORÍA</th>
				<th>SUBCATEGORÍA</th>
				<th>DIVISIÓN</th>
				<th>NOMBRE</th>
				<th>TIPO</th>
				<th>MARCA</th>
				<th>MODELO</th>
				<th>PRECIO</th>
				<th>EXISTENCIAS</th>
				<th class="nosort"></th>
				<th class="nosort"></th>
				<th class="nosort"></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($DatProd as $producto) :?>
				<tr>
			    	<td class="center"><?=$producto['id_producto']?></td>
			    	<td class="center"><?=$producto['nombre_categoria']?></td>
			    	<td class="center"><?=$producto['nombre_subcategoria']?></td>
			    	<td class="center"><?=$producto['nombre_division']?></td>
			    	<td class="center"><?=$producto['nombre']?></td>
			    	<td class="center"><?=$producto['nombre_tipo']?></td>
			    	<td class="center"><?=$producto['nombre_marca']?></td>
			    	<td class="center"><?=$producto['modelo']?></td>
			 		<!-- Si la MONEDA es PESOS MEXICANOS, el precio de todos los PRODUCTOS se muestra en
			 		 la MONEDA mencionada. -->
			    	<?php if(in_array("PESO", $nameMoneda)) :?>
				    	<!-- 1 = Dólares Americanos -->
				    	<?php if($producto['id_moneda'] == 1) :?>
				    		<!-- Si el PRECIO del PRODUCTO se encuentra en DÓLARES AMERICANOS se convierte a PESOS MEXICANOS. -->
				    		<td align="center"><b>$</b><?=$fnProductos -> pesosMexicanos($producto['precio'])?></td>
				    	<!-- 2 = Pesos Mexicanos -->
				    	<?php elseif($producto['id_moneda'] == 2) :?>
				    		<td align="center"><b>$</b><?=number_format($producto['precio'],2,'.',',')?></td>
				    	<?php endif; ?>
					<!-- Si la MONEDA es DÓLARES AMERICANOS, el precio de todos los PRODUCTOS se muestra en 
					 la MONEDA mencionada. -->
				    <?php elseif(in_array("DOLAR", $nameMoneda)) :?>
						<!-- 1 = Dólares Americanos -->
				    	<?php if($producto['id_moneda'] == 1) :?>
				    		<td align="center"><b>US$</b><?=number_format($producto['precio'],2,'.',',')?></td>
				    	<!-- 2 = Pesos Mexicanos -->
				    	<?php elseif($producto['id_moneda'] == 2) :?>
				    		<!-- Si el PRECIO del PRODUCTO se encuentra en PESOS MEXICANOS se convierte a DÓLARES AMERICANOS. -->
				    		<td align="center"><b>US$</b><?=$fnProductos -> dolaresAmericanos($producto['precio'])?></td>
				    	<?php endif; ?>
				    <?php endif; ?>
			    	<?php 
			    		$nomP = $producto['nombre'];
			    		$modP = $producto['modelo'];
			    		$existenciaProducto = $producto['exit_inventario'];
			    	?>
					<?php if($existenciaProducto != 0) :?>
						<td align="center">
		    				<?=$existenciaProducto?>
		    			</td>
		    		<?php else :?>
		    			<td align="center" class="sinExistenciaProd">
		    				<?=$existenciaProducto?>
		    			</td>
		    		<?php endif; ?>
		    		<!-- Icono para VER Existencia del Producto. -->
			    	<td>
			    		<?php if($existenciaProducto != 0) :?>
			    			<a href="../transacciones/inventario/?n=<?=$nomP?>&m=<?=$modP?>">
			    				<img src="../images/inventory.png" title="Ver en Inventario">
			    			</a>
			    		<?php endif; ?>
			    	</td>
			    	<?php $idProducto = encrypt($producto['id_producto'],"productosDM") ?>
			    	<td><a href="detalle.php?productdetail=<?=$idProducto?>"><img src="../images/detalle.png" title="Detalle"></a></td>
			    	<td><a href="editar.php?productedit=<?=$idProducto?>" class="edita"><img src="../images/editar.png" title="Editar"></a></td>
			    </tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot >
			<tr>
				<th class="search search_txt" title="Clave">Clave</th>
				<th class="search search_txt" title="Categoría">Categoría</th>
				<th class="search search_txt"  title="Subcategoría">Subcategoría</th>
				<th class="search search_txt" title="División">División</th>
				<th class="search search_txt" title="Nombre">Nombre</th>
				<th class="search search_txt" title="Tipo">Tipo</th>
				<th class="search search_txt" title="Marca">Marca</th>
				<th class="search search_txt" title="Modelo">Modelo</th>
				<th class="search search_txt" title="Precio">Precio</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th align="center" id="thMon">
					<button 
						style='display: <?php if(in_array("PESO", $nameMoneda)) echo 'block'; else echo 'none'  ?>;'
						title="Cambiar Precio a Dólares" id="precioDolares">
						<img src="../images/moneda_usa.png">
					</button>
					<button 
						style='display: <?php if(in_array("DOLAR", $nameMoneda)) echo 'block'; else echo 'none'  ?>;' 
						title="Cambiar Precio a Pesos" id="precioPesos">
						<img src="../images/moneda_mex.png">
					</button>
				</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</tr>
		</tfoot>
	</table>
<?php else :?>
	<div class="vacio">
		(No se encontraron resultados)
	</div>
<?php endif; ?>
<?php else: ?>
	<div class='caption'>
		<h3 style='top: 65%;'>Se requiere por lo menos un criterio para realizar la búsqueda</h3>
	</div>
 <?php endif; ?>