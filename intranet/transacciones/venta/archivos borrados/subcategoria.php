<?php
 if(isset($_POST["id_categoria"]))
 {
    $opciones = '<option value="0"> Elige subcategoria</option>';
    $conexion= new mysqli("localhost","root","","digitalm",3306);
    //select id_marca from detalle_marca where id_categoria=2
    $strConsulta = "SELECT DISTINCT P.id_subcategoria, nombre_subcategoria FROM inventario I
                    INNER JOIN productos P on I.id_producto=P.id_producto 
                    INNER JOIN subcategorias S on P.id_subcategoria=S.id_subcategoria 
                    where id_status=4 and P.id_categoria=".$_POST["id_categoria"];
    $result = $conexion->query($strConsulta);
    while( $fila = $result->fetch_array() )
    {
       $opciones.='<option value="'.$fila["id_subcategoria"].'">'.$fila["nombre_subcategoria"].'</option>';
    }
     echo $opciones;
 }
?>