<?php 
	include_once ('../../class/ingresos.php');
	$classIngresos = new Ingresos();

	if (isset($_REQUEST)) {

		$fechaEg = $_REQUEST['txt_fechaEg'];
	    $rfcEg = $_REQUEST['txt_rfcEg'];
	    $razonEg = $_REQUEST['txt_raSoEg'];
	    $serieEg = $_REQUEST['txt_serieEg'];
	    $folioEg = $_REQUEST['txt_folioEg'];
	    $subToEg = $_REQUEST['txt_subEg'];
	    $ivaEg = $_REQUEST['txt_ivaEg'];
	    $totalEg = $_REQUEST['txt_totalEg'];
	    $metPaEg = $_REQUEST['txt_metPaEg'];
	    $fePaEg = $_REQUEST['txt_fePaEg'];
	    $ctaEg = $_REQUEST['txt_cuentaEg'];
	    $concEg = $_REQUEST['txt_concepEg'];
	    $clasEg = $_REQUEST['txt_clasifEg'];
	    $statEg = $_REQUEST['txt_statusEg'];

	    // comprobar si hay criterios de busqueda
	    if ($fechaEg !== "" || $rfcEg !== "" || $razonEg !== "" || $serieEg !== "" || $folioEg !== "" || $subToEg !== "" || $ivaEg !== "" || $totalEg !== "" || $metPaEg !== "" || $fePaEg !== "" || $ctaEg !== "" || $concEg !== "" || $clasEg !== "" || $statEg !== "") :

	    	$resultadoBus = $classIngresos->buscarIng($fechaEg, $rfcEg, $razonEg, $serieEg, $folioEg, $subToEg, $ivaEg, $totalEg, $metPaEg, $fePaEg, $ctaEg, $concEg, $clasEg, $statEg); ?>
	    	<center>

	    	<?php if(count($resultadoBus) >= 1) : ?>
    		<table cellspacing="0" cellpadding="2" class="display" id="ingresos">
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
						<th>Fecha/Hora de Pago</th>
						<th># Cuenta</th>
						<th>Concepto</th>
						<th>Clasificación</th>
						<th>Status</th>
						<th>&nbsp;</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach($resultadoBus as $ingresos) :?>
						<tr>
							<td>
								<?php $FechaIngresos= $ingresos['fecha'] ?>
								<span style="display: none;"><?=$FechaIngresos?></span>
								<?php $FechaIngresos = date_format(date_create($FechaIngresos),'d/m/Y H:i:s') ?>
								<?=$FechaIngresos?>
							</td>
							<td><?=$ingresos['rfc_emisor']?></td>
							<td><?=$ingresos['razon_social_emisor']?></td>
							<td><?=$ingresos['serie']?></td>
							<td><?=$ingresos['no_folio']?></td>
							<td><b>$</b><?=$ingresos['subtotal']?></td>
							<td><b>$</b><?=$ingresos['iva']?></td>
							<td><b>$</b><?=$ingresos['total']?></td>
							<td><?=$ingresos['metodo_pago']?></td>
							<td>
								<?php $FechaHoraIngreso = $ingresos['fecha_hora_pago'] ?>
								<?php if($FechaHoraIngreso != NULL) :?>
									<?php $FechaHoraIngreso = date_format(date_create($FechaHoraIngreso),'d/m/Y H:i:s') ?>
									<?=$FechaHoraIngreso?>
								<?php endif; ?>
							</td>
							<td><?=$ingresos['no_cuenta']?></td>
							<td><?=$ingresos['concepto']?></td>
							<td><?=$ingresos['clasificacion']?></td>
							<td><?=$ingresos['estado']?></td>
							<td class="center">
								<!-- id ingresos -->
								<?php $idIngreso = $ingresos['id_ingresos'] ?>
								<a href="detalle_ingresos.php?ingreso=<?=$idIngreso?>"><img src="../../images/detalle.png" title="Ver"></a>
								<a href="modificar_ingresos.php?ingreso=<?=$idIngreso?>"><img src="../../images/editar.png" title="Editar"></a>
								<center>
									<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
										<input type="hidden" name="ingreso" readonly value="<?=$idIngreso?>" />
										<button type="button" class="deleteIngreso" title="Borrar">
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
	    	<?php else: ?>
				<div class="vacio">
					(No se encontraron resultados)
				</div>
			</center>
	    	<?php endif; // fin resultados busqueda 
			
		else:?>
			<div class='caption'><h3 style='top: 65%;'>Se requiere por lo menos un criterio para realizar la búsqueda</h3></div>

		<?php endif; // fin if combrobar si hay criterios
	}
 ?>