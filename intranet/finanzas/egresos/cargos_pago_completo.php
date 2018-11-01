<?php
	require '../../class/saldos.php';
	$fnSaldos = new saldos();
?>
<?php if ($otrosCargos = $fnSaldos -> obtenerOtrosCargos()) : ?>
	<p class="titulo">Otros Cargos</p>
	<table cellspacing="0" cellpadding="2" class="display" id="saldos">
		<thead>
			<tr>
				<th>Fecha</th>
				<th>Descripción</th>
				<th>Cargo</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($otrosCargos as $oCargos) :?>
				<tr>
					<td>
						<?php $fechaSaldo= $oCargos['fecha_s'] ?>
						<span style="display: none;"><?=$fechaSaldo?></span>
						<?php $fechaSaldo = date_format(date_create($fechaSaldo),'d-m-Y') ?>
						<?=$fechaSaldo?>
					</td>
					<td><?=$oCargos['descripcion_s']?></td>
					<td><b>$</b><?=number_format($oCargos['cargos_s'], 2)?></td>
					<td>
						<center>
							<form method="POST">
								<input type="hidden" name="idEgreso" readonly value="<?=$idEgreso?>">
								<input type="hidden" name="precioTotalE" readonly value="<?=$totalInicial?>">
								<input type="hidden" name="idSaldo" readonly value="<?=$oCargos['id_saldo']?>">
								<input type="hidden" name="cargoDeSaldo" readonly value="<?=$oCargos['cargos_s']?>">
								<input type="hidden" name="fecSaldo" readonly value="<?=$fechaSaldo?>">
								<input type="hidden" name="numCueB" readonly value="<?=$oCargos['num_cbancaria']?>">
								<input type="hidden" name="completarpago" class="terminarPago" readonly>
								<button type="button" class="addCargoCompleto" title="Agregar">
									<img src="../../images/add2.png">
								</button>
							</form>
						</center>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot style="display:table-header-group;">
			<th class="search2" title="Fecha">Fecha</th>
			<th class="search2" title="Descripción">Descripcion</th>
			<th></th>
			<th></th>
		</tfoot>
	</table>
	<div id="agregarPagoCompleto"></div>
	<div class="completarPago" title="Completar pago">
		<p class="mensaje">
			¿Con este cargo se completa el pago del egreso?
		</p>
	</div>
<?php else : ?>
	<p class="mensaje">
		Sin resultados de cargos.
	</p>
<?php endif;?>
<script type="text/javascript">
	$('.completarPago').hide();
	$('.addCargoCompleto').on('click', function(e) {
		e.preventDefault();
		var formAddCargoC = $(this.form);
		$('.completarPago').dialog({
			resizable: false,
			autoOpen: true,
			modal: true,
			width: 355,
			height: "auto",
			show: "fold",
			hide: "fade",
			buttons: {
				"Si": function() {
					$('.completarPago').dialog('close');
					$('.terminarPago').val('Si');
			    	$.post('agregar_pago_completo.php', formAddCargoC.serialize()).
			    	done(function(result){
			    		$('#agregarPagoCompleto').html(result);
			    	});	
				},
				"No": function() {
					$('.completarPago').dialog('close');
					$('.terminarPago').val('No');
					$.post('agregar_pago_completo.php', formAddCargoC.serialize()).
			    	done(function(result){
			    		$('#agregarPagoCompleto').html(result);
			    	});	
				}
			}
		});
    });
	// DataTable
	$('#saldos').dataTable({ 
        // Damos formato a la paginación(números).
        "sPaginationType": "full_numbers",
        // Ordenar de forma ascendente la columna de la posición 1.
        aaSorting: [[0,"asc"]],
        // Muestra el número de filas en una sola página.
        iDisplayLength: 10,
        /* Configura el menú que se utiliza para seleccionar 
        	el número de filas en una sola página. */
        aLengthMenu: [[5, 10, 20], [5, 10, 20]],
        // Desactivar la ordenación de una columna.
        aoColumnDefs:[{
        	bSortable: false,
        	// Posición de la columna.
        	aTargets: [3],
        }],
		// Cambiar de posición los elementos(paginado,buscar,etc.)
		"sDom" : '<"top"lp>rt<"bottom"i><"clear">'
    })
     .columnFilter({
    	aoColumns: [
    		{type:"date_range"},
    		{type:"text"},
    		null
    	]
    });
</script>