<?php
	session_start();
	// Manejamos en sesión el nombre del usuario que se ha logeado
	if(!isset($_SESSION["usuario"])){
		header("location:../");  
	}
	$_SESSION["usuario"];
	// Termina inicio de sesión

	require('../../class/ingresos.php');
	$classIngresos = new ingresos();

	// Eliminar Egreso
	$idIngreso = $_REQUEST['ingreso'];
	
	if($classIngresos->eliminarIngreso($idIngreso)){
		echo "<div class='success2'><h3>" . $classIngresos -> msj . "</h3></div>";
	}
?>

<?php if( $datosIngresos = $classIngresos -> listarIngresos() ) :?>
	<section>
		<div id="tabla_ingresos">
			<?php include 'tabla_ingresos.php' ?>
		</div>
	</section>
<?php else :?>
	<div class="vacio">
		(Sin registros)
	</div>
<?php endif; ?>

<script type='text/javascript'>
	ingresos(document).ready(function(){
		setTimeout(function(){
			ingresos('.success2').fadeOut(1500);
		},3000);
	});
</script>
