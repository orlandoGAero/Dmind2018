<?php require_once("../../libs/encrypt_decrypt_strings_urls.php") ?>
<!-- Tabla de ventas -->
<center>
	<table cellspacing="0" cellpadding="2" class="display" id="ventas">
		<!-- <thead style="display:table-row-group;"> -->
		<thead>
			<tr>
				<th>Folio</th>
				<th>Fecha de Captura</th>
				<th>Cliente de la Venta</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach($datosVentas as $ventas) :?>
				<tr>
					<td class="center"><?=$ventas['folio']?></td>
					<td class="center">
						<?php $FechaCaptura= $ventas['fecha_hora'] ?>
						<?php $FechaCaptura = date_format(date_create($FechaCaptura),'d/m/Y H:i:s') ?>
						<?=$FechaCaptura?>
					</td>
					<td class="center"><?=$ventas['nombre_cliente']?></td>
					<td class="center">
						<!-- id ventas -->
						<?php $idVenta = encrypt($ventas['id_venta'],"intranetdmventas") ?>
						<a href="detalle_venta.php?venta=<?=$idVenta?>">
					    	<img src="../../images/detalle.png"/>
					    </a>
					    
					    <a target="_blank" href="imprimir_detalle_venta.php?venta=<?=$idVenta?>" style="text-decoration:none;">
					    	<img src="../../images/filpdf.png" width="20" height="20" >PDF
					    </a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>

		<!-- <tfoot style="display:table-header-group;">
			<tr>
				<th class="search">Folio</th>
				<th class="search">Fecha de Captura</th>
				<th class="search">Cliente de la Venta</th>
				<th>&nbsp;</th>
			</tr>
		</tfoot> -->
	</table>
</center>