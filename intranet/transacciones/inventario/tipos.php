<?php
 if(isset($_POST["id_nombre"]))
 {
    $opciones = '<option value="">Selecciona Tipo</option>';
    $conexion= new mysqli("localhost","root","","digitalm",3306);

    $strConsulta = "SELECT DISTINCT P.id_tipo, T.nombre_tipo 
                    FROM productos P INNER JOIN tipos T ON P.id_tipo=T.id_tipo 
                    WHERE P.id_categoria = " . $_POST['id_categoria'] . 
                    " AND P.id_subcategoria = " . $_POST['id_subcategoria'] . 
                    " AND P.id_division = " . $_POST['id_division'] .
                    " AND P.id_nombre = " . $_POST['id_nombre'] . "
                     AND P.descontinuado = 'No';";
    $result = $conexion->query($strConsulta);
    while( $fila = $result->fetch_array() )
    {
       $opciones.='<option value="'.$fila["id_tipo"].'">'.$fila["nombre_tipo"].'</option>';
    }
     echo $opciones;
 }
?>
