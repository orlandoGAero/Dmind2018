<div class="form-varios">
	<form action="cargar_varios.php" method="post" id="formuXML" enctype="multipart/form-data">
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
