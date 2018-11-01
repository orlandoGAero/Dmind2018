<?php
	// Clase Proveedores
	include 'classProveedores.php';
	$fnProv = new Proveedores();
	// Datos
	$nomPro = $_REQUEST['txtNomP'];
	$telPro = $_REQUEST['txtTelP'];
	$emailPro = $_REQUEST['txtEmailP'];
	$urlPro = $_REQUEST['txtUrlP'];
	$catPro = $_REQUEST['sltCatP'];
	$razSocPro = $_REQUEST['txtRazSocP'];
	$rfcPro = $_REQUEST['txtrRfcP'];
	$tRazSocPro = $_REQUEST['sltTipRazSocP'];
	$banPro = $_REQUEST['txtBancoP'];
	$sucPro = $_REQUEST['txtSucursalP'];
	$titPro = $_REQUEST['txtTitularP'];
	$nCuentaPro = $_REQUEST['sltNumCuentaP'];
	$nClaInterPro = $_REQUEST['txtNumClaInterP'];
	$tCuentaPro = $_REQUEST['txtTipCuentaP'];
	$dirProveedor = $_REQUEST['direccionP'];
	// Registrar
	$fnProv -> registrarProveedor($nomPro, $telPro, $emailPro, $urlPro, $catPro, $razSocPro, $rfcPro, $tRazSocPro, $banPro, $sucPro, $titPro, $nCuentaPro, $nClaInterPro, $tCuentaPro, $dirProveedor);
?>
<?php if (isset($fnProv -> msjErr)) : ?>
	<div class='error'><h3><?=$fnProv -> msjErr?></h3></div>
<?php endif; ?>
<?php if (isset($fnProv -> msjOK) && $fnProv -> msjOK == "registrado") : ?>
	<script>window.location.replace('index.php')</script>
<?php endif; ?>
<script type='text/javascript'>
	setTimeout(function(){
		$('.error').fadeOut(1000);
	},5000);
</script>