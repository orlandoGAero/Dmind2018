<?php
 if(isset($_POST["id_categoria"]))
 {
    $opciones = '<option value="0"> Elige un nombre</option>';
    $conexion= new mysqli("localhost","root","","digitalm",3306);
    
    $id_subcategoria=$_POST["id_subcategoria"];
    $id_division=$_POST["id_division"];

    $strConsulta = "SELECT DISTINCT P.id_nombre, nombre FROM productos P INNER JOIN
                    nombres N on P.id_nombre=N.id_nombre 
                    where id_subcategoria=$id_subcategoria and id_division=$id_division and P.id_categoria=".$_POST["id_categoria"];
    $result = $conexion->query($strConsulta);
    while( $fila = $result->fetch_array() )
    {
       $opciones.='<option value="'.$fila["id_nombre"].'">'.$fila["nombre"].'</option>';
    }
     echo $opciones;
 }
?>