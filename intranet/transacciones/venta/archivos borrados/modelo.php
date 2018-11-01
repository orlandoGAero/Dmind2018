<?php
 if(isset($_POST["id_nombre"]))
 {
    $opciones = '<option value="0"> Elige un Modelo</option>';
    $conexion= new mysqli("localhost","root","","digitalm",3306);
    
    $id_marca=$_POST["id_marca"];
    $id_tipo=$_POST["id_tipo"];
    
    $strConsulta = "SELECT DISTINCT P.id_producto,modelo from inventario I
                    INNER JOIN productos P on I.id_producto=P.id_producto
                    where id_status=4 and id_tipo=$id_tipo and id_marca=$id_marca and id_nombre=".$_POST["id_nombre"];
    $result = $conexion->query($strConsulta);
?>
<?php
    while( $fila = $result->fetch_array() )
    {
       $opciones.='<option value="'.$fila["id_producto"].'">'.$fila["modelo"].'</option>';
    }
     echo $opciones;
 }
?>