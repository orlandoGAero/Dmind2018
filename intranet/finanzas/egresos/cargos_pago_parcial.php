<?php
	require_once '../../class/saldos.php';
	$fnSaldos = new saldos();
?>
<?php if ($cargosMenores = $fnSaldos -> obtenerCargosMenores($precioTotEgr)) : ?>
	<p class="titulo">Cargos Menores</p>
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
			<?php foreach($cargosMenores as $cargosM) :?>
				<tr>
					<td>
						<?php $fechaSaldo= $cargosM['fecha_s'] ?>
						<span style="display: none;"><?=$fechaSaldo?></span>
						<?php $fechaSaldo = date_format(date_create($fechaSaldo),'d-m-Y') ?>
						<?=$fechaSaldo?>
					</td>
					<td><?=$cargosM['descripcion_s']?></td>
					<td><b>$</b><?=number_format($cargosM['cargos_s'], 2)?></td>
					<td>
						<center>
							<form method="POST">
								<input type="hidden" name="idEgreso" readonly value="<?=$idEgreso?>">
								<input type="hidden" name="precioTotalE" readonly value="<?=$totalInicial?>">
								<input type="hidden" name="idSaldo" readonly value="<?=$cargosM['id_saldo']?>">
								<input type="hidden" name="cargoDeSaldo" readonly value="<?=$cargosM['cargos_s']?>">
								<input type="hidden" name="fecSaldo" readonly value="<?=$fechaSaldo?>">
								<input type="hidden" name="numCueB" readonly value="<?=$cargosM['num_cbancaria']?>">
								<button type="button" class="addCargoParcial" title="Agregar">
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
	<div id="agregarPagoParcial"></div>
<?php else : ?>
	<p class="mensaje">
		Sin resultados de Cargos menores.
	</p>
<?php endif;?> <!-- Fin de Cargos Menores. -->
<script type="text/javascript">
	$('.addCargoParcial').on('click', function(e) {
    	e.preventDefault();
    	$.post('agregar_pago_parcial.php', $(this.form).serialize()).
    	done(function(result){
    		$('#agregarPagoParcial').html(result);
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