<?php require_once("../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datProductos = $fnProd -> obtenerProductos() ) : ?>
	<table class="display" id="pro">
		<thead>
			<tr>
				<th>Id</th>
				<th>Categoría</th>
				<th>Subcategoría</th>
				<th>División</th>
				<th>Nombre</th>
				<th>Tipo</th>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Precio</th>
				<th>Existencia</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($datProductos as $productos) : ?>
				<tr>
					<td class="center"><?=$productos['id_producto']?></td>
					<td class="center"><?=$productos['nombre_categoria']?></td>
					<td class="center"><?=$productos['nombre_subcategoria']?></td>
					<td class="center"><?=$productos['nombre_division']?></td>
					<td class="center"><?=$productos['nombre']?></td>
					<td class="center"><?=$productos['nombre_tipo']?></td>
					<td class="center"><?=$productos['nombre_marca']?></td>
					<td class="center"><?=$productos['modelo']?></td>
					<td>
						<?php if($productos['id_moneda'] == 1) :?>
		    				<!-- Dolares Americanos -->
							<b>US$</b><?=number_format($productos['precio'],2,'.',',')?>
						<?php elseif($productos['id_moneda'] == 2) :?>
		    				<!-- Pesos Mexicanos -->
		    				<b>$</b><?=number_format($productos['precio'],2,'.',',')?>
		    			<?php endif; ?>			
					</td>
					<td class="center"><?=$productos['exit_inventario']?></td>
					<!--id -->
					<?php $idProd = encrypt($productos['id_producto'],"productosDM") ?>
					<td width="5%" class="center">
						<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
							<input type="hidden" name="txtIdProd" readonly value="<?=$idProd?>" />
							<button type="button" class="deleteProduct" title="Borrar">
								<img src="../../../images/eliminar.png" alt="Borrar">
							</button>
						</form>
					</td>
					<td>
						<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
							<input type="hidden" name="txtIdProd" readonly value="<?=$idProd?>" />
							<?php if($productos['descontinuado'] == "No") :?>
								<?php if($productos['exit_inventario'] == 0) :?>
									<button type="button" id="visible" title="¿Descontinuar?" class="descontinuar">
										<img src="" title="Visible" alt="">
									</button>
								<?php else :?>
									<button type="button" id="visibleConExist" title="Con existencia">
										<img src="" title="Visible" alt="">
									</button>
								<?php endif; ?>
							<?php elseif($productos['descontinuado'] == "Si") :?>
								<button type="button" id="novisible" title="¿Habilitar?" class="habilitar">
									<img src="" title="Descontinuado" alt="">
								</button>
							<?php endif; ?>
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot style="display:table-header-group;">
			<tr>
				<th class="search">Clave</th>
				<th class="search">Categoría</th>
				<th class="search2">Subcategoría</th>
				<th class="search">División</th>
				<th class="search">Nombre</th>
				<th class="search">Tipo</th>
				<th class="search">Marca</th>
				<th class="search">Modelo</th>
				<th class="search">Precio</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</tfoot>
	</table>
	<br />
<?php else :?>
	<div class="vacio">
		(Sin registros)
	</div>
<?php endif; ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.deleteProduct').click(function(){
			if (confirm('¿Desea eliminar el producto?')) {
				formDel = this.form;
				$('#tb_product').load('eliminar_producto.php',$(formDel).serialize());
			}
		});
		$('.descontinuar').click(function() {
			if (confirm('¿Desea descontinuar el producto?')) {
				idProduct = this.form;
				$('#tb_product').load('descontinuar_producto.php',$(idProduct).serialize());
			}
		});
		$('.habilitar').click(function() {
			if (confirm('¿Desea habilitar el producto?')) {
				idProd = this.form;
				$('#tb_product').load('habilitar_producto.php',$(idProd).serialize());
			}
		});

		$('#pro').dataTable({ 
	        // Damos formato a la paginación(números).
	        "sPaginationType": "full_numbers",
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
	        	aTargets: [10, 11]
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
	    		{type:"number"},
	    		{type:"text"},
	    		{type:"text"},
	    		null,
	    		null,
	    		null
	    	]
	    });
	});
</script>