<?php
	session_start();
	// Manejamos en sesión el nombre del usuario que se ha logeado
	if(!isset($_SESSION["usuario"])){
		header("location:../");  
	}
	$_SESSION["usuario"];
	// Termina inicio de sesión

	include_once('../../class/egresos.php');
	$classEgresos = new egresos();

?>
<!-- <div id="lista_egresos"> -->
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
<!-- </div> -->


    	 
    

