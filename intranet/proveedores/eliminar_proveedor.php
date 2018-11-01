<?php
	session_start();
	// Manejamos en sesión el nombre del usuario que se ha logeado
	if(!isset($_SESSION["usuario"])){
		header("location:../");  
	}
	$_SESSION["usuario"];
	// Termina inicio de sesión
	// Clase Proveedores.
	include 'classProveedores.php';
	$fnProv = new Proveedores();
?>
<?php if ($_REQUEST['idproveedor']) : ?>
	<?php
		$idProveedor = $_REQUEST['idproveedor'];
		$fnProv -> eliminarProveedor($idProveedor);
	?>
	<?php if (isset($fnProv -> msjErr)) : ?>
		<div class='error2'><h3><?=$fnProv -> msjErr?></h3></div>
	<?php endif; ?>
	<?php if (isset($fnProv -> msjOK)) : ?>
		<div class='success2'><h3><?=$fnProv -> msjOK?></h3></div>
	<?php endif; ?>
<?php endif; ?>
<?php include 'listar_proveedores.php' ?>
<script type='text/javascript'>
	$(document).ready(function(){
		setTimeout(function(){
			$('.error2').fadeOut(3000);
		},6000);
		setTimeout(function(){
			$('.success2').fadeOut(2000);
		},4000);
	});
</script>