<?php
 if(isset($_POST["id_cliente"]))
 {	
    $conexion= new mysqli("localhost","root","","digitalm",3306);
    $strConsulta = "SELECT id_cliente, nombre_cliente, calle, colonia, localidad, municipio,D.estado,F.rfc from clientes 
                    inner join direcciones D on clientes.id_direccion=D.id_direccion 
                    inner join datos_fiscales F on clientes.id_datfiscal=F.id_datfiscal where id_cliente=".$_POST["id_cliente"];
    $result = $conexion->query($strConsulta);
    while( $fila = $result->fetch_array())
    {
       $resp ='<h3>EN ATENCION A</h3><li>'.$fila["nombre_cliente"].'</li><li>RFC :<spam>'.$fila["rfc"].'</spam></li><li> <br>Estado :<spam>'.$fila["estado"].'</spam></li><li>Municipio:<spam>'.$fila["municipio"].'</spam></li><li>Localidad:<spam>'.$fila["localidad"].'</spam></li><li>Colonia  :<spam>'.$fila["colonia"].'</spam></li><li>Calle:<spam><li>'.$fila["calle"].' </spam></li>';
       $id_cli=$fila["id_cliente"];
    }

    $strConsulta = "select MAX(id_cotizacion) from cotizacion";
    $result = $conexion->query($strConsulta);
    while( $fila = $result->fetch_array())
    {
       $ultcot=$fila[0];
    }
    
    $strConsulta = "update cotizacion set id_cliente='$id_cli' WHERE id_cotizacion='$ultcot'";
    $result = $conexion->query($strConsulta);
    echo $resp;
}
?>