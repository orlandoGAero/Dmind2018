<script type="text/javascript">
$(document).ready(function(){
		$("#clonar").click(function(){
			var fp = $(".fpais").val();
			var fcod = $(".fcod_postal").val();
			var fc = $(".fcalle").val();
			var fne = $(".fnum_ext").val();
			var fni = $(".fnum_int").val();
			var fco = $(".fcolonia").val();
			var flo = $(".flocalidad").val();
			var fre = $(".freferencia").val();
			var fmu = $(".fmunicipio").val();
			var fes = $(".festado").val();
			$(".pais").val(""+fp);
			$(".cod_postal").val(""+fcod);
			$(".calle").val(""+fc);
			$(".num_ext").val(""+fne);
			$(".num_int").val(""+fni);
			$(".colonia").val(""+fco);
			$(".localidad").val(""+flo);
			$(".referencia").val(""+fre);
			$(".municipio").val(""+fmu);
			$(".estado").val(""+fes);
		});
	    $(".btn").click(function(){
        var nom = $(".nombre").val();
        var tel =$(".telefono").val();
        var cat = $(".categoria").val();
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
	if (cat==0) {
		    $(".categoria").focus();
		       $("#alerta3").fadeIn();
		        return false;
	}else{
	$("#alerta3").fadeOut();
	}

//para velidar los datos fiscales
// expresion oara validar el rfc tambien funciona  /^[A-Z]{3,4}([0-9]{2})(1[0-2]|0[1-9])([0-3][0-9])([ -]?)([A-Z0-9]{4})$/
      if (raz == "") {
          $("#alerta5").fadeIn();
          return false;
      }else{
      	$("#alerta5").fadeOut();
	      if (rfc == "") {
	      	$(".rfc").focus();
	          $("#alerta6").fadeIn();
	          return false;
	      }else{
	      	$("#alerta6").fadeOut();
		   if ($(".rfc").val().match(/^[a-zA-Z]((\.|_|-)?[a-zA-Z0-9]+){3}$/)) { 
				$("#alerta6").fadeOut();
			}else {
				$("#alerta6").fadeIn();
				return false;
			}
	      }
      }
   if ($(".correo").val()==""){
   	$("#alertaco").fadeIn();
   	return false;
   }else{
   	$("#alertaco").fadeOut();
 
   }	
    });

});
</script>
<center>
<div class="scrollbar" id="barra" style="height:550px;">
<form action="guardar.php" style="width:600px;"> 
<br>
	<h2 style="background:#16555B; color:white;border-top-right-radius:10px;border-top-left-radius:10px;">NUEVO PROVEEDOR</h2>

<div style="background:#fff; text-align:justify;padding:20px;"><br>
<b>Fecha:</b><input type="date" value="<?php echo date("Y-m-d"); ?>" name="fecha" readonly="readonly" style="width:140px;border:none;"><br><br>
<h4>Datos Proveedor</h4>
	<b>Nombre:</b>
		<input name="nom_prov" type="text" class="nombre" />
		<spam id="alerta1" class="errores">Ingresa un nombre</spam>
		<br><br>
<b>Telefono:</b>
<input type="text" name="telefono" class="telefono" />
<spam id="alerta2" class="errores">Ingresa un telefono</spam><br><br>
	<b>Categoria:</b>
	<select name="id_categoria_prov" class="categoria" required><br>
	<option value=" ">Elige</option>
<?php 
include ("../../../conexion.php");
$query="SELECT * FROM categorias_proveedor";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	echo "<option value='",$fila[0],"'>",$fila[1],"</option>";
}

 ?>
		</select>
		<spam id="alerta3" class="errores">Elige una categoria</spam><br><br>
	<b>Direccion Web:</b>
	<input type="text" name="web" /><br>
<hr>
<h4>Datos Fiscales</h4>
<label>Razon Social:</label>
<input type="text" name="razonsocial" class="raz">
<spam id="alerta5" class="errores">Ingrese Razon Social</spam><br><br>
<label>RFC:</label>
<input type="text" name="rfc" class="rfc" />
<spam id="alerta6" class="errores">Ingrese RFC Correcto</spam><br><br>
	<b>Email:</b>
	<input type="text" name="email" class="correo" >
	<spam id="alertaco" class="errores">Ingrese email Correcto</spam>
	<spam id="alertaco2" class="errores">Ingrese email Correcto</spam><br> <br>
<b>Tipo Razon Social:</b><br>
<select name="tipoRason_Soc">
	<option value="Moral">Moral</option>
	<option value="Social">Social</option>
</select><br><br>
<hr>
<h4>Direccion Fiscal</h4>
<label>Pais:</label>
<input type="text" class="fpais" name="fpais"><br><br>
<label>Estado:</label>
<input type="text" class="festado" name="festado"><br><br>
<label>Municipio / Delegacion:</label>
<input type="text" class="fmunicipio" name="fmunicipio"><br><br>
<label>Localidad:</label>
<input type="text" class="flocalidad" name="flocalidad"><br><br>
<label>Codigo Postal:</label>
<input type="text" class="fcod_postal" name="fcod_postal"><br><br>
<label>Colonia:</label>
<input type="text" class="fcolonia" name="fcolonia"><br><br>
<label>Calle:</label>
<input type="text" class="fcalle" name="fcalle"><br><br>
<label>No. Exterior:</label>
<input type="text" class="fnum_ext" name="fnum_ext"><br><br>
<label>No. Interior:</label>
<input type="text" class="fnum_int" name="fnum_int"><br><br>
<label>Referencia:</label>
<input type="text" class="freferencia" name="freferencia"><br><br>
<hr>
<h4>Datos Bancarios</h4>
<label>Nombre Banco:</label>
<input type="text" name="nom_banco" /><br><br>
<label>Sucursal:</label>
<input type="text" name="sucursal" /><br><br>
<label>Titular:</label>
<input type="text" name="titular" /><br><br>
<label>No. Cuenta</label>
<input type="text" name="no_cuenta" /><br><br>
<label>No. Clave Interbancaria</label>
<input type="text" name="clav_inter"><br><br>
<label>Tipo Cuenta:</label>
<input type="text" name="tipo_cuenta" /><br><br>
<hr>
<b id="clonar">Clonar dirección</b>
<h4>Datos de Dirección Fisica</h4>
<label>Pais:</label>
<input type="text" class="pais" name="pais"><br><br>
<label>Estado:</label>
<input type="text" class="estado" name="estado"><br><br>
<label>Municipio:</label>
<input type="text" class="municipio" name="municipio"><br><br>
<label>Localidad:</label>
<input type="text" class="localidad" name="localidad"><br><br>
<label>Colonia:</label>
<input type="text" class="colonia" name="colonia"><br><br>
<label>Sucursal:</label>
<input type="text" class="dsucursal" name="dsucursal"><br><br>
<label>Codigo Postal:</label>
<input type="text" class="cod_postal" name="cod_postal"><br><br>
<label>Calle:</label>
<input type="text" class="calle" name="calle"><br><br>
<label>No. Exterior:</label>
<input type="text" class="num_ext" name="num_ext"><br><br>
<label>No. Interior:</label>
<input type="text" class="num_int" name="num_int"><br><br>
<label>Referencia:</label>
<input type="text" class="referencia" name="referencia"><br><br>
<label>Ubicacion GPS:</label>
<input type="text" name="gps_ubicacion"><br>
</div>
<div style="background:#16555B;border-bottom-right-radius:10px;border-bottom-left-radius:10px;"><br>
		<input type="submit" name="enviar" value="Registrar" class="btn" />
		<input type="reset" value="Limpiar" class="btneliminar" /><br><br>
</div>
</form>

</center>
<div style="height:100px;"></div>
<div class="contbarra"></div>
 </div>