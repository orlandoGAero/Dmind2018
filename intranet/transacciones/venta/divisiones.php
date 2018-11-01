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

<?php
  $idCat = $_REQUEST['idCategoria'];
  $idSubcat = $_REQUEST['idSubcategoria'];
?>
<?php if(($idCat) != 0 && ($idSubcat) != 0) :?>
    <?php $Divisiones = $funcVentas -> obtenerDivisiones($idCat,$idSubcat) ?>
    <?php if($Divisiones == NULL) :?>
        <option value="">Sin divisiones</option>
    <?php else :?>
        <option value="">Elige una división</option>
        <?php foreach($Divisiones as $division) :?>
            <option value="<?=$division['id_division']?>"><?=$division['nombre_division']?></option>
        <?php endforeach; ?>
    <?php endif; ?>
<?php else :?>
    <option value="">Elige</option>
<?php endif; ?>