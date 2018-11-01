<?php
 if(isset($_POST["id_producto"]))
 {
    $conexion= new mysqli("localhost","root","","digitalm",3306);
    
    $id_producto=$_POST["id_producto"];
    $id_nombre=$_POST["id_nombre"];
    $no_serie=$_POST["no_serie"];

    $strConsulta = "SELECT count(no_serie) FROM inventario 
                    WHERE id_producto='$id_producto' and no_serie=$no_serie";
    $result = $conexion->query($strConsulta);
    while( $fila = $result->fetch_array())
    {
       $opciones.='<option value="'.$fila[0].'">Existencias: '.$fila[0].'</option>';
    }
     echo $opciones;
 }
?>