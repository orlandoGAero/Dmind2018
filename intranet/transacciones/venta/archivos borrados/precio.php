<?php
 if(isset($_POST["id_producto"]))
 {
    $conexion= new mysqli("localhost","root","","digitalm",3306);
    $strConsulta = "SELECT precio,id_moneda FROM productos WHERE id_producto = ".$_POST["id_producto"];
    $result = $conexion->query($strConsulta);
    while( $fila = $result->fetch_array())
    {
       $preciodolares=$fila["precio"];
       $monedaproducto=$fila["id_moneda"];
       $preciopesos=$fila["precio"];
    }

 $strConsulta = "SELECT V.id_moneda,valor FROM venta V INNER JOIN moneda M on V.id_moneda=M.id_moneda WHERE id_venta=".$_POST["id_venta"];
 $result = $conexion->query($strConsulta);
 while( $fila = $result->fetch_array())
 {
    $monedaventa=$fila["id_moneda"];
    $valor=$fila["valor"];
 }
 $strConsulta = "SELECT id_moneda,valor FROM moneda WHERE id_moneda=1";
 $result = $conexion->query($strConsulta);
 while( $fila = $result->fetch_array())
 {
    $valordolar=$fila["valor"];
 }
//para convertir los pesos del producto a dolares redondeados
if($monedaventa==1 && $monedaproducto==2){
    $convertirpesos=(round($preciopesos/$valor));
    $prec.='<option value="'.$convertirpesos.'">$'.$convertirpesos.'</option>';
}else{
	if($monedaventa==1 && $monedaproducto==1){
		$prec.='<option value="'.$preciopesos.'">$'.$preciopesos.'</option>';
	}else{
		if($monedaventa==2 && $monedaproducto==1){
				$convertirdolares=$preciodolares*$valordolar;	
				$prec.='<option value="'.$convertirdolares.'">$'.$convertirdolares.'</option>';
		}else{
				if($monedaventa==2 && $monedaproducto==2){
					$prec.='<option value="'.$preciopesos.'">$'.$preciopesos.'</option>';
				}
		}
	}
}
echo $prec;
}
?>