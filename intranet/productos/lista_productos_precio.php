<?php
	require_once("../libs/encrypt_decrypt_strings_urls.php");
	require('classProductos.php');
	$fnProductos = new Productos();
	$nameMoneda = $_REQUEST['moneda'];
?>
<?php if(	$DatProd = $fnProductos -> obtenerProductos() ) :?>
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
			    	<td align="center">
			 			<!-- Si la MONEDA es PESOS MEXICANOS, el precio de todos los PRODUCTOS se muestra en la MONEDA mencionada. -->
			    		<?php if($nameMoneda == "pesoMx") :?>
			    		<b>$</b>
				    	<!-- 1 = Dólares Americanos -->
				    	<?php if($producto['nombre_moneda'] == 'DOLAR') :?>
				    		<!-- Si el PRECIO del PRODUCTO se encuentra en DÓLARES AMERICANOS se convierte a PESOS MEXICANOS. -->
				    		<?=$fnProductos -> pesosMexicanos($producto['precio'])?>
				    	<!-- 2 = Pesos Mexicanos -->
				    	<?php elseif($producto['nombre_moneda'] == 'PESO') :?>
				    		<?=number_format($producto['precio'],2,'.',',')?>
				    	<?php endif; ?>
					<!-- Si la MONEDA es DÓLARES AMERICANOS, el precio de todos los PRODUCTOS se muestra en 
					 la MONEDA mencionada. -->
				    <?php elseif($nameMoneda == "dolarAm") :?>
				    	<b>US$</b>
						<!-- 1 = Dólares Americanos -->
				    	<?php if($producto['nombre_moneda'] == 'DOLAR') :?>
				    		<?=number_format($producto['precio'],2,'.',',')?>
				    	<!-- 2 = Pesos Mexicanos -->
				    	<?php elseif($producto['nombre_moneda'] == 'PESO') :?>
				    		<!-- Si el PRECIO del PRODUCTO se encuentra en PESOS MEXICANOS se convierte a DÓLARES AMERICANOS. -->
				    		<?=$fnProductos -> dolaresAmericanos($producto['precio'])?>
				    	<?php endif; ?>
				    <?php endif; ?>
					</td>
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
		<tfoot>
			<tr>
				<th class="search search_txt">Clave</th>
				<th class="search search_txt">Categoría</th>
				<th class="search search_txt">Subcategoría</th>
				<th class="search search_txt">División</th>
				<th class="search search_txt">Nombre</th>
				<th class="search search_txt">Tipo</th>
				<th class="search search_txt">Marca</th>
				<th class="search search_txt">Modelo</th>
				<th class="search search_txt">Precio</th>
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
					<?php //if($nameMoneda == "pesoMx") :?>
						<button
							style='display: <?php if($nameMoneda == "pesoMx") echo 'block'; else echo 'none'  ?>;'
							title="Cambiar Precio a Dólares" id="precioDolares"><img src="../images/moneda_usa.png">
						</button>
					<?php //elseif($nameMoneda == "dolarAm") :?>
						<button
							style='display: <?php if($nameMoneda == "dolarAm") echo 'block'; else echo 'none'  ?>;'
							title="Cambiar Precio a Pesos" id="precioPesos"><img src="../images/moneda_mex.png"></button>
					<?php //endif; ?>
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