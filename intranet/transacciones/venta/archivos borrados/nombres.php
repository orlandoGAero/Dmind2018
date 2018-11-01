<?php
 if(isset($_POST["id_categoria"]))
 {
    $opciones = '<option value="0"> Elige un nombre</option>';
    $conexion= new mysqli("localhost","root","","digitalm",3306);
    
    $id_subcategoria="id_subcategoria";

    $strConsulta = "SELECT DISTINCT P.id_nombre, nombre FROM inventario I 
                    INNER JOIN productos P on I.id_producto=P.id_producto
                    INNER JOIN nombres N on P.id_nombre=N.id_nombre 
                    where id_status=4 and P.id_categoria=".$_POST["id_categoria"] and $id_subcategoria="".$_POST["id_subcategoria"];
    $result = $conexion->query($strConsulta);
    while( $fila = $result->fetch_array() )
    {
       $opciones.='<option value="'.$fila["id_nombre"].'">'.$fila["nombre"].'</option>';
    }
     echo $opciones;
 }
?>