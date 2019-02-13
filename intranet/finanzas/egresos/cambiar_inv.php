<?php 
	session_start();
	// Manejamos en sesión el nombre del usuario que se ha logeado
	if(!isset($_SESSION["usuario"])){
		header("location:../");  
	}
	$_SESSION["usuario"];
	// Termina inicio de sesión

	require('../../class/egresos.php');
	$classEgresos = new egresos();
	// print_r($_REQUEST);
	if (isset($_REQUEST['idEg']) && isset($_REQUEST['valorBoton'])) {
		$idEg = $_REQUEST['idEg'];
		$valorBtn = $_REQUEST['valorBoton'];

		if($valorBtn === 'no') {
			// actualizar a si
			$classEgresos -> setInvSi($idEg);
			echo "<div class='success'><h3>Agregado para Inventario</h3></div>";
		}
		elseif($valorBtn === 'si') {
			// actualizar a no
			$classEgresos -> setInvNo($idEg);
			echo "<div class='error'><h3>Removido de Inventario</h3></div>";
		}
	}
 ?>

 <?php if( $datosEgresos = $classEgresos -> listarEgresos() ) :?>
	<section>
		<div id="tabla_egresos">
			<?php include 'tabla_egresos.php' ?>
		</div>
	</section>
<?php else :?>
	<div class="vacio">
		(Sin registros)
	</div>
<?php endif; ?>

<script type='text/javascript'>
	egresos(document).ready(function(){
		setTimeout(function(){
			egresos('.success').fadeOut(1500);
		},3000);
		setTimeout(function(){
			egresos('.error').fadeOut(1500);
		},3000);
	});
</script>