<?php include("../conexion.php") ?>
<?php 
	$query="SELECT
				C.id_cliente, 
				C.nombre_cliente,
				rfc,
				calle,
				num_ext,
				num_int,
				municipio,
				estado,
				nombre_categoria_cliente,
				D.id_direccion as dFiscal,
				C.id_direccion as dirClient,
				D.id_datfiscal,
				id_bancarios,
				C.fecha_alta
			FROM clientes C 
				INNER JOIN datos_fiscales D ON C.id_datfiscal=D.id_datfiscal
				INNER JOIN direcciones B ON C.id_direccion=B.id_direccion
				INNER JOIN categoria_cliente S ON C.id_categoria_cliente=S.id_categoria_cliente;";
	$result=mysql_query($query);
	$rows = mysql_num_rows($result);
?>
<center>
	<?php if($rows != 0) :?>
		<table class="display" id="allregistros">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Fecha<b style="color:transparent">-</b>Alta</th>
					<th>RFC</th>
					<th>Calle</th>
					<th>Estado</th>
					<th>Municipio</th>
					<th>Categoría</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php while($fila=mysql_fetch_array($result)) :?>
	  				<tr>
						<td><?=$fila["nombre_cliente"]?></td>
						<td><?=$fila["fecha_alta"]?></td>
						<td><?=$fila["rfc"]?></td>
						<td><?=$fila["calle"]." ".$fila["num_ext"]."/".$fila["num_int"]?></td>
						<td><?=$fila["estado"]?></td>
						<td><?=$fila["municipio"]?></td>
						<td><?=$fila["nombre_categoria_cliente"]?></td>
						<td><a href="detalle.php?id_clie=<?=$fila['id_cliente']?>"><img src="../images/detalle.png"><a></td>
						<td><a href="editar.php?id_clie=<?=$fila['id_cliente']?>"><img src="../images/editar.png"><a></td>
						<td>
							<a href="eliminar.php?id_clie=<?=$fila['id_cliente']?>&id_dfis=<?=$fila['dFiscal']?>&id_dcli=<?=$fila['dirClient']?>&id_datfis=<?=$fila['id_datfiscal']?>&dat_banc=<?=$fila['id_bancarios']?>">
								<img src="../images/eliminar.png">
							<a>
						</td>
				    </tr>
				<?php endwhile; ?>
			</tbody>
			<tfoot style="display:table-header-group;">
				<tr>
					<th class="search2">Nombre</th>
					<th class="search2">Fecha Alta</th>
					<th class="search2">RFC</th>
					<th class="search2">Calle</th>
					<th class="search2">Estado</th>
					<th class="search2">Municipio</th>
					<th class="search2">Categoría</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</tfoot>
		</table>
	<?php else :?>
		<div class="vacio">
			(Sin registros)
		</div>
	<?php endif; ?>
</center>
<script type="text/javascript">
	$(document).ready(function() {
		// DataTable
		$('#allregistros').dataTable({ 
	        // Damos formato a la paginación(números).
	        "sPaginationType": "full_numbers",
	        // Desactiva el filtrado de datos.
	        // bFilter: false,
	        // Ordenar de forma ascendente la columna de la posición 1.
	        aaSorting: [[0,"asc"]],
	        // Muestra el número de filas en una sola página.
	        iDisplayLength: 50,
	        /* Configura el menú que se utiliza para seleccionar 
	        	el número de filas en una sola página. */
	        aLengthMenu: [[25, 50, 100], [25, 50, 100]],
	        // Desactivar la ordenación de una columna.
	        aoColumnDefs:[{
	        	bSortable: false,
	        	// Posición de la columna.
	        	aTargets: [7,8,9],
	        }],
			// Cambiar de posición los elementos(paginado,buscar,etc.)
			"sDom" : '<"top"lp>rt<"bottom"i><"clear">'
	    })

	    .columnFilter({
	    	aoColumns: [
	    		{type:"text"},
	    		{type:"date_range"},
	    		{type:"text"},
	    		{type:"text"},	    		
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