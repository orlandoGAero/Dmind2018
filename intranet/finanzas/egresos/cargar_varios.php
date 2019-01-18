<div style="background-color: #fff; padding: 5px; min-height: 100vh; height: auto">
	<div>
		<form action="cargar_varios.php" method="post" id="formXML" enctype="multipart/form-data">
			<input type="file" name="facturas[]" required multiple />
			<input type="submit" class="btn primary" value="Cargar archivos XML">
		</form>
	</div>
	<div class="datosXML" style="margin-top: 10px; padding: 10px;"></div>
</div>
<script>
	let $ = jQuery.noConflict();
	$("#formXML").submit(function(e) {
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
				$(".datosXML").html(result);
			});
	});

</script>