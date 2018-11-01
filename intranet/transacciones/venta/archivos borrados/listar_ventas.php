<!-- Tabla de ventas -->
<center>
	<table cellspacing="0" cellpadding="2" class="display" id="ventas" >
		<!-- <thead style="display:table-row-group;"> -->
		<thead>
			<tr>
				<th>Folio</th>
				<th>Fecha de captura</th>
				<th>Cliente de la cotización</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach($datosVentas as $ventas) :?>
				<tr>
					<td class="center"><?=$ventas['id_venta']?></td>
					<td class="center">
						<?php $FechaCaptura= $ventas['fecha_hora'] ?>
						<?php $FechaCaptura = date_format(date_create($FechaCaptura),'d/m/Y H:i:s') ?>
						<?=$FechaCaptura?>
					</td>
					<td class="center"><?=$ventas['nombre_cliente']?></td>
					<td class="center">
						<!-- id ventas -->
						<?php $idVenta = $ventas['id_venta'] ?>
						<a href="./vistavent.php?venta=<?=$idVenta?>">
					    	<img src="../../images/detalle.png"/>
					    </a>
					    
					    <a target="blank" href="pdfvent.php?venta=<?=$idVenta?>" style="text-decoration:none;">
					    	<img src="../../images/filpdf.png" width="20" height="20" >PDF
					    </a>
						<!-- <a href="detalle_egresos.php?idEg=<?=$idVenta?>"><img src="../images/detalle.png" title="Ver"></a> -->
						<!-- <center>
							<form action="" method="POST" enctype="application/x-www-form-urlencoded" target="_self">
								<input type="hidden" name="idEg" readonly value="<?=$idVenta?>" />
								<button type="button" class="deletegreso">
									<img src="../images/eliminar.png" title="Borrar">
								</button>
							</form>
						</center> -->
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>

		<!-- <tfoot style="display:table-header-group;">
			<tr>
				<th class="search">Total</th>
				<th class="search2">Método Pago</th>
				<th class="search2">Fecha/Hr Pago</th>
				<th></th>
			</tr>
		</tfoot> -->
	</table>
</center>