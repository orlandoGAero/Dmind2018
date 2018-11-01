<?php
	session_start();
	// Manejamos en sesión el nombre del usuario que se ha logeado
	if(!isset($_SESSION["usuario"])){
		header("location:../");  
	}
	$_SESSION["usuario"]; // Termina inicio de sesión
	// Clase Saldos.
	require('../../class/saldos.php');
	$fnSaldos = new saldos();
?>
<?php if(isset($_REQUEST['saldo'])) : ?>
	<?php 
		$idSaldo = $_REQUEST['saldo'];
		$fnSaldos -> activarSaldo($idSaldo);
	?>
	<?php if(isset($fnSaldos -> msjAct)) : ?>
		<div class='success2'><h3><?=$fnSaldos -> msjAct?></h3></div>
	 	<?php if( $datosSaldos = $fnSaldos -> obtenerDatosSaldos() ) :?>
			<?php include 'tabla_saldos.php'; ?>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>
<script type='text/javascript'>
	$(document).ready(function(){
		$('html, body').scrollTop(0);
		setTimeout(function(){
			$('.success2').fadeOut(1500);
		},3000);
	});
</script>