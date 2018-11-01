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
	$buscarNameProd = $_REQUEST['nombrePro'];
?>
<?php if(	$DatProd = $fnProductos -> buscarProductosNombre($buscarNameProd) ) :?>
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
				<th></th>
				<th></th>
				<th></th>
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
		<tfoot style="display:table-header-group;">
			<tr>
				<th class="search" title="Clave">Clave</th>
				<th class="search" title="Categoría">Categoría</th>
				<th class="search2" title="Subcategoría">Subcategoría</th>
				<th class="search" title="División">División</th>
				<th class="search" title="Nombre">Nombre</th>
				<th class="search" title="Tipo">Tipo</th>
				<th class="search" title="Marca">Marca</th>
				<th class="search" title="Modelo">Modelo</th>
				<th class="search" title="Precio">Precio</th>
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
				<th align="center">
					<?php if(in_array("PESO", $nameMoneda)) :?>
						<button title="Cambiar Precio a Dólares" id="precioDolares"><img src="../images/moneda_usa.png"></button>
					<?php elseif(in_array("DOLAR", $nameMoneda)) :?>
						<button title="Cambiar Precio a Pesos" id="precioPesos"><img src="../images/moneda_mex.png"></button>
					<?php endif; ?>
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
		(Sin registros)
	</div>
<?php endif; ?>
<script type="text/javascript">
	var pro = jQuery.noConflict();
	pro(document).ready(function(){
		// DataTable
		pro('#products').dataTable({ 
	        // Damos formato a la paginación(números).
	        "sPaginationType": "full_numbers",
	        // Desactiva el filtrado de datos.
	        // bFilter: false,
	        // Ordenar de forma ascendente la columna de la posición 1.
	        aaSorting: [[0,"asc"]],
	        // Muestra el número de filas en una sola página.
	        iDisplayLength: 25,
	        /*Configura el menú que se utiliza para seleccionar 
	        	el número de filas en una sola página. */
	        aLengthMenu: [[25, 50, 100], [25, 50, 100]],
	        // Desactivar la ordenación de una columna.
	        aoColumnDefs:[{
	        	bSortable: false,
	        	// Posición de la columna.
	        	aTargets: [10, 11, 12]
	        }],
			// Cambiar de posición los elementos(paginado,buscar,etc.)
			"sDom" : '<"top"lp>rt<"bottom"i><"clear">'
	    })

		.columnFilter({
	    	aoColumns: [
	    		{type:"number"},
	    		{type:"text"},
	    		{type:"text"},
	    		{type:"text"},
	    		{type:"text"},
	    		{type:"text"},
	    		{type:"text"},
	    		{type:"text"},
	    		{type:"text"},
	    		null,
	    		null,
	    		null,
	    		null
	    	]
	    });
	     //FUNCIÓN que cambia el PRECIO del PRODUCTO a DÓlARES AMERICANOS.
	    pro('#precioDolares').click(function() {
	    	pro.post('lista_productos_precio.php', {moneda: 'dolarAm'}, function(data) {
	    		pro('#tablaProductos').html(data);
	    	});
	    });
	    // FUNCIÓN que cambia el PRECIO del PRODUCTO a PESOS MEXICANOS.
	    pro('#precioPesos').click(function() {
	    	pro.post('lista_productos_precio.php', {moneda: 'pesoMx'}, function(data) {
	    		pro('#tablaProductos').html(data);
	    	});
	    });
	});
</script>

