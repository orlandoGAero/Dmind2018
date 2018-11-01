<?php
 if(isset($_POST["id_nombre"]))
 {
    $opciones = '<option value="">Selecciona un modelo</option>';
    $conexion= new mysqli("localhost","root","","digitalm",3306);
    
    $strConsulta = "SELECT id_producto,modelo FROM productos
                    WHERE id_categoria = " . $_POST['id_categoria'] .
                    " AND id_subcategoria = " . $_POST['id_subcategoria'] .
                    " AND id_division = " . $_POST['id_division'] .                   
                    " AND id_nombre = " . $_POST['id_nombre'] .                
                    " AND id_tipo = " . $_POST['id_tipo'] .              
                    " AND id_marca = " . $_POST['id_marca'] . "
                     AND descontinuado = 'No';"; 
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