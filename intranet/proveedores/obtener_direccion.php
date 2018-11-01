<?php
	require '../class/codigos_postales.php';
	$fnCodPostal = new codigos_postales();
?>
<?php if ($_REQUEST['txtCodP']) : ?>
	<?php if($datosDireccion = $fnCodPostal -> obtenerDireccion($_REQUEST['txtCodP'])) :?>
		<table cellspacing="0" cellpadding="2" class="display" id="direcciones">
			<!-- <thead style="display:table-row-group;"> -->
			<thead>
				<tr>
					<th>Código Postal</th>
					<th>Localidad</th>
					<th>Municipio</th>
					<th>Estado</th>
					<th></th>
				</tr>
			</thead>

			<tbody>
				<?php foreach($datosDireccion as $dDireccion) :?>
					<tr>
						<td><?=$dDireccion['codigo_pos']?></td>
						<td><?=$dDireccion['localidad']?></td>
						<td><?=$dDireccion['municipio']?></td>
						<td><?=$dDireccion['estado']?></td> 
						<td>
							<center>
								<form id="formAddDir" method="POST">
									<input type="hidden" name="codigoP" value="<?=$dDireccion['codigo_pos']?>" readonly>
									<input type="hidden" name="nomLocalidad" value="<?=$dDireccion['localidad']?>" readonly>
									<input type="hidden" name="nomMunicipio" value="<?=$dDireccion['municipio']?>" readonly>
									<input type="hidden" name="nomEstado" value="<?=$dDireccion['estado']?>" readonly>
									<button type="button" class="AddDir" title="Agregar Dirección">
										<img src="../images/add2.png">
									</button>
								</form>
							</center>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<div id="direccionAgregada"></div>
	<?php else :?>
		<div class="vacio">
			<center>(Sin resultados)</center>
		</div>
	<?php endif; ?>
<?php endif; ?>
<script type="text/javascript">
	var $ = jQuery.noConflict();
	$(document).ready(function() {
		// DataTable
		$('#direcciones').dataTable({ 
	        // Damos formato a la paginación(números).
	        "sPaginationType": "full_numbers",
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
	        	aTargets: [4],
	        }],
			// Cambiar de posición los elementos(paginado,buscar,etc.)
			"sDom" : '<"top"lp>rt<"bottom"i><"clear">'
	    });
	    $('.AddDir').click(function() {
	    	$.post('agregar_direccion.php', $(this.form).serialize()).
	    	done(function(result){
	    		$('#direccionAgregada').html(result);
	    	});	    	
	    });
	});
</script>