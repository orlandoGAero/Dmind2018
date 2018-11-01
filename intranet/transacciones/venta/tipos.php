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
  $idNom = $_REQUEST['idNombre'];
?>
<?php if(($idCat) != 0 && ($idSubcat) != 0 && ($idDiv) != 0 && ($idNom) != 0) :?>
    <?php $TiposP = $funcVentas -> obtenerTipos($idCat,$idSubcat,$idDiv,$idNom) ?>
    <?php if($TiposP == NULL) :?>
        <option value="">Sin tipos</option>
    <?php else :?>
        <option value="">Elige un tipo</option>
        <?php foreach($TiposP as $tipo) :?>
            <option value="<?=$tipo['id_tipo']?>"><?=$tipo['nombre_tipo']?></option>
        <?php endforeach; ?>
    <?php endif; ?>
<?php else :?>
    <option value="">Elige</option>
<?php endif; ?>