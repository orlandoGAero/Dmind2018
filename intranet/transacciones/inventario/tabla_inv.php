<?php include ("../../conexion.php") ?>
<?php require_once("../../libs/encrypt_decrypt_strings_urls.php") ?>
<?php 
  	$query="SELECT 
			  inv.id_inventario,
			  prov.nom_proveedor,
			  nomProd.nombre,
			  prod.modelo,
			  tiProd.nombre_tipo,
			  maProd.nombre_marca,
			  inv.no_serie,
			  inv.no_factura,
			  estProd.nombre_estado,
			  staInv.nombre_status,
			  ubicInv.nombre_ubicacion,
			  inv.id_producto
			FROM
			  inventario inv
			 LEFT JOIN proveedores prov 
			  ON inv.id_proveedor = prov.id_proveedor
			 LEFT JOIN productos prod
			  ON inv.id_producto = prod.id_producto
			 INNER JOIN nombres nomProd
			  ON nomProd.id_nombre = prod.id_nombre
			 INNER JOIN tipos tiProd
			  ON tiProd.id_tipo = prod.id_tipo
			 INNER JOIN marca_productos maProd
			  ON maProd.id_marca = prod.id_marca
			 LEFT JOIN estados estProd
			  ON inv.id_estado = estProd.id_estado
			 LEFT JOIN status_inventario staInv
			  ON inv.id_status = staInv.id_status
			 LEFT JOIN ubicaciones ubicInv
			  ON inv.id_ubicacion = ubicInv.id_ubicacion
			ORDER BY inv.id_producto ASC;";
  	$result=mysql_query($query);
  	$row = mysql_num_rows($result);
?>

<?php if($row >= 1) :?>
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
		<?php while($fila=mysql_fetch_assoc($result)) :?>
		<tr>
			<td><?="00".$fila['id_inventario']?></td>
			<td><?=$fila['nom_proveedor']?></td>
			<td><?=$fila['nombre']."-".$fila['modelo']?></td>
			<td><?=$fila['nombre_tipo']?></td>
			<td><?=$fila['nombre_marca']?></td>
			<td align="center"><?=$fila['no_serie']?></td>
			<td align="center"><?=$fila['no_factura']?></td>
			<td><?=$fila['nombre_estado']?></td>
			<td><?=$fila['nombre_status']?></td>
			<td align="center"><?=$fila['nombre_ubicacion']?></td>
			<td>
				<?php $idInv = encrypt($fila['id_inventario'],"intranetdminventario") ?>
				<a href="detalle.php?product=<?=$idInv?>">
					<img src="../../images/detalle.png" title="Detalle" alt="Detalle">
				</a>
			</td>
			<td>
				<?php if($fila['nombre_status'] == "INVENTARIADO") :?>
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
		<?php endwhile; ?>
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
<?php else :?>
	<div class="vacio">
		<center>(Sin registros)</center>
	</div>
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
	});
</script>