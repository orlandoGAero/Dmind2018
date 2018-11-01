<?php
	require('../../conexion.php');
	require('funciones_ventas.php');

	$funcVentas = new funciones_ventas();
?>
<script type="text/javascript" src="../../js/filtrar_listas_prod_inv.js"></script>
<h3>AGREGAR PRODUCTO</h3>
	<form action="" method="POST" class="ventasform" id="formAddProd" target="_self">
		<ul>
			<li>
				<?php $idVenta = $funcVentas -> numeroVenta() ?>
				<input type="hidden" name="txtNumVenta1" value="<?=$idVenta?>" readonly>
			</li>
			<li>
				<label> Categoría:</label>
				<?php $Categorias = $funcVentas -> obtenerCategorias() ?>
				<select id="categoria" required>
					<option value="" selected>Elige</option>
					<?php foreach($Categorias as $categoria) :?>
						<option value="<?=$categoria['id_categoria']?>"><?=$categoria['nombre_categoria']?></option>
					<?php endforeach; ?>
				</select>
			</li>
			<li>
				<label> Subcategoria:</label>
				<select id="subcategoria" required>
					<option value="">Elige</option>
				</select>
			</li>
			<li>
				<label>División:</label>
			    <select id="divisiones" required>
			      <option value="">Elige</option>
			    </select>
			</li>
			<li>
				<label>Nombre:</label>
				<select id="nombres" name="nombre" required>
					<option value="">Elige</option>
				</select>
			</li>
			<li>
				<label>Tipo:</label>
				<select id="tipos" required>
					<option value="">Elige</option>
				</select>
			</li>
			<li>
				<label>Marca:</label>
			  	<select id="marcas" name="marca" required>
			  		<option value="">Elige</option>
			  	</select>
			</li>

			<li>
				<label>Modelo:</label>
			  	<select id="modelos" name="sltModeloProd" required>
			  		<option value="">Elige</option>
			  	</select>
			</li>
			<li>
				<label>No. Serie:</label>
				<select id="series" name="sltNumSerie" required>
					<option value="">Elige</option>
				</select>
			</li>
			<li>
				<div id="precio">
					<label>Precio: </label>
					<input type="text" name="txtPrice" readonly>
				</div>
			</li>
			<li>
				<label>Nota o Descripción:</label>
			</li>
			<li>
				<textarea name="txtNotaDescrip" id="descripcion" cols="90" rows="4" style="resize:none;"></textarea>
			</li>
			<li>
				<center>
					<button type="submit" class="btn primary" id="addProduct" disabled>Agregar</button>
					<button type="button" id="btn_reset" class="btnReset btn">Limpiar</button>
				</center>
			</li>
		</ul>
	</form>
	<script type="text/javascript">
		$(document).ready(function() {
			// Agregar Producto a la Venta.
			$("#formAddProd").on("submit", function(ap) {
				// Agrega los Productos
				ap.preventDefault();
				var mandarIva = $("#iva").val();
				$("#tablaProductos").load('agregar_productos.php?iva='+mandarIva+'&'+$("#formAddProd").serialize());
				if($("#nombreCliente").val() != 0){
					$("#btnVender").removeAttr('disabled');
					$("#btnImprimir").removeAttr('disabled');
				}
				// Llamando otra Función.
				actualizaNumSeries();
			});
			//Limpiar valores de Agregar Producto
			$(".btnReset").on("click", function() {
				$("#izquierdo").load('reset_add_product.php');
			});
		});
	</script>