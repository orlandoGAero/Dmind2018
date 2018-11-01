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
  $idMar = $_REQUEST['idMarca'];
  $idProducto = $_REQUEST['nomModelo'];
?>
<?php if(($idCat) != 0 && ($idSubcat) != 0 && ($idDiv) != 0 && ($idNom) != 0 && ($idTip) != 0 && ($idMar) != 0 && ($idProducto) != 0 ) :?>
    <?php $NoSeries = $funcVentas -> obtenerNumSerie($idCat,$idSubcat,$idDiv,$idNom,$idTip,$idMar,$idProducto) ?>
    <?php if($NoSeries == NULL) :?>
        <option value="">Sin no. series</option>
    <?php else :?>
        <option value="">Elige un no. serie</option>
        <?php foreach($NoSeries as $numSerie) :?>
            <option value="<?=$numSerie['id_inventario']?>"><?=$numSerie['no_serie']?></option>
        <?php endforeach; ?>
    <?php endif; ?>
<?php else :?>
    <option value="">Elige</option>
<?php endif; ?>