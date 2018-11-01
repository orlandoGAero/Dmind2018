<?php
    session_start();
    // Manejamos en sesión el nombre del usuario que se ha logeado
    if(!isset($_SESSION["usuario"])){
        header("location:../");  
    }
    $_SESSION["usuario"];
    // Termina inicio de sesión

    require('../../conexion.php');
    require('funciones_ventas.php');

    $funcVentas = new funciones_ventas();
?>

<?php if(isset($_REQUEST['idCliente'])) :?>
    <?php $cliente = $funcVentas -> datosCliente($_REQUEST['idCliente']) ?>
    <li>RFC: <b><?=$cliente['rfc']?></b></li>
    <li>Dirección: <b><?=$cliente['calle']." ".$cliente['num_ext']." ".$cliente['num_int']?></b></li>
    <li>Colonia: <b><?=$cliente['colonia']?></b></li>
    <li>Localidad: <b><?=$cliente['localidad']?></b></li>
    <li>Municipio: <b><?=$cliente['municipio']?></b></li>
    <li>Estado: <b><?=$cliente['estado']?></b></li>
    <li>C.P./País: <b><?=$cliente['cod_postal']."/".$cliente['pais']?></b></li>    
<?php endif; ?>