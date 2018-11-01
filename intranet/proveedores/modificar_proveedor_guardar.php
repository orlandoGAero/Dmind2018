<?php
	// Clase Proveedores
	include 'classProveedores.php';
	$fnProv = new Proveedores();
	// Datos
	$idPro = $_REQUEST['txtIdProveedor'];
	$nomPro = $_REQUEST['txtNomP'];
	$telPro = $_REQUEST['txtTelP'];
	$emailPro = $_REQUEST['txtEmailP'];
	$urlPro = $_REQUEST['txtUrlP'];
	if (isset($_REQUEST['txtIdCatPro'])) {
		$idDetCatPr = $_REQUEST['txtIdCatPro'];
	} else {
		$idDetCatPr = NULL;
	}
	$catPro = $_REQUEST['sltCatP'];
	$idPrDatFis = $_REQUEST['txtIdProDatFis'];
	$razSocPro = $_REQUEST['txtRazSocP'];
	$rfcPro = $_REQUEST['txtrRfcP'];
	$tRazSocPro = $_REQUEST['sltTipRazSocP'];
	if (isset($_REQUEST['txtIdProDatBan'])) {
		$idPrDatBan = $_REQUEST['txtIdProDatBan'];
	} else {
		$idPrDatBan = NULL;
	}
	$banPro = $_REQUEST['txtBancoP'];
	$sucPro = $_REQUEST['txtSucursalP'];
	$titPro = $_REQUEST['txtTitularP'];
	$nCuentaPro = $_REQUEST['sltNumCuentaP'];
	$nClaInterPro = $_REQUEST['txtNumClaInterP'];
	$tCuentaPro = $_REQUEST['txtTipCuentaP'];
	$dirProveedor = $_REQUEST['direccionP'];
	// Modificar
	$fnProv -> modificarProveedor($idPro, $nomPro, $telPro, $emailPro, $urlPro, $idDetCatPr, $catPro, $idPrDatFis, $razSocPro, $rfcPro, $tRazSocPro, $idPrDatBan, $banPro, $sucPro, $titPro, $nCuentaPro, $nClaInterPro, $tCuentaPro, $dirProveedor);
?>
<?php if (isset($fnProv -> msjErr)) : ?>
	<div class='error'><h3><?=$fnProv -> msjErr?></h3></div>
<?php endif; ?>
<?php if (isset($fnProv -> msjOK) && $fnProv -> msjOK == "modificado") : ?>
	<script>window.location.replace('index.php')</script>
<?php endif; ?>
<script type='text/javascript'>
	setTimeout(function(){
		$('.error').fadeOut(1000);
	},5000);
</script>