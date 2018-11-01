<?php
 if(isset($_POST["id_nombre"]))
 {
    $opciones = '<option value="0"> Elige Tipo</option>';
    $conexion= new mysqli("localhost","root","","digitalm",3306);

    $id_nombre=$_POST["id_nombre"];
    $id_subcategoria=$_POST["id_subcategoria"];
    $id_division=$_POST["id_division"];

    $strConsulta = "SELECT DISTINCT P.id_tipo, nombre_tipo FROM productos P 
                    INNER JOIN tipos on P.id_tipo=tipos.id_tipo 
                    where P.id_nombre=$id_nombre and id_division=$id_division";
    $result = $conexion->query($strConsulta);
    while( $fila = $result->fetch_array() )
    {
       $opciones.='<option value="'.$fila["id_tipo"].'">'.$fila["nombre_tipo"].'</option>';
    }
     echo $opciones;
 }
?>
