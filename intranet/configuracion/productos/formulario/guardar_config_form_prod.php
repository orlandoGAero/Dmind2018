<?php
	require ('classFormularioProd.php');
    $fnFormProd = new FormularioProd();
	if (isset($_REQUEST['cbxMod'])) {
		$_REQUEST['cbxMod'] = 1;
	}else {
		$_REQUEST['cbxMod'] = 0;
	}
	if (isset($_REQUEST['cbxPre'])) {
		$_REQUEST['cbxPre'] = 1;
	}else {
		$_REQUEST['cbxPre'] = 0;
	}
	if (isset($_REQUEST['cbxDescrip'])) {
		$_REQUEST['cbxDescrip'] = 1;
	}else {
		$_REQUEST['cbxDescrip'] = 0;
	}
	if( $fnFormProd -> guardarConfigFormProd($_REQUEST['cbxMod'],$_REQUEST['cbxPre'],$_REQUEST['cbxDescrip']) ){
		if(isset($fnFormProd -> msjOk)) echo"<div class='success'><h3>".$fnFormProd -> msjOk."</h3></div>";
	}
?>
<script type="text/javascript">
	setTimeout(function() {
        $('.success').fadeOut(2000);
    },3500);
</script>