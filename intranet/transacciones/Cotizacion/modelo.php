<?php
 if(isset($_POST["id_nombre"]))
 {
    $opciones = '<option value="0"> Elige un Modelo</option>';
    $conexion= new mysqli("localhost","root","","digitalm",3306);
    
    $id_tipo=$_POST["id_tipo"];
    $id_marca=$_POST["id_marca"];
    $strConsulta = "SELECT id_producto,modelo from productos P
                    where id_tipo=$id_tipo and id_marca=$id_marca and P.id_nombre=".$_POST["id_nombre"];
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