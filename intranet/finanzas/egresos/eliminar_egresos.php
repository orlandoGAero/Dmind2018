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

	// Eliminar Egreso
	$idEgreso = $_REQUEST['idEg'];
	
	if($classEgresos -> eliminarEgreso($idEgreso)){
		echo "<div class='success2'><h3>" . $classEgresos -> msj . "</h3></div>";
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
			egresos('.success2').fadeOut(1500);
		},3000);
	});
</script>
