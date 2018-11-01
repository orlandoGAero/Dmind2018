var $ = jQuery.noConflict();
$(document).ready(function() {
	$("#categoria").change(function(){
		var cat = $("#categoria").val();
		var subcat = $("#subcategoria").val();
		var div = $("#divisiones").val();
		var nom = $("#nombres").val();
		var tip = $("#tipos").val();
		var mar = $("#marcas").val();
		var mod = $("#modelos").val();
		var noSerie = $("#series").val();
		if($(this).val() != ""){
	    	$("#subcategoria").load('subcategoria.php?idCategoria='+cat);
	    	$("#divisiones").load('divisiones.php?idCategoria='+cat+'&idSubcategoria='+subcat);
	    	$("#nombres").load('nombres.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div);
	    	$("#tipos").load('tipos.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom);
	    	$("#marcas").load('marcas.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip);
	    	$("#modelos").load('modelo.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar);
	    	$("#series").load('noserie.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar+'&nomModelo='+mod);
		}else{
			$("#subcategoria").load('subcategoria.php?idCategoria='+cat);
			if($("#subcategoria").val("")){
				$("#divisiones").load('divisiones.php?idCategoria='+cat+'&idSubcategoria='+subcat);
			}
			if($("#divisiones").val("")){
				$("#nombres").load('nombres.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div);
			}
			if($("#nombres").val("")){
				$("#tipos").load('tipos.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom);
			}
			if($("#tipos").val("")){
				$("#marcas").load('marcas.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip);
			}
			if($("#marcas").val("")){
				$("#modelos").load('modelo.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar);
			}
			if($("#modelos").val("")){
				$("#series").load('noserie.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar+'&nomModelo='+mod);
			}
		}
	});

	$("#subcategoria").change(function(){
		var cat = $("#categoria").val();
		var subcat = $("#subcategoria").val();
		var div = $("#divisiones").val();
		var nom = $("#nombres").val();
		var tip = $("#tipos").val();
		var mar = $("#marcas").val();
		var mod = $("#modelos").val();
		if($(this).val() != ""){
	    	$("#divisiones").load('divisiones.php?idCategoria='+cat+'&idSubcategoria='+subcat);
	    	$("#nombres").load('nombres.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div);
	    	$("#tipos").load('tipos.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom);
	    	$("#marcas").load('marcas.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip);
	    	$("#modelos").load('modelo.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar);
	    	$("#series").load('noserie.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar+'&nomModelo='+mod);
		}else{
			$("#divisiones").load('divisiones.php?idCategoria='+cat+'&idSubcategoria='+subcat);
			if($("#divisiones").val("")){
				$("#nombres").load('nombres.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div);
			}
			if($("#nombres").val("")){
				$("#tipos").load('tipos.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom);
			}
			if($("#tipos").val("")){
				$("#marcas").load('marcas.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip);
			}
			if($("#marcas").val("")){
				$("#modelos").load('modelo.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar);
			}
			if($("#modelos").val("")){
				$("#series").load('noserie.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar+'&nomModelo='+mod);
			}
		}
	});

	$("#divisiones").change(function() {
		var cat = $("#categoria").val();
		var subcat = $("#subcategoria").val();
		var div = $("#divisiones").val();
		var nom = $("#nombres").val();
		var tip = $("#tipos").val();
		var mar = $("#marcas").val();
		var mod = $("#modelos").val();
		if($(this).val() != ""){
		    $("#nombres").load('nombres.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div);
		    $("#tipos").load('tipos.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom);
		    $("#marcas").load('marcas.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip);
	    	$("#modelos").load('modelo.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar);
	    	$("#series").load('noserie.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar+'&nomModelo='+mod);
		}else{
			$("#nombres").load('nombres.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div);
			if($("#nombres").val("")){
				$("#tipos").load('tipos.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom);
			}
			if($("#tipos").val("")){
				$("#marcas").load('marcas.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip);
			}
			if($("#marcas").val("")){
				$("#modelos").load('modelo.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar);
			}
			if($("#modelos").val("")){
				$("#series").load('noserie.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar+'&nomModelo='+mod);
			}
		}
	});

	$("#nombres").change(function() {
		var cat = $("#categoria").val();
		var subcat = $("#subcategoria").val();
		var div = $("#divisiones").val();
		var nom = $("#nombres").val();
		var tip = $("#tipos").val();
		var mar = $("#marcas").val();
		var mod = $("#modelos").val();
		if($(this).val() != ""){
		    $("#tipos").load('tipos.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom);
		    $("#marcas").load('marcas.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip);
	    	$("#modelos").load('modelo.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar);
	    	$("#series").load('noserie.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar+'&nomModelo='+mod);
		}else{
			$("#tipos").load('tipos.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom);
			if($("#tipos").val("")){
				$("#marcas").load('marcas.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip);
			}
			if($("#marcas").val("")){
				$("#modelos").load('modelo.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar);
			}
			if($("#modelos").val("")){
				$("#series").load('noserie.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar+'&nomModelo='+mod);
			}
		}
	});

	$("#tipos").change(function() {
		var cat = $("#categoria").val();
		var subcat = $("#subcategoria").val();
		var div = $("#divisiones").val();
		var nom = $("#nombres").val();
		var tip = $("#tipos").val();
		var mar = $("#marcas").val();
		var mod = $("#modelos").val();
		if($(this).val() != ""){
		    $("#marcas").load('marcas.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip);
		    $("#modelos").load('modelo.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar);
	    	$("#series").load('noserie.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar+'&nomModelo='+mod);
		}else{
			$("#marcas").load('marcas.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip);
			if($("#marcas").val("")){
				$("#modelos").load('modelo.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar);
			}
			if($("#modelos").val("")){
				$("#series").load('noserie.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar+'&nomModelo='+mod);
			}
		}
	});

	$("#marcas").change(function() {
		var cat = $("#categoria").val();
		var subcat = $("#subcategoria").val();
		var div = $("#divisiones").val();
		var nom = $("#nombres").val();
		var tip = $("#tipos").val();
		var mar = $("#marcas").val();
		var mod = $("#modelos").val();
		if($(this).val() != ""){
		    $("#modelos").load('modelo.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar);
		    $("#series").load('noserie.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar+'&nomModelo='+mod);
		}else{
			$("#modelos").load('modelo.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar);
			if($("#modelos").val("")){
				$("#series").load('noserie.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar+'&nomModelo='+mod);
			}
		}
	});

	$("#modelos").change(function() {
		var cat = $("#categoria").val();
		var subcat = $("#subcategoria").val();
		var div = $("#divisiones").val();
		var nom = $("#nombres").val();
		var tip = $("#tipos").val();
		var mar = $("#marcas").val();
		var mod = $("#modelos").val();
		var noSerie = $("#series").val();
		if($(this).val() != ""){
		    $("#series").load('noserie.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar+'&nomModelo='+mod);
			$("#precio").load('precio.php?idInventario='+noSerie);
		}else{
			$("#series").load('noserie.php?idCategoria='+cat+'&idSubcategoria='+subcat+'&idDivision='+div+'&idNombre='+nom+'&idTipo='+tip+'&idMarca='+mar+'&nomModelo='+mod);
			$("#precio").load('precio.php?idInventario=');

		}
	});

	$("#series").change(function() {
		var noSerie = $("#series").val();
		if($(this).val() != ""){
			$("#precio").load('precio.php?idInventario='+noSerie);
			$("#descripcion").val('');
		}else{
			$("#precio").load('precio.php?idInventario=');
		}
	});
});