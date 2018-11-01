<?php
 if(isset($_POST["id_categoria"]))
 {
    $opciones = '<option value="">Selecciona Subcategoria</option>';
    $conexion= new mysqli("localhost","root","","digitalm",3306);
    //select id_marca from detalle_marca where id_categoria=2
    $strConsulta = "SELECT DISTINCT P.id_subcategoria, S.nombre_subcategoria 
                    FROM productos P INNER JOIN subcategorias S ON P.id_subcategoria=S.id_subcategoria 
                    WHERE P.id_categoria=".$_POST["id_categoria"]." AND P.descontinuado = 'No';";
    $result = $conexion->query($strConsulta);
    while( $fila = $result->fetch_array() )
    {
       $opciones.='<option value="'.$fila["id_subcategoria"].'">'.$fila["nombre_subcategoria"].'</option>';
    }
     echo $opciones;
 }
?>