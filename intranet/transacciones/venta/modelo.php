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
?>
<?php if(($idCat) != 0 && ($idSubcat) != 0 && ($idDiv) != 0 && ($idNom) != 0 && ($idTip) != 0 && ($idMar) != 0) :?>
    <?php $Modelos = $funcVentas -> obtenerModelos($idCat,$idSubcat,$idDiv,$idNom,$idTip,$idMar) ?>
    <?php if($Modelos == NULL) :?>
        <option value="">Sin modelos</option>
    <?php else :?>
        <option value="">Elige una modelo</option>
        <?php foreach($Modelos as $modelo) :?>
            <option value="<?=$modelo['id_producto']?>"><?=$modelo['modelo']?></option>
        <?php endforeach; ?>
    <?php endif; ?>
<?php else :?>
    <option value="">Elige</option>
<?php endif; ?>