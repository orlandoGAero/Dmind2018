<link rel="stylesheet" type="text/css" href="../css/agregar_direccion.css"><!-- CSS -->
<form method="POST" id="formOpcDire">
	<ul>
		<li class="form-dialog">
			<label class="cp">Código Postal:</label>&nbsp;
			<input type="text" name="txtCodP" id="codigoPos" maxlength="5" autocomplete="off">
		</li>
	</ul>
</form>
<br>
<div id="buscarDir"></div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#codigoPos').keyup(function() {
			$('#buscarDir').html("<div align='center'><img src='../images/loader_blue.gif'></div>")
			$.post('obtener_direccion.php', $('#formOpcDire').serialize()) 
			.done(function(data) {
				$('#buscarDir').html(data);
			});
		});
	});
</script>