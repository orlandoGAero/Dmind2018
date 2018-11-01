<?php
	require 'classProveedores.php';
	$fnProveedores = new Proveedores();
?>
<center><h1>Agregar Datos Proveedor</h1></center>
<?php if($datosProvEgresos = $fnProveedores -> obtenerProvEgresos()) :?>
	<table class="display" id="egresos">
		<thead>
			<tr>
				<th>Fecha</th>
				<th>RFC Emisor</th>
				<th>Razón Social Emisor</th>
				<th># Serie</th>
				<th># Folio</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($datosProvEgresos as $provEgresos) :?>
				<tr>
					<td>
						<?php $FechaEgresos= $provEgresos['fecha'] ?>
						<?php $FechaEgresos = date_format(date_create($FechaEgresos),'d/m/Y H:i:s') ?>
						<?=$FechaEgresos?>
					</td>
					<td><?=$provEgresos['rfc_emisor']?></td>
					<td><?=$provEgresos['razon_social_emisor']?></td>
					<td><?=$provEgresos['serie']?></td>
					<td><?=$provEgresos['no_folio']?></td>
					<td>
						<form method="POST" id="formProvE">
							<input type="hidden" name="txtIdProvEgre" readonly value="<?=$provEgresos['idegresos']?>">
							<button type="button" class="addProvEgresos"><img src="../images/add2.png" alt="Obtener Datos" title="Obtener Datos"></button>
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php else :?>
	<div class="vacio">
		<center>(Sin registros)</center>
	</div>
<?php endif; ?>
<script type="text/javascript">
	var $ = jQuery.noConflict();
	$(document).ready(function() {
		// DataTable
		$('#egresos').dataTable({ 
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

	    $('.addProvEgresos').click(function() {
	    	formProvE = this.form;
			$("#loadDatProvEgr").load('obtener_datos_proveedorE.php',$(formProvE).serialize());
	    	$('#pop-up').css('display', 'none');
	    	$('#fade').css('display', 'none');
	    });
	});
</script>
