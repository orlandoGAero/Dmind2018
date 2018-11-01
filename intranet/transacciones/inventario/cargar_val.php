<?php
	$serie = $_REQUEST['txt_serie'];
	$folio = $_REQUEST['txt_folio'];
	if (isset($serie) && isset($folio)) {
		echo "<script type='text/javascript'>
				$(document).ready(function(){
					$('#txt_f').val('".$_REQUEST['txt_serie']."".$_REQUEST['txt_folio']."');
				});
		      </script>";
	}
?>