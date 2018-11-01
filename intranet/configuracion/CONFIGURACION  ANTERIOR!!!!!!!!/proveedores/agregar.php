<center>
<br>
<form action="guardar.php" class="regusuario" style="width:500px; text-align:justify"> 
	<h2 class="formarriba" style="width:500px; padding:13px">NUEVO PROVEEDOR</h2>

<div class="camps" style="width:500px; padding:13px" id="barra"><br>
	<label>Nombre proveedor :</label>
		<input name="nom_proveedor" type="text"/>
<?php //este se utiliza para llenar el id del numero de registro de datos_fiscales
  $conexion= new mysqli("localhost","root","","digitalm",3306);
  $strConsulta = "select MAX(id_datfiscal) from datos_fiscales";
  $result = $conexion->query($strConsulta);
  while( $fila = $result->fetch_array())
  {
     $maxid_fis=$fila[0]+1;
  }
?>
<input type="hidden" name="id_datfiscal" title="id_datfiscal" value="<?php echo $maxid_fis ?>" />
<hr>
<h4 style="margin-top:-15px">Datos Fiscales</h4>
<label>Razon Social:</label>
<input type="text" name="razon_social">
<label>RFC:</label>
<input type="text" name="rfc"><br><br>
<label>Tipo Razon Social:</label>
<input type="text" name="tipo_razon_social">
<label>Email:</label>
<input type="text" name="email"><br>
<hr>
<h4 style="margin-top:-15px">Datos de Bancarios</h4>
<?php //este se utiliza para llenar el id del numero de registro de datos_fiscales
  $conexion= new mysqli("localhost","root","","digitalm",3306);
  $strConsulta = "select MAX(id_bancarios) from datos_bancarios";
  $result = $conexion->query($strConsulta);
  while( $fila = $result->fetch_array())
  {
     $maxid_ban=$fila[0]+1;
  }
?>
<input type="hidden" name="id_bancarios" title="id_bancarios" value="<?php echo $maxid_ban ?>" />
<label>Nombre Banco :</label>
<input type="text" name="nombre_banco" />
<label>Sucursal :</label>
<input type="text" name="sucursal"><br><br>
<label>Titular :</label>
<input type="text" name="titular">
<label>No. Cuenta :</label>
<input type="text" name="no_cuenta"><br><br>
<label>Clave Interbancaria :</label>
<input type="text" name="clave_interbancaria"><br><br>
<label>Tipo de cuenta :</label>
<select name="tipo_cuenta">
<option value="otro">Elija</option>
<option value="cheques">Cheques</option>
<option value="debito">Debito</option>
<option value="credito">Credito</option>
</select>
<?php //este se utiliza para llenar el combo de id_direccion
  $conexion= new mysqli("localhost","root","","digitalm",3306);
  $strConsulta = "select MAX(id_direccion) from direcciones";
  $result = $conexion->query($strConsulta);
  while( $fila = $result->fetch_array())
  {
     $maxid_direc=$fila[0]+1;
  }
?>
<input type="hidden" name="id_direccion" title="id_direccion" value="<?php echo $maxid_direc ?>" />

<hr>
<h4 style="margin-top:-15px">Datos de Direccion</h4>
<label>Calle :</label>
<input type="text" name="calle">
<label>No.Exerior :</label>
<input type="text" name="num_ext"><br><br>
<label>No. Interior :</label>
<input type="text" name="num_int">
<label>Colonia :</label>
<input type="text" name="colonia"><br><br>
<label>Localidad :</label>
<input type="text" name="localidad">
<label>Referencia :</label>
<input type="text" name="referencia"><br><br>
<label>Municipio :</label>
<input type="text" name="municipio">
<label>Estado :</label>
<input type="text" name="estado"><br><br>
<label>Pais :</label>
<input type="text" name="pais">
<label>Codigo Postal :</label>
<input type="text" name="cod_postal"><br><br>
<label>GPS Ubicación :</label>
<input type="text" name="gps_ubicacion">
<label>Telefono :</label>
<input type="text" name="telefono">
</div>
<div style="width:526px; text-align:center" class="formabajo"><br>
		<input type="submit" name="enviar" value="Registrar" class="boton" />
		<input type="reset" value="Borrar" class="boton" style="margin-left:30px;" /><br><br>
</div>
</form>
</center>
<br>
<br>
<br>
<br>
<br><br>
<br>
<br>