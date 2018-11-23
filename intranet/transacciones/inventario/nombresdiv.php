<?php
    require_once('classInventario.php');
    $Inv = new Inventario();

    if(isset($_POST["id_categoria"]))
    {
        $cat = $_POST['id_categoria'];
        $subCat = $_POST['id_subcategoria'];
        $division = $_POST['id_division'];

        $opciones = '<option value="">Selecciona Nombre</option>';
        
        $nombres = $Inv->getNombresProd($cat, $subCat, $division);

        foreach ($nombres as $nombre){
            $opciones.='<option value="'.$nombre["id_nombre"].'">'.$nombre["nombre"].'</option>';
        }
        echo $opciones;
    }
?>