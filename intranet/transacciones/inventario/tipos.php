<?php
    require_once('classInventario.php');
    $Inv = new Inventario();
    
    if(isset($_POST["id_nombre"]))
    {
        $cat = $_POST['id_categoria'];
        $subCat = $_POST['id_subcategoria'];
        $division = $_POST['id_division'];
        $nombre = $_POST['id_nombre'];

        $opciones = '<option value="">Selecciona Tipo</option>';
        
        $tipos = $Inv->getTiposProd($cat, $subCat, $division, $nombre);
       
        foreach ($tipos as $tipo) {
            $opciones.='<option value="'.$tipo["id_tipo"].'">'.$tipo["nombre_tipo"].'</option>';
        }
        echo $opciones;
    }
?>
