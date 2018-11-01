<?php
 if(isset($_POST["id_subcategoria"]))
 {
    $divis = '<option value="">Selecciona División</option>';
    $conexion= new mysqli("localhost","root","","digitalm",3306);

    $strConsulta = "SELECT DISTINCT P.id_division, D.nombre_division 
                    FROM productos P INNER JOIN division D ON P.id_division=D.id_division
                    WHERE id_categoria = " . $_POST["id_categoria"] . " AND P.id_subcategoria = " . $_POST["id_subcategoria"] . "
                     AND P.descontinuado = 'No';";
    $result = $conexion->query($strConsulta);
    while( $fila = $result->fetch_array() )
    {
       $divis.='<option value="'.$fila["id_division"].'">'.$fila["nombre_division"].'</option>';
    }
     echo $divis;
 }
?>