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
<?php if(isset($_REQUEST['saldo'])) : ?>
	<?php 
		$idSaldo = $_REQUEST['saldo'];
		$fnSaldos -> eliminarSaldo($idSaldo);
	?>
	<?php if(isset($fnSaldos -> msjOK) && $fnSaldos -> msjOK == 'eliminado') : ?>
	 	<script>window.location.replace('listar_saldos.php')</script>
	<?php endif; ?>
<?php endif; ?>