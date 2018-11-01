<!-- Tabla de Saldos -->
<div id="saldos-registrados">
	<table cellspacing="0" cellpadding="2" class="display" id="saldos">
		<!-- <thead style="display:table-row-group;"> -->
		<thead>
			<tr>
				<th>Fecha</th>
				<th>Descripción</th>
				<th>Referencia</th>
				<th>Cargos</th>
				<th>Abono</th>
				<th>Saldo</th>
				<th>Clasificación</th>
				<th>Cuenta Bancaria</th>
				<th>Estatus</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			<?php foreach($datosSaldos as $dSaldos) :?>
				<tr>
					<td>
						<?php $fechaSaldo= $dSaldos['fecha_s'] ?>
						<span style="display: none;"><?=$fechaSaldo?></span>
						<?php $fechaSaldo = date_format(date_create($fechaSaldo),'d-m-Y') ?>
						<?=$fechaSaldo?>
					</td>
					<td><?=$dSaldos['descripcion_s']?></td>
					<td><?=$dSaldos['referencia_s']?></td>
					<td><b>$</b><?=number_format($dSaldos['cargos_s'], 2)?></td>
					<td><b>$</b><?=number_format($dSaldos['abonos_s'], 2)?></td>
					<td><b>$</b><?=number_format($dSaldos['saldo'], 2)?></td>
					<td><?=$dSaldos['clasificacion_s']?></td>
					<td><?=$dSaldos['num_cbancaria']?></td>
					<td><?=$dSaldos['forma_pago']?></td>
					<!-- Id Saldo -->
						<?php $idSaldo = $dSaldos['id_saldo'] ?>
					<!-- Fin Id Saldo -->
					<td class="center">
						<?php if (($dSaldos['forma_pago'] == 'completo') || ($dSaldos['forma_pago'] == 'parcial')) : ?>
							<img src="../../images/deshabilitado-novisible.png" alt="Saldo Completado" title="Saldo Completado">
						<?php elseif($dSaldos['forma_pago'] == 'completo-parcial') : ?>
							<img src="../../images/deshabilitado-visible.png" alt="Saldo Visible" title="Saldo Visible">
						<?php else : ?>
							<?php if ($dSaldos['agregado'] == 'No') : ?>
								<form method="POST" enctype="application/x-www-form-urlencoded" target="_self">
									<input type="hidden" name="saldo" readonly value="<?=$idSaldo?>" />
									<button type="button" class="desactivarsaldo" alt="Desactivar Saldo" title="Saldo Activo">
										<img src="../../images/visible.png">
									</button>
								</form>
							<?php elseif ($dSaldos['agregado'] == 'Si') : ?>
								<form method="POST" enctype="application/x-www-form-urlencoded" target="_self">
									<input type="hidden" name="saldo" readonly value="<?=$idSaldo?>" />
									<button type="button" class="activarsaldo" alt="Activar Saldo" title="Saldo Inactivo">
										<img src="../../images/desactivado.png">
									</button>
								</form>
							<?php endif ?>
						<?php endif; ?>
					</td>
					<td>
						<a href="detalle_saldo.php?saldo=<?=$idSaldo?>"><img src="../../images/detalle.png" title="Ver"></a>
					</td>
					<td>
						<?php if ($dSaldos['forma_pago'] == '') : ?>
							<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
								<input type="hidden" name="saldo" readonly value="<?=$idSaldo?>" />
								<button type="button" class="deletesaldo" title="Borrar">
									<img src="../../images/eliminar.png">
								</button>
							</form>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>

		<tfoot style="display:table-header-group;">
			<!-- <tr class="texto"><td colspan="17">Buscar por:</td></tr> -->
			<tr>
				<th class="search" title="Fecha">Fecha</th>
				<th class="search2" title="Descripción">Descripción</th>
				<th class="search2" title="Referencia">Referencia</th>
				<th></th>
				<th></th>
				<th></th>
				<th class="search2" title="Clasificación">Clasificación</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</tfoot>
	</table>
</div>
<script type="text/javascript">
	var $ = jQuery.noConflict();
	
	$(document).ready(function() {
		// Borrar Saldo.
		$('.deletesaldo').click(function(){
			if (confirm('¿Quieres eliminar el saldo?')) {
				formDelS = this.form;
				$.post('eliminar_saldo.php', $(formDelS).serialize())
				.done(function(data) {
					$('#lista-saldos').html(data);
				});
			}
		});
		// Deactivar Saldo.
		$('.desactivarsaldo').click(function(){
			if (confirm('¿Quieres desactivar el saldo?')) {
				formDesS = this.form;
				$.post('desactivar_saldo.php', $(formDesS).serialize())
				.done(function(data) {
					$('#saldos-registrados').html(data);
				});
			}
		});
		// Activar Saldo.
		$('.activarsaldo').click(function(){
			if (confirm('¿Quieres activar el saldo?')) {
				formActS = this.form;
				$.post('activar_saldo.php', $(formActS).serialize())
				.done(function(data) {
					$('#saldos-registrados').html(data);
				});
			}
		});
		// DataTable
		$('#saldos').dataTable({ 
	        // Damos formato a la paginación(números).
	        "sPaginationType": "full_numbers",
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
	        	aTargets: [9, 10, 11],
	        }],
			// Cambiar de posición los elementos(paginado,buscar,etc.)
			"sDom" : '<"top"lp>rt<"bottom"i><"clear">'
	    })
	    .columnFilter({
	    	aoColumns: [
	    		{type:"date_range"},
	    		{type:"text"},
	    		{type:"text"},
	    		null,
	    		null,
	    		null,
	    		{type:"text"},
	    		null,
	    		// null,
	    		null
	    	]
	    });

	});
</script>