<?php
	require('../../class/egresos.php');
	$classEgresos = new egresos();
    $modeloC = $_REQUEST['modelo'];
    $index = $_REQUEST['indice'];
    
    $classEgresos -> obtenerModelo($modeloC);
	if(isset($classEgresos -> msjErr)){
		echo"<div class='error'><h3>".$classEgresos -> msjErr."</h3></div>";
        echo "<script>
                $('#check{$index}').removeAttr('checked');
            </script>";
	}
?>
<script type="text/javascript">
	setTimeout(function(){
		$('.error').fadeOut(2000);
	},4000);
</script>