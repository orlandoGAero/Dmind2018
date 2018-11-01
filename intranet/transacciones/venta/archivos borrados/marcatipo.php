<?php
 if(isset($_POST["id_nombre"]))
 {
    $opciones = '<option value="0"> Elige un marca</option>';
    $conexion= new mysqli("localhost","root","","digitalm",3306);

    $id_nombre=$_POST["id_nombre"];
    $id_division=$_POST["id_division"];
    $id_tipo=$_POST["id_tipo"];

    $strConsulta = "SELECT DISTINCT P.id_marca, nombre_marca from inventario I 
                    INNER JOIN productos P on I.id_producto=P.id_producto
                    inner join marca_productos M on P.id_marca=M.id_marca 
                    where id_status=4 and id_nombre=$id_nombre and id_division=$id_division and id_tipo=$id_tipo";
    $result = $conexion->query($strConsulta);
    while( $fila = $result->fetch_array() )
    {
       $opciones.='<option value="'.$fila["id_marca"].'">'.$fila["nombre_marca"].'</option>';
    }
     echo $opciones;
 }
?>