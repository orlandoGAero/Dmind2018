<?php 
	require_once("../../libs/encrypt_decrypt_strings_urls.php");
	include_once ('classInventario.php');
	$funInv = new Inventario(); 
	// print_r($_REQUEST);
	if (isset($_REQUEST['txt_provInv']) 
		|| isset($_REQUEST['txt_prodInv']) 
		|| isset($_REQUEST['txt_tipoInv'])
		|| isset($_REQUEST['txt_marInv'])
		|| isset($_REQUEST['txt_noSeInv'])
		|| isset($_REQUEST['txt_facInv'])
		|| isset($_REQUEST['txt_estInv'])
		|| isset($_REQUEST['txt_staInv'])
		|| isset($_REQUEST['txt_ubiInv']) )  {
		
		$provIn  = $_REQUEST['txt_provInv'];
		$prodIn  = $_REQUEST['txt_prodInv'];
		$tipoIn  = $_REQUEST['txt_tipoInv'];
		$marIn   = $_REQUEST['txt_marInv'];
		$noSeIn  = $_REQUEST['txt_noSeInv'];
		$facIn   = $_REQUEST['txt_facInv'];
		$estIn   = $_REQUEST['txt_estInv'];
		$staIn   = $_REQUEST['txt_staInv'];
		$ubiIn   = $_REQUEST['txt_ubiInv'];
	}

	if ( $provIn !== "" || $prodIn !== "" || $tipoIn !== "" || $marIn !== "" || $noSeIn !== "" || $facIn !== "" || $estIn !== "" || $staIn !== "" || $ubiIn !== "" ) :

		$resultadoBusq = $funInv->buscarInv($provIn, $prodIn, $tipoIn, $marIn, $noSeIn, $facIn, $estIn, $staIn, $ubiIn);
		// print_r($resultadoBusq);
 ?>
	<center>
		<?php if(count($resultadoBusq) >= 1): ?>
			<table class="display" id="inv">
				<thead>
					<tr>
						<th>ID</th>
						<th>PROVEEDOR</th>
						<th>PRODUCTO</th>
						<th>TIPO</th>
						<th>MARCA</th>
						<th>NO_SERIE</th>
						<th>FACTURA / COMPRA</th>
						<th>ESTADO</th>
						<th>STATUS</th>
						<th>UBICACIÓN</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				
				<tbody>
					<?php foreach ($resultadoBusq as $resultInv) :?>
					<tr>
						<td><?="00".$resultInv['id_inventario']?></td>
						<td><?=$resultInv['nom_proveedor']?></td>
						<td><?=$resultInv['nombre']."-".$resultInv['modelo']?></td>
						<td><?=$resultInv['nombre_tipo']?></td>
						<td><?=$resultInv['nombre_marca']?></td>
						<td align="center"><?=$resultInv['no_serie']?></td>
						<td align="center"><?=$resultInv['no_factura']?></td>
						<td><?=$resultInv['nombre_estado']?></td>
						<td><?=$resultInv['nombre_status']?></td>
						<td align="center"><?=$resultInv['nombre_ubicacion']?></td>
						<td>
							<?php $idInv = encrypt($resultInv['id_inventario'],"intranetdminventario") ?>
							<a href="detalle.php?product=<?=$idInv?>">
								<img src="../../images/detalle.png" title="Detalle" alt="Detalle">
							</a>
						</td>
						<td>
							<?php if($resultInv['nombre_status'] == "INVENTARIADO") :?>
								<a href="editar.php?product=<?=$idInv?>">
									<img src="../../images/editar.png" title="Editar" alt="Editar">
								</a>
							<?php endif; ?>
						</td>
						<td>
							<a href="clonar.php?product=<?=$idInv?>">
								<img width="20" height="20" src="../../images/copy2.png" title="Clonar" alt="Clonar">
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
				
				<tfoot style="display:table-header-group;">
					<tr>
						<th class="search">Clave</th>
						<th class="search">Proveedor</th>
						<th class="search">Producto</th>
						<th class="search">Tipo</th>
						<th class="search">Marca</th>
						<th class="search">No_Serie</th>
						<th class="search">Factura</th>
						<th class="search">Estado</th>
						<th class="search">Status</th>
						<th class="search">Ubicación</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</tfoot>
			</table>
		<?php else: ?>
			<div class="vacio">
				(No se encontraron resultados)
			</div>
 		<?php endif; ?>
	</center>
<?php else: ?>
	<div class='caption'>
		<h3 style='top: 65%;'>Se requiere por lo menos un criterio para realizar la búsqueda</h3>
	</div>
 <?php endif; ?>

 <script type="text/javascript">
	var a = jQuery.noConflict();
	a(document).ready(function(){
		// DataTable
		a('#inv').dataTable({ 
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
	        	aTargets: [10, 11, 12]
	        }],
			// Cambiar de posición los elementos(paginado,buscar,etc.)
			"sDom" : '<"top"lp>rt<"bottom"i><"clear">'
	    })

		.columnFilter({
	    	aoColumns: [
	    		{type:"number"},
	    		{type:"text"},
	    		{type:"text"},
	    		{type:"text"},
	    		{type:"text"},
	    		{type:"text"},
	    		{type:"number"},
	    		{type:"text"},
	    		{type:"text"},
	    		{type:"text"},
	    		null,
	    		null,
	    		null
	    	]
	    });
	});
</script>