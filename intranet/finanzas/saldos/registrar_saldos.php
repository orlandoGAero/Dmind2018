<?php
	session_start();
	// Manejamos en sesión el nombre del usuario que se ha logeado
	if(!isset($_SESSION["usuario"])){
		header("location:../");  
	}
	$_SESSION["usuario"];
	// Termina inicio de sesión
?>
<center>
	<section id="botonesFinanz">
		<form method="POST" id="formRegSaldo" enctype="multipart/form-data">    		
			<input type="file" name="csvsaldos" required />
			<input type="submit" class="btn primary" value="Registrar">
		</form>
	</section>
	<div id="register-saldos"></div>
</center>

<script type="text/javascript">
var $ = jQuery.noConflict();
$(document).ready(function(){
	$("#formRegSaldo").submit(function(xml) {
		$("#register-saldos").html("<div><img src='../../images/loader_blue.gif'></div>");
		xml.preventDefault();
		var formData = new FormData(document.getElementById("formRegSaldo"));
		$.ajax({
			url: "registrar_saldos_guardar.php",
			type: "POST",
			dataType: "html",
			data: formData,
			cache: false,
			contentType: false,
			processData: false
		})
		.done(function(result){
			$("#register-saldos").html(result);
		});
	});
});
</script>