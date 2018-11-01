<?php
 if(isset($_POST["id_nombre"]))
 {
    $opciones = '<option value="">Selecciona una marca</option>';
    $conexion= new mysqli("localhost","root","","digitalm",3306);

    $id_tipo="id_tipo";
    $id_division="id_division";
    $id_subcategoria="id_subcategoria";

    $strConsulta = "SELECT DISTINCT P.id_marca, M.nombre_marca 
                    FROM productos P INNER JOIN marca_productos M ON P.id_marca=M.id_marca 
                    WHERE id_categoria = " . $_POST['id_categoria'] .   
                    " AND id_subcategoria = " . $_POST['id_subcategoria'] . 
                    " AND id_division = " . $_POST['id_division'] . 
                    " AND id_nombre = " . $_POST['id_nombre'] . 
                    " AND id_tipo = " . $_POST['id_tipo'] . "
                     AND P.descontinuado = 'No';";
    $result = $conexion->query($strConsulta);
    while( $fila = $result->fetch_array() )
    {
       $opciones.='<option value="'.$fila["id_marca"].'">'.$fila["nombre_marca"].'</option>';
    }
     echo $opciones;
 }
?>