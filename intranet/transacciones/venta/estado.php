<?php
 if(isset($_POST["id_status"]))
 {	
    $conexion= new mysqli("localhost","root","","digitalm",3306);
    $id_status=$_POST["id_status"];
    $strConsulta = "select MAX(id_venta) from venta";
    $result = $conexion->query($strConsulta);
    while( $fila = $result->fetch_array())
    {
       $ultima=$fila[0];
    }
    
    $strConsulta = "update venta set id_status_venta='$id_status' WHERE id_venta='$ultima'";
    $result = $conexion->query($strConsulta);
    echo $resp=$strConsulta;
}
?>