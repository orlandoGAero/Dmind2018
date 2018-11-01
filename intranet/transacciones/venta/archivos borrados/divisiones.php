<?php
 if(isset($_POST["id_subcategoria"]))
 {
    $divis = '<option value="0"> Elige un nombre</option>';
    $conexion= new mysqli("localhost","root","","digitalm",3306);
    $id_subcategoria="id_subcategoria";

    $id_categoria=$_POST["id_categoria"];
    $strConsulta = "SELECT DISTINCT P.id_division, nombre_division FROM inventario I 
                    INNER JOIN productos P on I.id_producto=P.id_producto
                    INNER JOIN division D on P.id_division=D.id_division
                    where id_status=4 and id_categoria=$id_categoria and P.id_subcategoria=".$_POST["id_subcategoria"];
    $result = $conexion->query($strConsulta);
    while( $fila = $result->fetch_array() )
    {
       $divis.='<option value="'.$fila["id_division"].'">'.$fila["nombre_division"].'</option>';
    }
     echo $divis;
 }
?>