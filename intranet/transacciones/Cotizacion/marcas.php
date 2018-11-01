<?php
 if(isset($_POST["id_nombre"]))
 {
    $opciones = '<option value="0"> Elige un marca</option>';
    $conexion= new mysqli("localhost","root","","digitalm",3306);
    
    $id_nombre=$_POST["id_nombre"];
    $id_division=$_POST["id_division"];
    $id_subcategoria=$_POST["id_subcategoria"];

    $strConsulta = "SELECT DISTINCT P.id_marca, nombre_marca from productos P 
                    inner join marcas M on P.id_marca=M.id_marca 
                    where id_nombre=$id_nombre and id_division=$id_division and id_subcategoria=$id_subcategoria";
    $result = $conexion->query($strConsulta);
    while( $fila = $result->fetch_array() )
    {
       $opciones.='<option value="'.$fila["id_marca"].'">'.$fila["nombre_marca"].'</option>';
    }
     echo $opciones;
 }
?>