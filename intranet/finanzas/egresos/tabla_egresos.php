<!-- Tabla de egresos -->
<center>
	<table cellspacing="0" cellpadding="2" class="display" id="egresos">
		<!-- <thead style="display:table-row-group;"> -->
		<thead>
			<tr>
				<th>Fecha</th>
				<th>RFC Emisor</th>
				<th>Razón Social Emisor</th>
				<th># Serie</th>
				<th># Folio</th>
				<th>Subtotal</th>
				<th>IVA</th>
				<th>Total</th>
				<th>Método de Pago</th>
				<th>Fecha de Pago</th>
				<th># Cuenta</th>
				<th>Concepto</th>
				<th>Clasificación</th>
				<th>Status</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach($datosEgresos as $egresos) :?>
				<tr>
					<td>
						<?php $FechaEgresos= $egresos['fecha'] ?>
						<span style="display: none;"><?=$FechaEgresos?></span>
						<?php $FechaEgresos = date_format(date_create($FechaEgresos),'d/m/Y H:i:s') ?>
						<?=$FechaEgresos?>
					</td>
					<td><?=$egresos['rfc_emisor']?></td>
					<td><?=$egresos['razon_social_emisor']?></td>
					<td><?=$egresos['serie']?></td>
					<td><?=$egresos['no_folio']?></td>
					<td><b>$</b><?=number_format($egresos['subtotal'], 2)?></td>
					<td><b>$</b><?=number_format($egresos['iva'], 2)?></td>
					<td><b>$</b><?=number_format($egresos['total'], 2)?></td>
					<td><?=$egresos['metodo_pago']?></td>
					<td>
						<?php $fechaPagoEgreso = $egresos['fecha_pago'] ?>
						<?php if($fechaPagoEgreso != NULL) :?>
							<?php $fechaPagoEgreso = date_format(date_create($fechaPagoEgreso),'d/m/Y') ?>
							<?=$fechaPagoEgreso?>
						<?php endif; ?>
					</td>
					<td><?=$egresos['no_cuenta']?></td>
					<td><?=$egresos['concepto']?></td>
					<td><?=$egresos['clasificacion']?></td>
					<td><?=$egresos['estado']?></td>
					<td class="center">
						<!-- id egresos -->
						<?php $idEgreso = $egresos['idegresos'] ?>
						<a href="detalle_egresos.php?egreso=<?=$idEgreso?>"><img src="../../images/detalle.png" title="Ver"></a>
						<a href="modificar_egresos.php?idEg=<?=$idEgreso?>"><img src="../../images/editar.png" title="Editar"></a>
						<center>
							<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
								<input type="hidden" name="idEg" readonly value="<?=$idEgreso?>" />
								<button type="button" class="deletegreso" title="Borrar">
									<img src="../../images/eliminar.png">
								</button>
							</form>
						</center>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>

		<tfoot style="display:table-header-group;">
			<!-- <tr class="texto"><td colspan="17">Buscar por:</td></tr> -->
			<tr>
				<th class="search" title="Fecha">Fecha</th>
				<th></th>
				<th class="search2" title="Nombre Emisor">Nombre Emisor</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th class="search" title="Total">Total</th>
				<th class="search2" title="Método de Pago">Método Pago</th>
				<th class="search2" title="Fecha y Hora de Pago">Fecha/Hr Pago</th>
				<th class="search" title="Número de Cuenta"># Cuenta</th>
				<th class="search" title="Concepto">Concepto</th>
				<th class="search2" title="Clasificación">Clasificación</th>
				<th class="search" title="Status">Status</th>
				<th></th>
			</tr>
		</tfoot>
	</table>
</center>

<script type="text/javascript">
	var egresos = jQuery.noConflict();
	
	egresos(document).ready(function() {
		egresos('.deletegreso').click(function(){
			if (confirm('¿Desea eliminar el registro?')) {
				formDelE = this.form;
				egresos('#lista_egresos').load('eliminar_egresos.php',egresos(formDelE).serialize());
			}
		});

		// DataTable
		egresos('#egresos').dataTable({ 
	        // Damos formato a la paginación(números).
	        "sPaginationType": "full_numbers",
	        // Desactiva el filtrado de datos.
	        // bFilter: false,
	        // Ordenar de forma ascendente la columna de la posición 1.
	        aaSorting: [[0,"asc"]],
	        // Muestra el número de filas en una sola página.
	        iDisplayLength: 25,
	        /* Configura el menú que se utiliza para seleccionar 
	        	el número de filas en una sola página. */
	        aLengthMenu: [[25, 50, 100], [25, 50, 100]],
	        // Desactivar la ordenación de una columna.
	        aoColumnDefs:[{
	        	bSortable: false,
	        	// Posición de la columna.
	        	aTargets: [14],
	        }],
			// Cambiar de posición los elementos(paginado,buscar,etc.)
			"sDom" : '<"top"lp>rt<"bottom"i><"clear">'
	    })
	    .columnFilter({
	    	aoColumns: [
	    		{type:"date_range"},
	    		null,
	    		{type:"text"},
	    		null,
	    		null,
	    		null,
	    		null,
	    		{type:"text"},
	    		{type:"text"},
	    		{type:"date_range"},
	    		{type:"number"},
	    		{type:"text"},
	    		{type:"text"},
	    		{type:"text"},
	    		null
	    	]
	    });

	});
</script>