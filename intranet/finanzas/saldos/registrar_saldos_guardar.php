<?php
	session_start();
	// Manejamos en sesión el nombre del usuario que se ha logeado
	if(!isset($_SESSION["usuario"])){
		header("location:../");  
	}
	$_SESSION["usuario"];
	// Termina inicio de sesión

	require('../../class/saldos.php');
	$fnSaldos = new saldos();
?>
<?php 
	$fnSaldos -> registrarSaldos($_FILES['csvsaldos']['name'], $_FILES['csvsaldos']['tmp_name'], $_FILES['csvsaldos']['type'], $_FILES['csvsaldos']['size']);
?>
<?php if(isset($fnSaldos -> msjErr)) : ?>
	<div class='error'><h3><?=$fnSaldos -> msjErr?></h3></div>
<?php endif; ?>
<?php if(isset($fnSaldos -> msjOK)) : ?>
	<div><h3><?=$fnSaldos -> msjOK?></h3></div>
<?php endif; ?>
<script type='text/javascript'>
	setTimeout(function(){
		$('.error').fadeOut(1000);
	},5000);
	$('#numCuentaBanc').change(function() {
		var valorNumC = $(this).val();
		$.ajax({
			url: 'getCuentasBancarias.php',
			type: 'POST',
			data: {cuentabancaria: valorNumC},
			success: function(response) {
				$('.cuentaB').html(response).fadeIn();
			}
		});
		$('#btnRegNumC').removeAttr('disabled');
	});
	$('#btnRegNumC').click(function() {
		$.post('agregar_cuenta_bancaria.php', $('#addNumCuenta').serialize())
		.done(function(data){
			$('#numCuentaRegistrada').html(data);
		});
	});
	$('.fancybox-close').click(function() {
		$.fancybox.close();
		window.location.replace('listar_saldos.php');
	});
</script>