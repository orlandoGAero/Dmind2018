<?php 
	require 'classProveedores.php';
	$fnProveedores = new Proveedores();
	$idEgresos = $_REQUEST['txtIdProvEgre'];
	$datosProveedorE = $fnProveedores -> obtenerDatoProvEgresos($idEgresos);
	echo "<script type='text/javascript'>
			 $(document).ready(function() {
				$('#provEgreAdd').val('Si');
				$('#idEgreAdd').val('".$idEgresos."');
				$('#razonSocialProv').val('".$datosProveedorE['razon_social_emisor']."').attr('readonly', 'readonly');
				$('#rfcProv').val('".$datosProveedorE['rfc_emisor']."').attr('readonly', 'readonly');
				$('#paisProv').val('".$datosProveedorE['ed_pais']."').attr('readonly', 'readonly');
				$('#estadoProv').val('".$datosProveedorE['ed_estado']."').attr('readonly', 'readonly');
				$('#municipioProv').val('".$datosProveedorE['ed_municipio']."').attr('readonly', 'readonly');
				$('#codPosProv').val('".$datosProveedorE['ed_cod_post']."').attr('readonly', 'readonly');
				$('#coloniaProv').val('".$datosProveedorE['ed_colonia']."').attr('readonly', 'readonly');
				$('#calleProv').val('".$datosProveedorE['ed_calle']."').attr('readonly', 'readonly');
				$('#nExtProv').val('".$datosProveedorE['ed_no_ext']."').attr('readonly', 'readonly');
				$('#nIntProv').val('".$datosProveedorE['ed_no_int']."').attr('readonly', 'readonly');
			 });
		  </script>";
?>