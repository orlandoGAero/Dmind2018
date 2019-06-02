<?php 
	session_start();
	// Manejamos en sesión el nombre del usuario que se ha logeado
	if(!isset($_SESSION["usuario"])){
		header("location:../");  
	}
	$_SESSION["usuario"];
	// Termina inicio de sesión

	include_once('../../class/ingresos.php');
	$classIngresos = new ingresos();

	if( $datosIngresos = $classIngresos -> listarIngresos() ) :?>
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
