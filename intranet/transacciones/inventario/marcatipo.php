<?php
    require_once('classInventario.php');
    $Inv = new Inventario();
    
    if(isset($_POST["id_nombre"]))
    {
        $opciones = '<option value="">Selecciona una marca</option>';

        $cat = $_POST['id_categoria'];
        $subCat = $_POST['id_subcategoria'];
        $division = $_POST['id_division'];
        $nombre = $_POST['id_nombre'];
        $tipo = $_POST['id_tipo'];

        $marcas = $Inv->getMarcasProd($cat, $subCat, $division, $nombre, $tipo);
        
        foreach ($marcas as $marca) {
            $opciones.='<option value="'.$marca["id_marca"].'">'.$marca["nombre_marca"].'</option>';
        }
        echo $opciones;
    }
?>