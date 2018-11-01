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
  $idTip = $_REQUEST['idTipo'];
?>
<?php if(($idCat) != 0 && ($idSubcat) != 0 && ($idDiv) != 0 && ($idNom) != 0 && ($idTip) != 0) :?>
    <?php $Marcas = $funcVentas -> obtenerMarcas($idCat,$idSubcat,$idDiv,$idNom,$idTip) ?>
    <?php if($Marcas == NULL) :?>
        <option value="">Sin marcas</option>
    <?php else :?>
        <option value="">Elige una marca</option>
        <?php foreach($Marcas as $marcas) :?>
            <option value="<?=$marcas['id_marca']?>"><?=$marcas['nombre_marca']?></option>
        <?php endforeach; ?>
    <?php endif; ?>
<?php else :?>
    <option value="">Elige</option>
<?php endif; ?>