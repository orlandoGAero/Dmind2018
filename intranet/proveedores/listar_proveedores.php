<?php 
	require_once 'classProveedores.php';
	$fnProv = new Proveedores();
?>
<?php if($datosProv = $fnProv -> listarProveedores()) :?>
	<table cellspacing="0" cellpadding="2" class="display" id="proveedores">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>RFC</th>
				<th>Email</th>
				<th>Calle</th>
				<th>Municipio</th>
				<th>Estado</th>
				<th>Teléfono</th>
				<th>Categoría</th>
				<th>Dirección Web</th>
				<th>Fecha Registro</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($datosProv as $proveedor) :?>
				<tr>
					<td align="center"><?=$proveedor['id_proveedor']?></td>
					<td align="center"><?=$proveedor['nom_proveedor']?></td>
					<td align="center"><?=$proveedor['rfc_prov']?></td>
					<td align="center"><?=$proveedor['email_proveedor']?></td>
					<td>
						<?php if($proveedor['num_int_p'] != "") : ?>
							<?php $numExterior = "/".$proveedor['num_int_p']; ?>
						<?php else : ?>
							<?php $numExterior = ""; ?>
						<?php endif; ?>
						<?=$proveedor['calle_p']." ".$proveedor['num_ext_p'].$numExterior?>
						
					</td>
					<td align="center"><?=$proveedor['municipio_p']?></td>
					<td align="center"><?=$proveedor['estado_p']?></td>
					<td align="center"><?=$proveedor['tel_proveedor']?></td>
					<td align="center"><?=$proveedor['nombre_cat_prov']?></td>
					<td align="center"><?=$proveedor['url_proveedor']?></td>
					<td><?=$proveedor['fecha_registro']?></td>
					<td>
						<a href="detalle_proveedor.php?proveedor=<?=$proveedor['id_proveedor']?>">
							<img src="../images/detalle.png" alt="Detalle" title="Detalle">
						</a>
					</td>
					<td>
						<a href="modificar_proveedor.php?proveedor=<?=$proveedor['id_proveedor']?>" class="editProv">
							<img src="../images/editar.png" alt="Editar" title="Editar">
						</a>
					</td>
					<td>
						<form method="POST" enctype="application/x-www-form-urlencoded" target="_self">
							<input type="hidden" name="idproveedor" readonly value="<?=$proveedor['id_proveedor']?>" />
							<button type="button" class="deleteProv" title="Borrar">
								<img src="../images/eliminar.png">
							</button>
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php else :?>
	<div class="vacio">
		(Sin registros)
	</div>
<?php endif; ?>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../libs/dataTables/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="../libs/dataTables/js/dataTables.columnFilter.js"></script>
<script type="text/javascript" src="../libs/fancyBox/source/jquery.fancybox.js"></script>
<!-- Jquery UI -->
<script type="text/javascript" src="../libs/jQueryUI/js/jquery-ui.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		// DataTable
		$('#proveedores').dataTable({ 
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
	        	aTargets: [11, 12, 13],
	        }],
			// Cambiar de posición los elementos(paginado,buscar,etc.)
			"sDom" : '<"top"lp>rt<"bottom"i><"clear">'
	    });
	    // Eliminar Proveedor
		$('.deleteProv').click(function(){
			if (confirm('¿Desea eliminar el proveedor?')) {
				formDelP = this.form;
				$("#lista-proveedores").html("<center><div><img src='../images/loader_blue.gif'></div></center>");
				$.post('eliminar_proveedor.php', $(formDelP).serialize())
				.done(function(data) {
					$("#lista-proveedores").html(data);
				});
			}
		});
		// FancyBox (Ventana Flotante)
		$('.editProv').fancybox({
			'scrolling':'auto',
			'autoSize':false,
			'transitionIn':'none',
			'transitionOut':'none',
			'width':700,
			'height':600,
			'type':'ajax'
		});
	});
</script>