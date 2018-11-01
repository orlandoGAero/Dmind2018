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
?>
<?php if($idCat != 0) :?>
    <?php $Subcategorias = $funcVentas -> obtenerSubcategorias($idCat) ?>
    <?php if($Subcategorias == NULL) :?>
        <option value="">Sin Subcategorías</option>
    <?php else :?>
        <option value="">Elige subcategoría</option>
        <?php foreach($Subcategorias as $subcategoria) :?>
            <option value="<?=$subcategoria['id_subcategoria']?>"><?=$subcategoria['nombre_subcategoria']?></option>
        <?php endforeach; ?>
    <?php endif; ?>
<?php else :?>
    <option value="">Elige</option>
<?php endif; ?>