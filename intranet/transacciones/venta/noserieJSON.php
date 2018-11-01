<?php
    sleep(1);
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
<?php $NoSeries = $funcVentas -> obtenerNumSerieJSON($idCat,$idSubcat,$idDiv,$idNom,$idTip,$idMar,$idProducto) ?>
<?php echo json_encode($NoSeries) ?>