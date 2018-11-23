<?php
    require_once('classInventario.php');
    $Inv = new Inventario();

    if(isset($_POST["id_subcategoria"]))
    {
        $cat = $_POST['id_categoria'];
        $subCat = $_POST['id_subcategoria'];
        $divis = '<option value="">Selecciona División</option>';
        
        $divisiones = $Inv->getDivisionesProd($cat, $subCat);

        foreach ($divisiones as $division)
        {
            $divis.='<option value="'.$division["id_division"].'">'.$division["nombre_division"].'</option>';
        }
        echo $divis;
    }
?>