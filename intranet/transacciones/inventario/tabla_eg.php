	<link rel="stylesheet" type="text/css" href="../../css/busqueda.css">
<!-- DataTables -->
    <!-- CSS --><link rel="stylesheet" type="text/css" href="../../libs/dataTables/css/datatables.css">
    <!-- JS --><script type="text/javascript" src="../../libs/dataTables/js/jquery.dataTables.js" ></script>
    <!-- JS Filtrar Columnas --><script type="text/javascript" src="../../libs/dataTables/js/dataTables.columnFilter.js" ></script>
<?php
	require ('classInventario.php');
	$funInv = new Inventario();

	$egresos = $funInv->getEgInv();
	
?>
<h1>Egresos</h1><h3> (Facturas por Cargar)</h3>
<?php if($funInv->getEgInv()): ?>
<table cellspacing="0" cellpadding="2" class="display" id="egre">
	<thead>	
		<tr>
			<th>Fecha</th>
			<th>RFC Emisor</th>
			<th>Razón Social Emisor</th>
			<th>Serie</th>
			<th>No.Folio</th>
			<th>Ver</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach ($egresos as $row):
			$id_eg = $row['idegresos'];
			$rfcE = $row['rfc_emisor'];
			$nomProv = $funInv->getNombreProv($rfcE);
		?>
			<tr>
				<td><?=$row['fecha']?></td>
				<td><?=$row['rfc_emisor']?></td>
				<td><?=$row['razon_social_emisor']?></td>
				<td><?=$row['serie']?></td>
				<td><?=$row['no_folio']?></td>
				<td>
					<form>
						<input type="hidden" name="txt_ideg" id="eg" value="<?=$id_eg?>">
						<input type="hidden" name="txt_serie" value="<?=$row['serie']?>">
						<input type="hidden" name="txt_folio" value="<?=$row['no_folio']?>">
						<input type="hidden" name="txt_nomprov" value="<?=$nomProv['nom_proveedor']?>">
						<input type="hidden" name="txt_idprov" value="<?=$nomProv['id_proveedor']?>">
						<button class="cargar-conceptos centrar">
							<img src="../../images/open-eye.png"/>
						</button>
					</form>
				</td>
			</tr>
		<?php endforeach; ?>
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
<div id="contenido" class="modal-c"></div>

<?php else:?>
	<div class="vacio">
		<center>(Sin registros)</center>
	</div>
<?php endif; ?>
<script type="text/javascript">
	$(document).ready(function(){
		
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

		$(".cargar-conceptos").click(function(e){
			e.preventDefault();
			$.ajax({
				url: 'ver_conceptos.php',
				data: {
					id_egreso: e.currentTarget.form[0].value,
					serie: e.currentTarget.form[1].value,
					folio: e.currentTarget.form[2].value,
					nom_prov: e.currentTarget.form[3].value,
					id_prov: e.currentTarget.form[4].value
				},
				success: function(res) {
					let listaConceptos = $("#contenido");
					listaConceptos.append(res);
					listaConceptos.show();
					$("#cerrar-contenido").click(function(){
						listaConceptos.hide();
						$('#divTabla').hide();
						$('#fade').hide();
					});
				}
			})
		});
	});
</script>
