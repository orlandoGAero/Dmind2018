<?php //este se utiliza para llenar el combo de productos
  $conexion= new mysqli("localhost","root","","digitalm",3306);
  $strConsulta = "select descripcion,modelo from productos";
  $result = $conexion->query($strConsulta);
  $des = '<option></option>';
  while( $fila = $result->fetch_array())
  {
     $des.='<option>'.$fila["descripcion"].'</option>';
  }
?>
<datalist id="lista">
<?php echo $des; ?>
</datalist>
