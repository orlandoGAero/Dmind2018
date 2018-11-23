<?php
	$serie = $_REQUEST['txt_serie'];
	$folio = $_REQUEST['txt_folio'];
	$idpro = $_REQUEST['txt_idpro'];
	$modelo = $_REQUEST['txt_modelo'];
	$cantidad = $_REQUEST['txt_cantidad'];
	$idcat = $_REQUEST['txt_idcat'];
	$categoria = $_REQUEST['txt_categoria'];
	$idsub = $_REQUEST['txt_idsubcat']; 
	$subcategoria = $_REQUEST['txt_subcategoria'];
	$iddiv = $_REQUEST['txt_iddiv']; 
	$division = $_REQUEST['txt_division'];
	$idnom = $_REQUEST['txt_idnom']; 
	$nombre = $_REQUEST['txt_nombre'];
	$idtip = $_REQUEST['txt_idtip']; 
	$tipo = $_REQUEST['txt_tipo'];
	$idmar = $_REQUEST['txt_idmar']; 
	$marca = $_REQUEST['txt_marca'];
	if (isset($serie) && isset($folio) && isset($modelo) && isset($idpro) && isset($cantidad)
		&& isset($idcat) && isset($categoria) && isset($idsub) && isset($subcategoria) 
		&& isset($iddiv) && isset($division) && isset($idnom) && isset($nombre) 
		&& isset($idtip) && isset($tipo) && isset($idmar) && isset($marca)) {
		echo "<script type='text/javascript'>
				$(document).ready(function(){
					$('#txt_f').val('".$_REQUEST['txt_serie']."".$_REQUEST['txt_folio']."');
					$('#cantidad').val('".$_REQUEST['txt_cantidad']."');
					
					let cat = $('#categoria');
					cat.find('option').remove();
					cat.append(`<option value='{$idcat}' selected>{$categoria}</option>`);
					
					let sub = $('#subcategoria');
					sub.find('option').remove();
					sub.append(`<option value='{$idsub}' selected>{$subcategoria}</option>`);

					let div = $('#divisiones');
					div.find('option').remove();
					div.append(`<option value='{$iddiv}' selected>{$division}</option>`);
					
					let nom = $('#nombres');
					nom.find('option').remove();
					nom.append(`<option value='{$idnom}' selected>{$nombre}</option>`);

					let tip = $('#tipos');
					tip.find('option').remove();
					tip.append(`<option value='{$idtip}' selected>{$tipo}</option>`);

					let mar = $('#marcas');
					mar.find('option').remove();
					mar.append(`<option value='{$idmar}' selected>{$marca}</option>`);

					let mod = $('#modelos');
					mod.find('option').remove();
					mod.append(`<option value='{$idpro}' selected>{$modelo}</option>`);

				});
				</script>";
			}
			
			?>