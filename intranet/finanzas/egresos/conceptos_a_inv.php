<?php 
	// Clase de Egresos.
     	include_once('../../class/egresos.php');
		$classEgresos = new egresos();

		if (isset($_REQUEST['idEgCon'])) {
			$idEgcon = $_REQUEST['idEgCon'];
			$item = $_REQUEST['item'];
			$valorInv = $_REQUEST['btnCambiar'];
			
			if($valorInv === 'si'){
				//actualizar a No
				$classEgresos -> setNoEgConAddInv($idEgcon);
			} else if($valorInv === 'no') {
				//actualizar a Si
				$classEgresos -> setSiEgConAddInv($idEgcon);
			}
			

			$agregarInv = $classEgresos-> getInvCon($idEgcon);
		}
 ?>
	<input type="hidden" id="IdECon" value="<?=$idEgcon?>" readonly>
	<input type="hidden" id="numCon" value="<?=$item?>" readonly>

<button type="button" class="cambiarAddInv" name="btnCambiarInv" style="margin-left: 25px;"
		data-cambiar="<?php
    					if($agregarInv['agregar_inv'] === 'Si') 
    						echo 'si';
    					elseif($agregarInv['agregar_inv'] === 'No')
    						echo 'no';
    					?>"
	    data-idecon="<?=$idEgcon?>"
	    data-item="<?=$item?>"
    	title="<?php
				if($agregarInv['agregar_inv'] === 'Si') 
					echo 'Concepto agregado al inventario';
				elseif($agregarInv['agregar_inv'] === 'No')
					echo 'Concepto removido del inventario';
				?>" 
>
	<?php if ($agregarInv['agregar_inv'] === 'Si'): ?>
		<img src="../../images/checked.svg" width="32" height="32" alt="" />
	<?php elseif ($agregarInv['agregar_inv'] === 'No'): ?>
		<img src="../../images/cancel.svg" width="32" height="32" alt="" />
	<?php endif; ?>
</button>
<script>
	$(".cambiarAddInv").click(function(e) {
        	
        	let idEcon = e.currentTarget.getAttribute("data-idecon");
        	let numCon = e.currentTarget.getAttribute("data-item");
        	let valorBtn = e.currentTarget.getAttribute("data-cambiar");

        	$.post('conceptos_a_inv.php', 
        		{idEgCon: idEcon, item: numCon, btnCambiar: valorBtn}, 
        		function(data) {
	        		$(`#div-add-inv${numCon}`).html(data);
	        	}
        	);
        });
</script>
