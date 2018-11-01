$(document).ready(function() {
	$('#dirFisProv').click(function() {
		if ($(this).attr('checked')) {
			dir = "<li>&nbsp;</li>"+
				"<li><span class='azul'>Dirección Fisica</span></li>"+
				"<li>"+
					"<label>Calle:</label>"+
					"<input type='text' name='direccionP[2][txtCalle]' maxlength='70' autocomplete='off'>"+
				"</li>"+
				"<li>"+
					"<label>No. Exterior:</label>"+
					"<input type='text' name='direccionP[2][txtNexterior]' maxlength='10' autocomplete='off'>"+
				"</li>"+
				"<li>"+
					"<label>No. Interior:</label>"+
					"<input type='text' name='direccionP[2][txtNinterior]' maxlength='10' autocomplete='off'>"+
				"</li>"+
				"<li>"+
					"<label>Colonia:</label>"+
					"<input type='text' name='direccionP[2][txtColonia]' maxlength='70' autocomplete='off'>"+
				"</li>"+
				"<li>"+
					"<label>Localidad:</label>"+
					"<input type='text' name='direccionP[2][txtLocalidad]' maxlength='70' autocomplete='off'>"+
				"</li>"+
				"<li>"+
					"<label>Municipio:</label>"+
					"<input type='text' name='direccionP[2][txtMunicipio]' maxlength='70' autocomplete='off'>"+
				"</li>"+
				"<li>"+
					"<label>Estado:</label>"+
					"<input type='text' name='direccionP[2][txtEstado]' maxlength='70' autocomplete='off'>"+
				"</li>"+
				"<li>"+
					"<label>País:</label>"+
					"<input type='text' name='direccionP[2][txtPais]' maxlength='70' autocomplete='off'>"+
				"</li>"+
				"<li>"+
					"<label>Código Postal:</label>"+
					"<input type='text' name='direccionP[2][txtCp]' maxlength='5' autocomplete='off' pattern='^[0-9]{4,5}$' title='4 ó 5 digitos'>"+
				"</li>"+
				"<li>"+
					"<label>Referencia:</label>"+
					"<input type='text' name='direccionP[2][txtRef]' maxlength='70' autocomplete='off'>"+
				"</li>"+
				"<li>"+
					"<label>Ubicación GPS:</label>"+
					"<input type='text' name='direccionP[2][txtUbGps]' maxlength='70' autocomplete='off'>"+
				"</li>"+
				"<li>"+
					"<label>Tipo Dirección:</label>"+
					"<input type='text' name='direccionP[2][txtTipDir]' id='tipoDireccion' maxlength='45' autocomplete='off' value='FISICA' readonly>"+
				"</li>";
			$('#tipoDir').html(dir);
			$('#tipoDireccion').val('FISCAL');
		} else {
			$('#tipoDir > li').remove();
			$('#tipoDireccion').val('FISCAL Y FISICA');
		}
	});
});