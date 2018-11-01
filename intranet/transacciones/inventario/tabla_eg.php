	<link rel="stylesheet" type="text/css" href="../../css/busqueda.css">
<!-- DataTables -->
    <!-- CSS --><link rel="stylesheet" type="text/css" href="../../libs/dataTables/css/datatables.css">
    <!-- JS --><script type="text/javascript" src="../../libs/dataTables/js/jquery.dataTables.js" ></script>
    <!-- JS Filtrar Columnas --><script type="text/javascript" src="../../libs/dataTables/js/dataTables.columnFilter.js" ></script>
<?php  include ("../../conexion.php");?>
<?php 
	$sql = "SELECT fecha,rfc_emisor,razon_social_emisor,serie,no_folio
FROM egresos";
	$ejecutar = mysql_query($sql) or die(mysql_error());
	$filas = mysql_num_rows($ejecutar);
?>
<h1>Egresos</h1>
<?php if($filas >= 1): ?>
<table cellspacing="0" cellpadding="2" class="display" id="egre">
	<thead>	
		<tr>
			<th>Fecha</th>
			<th>RFC Emisor</th>
			<th>Razón Social Emisor</th>
			<th>Serie</th>
			<th>No.Folio</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php while($row=mysql_fetch_assoc($ejecutar)):?>
			<tr>
				<td><?=$row['fecha']?></td>
				<td><?=$row['rfc_emisor']?></td>
				<td><?=$row['razon_social_emisor']?></td>
				<td><?=$row['serie']?></td>
				<td><?=$row['no_folio']?></td>
				<td>
					<form>
						<input type="hidden" name="txt_serie" value="<?=$row['serie']?>">
						<input type="hidden" name="txt_folio" value="<?=$row['no_folio']?>">
						<button type="submit" class="btn-form"><img src="../../images/add2.png" alt="Obtener Datos" title="Obtener Datos"></button>
					</form>
				</td>
			</tr>
		<?php endwhile; ?>
	</tbody>
	<tfoot style="display:table-header-group;">
			<tr>
				<th class="search">Fecha</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
	</tfoot>
</table>
<?php else:?>
	<div class="vacio">
		<center>(Sin registros)</center>
	</div>
<?php endif; ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.btn-form').bind('click',function(add){
			add.preventDefault();
			formCargar = this.form;
			$('#cargar').load('cargar_val.php',$(formCargar).serialize());
			$('#divTabla').hide();
			$('#fade').hide();
			return false;
		});

		// DataTable
		jQuery('#egre').dataTable({ 
	        // Damos formato a la paginación(números).
	        "sPaginationType": "full_numbers",
	        // Desactiva el filtrado de datos.
	        // bFilter: false,
	        // Ordenar de forma ascendente la columna de la posición 1.
	        aaSorting: [[0,"asc"]],
	        // Muestra el número de filas en una sola página.
	        iDisplayLength: 5,
	        /* Configura el menú que se utiliza para seleccionar 
	        	el número de filas en una sola página. */
	        aLengthMenu: [[5, 10, 20], [5, 10, 20]],
	        // Desactivar la ordenación de una columna.
	        aoColumnDefs:[{
	        	bSortable: false,
	        	// Posición de la columna.
	        	aTargets: [5],
	        }],
			// Cambiar de posición los elementos(paginado,buscar,etc.)
			"sDom" : '<"top"lp>rt<"bottom"i><"clear">'
	    })

	    .columnFilter({
	    	aoColumns: [
	    		{type:"date_range"},
	    		null,
	    		null,
	    		null,
	    		null,
	    		null
	    	]
	    });
	});
</script>
