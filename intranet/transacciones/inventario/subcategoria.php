<?php
    require_once('classInventario.php');
    $Inv = new Inventario();

    if(isset($_POST["id_categoria"]))
    {
        $cat = $_POST['id_categoria'];
        $opciones = '<option value="">Selecciona Subcategoria</option>';
        $subCategorias = $Inv->getSubcategoriasProd($cat);
        foreach ($subCategorias as $subCategoria) {
            $opciones.='<option value="'.$subCategoria["id_subcategoria"].'">'.$subCategoria["nombre_subcategoria"].'</option>';
        }
        echo $opciones;
    }
?>