<?php
 if(isset($_POST["id_categoria"]))
 {
    $opciones = '<option value="0"> Elige subcategoria</option>';
    $conexion= new mysqli("localhost","root","","digitalm",3306);
    //select id_marca from detalle_marca where id_categoria=2
    $strConsulta = "SELECT DISTINCT P.id_subcategoria, nombre_subcategoria FROM productos P INNER JOIN subcategorias S on P.id_subcategoria=S.id_subcategoria where P.id_categoria=".$_POST["id_categoria"];
    $result = $conexion->query($strConsulta);
    while( $fila = $result->fetch_array() )
    {
       $opciones.='<option value="'.$fila["id_subcategoria"].'">'.$fila["nombre_subcategoria"].'</option>';
    }
     echo $opciones;
 }
?>