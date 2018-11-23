<?php
    require_once('classInventario.php');
    $Inv = new Inventario();

    if(isset($_POST["id_nombre"]))
    {
        $cat = $_POST['id_categoria'];
        $subCat = $_POST['id_subcategoria'];
        $division = $_POST['id_division'];
        $nombre = $_POST['id_nombre'];
        $tipo = $_POST['id_tipo'];
        $marca = $_POST['id_marca'];

        $opciones = '<option value="">Selecciona un modelo</option>';
        
        $modelo = $Inv->getModeloProd($cat, $subCat, $division, $nombre, $tipo, $marca);

        foreach ($modelo as $mod) {
            $opciones.='<option value="'.$mod["id_producto"].'">'.$mod["modelo"].'</option>';
        }
        echo $opciones;
    }
?>