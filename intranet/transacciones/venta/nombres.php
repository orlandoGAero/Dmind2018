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
  $idDiv = $_REQUEST['idDivision'];
?>
<?php if(($idCat) != 0 && ($idSubcat) != 0 && ($idDiv) != 0) :?>
    <?php $Nombres = $funcVentas -> obtenerNombres($idCat,$idSubcat,$idDiv) ?>
    <?php if($Nombres == NULL) :?>
        <option value="">Sin nombres</option>
    <?php else :?>
        <option value="">Elige un nombre</option>
        <?php foreach($Nombres as $nombre) :?>
            <option value="<?=$nombre['id_nombre']?>"><?=$nombre['nombre']?></option>
        <?php endforeach; ?>
    <?php endif; ?>
<?php else :?>
    <option value="">Elige</option>
<?php endif; ?>