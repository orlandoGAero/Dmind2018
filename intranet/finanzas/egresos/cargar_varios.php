
<div class="form-varios">
	<form action="cargar_varios.php" method="post" id="formXML" enctype="multipart/form-data">
		<label for="file-upload" class="subir">
		     Elegir archivos
		</label>
		<input type="file" id="file-upload" name="facturas[]" onchange='cambiar()' required multiple style="display: none" />
		<div id="info" class="textoArchivos"></div>
		<input type="submit" class="btn primary" value="Cargar archivos XML">
	</form>
</div>
<div class="contenido-cargar-v">
	<div class="datosXML datosCargados"></div>
	<div id="cargar" class="cargando"></div>
</div>

<script>
	let $ = jQuery.noConflict();
	$("#formXML").submit(function(e) {
		$('#cargar').html('<div id="imagenCargar"><img src="../../images/cargando.gif"/></div>');
		e.preventDefault();

		let datosForm = new FormData(document.getElementById("formXML"));

		$.ajax({
			url: "obtener_varios_xml.php",
			type: "post",
			dataType: "html",
			data: datosForm,
			cache: false,
			contentType: false,
			processData: false
		})
			.done(function(result){
				$("#imagenCargar").remove();
				$(".datosXML").html(result);
			});
	});

	function cambiar(){
	    var pdrs = `${document.getElementById('file-upload').files.length} archivos agregados`;
	    document.getElementById('info').innerHTML = pdrs;
	}

</script>