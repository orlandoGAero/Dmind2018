<?php
 if(isset($_POST["id_categoria"]))
 {
    $opciones = '<option value="">Selecciona Nombre</option>';
    $conexion= new mysqli("localhost","root","","digitalm",3306);
    
    $strConsulta = "SELECT DISTINCT P.id_nombre, N.nombre 
                    FROM productos P INNER JOIN nombres N ON P.id_nombre=N.id_nombre 
                    WHERE P.id_categoria = " . $_POST['id_categoria'] . " AND id_subcategoria = " . $_POST["id_subcategoria"] . " AND id_division = " . $_POST["id_division"] ." AND P.descontinuado = 'No';";
    $result = $conexion->query($strConsulta);
    while( $fila = $result->fetch_array() )
    {
       $opciones.='<option value="'.$fila["id_nombre"].'">'.$fila["nombre"].'</option>';
    }
     echo $opciones;
 }
?>