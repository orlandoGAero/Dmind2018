<script type="text/javascript">
$(document).ready(function(){
	    $(".btn").click(function(){
        var nom = $(".nombre").val();
        var tel =$(".telefono").val();
        var are = $(".area").val();
        var raz = $(".raz").val();
      	var rfc = $(".rfc").val();
      	//var correo = ^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$;
      if (nom == "") {
      	  $(".nombre").focus();
          $("#alerta1").fadeIn();
          return false;
      }else{
      	$("#alerta1").fadeOut();
      }
      if ($(".telefono").val().length < 10 || $(".telefono").val().length > 10 || isNaN(tel)) {
      	  $(".telefono").focus();
          $("#alerta2").fadeIn();
          return false;
      }else{
      	$("#alerta2").fadeOut();

      }
	if (are==0) {
		    $(".area").focus();
		       $("#alerta3").fadeIn();
		        return false;
	}else{
	$("#alerta3").fadeOut();
	}	
    });

});
</script>
</script>
<center>
<div class="scrollbar" id="barra" style="height:550px;">
<form action="guardar.php" style="width:600px;"> 
<br>
	<h2 style="background:#16555B; color:white;border-top-right-radius:10px;border-top-left-radius:10px;">NUEVO CONTACTO</h2>

<div style="background:#fff; text-align:justify;padding:20px;"><br>
<center>
<h4>Datos Contacto</h4>
<b>Fecha:</b><input type="date" value="<?php echo date("Y-m-d"); ?>" name="fecha" readonly="readonly" style="width:140px;border:none;"><br><br>
<table>
	<tr><td><label>Nombre:</label></td><td>
		<input name="nom_clie" type="text" class="nombre" />
		<spam id="alerta1" class="errores">Ingresa un nombre</spam></td></tr>
	<tr><td><label>Teléfono Movil:</label></td><td>
		<input name="tel_movil" type="text" /></td></tr>
	<tr><td><label>Teléfono Oficina:</label></td><td>
		<input name="tel_oficina" type="text" class="telefono" />
		<spam id="alerta2" class="errores">Ingresa telefono</spam>
		</td></tr>
	<tr><td><label>Teléfono Casa:</label></td>
	<td><input name="tel_casa" type="text" />
	</td></tr>
	<tr><td><label>Teléfono Emergencia:</label></td><td>
		<input name="tel_emerg" type="text" class="tel4" /></td></tr>
	<tr><td><label>Area-Contacto:</label></td>
		<td><select name="area_cont" class="area">
			<option value="0">Elige</option>
<?php 
include ("../conexion.php");
$query="SELECT * FROM areacontacto";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	echo "<option value='",$fila[0],"'>",$fila[1],"</option>";
}

 ?>
		</select>
		<spam id="alerta3" class="errores">Selecciona Area</spam>
		</td></tr>
<tr><td><label>E-mail Personal:</label></td><td>
<input type="text" name="email_personal" class="emailp" />
	<spam id="alertae1" class="errores">Ingrese email Correcto</spam>
	</td></tr>
<tr><td><label>E-mail Intitucion:</label></td><td>
<input type="text" name="email_institucion" class="emaili" />
	<spam id="alertae2" class="errores">Ingrese email Correcto</spam>
	</td></tr>
<tr><td><label>Facebook:</label></td><td>
<input type="text" name="facebook"></td></tr>
<tr><td><label>Direccion web:</label></td><td>
<input type="text" name="web" /></td></tr>
<tr><td><label>Twiter:</label></td><td>
<input type="text" name="twiter" /></td></tr>
<tr><td><label>Skype:</label></td><td>
<input type="text" name="skype" /></td></tr>
</table>

		<br><br>
<hr>
<h4>Datos de Dirección</h4>
<table>
<tr><td>
<label>Calle:</label></td>
<td>
<input type="text" name="calle">
</tr></td>
</tr>
<tr><td>
<label>No. Exterior:</label></td>
<td>
<input type="text" name="num_ext">
</td>
</tr>
<tr><td>
<label>No. Interior:</label></td>
<td>
<input type="text" name="num_int">
</td>
</tr>
<tr><td>
<label>Colonia:</label></td>
<td>
<input type="text" name="colonia">
</td>
</tr>
<tr><td>
<label>Localidad:</label></td>
<td>
<input type="text" name="localidad">
</td>
</tr>
<tr><td>
<label>Referencia:</label></td>
<td>
<input type="text" name="referencia">
</td>
</tr>
<tr><td>
<label>Municipio/<br> Delegacion:</label></td>
<td>
<input type="text" name="minicipio">
</td>
</tr>
<tr><td>
<label>Estado:</label></td>
<td>
<input type="text" name="estado">
</td>
</tr>
<tr><td>
<label>Pais:</label></td>
<td>
<input type="text" name="pais">
</td>
</tr>
<tr><td>
<label>Codigo Postal:</label></td>
<td>
<input type="text" name="cod_postal">
</td>
</tr>
<tr><td>
<label>Ubicacion GPS:</label></td>
<td>
<input type="text" name="gps_ubicacion"/>
</td>
</tr>
</table>
</center>
</div>
<div style="background:#16555B;border-bottom-right-radius:10px;border-bottom-left-radius:10px;"><br>
		<input type="submit" name="enviar" value="Registrar" class="btn" />
		<input type="reset" value="Cancelar" class="btneliminar" /><br><br>
</div>
</form>

</center>
<div style="height:100px;"></div>
<div class="contbarra"></div>
 </div>
