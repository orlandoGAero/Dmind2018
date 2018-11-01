<?php
 if(isset($_POST["id_producto"]))
 {
    $opciones = '<option value="0"> No. serie</option>';
    $conexion= new mysqli("localhost","root","","digitalm",3306);
    
    $id_producto=$_POST["id_producto"];
    $id_marca=$_POST["id_marca"];
    $id_nombre=$_POST["id_nombre"];
    $id_tipo=$_POST["id_tipo"];

    $strConsulta = "SELECT no_serie, P.id_producto FROM inventario I
                    INNER JOIN productos P on I.id_producto=P.id_producto
                    WHERE id_status=4 and id_marca=$id_marca and id_nombre=$id_nombre and id_tipo=$id_tipo and P.id_producto=$id_producto";
    $result = $conexion->query($strConsulta);
    while( $fila = $result->fetch_array())
    {
       $opciones.='<option value="'.$fila["no_serie"].'">'.$fila["no_serie"].'</option>';
    }
     echo $opciones;
 }
?>