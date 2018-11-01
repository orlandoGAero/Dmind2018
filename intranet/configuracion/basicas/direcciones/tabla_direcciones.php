<?php require_once("../../../libs/encrypt_decrypt_strings_urls.php"); ?>
<?php if($datDireccion = $fnDirecciones -> obtenerDirecciones() ) : ?>
	<table class="display" id="dir">
		<thead>	
			<tr>
				<th>ID</th>
				<th>Calle</th>
				<th>Num_Ext</th>
				<th>Num_Int</th>
				<th>Colonia</th>
				<th>Localidad</th>
				<th>Referencia</th>
				<th>Municipio</th>
				<th>Estado</th>
				<th>Pais</th>
				<th>C.P.</th>
				<th>Sucursal</th>
				<th>GPS Ubicacion</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($datDireccion as $fnDirecciones) : ?>
			<tr>
				<td class="center"><?=$fnDirecciones['id_direccion']?></td>
				<td><?=$fnDirecciones['calle']?></td>
				<td><?=$fnDirecciones['num_ext']?></td>
				<td><?=$fnDirecciones['num_int']?></td>
				<td><?=$fnDirecciones['colonia']?></td>
				<td><?=$fnDirecciones['localidad']?></td>
				<td><?=$fnDirecciones['referencia']?></td>
				<td><?=$fnDirecciones['municipio']?></td>
				<td><?=$fnDirecciones['estado']?></td>
				<td><?=$fnDirecciones['pais']?></td>
				<td><?=$fnDirecciones['cod_postal']?></td>
				<td><?=$fnDirecciones['sucursal']?></td>
				<td><?=$fnDirecciones['gps_ubicacion']?></td>
				<td width="5%">
					<!--id -->
					<?php $idDir = encrypt($fnDirecciones['id_direccion'],"direccionesDM") ?>
					<a href="actualizar_direccion.php?id_dir=<?=$idDir?>" class="EditDir"><img src="../../../images/editar.png" title="Editar"></a>
				</td>
				<td width="5%">
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
						<input type="hidden" name="txtidDir" readonly value="<?=$idDir?>" />
						<button type="button" class="deleteDir">
							<img src="../../../images/eliminar.png" title="Borrar" alt="Borrar">
						</button>
					</form>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot style="display:table-header-group;">
			<tr>
				<th class="search">Id</th>
				<th class="search">Calle</th>
				<th class="search">Num Ext</th>
				<th class="search">Num Int</th>
				<th class="search">Colonia</th>
				<th class="search">Localidad</th>
				<th class="search">Referencia</th>
				<th class="search">Municipio</th>
				<th class="search">Estado</th>
				<th class="search">Pais</th>
				<th class="search">C.P.</th>
				<th class="search">Sucursal</th>
				<th class="search">GPS Ubicación</th>
				<th></th>
				<th></th>
			</tr>
		</tfoot>
	</table>
	<br />
<?php else :?>
	<div class="vacio">
		(Sin registros)
	</div>
<?php endif; ?>
<script type="text/javascript">
	var $ = jQuery.noConflict();
	$(document).ready(function(){
		$('.deleteDir').click(function(){
			if (confirm('¿Desea eliminar la dirección?')) {
				formDel = this.form;
				$('#tb_dir').load('eliminar_direccion.php',$(formDel).serialize());
			}
		});
		$('.EditDir').fancybox({
			'autoSize':false,
			'transitionIn':'none',
			'transitionOut':'none',
			'width':362,
			'height':590,
			'type':'ajax'
		});
		// DataTable
		$('#dir').dataTable({ 
	        // Damos formato a la paginación(números).
	        "sPaginationType": "full_numbers",
	        // Desactiva el filtrado de datos.
	        // bFilter: false,
	        // Ordenar de forma ascendente la columna de la posición 1.
	        aaSorting: [[0,"asc"]],
	        // Muestra el número de filas en una sola página.
	        iDisplayLength: 25,
	        /*Configura el menú que se utiliza para seleccionar 
	        	el número de filas en una sola página. */
	        aLengthMenu: [[25, 50, 100], [25, 50, 100]],
	        // Desactivar la ordenación de una columna.
	        aoColumnDefs:[{
	        	bSortable: false,
	        	// Posición de la columna.
	        	aTargets: [13,14]
	        }],
			// Cambiar de posición los elementos(paginado,buscar,etc.)
			"sDom" : '<"top"lp>rt<"bottom"i><"clear">'
	    })

		.columnFilter({
	    	aoColumns: [
	    		{type:"number"},
	    		{type:"text"},
	    		{type:"number"},
	    		{type:"number"},
	    		{type:"text"},
	    		{type:"text"},
	    		{type:"text"},
	    		{type:"text"},
	    		{type:"text"},
	    		{type:"text"},
	    		{type:"number"},
	    		{type:"text"},
	    		{type:"text"},
	    		null,
	    		null
	    	]
	    });
	});
</script>