<?php
	require_once("../../libs/encrypt_decrypt_strings_urls.php");
	$nombre = $_GET['n'];
	$modelo = $_GET['m'];
?>
<a href="#"><div class="nommod"><?=$nombre."-".$modelo;?></div></a>

<?php if($datosFInv = $funInv -> obtenerDatosFiltrar($nombre, $modelo) ): ?>
<table class="display" id="inv">
	<thead>
		<tr>
			<th>ID</th>
			<th>PROVEEDOR</th>
			<th>PRODUCTO</th>
			<th>TIPO</th>
			<th>MARCA</th>
			<th>NO_SERIE</th>
			<th>FACTURA / COMPRA</th>
			<th>ESTADO</th>
			<th>STATUS</th>
			<th>UBICACIÓN</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($datosFInv as $funInv): ?>
		<tr>
			<td><?=$funInv['id_inventario']?></td>
			<td><?=$funInv['nom_proveedor']?></td>
			<td><?=$funInv['nombre']."-".$funInv['modelo']?></td>
			<td><?=$funInv['nombre_tipo']?></td>
			<td><?=$funInv['nombre_marca']?></td>
			<td><?=$funInv['no_serie']?></td>
			<td><?=$funInv['no_factura']?></td>
			<td><?=$funInv['nombre_estado']?></td>
			<td><?=$funInv['nombre_status']?></td>
			<td><?=$funInv['nombre_ubicacion']?></td>
			<td>
				<?php $idInv = encrypt($funInv['id_inventario'],"intranetdminventario") ?>
				<a href="detalle.php?product=<?=$idInv?>">
					<img src="../../images/detalle.png" title="Detalle" alt="Detalle">
				</a>
			</td>
			<td>
				<?php if($funInv['nombre_status'] == "INVENTARIADO") :?>
					<a href="editar.php?product=<?=$idInv?>">
						<img src="../../images/editar.png" title="Editar" alt="Editar">
					</a>
				<?php endif; ?>
			</td>
			<td>
				<a href="clonar.php?product=<?=$idInv?>">
					<img width="20" height="20" src="../../images/copy2.png" title="Clonar" alt="Clonar">
				</a>
			</td>
		</tr>
	<?php endforeach;?>	
	</tbody>
	<tfoot style="display:table-header-group;">
		<tr>
			<th class="search">Clave</th>
			<th class="search">Proveedor</th>
			<th class="search">Producto</th>
			<th class="search">Tipo</th>
			<th class="search">Marca</th>
			<th class="search">No_Serie</th>
			<th class="search">Factura</th>
			<th class="search">Estado</th>
			<th class="search">Status</th>
			<th class="search">Ubicación</th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</tfoot>
</table>
<?php endif; ?>

<script type="text/javascript">
	var a = jQuery.noConflict();
	a(document).ready(function(){
		// DataTable
		a('#inv').dataTable({ 
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
	    		{type:"number"},
	    		{type:"text"},
	    		{type:"text"},
	    		{type:"text"},
	    		null,
	    		null,
	    		null
	    	]
	    });
	
	    a('.nommod').click(function(e){
			e.preventDefault();
			a('#tb_inv').load('tabla_inv.php');
		});
	});
</script>