// FUNCIÓN - Actualiza los valores de la lista de Números de Serie.
function actualizaNumSeries() {
	var cat = $("#categoria").val();
	var subcat = $("#subcategoria").val();
	var div = $("#divisiones").val();
	var nom = $("#nombres").val();
	var tip = $("#tipos").val();
	var mar = $("#marcas").val();
	var mod = $("#modelos").val();
	var numserie = $("#series");
	if(cat != 0 && subcat != 0 && div != 0 && nom != 0 && tip != 0 && mar != 0 && mod != 0 ){
		// Muestra mensaje de Cargar.
		numserie.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
		$("#precio").load("precio.php?idInventario=");
		$("#descripcion").val('');
		$.post('noserieJSON.php', {"idCategoria":cat,"idSubcategoria":subcat,"idDivision":div,"idNombre":nom,"idTipo":tip,"idMarca":mar,"nomModelo":mod}, function(data) {
			numserie.empty();
			if(data == ""){
				numserie.append('<option value="">Sin no. series</option>');
			}else{
				numserie.append('<option value="">Elige un no. serie</option>');
				for(var i=0; i<data.length; i++){
					numserie.append('<option value="' + data[i].id_inventario + '">' + data[i].no_serie +'</option>');
				}
			}
		}, "json");
	}
}