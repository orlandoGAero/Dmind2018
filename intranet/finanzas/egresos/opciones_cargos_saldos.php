<?php
	require '../../class/saldos.php';
	$fnSaldos = new saldos();
?>
<!-- Verificar la existencia del Id egreso y el total del egreso -->
<?php if (isset($_REQUEST['egreso']) && isset($_REQUEST['totalEgreso'])) : ?>
	<!-- Verificar que el Id Egreso y el total del egreso no estén vacíos -->
	<?php if ($_REQUEST['egreso'] != "" && $_REQUEST['totalEgreso']) : ?>
		<!-- Verificar existencia del pago restante -->
		<?php if (isset($_REQUEST['pagoRestante'])) : ?> 
			<?php
				$precioTotEgr = $_REQUEST['pagoRestante'];
				$btnAgregarCargo = 'addCargoParcial';
				$resultadoAgregarPago = 'agregarPagoParcial';
			?>
		<?php else : ?>
			<?php
				$precioTotEgr = $_REQUEST['totalEgreso'];
				$btnAgregarCargo = 'addCargoCompleto';
				$resultadoAgregarPago = 'agregarPagoCompleto';
			?>
		<?php endif; ?> <!-- Fin de verificar existencia del pago restante -->
		<?php $idEgreso = $_REQUEST['egreso']; ?> <!-- Id de Egreso -->
		<!-- Obtener Cargos exactos según el precio total del egreso -->
		<?php if($datosCargos = $fnSaldos -> obtenerCargos($precioTotEgr)) :?>
			<p class="titulo">Cargos</p>
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
					<?php foreach($datosCargos as $dCargos) :?>
						<tr>
							<td>
								<?php $fechaSaldo= $dCargos['fecha_s'] ?>
								<span style="display: none;"><?=$fechaSaldo?></span>
								<?php $fechaSaldo = date_format(date_create($fechaSaldo),'d-m-Y') ?>
								<?=$fechaSaldo?>
							</td>
							<td><?=$dCargos['descripcion_s']?></td>
							<td><b>$</b><?=number_format($dCargos['cargos_s'], 2)?></td>
							<td>
								<center>
									<form method="POST">
										<input type="hidden" name="idEgreso" readonly value="<?=$idEgreso?>">
										<input type="hidden" name="precioTotalE" readonly value="<?=$_REQUEST['totalEgreso']?>">
										<input type="hidden" name="idSaldo" readonly value="<?=$dCargos['id_saldo']?>">
										<input type="hidden" name="cargoDeSaldo" readonly value="<?=$dCargos['cargos_s']?>">
										<input type="hidden" name="fecSaldo" readonly value="<?=$fechaSaldo?>">
										<input type="hidden" name="numCueB" readonly value="<?=$dCargos['num_cbancaria']?>">
										<button type="button" class="<?=$btnAgregarCargo?>" title="Agregar">
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
			<div id="<?=$resultadoAgregarPago?>"></div>
			<script type="text/javascript">
				// Pago Parcial de Cargo.
				$('.addCargoParcial').on('click', function(e) {
			    	e.preventDefault();
			    	$.post('agregar_pago_parcial.php', $(this.form).serialize()).
			    	done(function(result){
			    		$('#agregarPagoParcial').html(result);
			    	});	    	
			    });
			    // Pago Completo de Cargo.
			    $('.addCargoCompleto').on('click', function(e) {
			    	e.preventDefault();
			    	$.post('agregar_pago_completo.php', $(this.form).serialize()).
			    	done(function(result){
			    		$('#agregarPagoCompleto').html(result);
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
		<?php else :?>
			<p class="mensaje">
				No se encontraron Cargos que coincidieran con la cantidad total del egreso.
			</p>
			<?php if (isset($_REQUEST['pagoRestante'])) : ?>
				<?php
					$totalInicial = $_REQUEST['totalEgreso'];
					include 'cargos_pago_parcial.php';
				?>
			<?php else : ?>
				<p class="mensaje">
					¿El pago es parcial?
					Si <input type="radio" name="pagoParcial" class="parcialPago" value="Si">
					No <input type="radio" name="pagoParcial" class="parcialPago" value="No">
				</p>
				<div id="opciones-pago"></div>
			<?php endif; ?>
				<script type="text/javascript">
					$(document).ready(function() {
					    $('.parcialPago').on('click', function() {
					    	if (!this.checked) {
					    		return false;
					    	}
					    	$('#opciones-pago').html("<div align='center'><img src='../../images/loader_blue.gif'></div>");
					    	$.ajax({
					    		url: 'formas_pago.php',
					    		type: 'POST',
					    		data: {
					    				tipopago: this.value,
					    				egreso: <?=$idEgreso?>,
					    				preciototal: <?=$_REQUEST['totalEgreso']?>
					    			  }
					    	})
					    	.done(function(result){
					    		$('#opciones-pago').html(result);
					    	});
					    });
					});
				</script>
		<?php endif; ?> <!-- FIN de función 'obtenerCargos' -->
	<?php endif; ?> <!-- FIN de verificar que no estén vacíos el Id egreso y total del egreso -->
<?php else : ?>
	<div class="vacio" align="center">No se recibieron los datos.</div>
<?php endif; ?> <!-- FIN de verificar existencia de Id egreso y total egreso -->