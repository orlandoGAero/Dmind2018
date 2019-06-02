<?php 
	require('../../class/ingresos.php');
	$classIngresos = new ingresos();

	if (isset($_FILES['facturas'])) {
			
		$nombreArchivo = $_FILES['facturas']['name'];
		$nombreArchTmp = $_FILES['facturas']['tmp_name'];
		$erroArch = $_FILES['facturas']['error'];
		$tipoArch = $_FILES['facturas']['type'];
		$tamArch = $_FILES['facturas']['size'];

		function array_map_llave($name, $type, $tmp_name, $error, $size) {
			$tmp_array['name'] = $name;
			$tmp_array['type'] = $type;
			$tmp_array['tmp_name'] = $tmp_name;
			$tmp_array['error'] = $error;
			$tmp_array['size'] = $size;

			return $tmp_array;
		}

		$archivos = array_map('array_map_llave',$nombreArchivo,$tipoArch,$nombreArchTmp,$erroArch,$tamArch);
	}

	$indice = 0;
	$xmlIngresos = array();

	foreach ($archivos as $archivo) :

	 	$classIngresos -> obtenerDatosXML($archivo['name'],$archivo['tmp_name'],$archivo['type']);

		// Array para cargar los datos del ingreso en el formulario de registro
		if ($archivo['type'] == 'text/xml') {
			
			if(isset($classIngresos -> datosIngresosXML)) {

				$xmlIngresos[$indice] = $classIngresos -> datosIngresosXML; 
				$indice += 1;
			}
		}
		
 	endforeach;

 	// print_r($xmlIngresos);

 ?>
	<!-- Mensajes -->
	<?php if(isset($classIngresos -> msjErr)) :?><div class="error"><h3><?=$classIngresos -> msjErr?></h3></div>
	<?php endif; ?>

	<?php if(isset($classIngresos -> msjCap)) :?>
		<div class="caption"><h3><?=$classIngresos -> msjCap?></h3></div>
	<?php endif; ?>

	<?php if(isset($classIngresos -> msjOk)) :?>
		<div class="success"><h3><?=$classIngresos -> msjOk?></h3></div>

		<div class=''>
			<h2 style='color:#16555B;'>Facturas Cargadas</h2>
		</div>
		<div class="formFact">

			<?php
				// array para unir conceptos e impuestos de la factura
				$conceptosXmlIngresos = array();
				// echo "<pre>";print_r($xmlIngresos);echo "</pre>";
				$i = 0;
				// foreach por cada archivo
				foreach ($xmlIngresos as $ingreso) : 
					// contar array de impuestos
					$cantidadArrIm = count($xmlIngresos[$i]['impuestosConceptosComprobanteI']);
					
					// ciclo por cada concepto 
					for ($idx=0; $idx < count($xmlIngresos[$i]['conceptosComprobanteI']) ; $idx++) { 

						if ($cantidadArrIm !== 0) {
							$conceptosXmlIngresos[$i][] = array_merge($xmlIngresos[$i]['conceptosComprobanteI'][$idx], 
																	 $xmlIngresos[$i]['impuestosConceptosComprobanteI'][$idx]);
						} else {
							$conceptosXmlIngresos[$i][] = array_merge($xmlIngresos[$i]['conceptosComprobanteI'][$idx]);
						}

					} // fin for

					$folioFis = $ingreso['folioFiscalI'];
					
					$folio8dig = substr($folioFis, 0, 8);
				
					$fila = $classIngresos->encontrarIngxFolio($folioFis);
			?>

					<div class="nomFact 
						<?php if($fila == 1) echo "siExiste"; else echo "noExiste"; ?>" 
						<?php if($fila == 1) echo "style='display:flex; flex-direction:row; '"; ?> 
					>
						<div>
							<p>Factura No. <?=$i+1?> - <?=$folio8dig?></p>
						</div>
						<?php if ($fila == 1) : ?>
							<div class="guardada-ant">Ya Existe</div>
						<?php endif; ?>
					</div>

				<?php
					// alamacenar union de conceptos e impuestos en un array con clave conceptosFacturas
					$conceptosImp['conceptosFacturas'] = $conceptosXmlIngresos[$i];
					// unir en un array datos de ingresos y conceptos e inmpuestos de ingresos 
					$datosIngresos[] = array_merge($ingreso,$conceptosImp);

					$i++;
					
					endforeach; //fin foreach
					// print "cantidad de ingresos: ".count($datosIngresos);
				// echo "<pre>";print_r($conceptosXmlIngresos);echo "</pre>";
				?>
				<div id="guardarVa" class="cargando"></div>	
				<div class="botones-cargar">
					<div style="width: max-content; margin: 0 auto; max-width: 166px">
						<button class="btn primary" id="btnGuardarInV" name="btnGuardarVariosIn">Registrar</button>
						<button class="btneliminar" id="btnCancelarIn">Cancelar</button>
					</div>
				</div>
		</div>
		<div id="registrarEg"></div>
	<?php
		$ingresos = json_encode($datosIngresos);
	 endif;
	?>

	<div id="datosIngresos" data-ingresos='<?=$ingresos?>'></div>